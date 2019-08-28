<?php
/**
 * Teleb Contact question generic button
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Block\Adminhtml\Question\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Teleb\Contact\Api\QuestionRepositoryInterface;

/**
 * Class GenericButton
 *
 * @package Teleb\Contact\Block\Adminhtml\Question\Edit
 */
class GenericButton
{
    /**
     * Context
     *
     * @var Context
     */
    private $context;

    /**
     * Question repository interface
     *
     * @var QuestionRepositoryInterface
     */
    private $questionRepository;

    /**
     * GenericButton constructor
     *
     * @param Context                     $context
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Context $context,
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->context = $context;
        $this->questionRepository = $questionRepository;
    }

    /**
     * Get Question ID
     *
     * @return int
     */
    public function getQuestionId()
    {
        try {
            $modelId = $this->context->getRequest()->getParam('id');

            return $this->questionRepository->getById($modelId)->getId();
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array  $params
     *
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
