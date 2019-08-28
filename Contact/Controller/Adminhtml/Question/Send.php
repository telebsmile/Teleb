<?php
/**
 * Teleb Contact Send
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect as ResultRedirect;
use Magento\Framework\App\Area;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\Store;
use Magento\Framework\Mail\Template\TransportBuilder;
use Teleb\Contact\Api\Data\QuestionInterface;
use Teleb\Contact\Api\QuestionRepositoryInterface;

/**
 * Class Send
 *
 * @package Teleb\Contact\Controller\Adminhtml\Question
 */
class Send extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Teleb_Contact::contact_question_answer';

    /**
     * #@+
     * Config path const
     */
    const SEND_ANSWER_FOR_QUESTION_EMAIL_TEMPLATE = 'teleb_contact/email_template/contact_question_answer';
    const SEND_ANSWER_FOR_QUESTION_SENDER_EMAIL = 'trans_email/ident_general/email';
    const SEND_ANSWER_FOR_QUESTION_SENDER_NAME = 'trans_email/ident_general/name';
    /**#@-*/

    /**
     * Scope config interface
     *
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Question Repository
     *
     * @var QuestionRepositoryInterface
     */
    private $questionRepository;

    /**
     * Transport Builder
     *
     * @var TransportBuilder
     */
    private $transportBuilder;

    /**
     * Send constructor.
     *
     * @param Action\Context             $context
     * @param QuestionRepositoryInterface $questionRepository
     * @param TransportBuilder           $transportBuilder
     * @param ScopeConfigInterface       $scopeConfig
     */
    public function __construct(
        Action\Context $context,
        QuestionRepositoryInterface $questionRepository,
        TransportBuilder $transportBuilder,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->questionRepository = $questionRepository;
        $this->transportBuilder = $transportBuilder;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * Send Action
     *
     * @return ResultRedirect
     */
    public function execute()
    {
        /** @var ResultRedirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            $id = $this->getRequest()->getParam('id');
            /** @var QuestionInterface $question */
            $question = $this->questionRepository->getById($id);
        } catch (NoSuchEntityException $error) {
            $this->messageManager->addErrorMessage($error->getMessage());

            return $resultRedirect->setPath('*/*/');
        }

        $answer = $question->getAnswer();

        if ($answer) {
            try {
                $customerEmail = $question->getEmail();
                $customerName = $question->getName();
                $adminEmail = $this->getAdminEmail();
                $adminName = $this->getAdminName();
                $emailData = [
                    'userName'   => $customerName,
                    'answer' => $answer,
                    'theme' => $question->getTheme(),
                    'comment' => $question->getComment(),
                ];

                $transport = $this->transportBuilder
                    ->setTemplateIdentifier($this->getEmailTemplate())
                    ->setTemplateOptions([
                        'area' => Area::AREA_FRONTEND,
                        'store' => Store::DEFAULT_STORE_ID
                    ])->setTemplateVars($emailData)
                    ->setFrom(['name' => $adminName,'email' => $adminEmail])
                    ->addTo($customerEmail, $customerName)
                    ->getTransport();
                $transport->sendMessage();

                $this->messageManager->addSuccessMessage(__('Email has been sent successfully.'));

                return $resultRedirect->setPath('*/*/');
            } catch(\Exception $e){
                $this->messageManager->addErrorMessage($e->getMessage());
                $resultRedirect->setUrl($this->_redirect->getRefererUrl());

                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('Save answer before send email.'));

        return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
    }

    /**
     * Get Email Template
     *
     * @return string
     */
    public function getEmailTemplate()
    {
        return $this->scopeConfig->getValue(static::SEND_ANSWER_FOR_QUESTION_EMAIL_TEMPLATE);
    }

    /**
     * Get Admin Email
     *
     * @return string
     */
    public function getAdminEmail()
    {
        return $this->scopeConfig->getValue(static::SEND_ANSWER_FOR_QUESTION_SENDER_EMAIL);
    }

    /**
     * Get Admin Name
     *
     * @return string
     */
    public function getAdminName()
    {
        return $this->scopeConfig->getValue(static::SEND_ANSWER_FOR_QUESTION_SENDER_NAME);
    }
}
