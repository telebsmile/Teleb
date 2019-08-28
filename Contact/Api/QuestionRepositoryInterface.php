<?php
/**
 * Teleb Contact question repository interface
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Teleb\Contact\Api\Data\QuestionInterface;

/**
 * Interface QuestionRepositoryInterface
 *
 * @package Teleb\Contact\Api
 */
interface QuestionRepositoryInterface
{
    /**
     * Retrieve a question by it's id
     *
     * @param int $objectId
     *
     * @return QuestionRepositoryInterface
     */
    public function getById($objectId);

    /**
     * Retrieve questions which match a specified criteria.
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     *
     * @return \Magento\Framework\Api\SearchResults
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null);

    /**
     * Save question
     *
     * @param QuestionInterface $object
     *
     * @return QuestionRepositoryInterface
     */
    public function save(QuestionInterface $object);

    /**
     * Delete a question by its id
     *
     * @param int $objectId
     *
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById($objectId);
}
