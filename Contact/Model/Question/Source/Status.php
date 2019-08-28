<?php
/**
 * Teleb Contact Question Status
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Model\Question\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Teleb\Contact\Model\Question;
/**
 * Class Status
 *
 * @package Teleb\Contact\Model\Question\Source
 */
class Status implements OptionSourceInterface
{
    /**
     * Question
     *
     * @var Question
     */
    private $question;

    /**
     * Status constructor
     *
     * @param Question $question
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->question->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
