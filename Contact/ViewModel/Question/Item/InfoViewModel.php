<?php
/**
 * Teleb Contact InfoViewModel
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\ViewModel\Question\Item;

use Teleb\Contact\Model\QuestionRepository;
use Teleb\Contact\Ui\Component\Listing\Column\QuestionActions;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\UrlInterface;

/**
 * Class InfoViewModel
 *
 * @package Teleb\Contact\ViewModel\Question\Item
 */
class InfoViewModel implements ArgumentInterface
{
    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * QuestionRepository
     *
     * @var QuestionRepository
     */
    private $questionRepository;

    /**
     * Url Builder
     *
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * InfoViewModel constructor.
     *
     * @param Registry       $registry
     * @param QuestionRepository $questionRepository
     */
    public function __construct(
        Registry $registry,
        QuestionRepository $questionRepository,
        UrlInterface $urlBuilder
    ) {
        $this->coreRegistry = $registry;
        $this->questionRepository = $questionRepository;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Get Question
     *
     * @return \Teleb\Contact\Model\Question
     */
    public function getQuestion()
    {
        return $this->coreRegistry->registry('teleb_contact_question');
    }

    /**
     * Get Question
     *
     * @param $id
     *
     * @return \Teleb\Contact\Model\Question|null
     */
    public function getQuestionById($id)
    {
        try {
            $question = $this->questionRepository->getById($id);
        } catch (NoSuchEntityException $e) {
            $question = null;
        }

        return $question;
    }

    /**
     * Get Question Url
     *
     * @param string $questionId
     *
     * @return string
     */
    public function getQuestionUrl($questionId)
    {
        return $this->urlBuilder->getUrl(
            QuestionActions::URL_PATH_ANSWER,
            ['id' => $questionId]
        );
    }
}
