<?php
/**
 *  Teleb Contact Plugin BeforeContactPostExecute
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */

namespace Teleb\Contact\Plugin\Controller\Index;

use Magento\Contact\Controller\Index\Post as ContactPost;
use Magento\Framework\App\Request\Http as Request;
use Magento\Framework\Exception\CouldNotSaveException;
use Teleb\Contact\Model\QuestionFactory;
use Teleb\Contact\Model\QuestionRepository;
use Psr\Log\LoggerInterface;

class BeforeContactPostExecute
{
    /**
     * Question Factory
     *
     * @var QuestionFactory
     */
    protected $questionFactory;

    /**
     * Question Repository
     *
     * @var QuestionRepository
     */
    protected $questionRepository;

    /**
     * Logger
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * BeforeContactPostExecute constructor.
     *
     * @param QuestionFactory    $questionFactory
     * @param QuestionRepository $questionRepository
     * @param LoggerInterface    $logger
     */
    public function __construct(
        QuestionFactory $questionFactory,
        QuestionRepository $questionRepository,
        LoggerInterface $logger
    ) {
        $this->questionFactory = $questionFactory;
        $this->questionRepository = $questionRepository;
        $this->logger = $logger;
    }

    /**
     * Contact Post Before Execute Plugin
     *
     * @param ContactPost $contactPost
     */
    public function beforeExecute(ContactPost $contactPost)
    {
        /** @var Request $request */
        $request = $contactPost->getRequest();
        $postData = $request->getPostValue();
        if (!empty($postData)) {
            $question = $this->questionFactory->create();
            $question->setData($postData);

            try {
                $this->questionRepository->save($question);
            } catch (CouldNotSaveException $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
