<?php
/**
 * OPcache GUI administration block
 *
 * @category  Amadeco
 * @package   Amadeco_OpcacheGui
 * @author    Ilan Parmentier, Yehor Shytikov
 * @copyright Copyright © 2020-2025 Genaker, Amadeco. All rights reserved.
 * @license   MIT License
 */
declare(strict_types=1);

namespace Amadeco\OpcacheGui\Block\Adminhtml\Index;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;

/**
 * Admin block for OPcache GUI interface
 */
class Gui extends Template
{
    /**
     * Constructor
     *
     * @param Context $context
     * @param array   $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
}
