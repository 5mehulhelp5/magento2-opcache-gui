<?php
/**
 * OPcache GUI module registration
 *
 * @category  Genaker
 * @package   Genaker_Opcache
 * @author    Yehor Shytikov, Ilan Parmentier
 * @copyright Copyright © 2020-2025 Genaker, Amadeco. All rights reserved.
 * @license   MIT License
 */
declare(strict_types=1);

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(ComponentRegistrar::MODULE, 'Genaker_Opcache', __DIR__);
