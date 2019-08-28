<?php
/**
 * Teleb Contact Edit Question
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Teleb\Contact\Api\QuestionRepositoryInterface;
use Teleb\Contact\Model\Question;

/**
 * Class Edit
 *
 * @package Teleb\Contact\Controller\Adminhtml\Question
 */
class Edit extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Teleb_Contact::contact_question_save';

    /**
     * Core registry
     *
     * @var Registry
     */
    private $coreRegistry;

    /**
     * Page factory
     *
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * Question repository interface
     *
     * @var QuestionRepositoryInterface
     */
    private $questionRepository;

    /**
     * Edit constructor
     *
     * @param Action\Context              $context
     * @param PageFactory                 $resultPageFactory
     * @param Registry                    $registry
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $registry;
        $this->questionRepository = $questionRepository;
        parent::__construct($context);
    }

    /**
     * Edit Question page
     *
     * @return \Magento\Backend\Model\View\Result\Page | \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $id = $this->getRequest()->getParam('id');
        $resultPage->getConfig()->getTitle()->prepend(__('Question Information'));

        try {
            /** @var Question $model */
            $model = $this->questionRepository->getById($id);
            $resultPage->getConfig()->getTitle()->prepend(__('Edit question from user %1', $model->getName()));

        } catch (NoSuchEntityException $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while editing user question.'));
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();

            return $resultRedirect->setPath('*/*/');
        }
        $this->coreRegistry->register('teleb_contact_question', $model);

        $resultPage->addBreadcrumb(__('Edit Contact Question'), __('Edit Contact Question'));

        return $resultPage;
    }
}
