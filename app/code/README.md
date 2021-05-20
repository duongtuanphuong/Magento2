# module-magento2
php bin/magento setup:upgarade

php bin/magento cache:clean

php bin/magento cron:run --group="default"
