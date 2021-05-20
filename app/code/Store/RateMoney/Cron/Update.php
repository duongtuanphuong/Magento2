<?php


namespace Store\RateMoney\Cron;

use Magento\Framework\Exception\CronException;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\HTTP\Client\Curl;
use Store\RateMoney\Model\Rate;
use Store\RateMoney\Model\ResourceModel;
use Zend\Json\Decoder;
use Zend\Json\Json;
use Psr\Log\LoggerInterface;

class Update
{
    private $objectManager;
    private $resource;
    private $_curl;

    public function __construct(
        ObjectManagerInterface $objectManager,
        ResourceModel\Rate $resource,
        Curl $curl
    )
    {
        $this->objectManager = $objectManager;
        $this->resource = $resource;
        $this->_curl = $curl;
    }

    public function execute()
    {
        $rate = $this->getRateapi();

        if (null === $rate) {
            return $this;
        }

        try {
     

            $this->resource->save($rate);
        } catch (\Exception $e) {
            $this->objectManager->get(LoggerInterface::class)->error($e->getMessage());
        }

       
    }

    private function getRateapi(): ?Rate
    {
        $uri = 'https://currencyapi.net/api/v1/rates';
        $client = new \Zend\Http\Client($uri, [
            'timeout' => 30
        ]);
          $client->setParameterGet(
            [
                'key' => '8ZE90gHk7JsYBvfqthFsOmdRdmW57YR0BoPE'
            ]
        );

        try {
            $response = $client->send();
            $data = Decoder::decode($response->getBody(), Json::TYPE_ARRAY);

            if (200 !== $response->getStatusCode()) {
                $this->objectManager->get(LoggerInterface::class)->error($data['message']);
                throw new CronException($data['message']);
            }
        } catch (\Exception $e) {
            $this->objectManager->get(LoggerInterface::class)->error($e->getMessage());

            return null;
        }

        /** @var Rate $rate */
        $rate = $this->objectManager->create(Rate::class);
        
              $rate->setData(
            [
                // 'usd' =>$data['rates']['USD']
                'eur' =>$data['rates']['EUR'],
                'lak' =>$data['rates']['LAK'],
                'thb' =>$data['rates']['THB'],
                'krw' =>$data['rates']['KRW'],
                'inr' =>$data['rates']['INR'],
                'btc' =>$data['rates']['BTC'],
                'jpy' =>$data['rates']['JPY'],
                'rub' =>$data['rates']['RUB'],
                'vnd' =>$data['rates']['VND']
            ]
        );
        
      

        return $rate;
    }
}