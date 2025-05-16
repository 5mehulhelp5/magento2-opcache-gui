<?php
/**
 * OPcache GUI administration controller
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
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Response\Http as ResponseHttp;

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
    public const ADMIN_RESOURCE = 'Genaker_Opcache::index_gui';

    /**
     * @var PageFactory
     */
    private PageFactory $resultPageFactory;

    /**
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
     * @throws LocalizedException
     */
    public function execute(): ResultInterface
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Genaker_Opcache::index_gui');
        $resultPage->getConfig()->getTitle()->prepend(__('PHP OPcache GUI'));
        
        return $resultPage;
    }
}
