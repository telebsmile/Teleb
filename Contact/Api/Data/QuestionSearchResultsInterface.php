<?php
/**
 * Teleb Contact question search results interface
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface QuestionSearchResultsInterface
 *
 * @package Teleb\Contact\Api\Data
 */
interface QuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get questions list
     *
     * @return \Teleb\Contact\Api\Data\QuestionInterface[]
     */
    public function getItems();

    /**
     * Set questions list
     *
     * @param \Teleb\Contact\Api\Data\QuestionInterface[] $items
     *
     * @return QuestionSearchResultsInterface
     */
    public function setItems(array $items);
}
