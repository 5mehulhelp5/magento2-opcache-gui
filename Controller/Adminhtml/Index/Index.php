<?php
/**
 * OPcache GUI index controller
 *
 * @category  Genaker
 * @package   Genaker_Opcache
 * @author    Yehor Shytikov
 * @copyright Copyright © 2020-2025 Genaker. All rights reserved.
 * @license   MIT License
 */
declare(strict_types=1);

namespace Genaker\Opcache\Controller\Adminhtml\Index;

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
    public const ADMIN_RESOURCE = 'Genaker_Opcache::index_index';

    /**
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
        $resultPage->setActiveMenu('Genaker_Opcache::index_index');
        $resultPage->getConfig()->getTitle()->prepend(__('PHP OPcache Dashboard'));

        return $resultPage;
    }
}
