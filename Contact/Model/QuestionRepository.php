<?php
/**
 * Teleb Contact question repository
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Teleb\Contact\Api\Data;
use Teleb\Contact\Api\QuestionRepositoryInterface;
use Teleb\Contact\Model\ResourceModel\Question as ResourceQuestion;
use Teleb\Contact\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;

/**
 * Class QuestionRepository
 *
 * @package Teleb\Contact\Model
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * Resource question
     *
     * @var ResourceQuestion
     */
    private $resource;

    /**
     * Question factory
     *
     * @var QuestionFactory
     */
    private $questionFactory;

    /**
     * Question collection factory
     *
     * @var QuestionCollectionFactory
     */
    private $questionCollectionFactory;

    /**
     * Question search results interface factory
     *
     * @var questionSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * QuestionRepository constructor
     *
     * @param ResourceQuestion                           $resource
     * @param QuestionFactory                            $questionFactory
     * @param QuestionCollectionFactory                  $questionCollectionFactory
     * @param Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceQuestion $resource,
        QuestionFactory $questionFactory,
        QuestionCollectionFactory $questionCollectionFactory,
        Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->questionFactory = $questionFactory;
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save Question data
     *
     * @param \Teleb\Contact\Api\Data\QuestionInterface $question
     *
     * @return Question
     *
     * @throws CouldNotSaveException
     */
    public function save(Data\QuestionInterface $question)
    {
        try {
            $this->resource->save($question);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $question;
    }

    /**
     * Load Question data by given Question Identity
     *
     * @param string $questionId
     *
     * @return Question
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($questionId)
    {
        $question = $this->questionFactory->create();
        $this->resource->load($question, $questionId);
        if (!$question->getId()) {
            throw new NoSuchEntityException(__('Question with id "%1" does not exist.', $questionId));
        }

        return $question;
    }

    /**
     * Load Question data collection by given search criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     *
     * @return \Teleb\Contact\Model\ResourceModel\Question\Collection
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function getList(SearchCriteriaInterface $criteria = null)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $collection = $this->questionCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $question = [];
        /** @var Data\QuestionInterface $questionModel */
        foreach ($collection as $questionModel) {
            $question[] = $questionModel;
        }
        $searchResults->setItems($question);

        return $searchResults;
    }

    /**
     * Delete Question
     *
     * @param \Teleb\Contact\Api\Data\QuestionInterface $question
     *
     * @return bool
     *
     * @throws CouldNotDeleteException
     */
    public function delete(Data\QuestionInterface $question)
    {
        try {
            $this->resource->delete($question);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * Delete Question by given Question Identity
     *
     * @param string $questionId
     *
     * @return bool
     *
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($questionId)
    {
        return $this->delete($this->getById($questionId));
    }
}
