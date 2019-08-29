<?php
/**
 * Teleb Contact  Update
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\NoSuchEntityException;
use Teleb\Contact\Api\QuestionRepositoryInterface;
use Teleb\Contact\Model\QuestionFactory;

/**
 * Class Update
 *
 * @package Teleb\Contact\Controller\Adminhtml\Question
 */
class Update extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Teleb_Contact::contact_question_save';

    /**
     * Data persistor interface
     *
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * Question factory
     *
     * @var QuestionFactory
     */
    private $questionFactory;

    /**
     * Question repository interface
     *
     * @var QuestionRepositoryInterface
     */
    private $questionRepository;

    /**
     * Update constructor
     *
     * @param Action\Context              $context
     * @param DataPersistorInterface      $dataPersistor
     * @param QuestionRepositoryInterface $questionRepository
     * @param QuestionFactory             $questionFactory
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        QuestionRepositoryInterface $questionRepository,
        QuestionFactory $questionFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->questionRepository = $questionRepository;
        $this->questionFactory = $questionFactory;
        parent::__construct($context);
    }

    /**
     * Update action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $postObject = new DataObject();
            $postObject->setData($data);

            $id = $this->getRequest()->getParam('id');

            try {
                $model = $this->questionRepository->getById($id);
                $model->setData($data);
                $this->questionRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You updated data.'));
                $this->dataPersistor->clear('teleb_contact_question');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while update data.'));
            }

            $this->dataPersistor->set('teleb_contact_question', $data);

            return $resultRedirect->setPath(
                '*/*/edit',
                ['id' => $this->getRequest()->getParam('id')]
            );
        }

        return $resultRedirect->setPath('*/*/');
    }
}
