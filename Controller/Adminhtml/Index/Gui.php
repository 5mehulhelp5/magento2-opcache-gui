<?php
/**
 * Controller for the OPcache GUI interface
 *
 * @category Amadeco
 * @package Amadeco_OpcacheGui
 * @author Ilan Parmentier, Yehor Shytikov
 * @copyright Copyright © 2020-2025 Genaker, Amadeco. All rights reserved.
 * @license MIT License
 */
declare(strict_types=1);

namespace Amadeco\OpcacheGui\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\View\LayoutFactory;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Controller for the OPcache GUI interface
 */
class Gui extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Amadeco_OpcacheGui::index_gui';

    /**
     * @var RawFactory
     */
    private $resultRawFactory;

    /**
     * @var LayoutFactory
     */
    private $layoutFactory;

    /**
     * @var ProductMetadataInterface
     */
    private $productMetadata;

    /**
     * Constructor
     *
     * @param Context $context
     * @param RawFactory $resultRawFactory
     * @param LayoutFactory $layoutFactory
     * @param ProductMetadataInterface $productMetadata
     */
    public function __construct(
        Context $context,
        RawFactory $resultRawFactory,
        LayoutFactory $layoutFactory,
        ProductMetadataInterface $productMetadata
    ) {
        $this->resultRawFactory = $resultRawFactory;
        $this->layoutFactory = $layoutFactory;
        $this->productMetadata = $productMetadata;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     * @throws LocalizedException
     */
    public function execute(): ResultInterface
    {
        if (!isset($_SERVER['SERVER_SOFTWARE'])) {
            $_SERVER['SERVER_SOFTWARE'] = 'Magento/' . $this->productMetadata->getVersion();
        }

        $result = $this->resultRawFactory->create();

        $layout = $this->layoutFactory->create();

        $block = $layout->createBlock(
            \Amadeco\OpcacheGui\Block\Adminhtml\Index\Gui::class,
            'index.gui'
        )->setTemplate('Amadeco_OpcacheGui::index/gui.phtml');

        $result->setHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->setContents($block->toHtml());

        return $result;
    }
}
