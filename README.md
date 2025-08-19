# Magento 2 OPcache GUI PHP Performance Dashboard

[![Latest Stable Version](https://img.shields.io/badge/version-1.0.0-brightgreen.svg)](https://github.com/amadeco/module-opcache-gui)
[![Magento 2](https://img.shields.io/badge/Magento-2.4.x-orange.svg)](https://magento.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://www.php.net)
[![License](https://img.shields.io/badge/license-MIT-yellowgreen.svg)](https://opensource.org/licenses/MIT)

> Advanced OPcache monitoring and control GUI for Magento 2, implemented with React for a responsive and modern experience.

![Magento 2 Opcache GUI](https://github.com/user-attachments/assets/2631bd76-da57-4a58-9ac8-13d5548759b1)

## Features

- **Real-time OPcache Monitoring**: View memory usage, hit/miss ratio, and cached scripts
- **Performance Metrics**: Track OPcache efficiency and PHP performance
- **Cache Control**: Reset cache, invalidate files, or force file refresh
- **Configuration Viewer**: Examine your current OPcache configuration
- **React-based Interface**: Modern, responsive UI built with React (Integrates with [amnuts/opcache-gui](https://github.com/amnuts/opcache-gui))
- **Script Analysis**: Identify which files consume the most cache memory

## Installation

### Option 1: Composer (Recommended)

```bash
composer require amadeco/module-opcache-gui
bin/magento module:enable Amadeco_OpcacheGui
bin/magento setup:upgrade --keep-generated
bin/magento cache:clean
```

> This extension uses CDN-hosted React components and doesn't require static content generation, allowing installation with the `--keep-generated` flag.

### Option 2: Manual Installation

1. Download or clone the repository
2. Copy the files to `app/code/Amadeco/OpcacheGui/`
3. Run the following commands:

```bash
bin/magento module:enable Amadeco_OpcacheGui
bin/magento setup:upgrade --keep-generated
bin/magento cache:clean
```

## Usage

### Accessing the Dashboard

Navigate to **System → Tools → PHP OpCache Dashboard** in your Magento Admin Panel.

## OPcache Optimization Guide

### Recommended PHP OPcache Settings for Magento 2

```ini
opcache.enable = 1
opcache.enable_cli = 0
opcache.memory_consumption = 1024
opcache.interned_strings_buffer = 128
opcache.max_accelerated_files = 60000
;
; Production Mode
;
opcache.validate_timestamps = 0
;
; Development Mode
;
;opcache.validate_timestamps = 1
;opcache.revalidate_freq = 10
;
opcache.save_comments = 1
opcache.enable_file_override = 0
```

### Technical Tips

#### Tip 1: Calculate Your Required Cache Size

```bash
# Calculate the exact number of PHP files in your Magento codebase
find . -type f -print | grep php | wc -l
```

Set `opcache.max_accelerated_files` to this number plus a 25% margin, rounded to the nearest higher prime number for optimal hash table performance.

#### Tip 2: Implement Selective PHP Preloading

For Magento 2, selective preloading is vastly more efficient than preloading all files:

```php
// Example preload.php for Magento 2
function preload($path) {
    static $loaded = 0;
    if ($loaded >= 500) return;
    
    if (is_file($path) && preg_match("/\.php$/", $path)) {
        opcache_compile_file($path);
        $loaded++;
    }
}

// Only preload essential core files
preload(__DIR__ . '/vendor/magento/framework/App/Bootstrap.php');
preload(__DIR__ . '/vendor/magento/framework/App/Http.php');
// Additional critical files...
```

References:
- [Magento Community Issue #98](https://github.com/magento/community-features/issues/98#issuecomment-481635316)
- [Example Implementation](https://github.com/MonogoPolska/monogo-m2-preload)

#### Tip 3: Avoid JIT Compilation for Magento 2

JIT compilation causes segfaults with Magento 2 and provides minimal performance gains:

```ini
; Disable JIT for Magento 2
opcache.jit_buffer_size = 0
opcache.jit = off
```

Reference: [Magento 2 PHP 8.2 JIT Performance Analysis](https://yegorshytikov.medium.com/magento-2-adobe-commerce-php-8-2-jit-performance-how-faster-is-magento-2-with-jit-876bdb8641a1)

#### Tip 4: Blacklist Non-Essential Files

Create an `opcache.blacklist` file to exclude test directories and rarely-used files:

```
/home/USER/public_html/vendor/*/Test/*
/home/USER/public_html/vendor/*/tests/*
/home/USER/public_html/dev/*
/home/USER/public_html/setup/*
```

Then reference it in your php.ini or pool configuration:
```ini
opcache.blacklist_filename = /path/to/opcache.blacklist
```

#### Tip 5: Separate CLI and Web Process Configurations

For optimal performance, maintain distinct OPcache configurations for CLI and web processes:

**CLI Configuration** (`/etc/php/8.x/cli/php.ini`):
```ini
;
; OpCache Config
;
opcache.enable = 1
opcache.enable_cli = 1
opcache.memory_consumption = 512
opcache.interned_strings_buffer = 32
opcache.max_accelerated_files = 30000
opcache.max_wasted_percentage = 5
opcache.use_cwd = 1
;
; Magento mode Production
;
;opcache.validate_timestamps = 0
;
; Magento mode Developpement
;
opcache.validate_timestamps = 1
;opcache.revalidate_freq = 10
opcache.file_update_protection = 0
opcache.revalidate_path = 0
opcache.save_comments = 1
opcache.load_comments = 1
opcache.enable_file_override = 0
opcache.optimization_level = 0xffffffff
opcache.blacklist_filename = "/home/**USER**/opcache.blacklist"
opcache.max_file_size = 0
opcache.consistency_checks = 0
opcache.force_restart_timeout = 60
opcache.error_log = "/var/log/php-fpm/opcache.log"
;opcache.log_verbosity_level = 1
opcache.log_verbosity_level = 3
opcache.preferred_memory_model = ""
opcache.protect_memory = 0
;
;
;
opcache.file_cache = "/tmp/"
opcache.file_cache_only = 1
opcache.file_cache_consistency_checks = 1
opcache.huge_code_pages = 1
;
; Support for PHP >7.4 Preload Feature #98
;
; Issue : https://github.com/magento/community-features/issues/98#issuecomment-481635316
; Magento 2 simple preload : https://github.com/MonogoPolska/monogo-m2-preload
;
; Doesn't work in CLI with config opcache.file_cache_only = 1
;
;opcache.preload = "/home/**USER**/public_html/preload.php"
;opcache.preload_user = **PHP-USER**
;
; JIT Just In Time Compilation
;
;opcache.jit = 1235
;opcache.jit_buffer_size = 536870912
opcache.jit = off
opcache.jit_buffer_size = 0
```

**Web Processes Configuration** (`/etc/php/8.x/fpm/php.ini`):
```ini
;
; OpCache Config
; 
opcache.enable = 1
opcache.enable_cli = 0
opcache.use_cwd = 1
opcache.validate_root = 1
opcache.revalidate_path = 0
;
; Magento mode Production
;
opcache.validate_timestamps = 0
; 
; Magento mode Developpement
;
;opcache.validate_timestamps = 1
;opcache.revalidate_freq = 10
opcache.save_comments = 1
opcache.enable_file_override = 0
opcache.consistency_checks = 0
opcache.protect_memory = 0
opcache.memory_consumption = 1024
opcache.interned_strings_buffer = 256
;
; Quickly calculate the number of files in our codebase.
; find . -type f -print | grep php | wc -l
;
opcache.max_accelerated_files = 120000
opcache.max_wasted_percentage = 15
opcache.file_update_protection = 2
opcache.optimization_level = 0xffffffff
;opcache.blacklist_filename = "/home/**USER**/opcache.blacklist"
opcache.max_file_size = 0
opcache.force_restart_timeout = 60
opcache.error_log = "/home/**USER**/public_html/var/log/opcache.log"
opcache.log_verbosity_level = 2
opcache.preferred_memory_model = ""
opcache.huge_code_pages = 1
```

**Key Differences Explained**:

| Setting | CLI | Web | Reason |
|---------|-----|-----|--------|
| `memory_consumption` | 512MB | 1024MB | CLI needs less memory since it handles one command at a time |
| `interned_strings_buffer` | 32MB | 256MB | Web processes handle more unique strings from templates |
| `validate_timestamps` | On | Off | CLI tools need to see file changes immediately |
| `file_cache_only` | On | Off | CLI benefits from file-based cache for persistence |
| `max_accelerated_files` | 30000 | 120000 | CLI uses fewer files than web processes |
| `log_verbosity_level` | 3 | 2 | More detailed logging helps with CLI debugging |

#### Tip 6: PHP-FPM Pool Partitioning for Frontend and Admin

Split your PHP-FPM configuration into separate pools for frontend and admin:

```ini
# /etc/php/8.1/fpm/pool.d/magento-frontend.conf
[magento-frontend]
user = www-data
listen = /var/run/php-fpm-magento-frontend.sock
pm = dynamic
pm.max_children = 120
pm.start_servers = 20
pm.min_spare_servers = 10
pm.max_spare_servers = 35

# /etc/php/8.1/fpm/pool.d/magento-admin.conf
[magento-admin]
user = www-data
listen = /var/run/php-fpm-magento-admin.sock
pm = dynamic
pm.max_children = 20
pm.start_servers = 5
pm.min_spare_servers = 3
pm.max_spare_servers = 10
```

Then configure NGINX to route requests accordingly:

```nginx
# Frontend requests
location ~ ^/(pub|static|media)/.*\.php$ {
    fastcgi_pass unix:/var/run/php-fpm-magento-frontend.sock;
    # Additional FastCGI settings...
}

# Admin requests
location ~ ^/admin {
    fastcgi_pass unix:/var/run/php-fpm-magento-admin.sock;
    # Additional FastCGI settings...
}
```

Benefits:
- Better resource allocation based on specific needs
- Isolation of admin processes from customer-facing frontend
- Prevents admin-intensive tasks from impacting storefront performance
- More efficient OPcache utilization for each context

## Configuration Location Matters

OPcache memory settings must be configured in php.ini rather than in PHP-FPM pool configuration files:

1. **Initialization Order**: OPcache initializes early in PHP's startup process, before pool configurations are processed
   
2. **Shared Memory Allocation**: Settings like `memory_consumption` define system-level allocations that must be consistent across PHP-FPM pools
   
3. **Global vs. Pool-specific Settings**: Some directives only work when set globally in php.ini

## Credits

- Based on [Genaker/Magento2OPcacheGUI](https://github.com/Genaker/Magento2OPcacheGUI)
- Integrates with [amnuts/opcache-gui](https://github.com/amnuts/opcache-gui)
- Enhanced by [Amadeco](https://www.amadeco.fr)

## License

[MIT License](LICENSE.md)
