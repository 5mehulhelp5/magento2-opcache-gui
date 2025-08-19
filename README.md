Source: [@Genaker/Magento2OPcacheGUI ](https://github.com/Genaker/Magento2OPcacheGUI) Updating to integrate opcache-gui (https://github.com/amnuts/opcache-gui) via composer

# Magento 2 OPcache GUI PHP Performance Dashboard

Magento 2 Opcache Control GUI using React Frontend Micro-services. 

![Magento 2 Opcache GUI](https://github.com/user-attachments/assets/60f1a3aa-8c34-45ef-9b63-db3d9385b883)

# Where to find in the Admin Menu

System -> React -> OpCache GUI

# Installation 

Copy to App code, Setup, and compile as always. 

This Extension doesn't need static content generation it uses CDN version of React JS. So, you can install with flag *--keep-generated*

or use composer: 
```
composer require amadeco/module-db-override
```

# Magento 2 Opcache best settings

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

# CLI opcache settings 
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

# PHP BogoMIPS performance measurement

New feature has been added. Now you will have PHP performance test on GUI open. 

Magento 2 is CPU CPU-intensive platform due to bad framework design. You should use the fastest CPU to achieve a good page rendering performance. If Magento 2 takes a 2GHz processor core 3 seconds to process a request, then the same request would be returned in around 2 seconds by a 3GHz processor core. Test your PHP performance. 

![Magento 2 PHP performance](https://github.com/user-attachments/assets/b7aed8ba-f179-4e61-b338-30812a7d798d)

AWS C5.large has *0.032* PHP 7.3.23 performance score (less is better). <br/>
AWS R5.xlarge has *0.039* PHP 7.2.34 performance score (less is better). <br/>
AWS C8.xlarge has *0.029* PHP 8.1 performance score (less is better), CLI performace is: 0.066 for Cli opcache doesn't work it is well known PHP issue <br/>

Two types of BogoMIPS performance are measured from the CLI and from the web interface cached by OPcache.
