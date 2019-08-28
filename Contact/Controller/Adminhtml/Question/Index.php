<?php
/**
 * Teleb Contact Question Index
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Teleb
 */
namespace Teleb\Contact\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 *
 * @package Teleb\Contact\Controller\Adminhtml\Question
 */
class Index extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Teleb_Contact::contact_question';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     *
     * @param Context     $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $pageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Teleb_Contact::question');
        $resultPage->addBreadcrumb(__('Teleb Contact Questions'), __('Teleb Contact Questions'));
        $resultPage->addBreadcrumb(__('Teleb Contact Questions'), __('Teleb Contact Questions'));
        $resultPage->getConfig()->getTitle()->prepend(__('Teleb Contact Questions'));

        return $resultPage;
    }
}
