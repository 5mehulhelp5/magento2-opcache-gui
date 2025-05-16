<?php
/**
 * OPcache GUI administration block
 *
 * @category  Genaker
 * @package   Genaker_Opcache
 * @author    Ilan Parmentier
 * @copyright Copyright © 2020-2025 Amadeco. All rights reserved.
 * @license   MIT License
 */
declare(strict_types=1);

namespace Genaker\Opcache\Block\Adminhtml\Index;

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
