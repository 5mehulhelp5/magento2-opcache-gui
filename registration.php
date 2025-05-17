<?php
/**
 * OPcache GUI module registration
 *
 * @category  Amadeco
 * @package   Amadeco_OpcacheGui
 * @author    Yehor Shytikov, Ilan Parmentier
 * @copyright Copyright © 2020-2025 Genaker, Amadeco. All rights reserved.
 * @license   MIT License
 */
declare(strict_types=1);

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(ComponentRegistrar::MODULE, 'Amadeco_OpcacheGui', __DIR__);
