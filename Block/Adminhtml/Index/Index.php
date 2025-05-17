<?php
/**
 * OPcache GUI index block
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
use Magento\Backend\Model\UrlInterface;

/**
 * Admin block for OPcache GUI main page
 */
class Index extends Template
{
    /**
     * Backend URL interface
     *
     * @var UrlInterface
     */
    protected UrlInterface $backendUrl;
    
    /**
     * Constructor
     *
     * @param Context      $context
     * @param UrlInterface $backendUrl
     * @param array        $data
     */
    public function __construct(
        Context $context,
        UrlInterface $backendUrl,
        array $data = []
    ) {
        $this->backendUrl = $backendUrl;
        parent::__construct($context, $data);
    }
    
    /**
     * Get OPcache GUI URL
     *
     * @return string
     */
    public function getGuiUrl(): string
    {
        return $this->backendUrl->getUrl('opcache_gui/index/gui');
    }
}
