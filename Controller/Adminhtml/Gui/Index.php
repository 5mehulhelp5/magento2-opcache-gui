<?php
/**
 * OPcache GUI index controller
 *
 * @category  Amadeco
 * @package   Amadeco_OpcacheGui
 * @author    Ilan Parmentier
 * @copyright Copyright © Amadeco. All rights reserved.
 * @license   MIT License
 */
declare(strict_types=1);

namespace Amadeco\OpcacheGui\Controller\Adminhtml\Gui;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Main controller for the OPcache GUI module
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Amadeco_OpcacheGui::gui_index';

    /**
     * Page factory for creating result pages
     *
     * @var PageFactory
     */
    private PageFactory $resultPageFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Amadeco_OpcacheGui::gui_index');
        $resultPage->getConfig()->getTitle()->prepend(__('PHP OpCache Dashboard'));

        return $resultPage;
    }
}