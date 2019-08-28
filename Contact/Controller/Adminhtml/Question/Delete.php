<?php
/**
 * Teleb Contact question delete
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Teleb\Contact\Api\QuestionRepositoryInterface;

/**
 * Class Delete
 *
 * @package Teleb\Contact\Controller\Adminhtml\Question
 */
class Delete extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Teleb_Contact::contact_question_delete';

    /**
     * Question repository interface
     *
     * @var QuestionRepositoryInterface
     */
    private $questionRepository;

    /**
     * Delete constructor
     *
     * @param Action\Context              $context
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Action\Context              $context,
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->questionRepository = $questionRepository;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $questionRepository = $this->questionRepository;
                $questionRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('The question has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a question to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
