# Magento 2 OPcache GUI PHP Performance Dashboard

Magento 2 Opcache Control GUI using React Frontend Micro-services (https://github.com/amnuts/opcache-gui). 

<img width="1374" height="937" alt="Capture d’écran 2025-08-19 à 20 51 57" src="https://github.com/user-attachments/assets/df8ff91d-d4af-462e-85bd-ee851a1a57cb" />

## Where to find in the Admin Menu

System -> Tools -> OpCache GUI

## Installation 

Copy to App code, Setup, and compile as always. 

This Extension doesn't need static content generation it uses CDN version of React JS. So, you can install with flag *--keep-generated*

or use composer: 
```
composer require amadeco/module-db-override
```

## Magento 2 Opcache best settings

The biggest Magento 2 performance issue is the wrong (default) PHP OPcache settings. 

Check your PHP settings with this module:
```
opcache.enable = 1
opcache.enable_cli = 0
opcache.memory_consumption = 556
opcache.max_accelerated_files = 1000000
opcache.validate_timestamps = 0
opcache.interned_strings_buffer=64
opcache.max_wasted_percentage=5
opcache.save_comments=1
opcache.fast_shutdown=1
```

## CLI opcache settings 
should be a separate cli config file like */etc/php/8.1/cli/conf.d/10-opcache.ini*
```
zend_extension=opcache.so
opcache.memory_consumption=1000M
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=10000000
opcache.validate_timestamps=1
; opcache.revalidate_freq=2
opcache.enable_cli=1
opcache.file_cache=/tmp/
opcache.file_cache_only=0
opcache.file_cache_consistency_checks=1
```  
