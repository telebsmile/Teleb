<?php
/**
 *  Teleb Contact Question model
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */

namespace Teleb\Contact\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Teleb\Contact\Api\Data\QuestionInterface;

/**
 * Class Question
 *
 * @package Teleb\Contact\Model
 *
 */
class Question extends AbstractModel implements QuestionInterface, IdentityInterface
{
    /**#@+
     * Question's Statuses
     */
    const STATUS_NOT_ANSWERED = 0;
    const STATUS_ANSWERED = 1;
    /**#@-*/

    /**
     * Question cache tag
     */
    const CACHE_TAG = 'teleb_contact_question';

    /**
     * Question construct
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Teleb\Contact\Model\ResourceModel\Question');
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Retrieve Question id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->getData(self::TELEPHONE);
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->getData(self::THEME);
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * Get creation time
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Get update time
     *
     * @return string
     */
    public function getUpdateAt()
    {
        return $this->getData(self::UPDATE_AT);
    }

    /**
     * Get is answered
     *
     * @return string
     */
    public function getIsAnswered()
    {
        return $this->getData(self::IS_ANSWERED);
    }

    /**
     * Set ID
     *
     * @param int $id
     *
     * @return QuestionInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return QuestionInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return QuestionInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return QuestionInterface
     */
    public function setTelephone($telephone)
    {
        return $this->setData(self::TELEPHONE, $telephone);
    }

    /**
     * Set theme
     *
     * @param string $theme
     *
     * @return QuestionInterface
     */
    public function setTheme($theme)
    {
        return $this->setData(self::THEME, $theme);
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return QuestionInterface
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return QuestionInterface
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     *
     * @return QuestionInterface
     */
    public function setCreatedAt($creationTime)
    {
        return $this->setData(self::CREATED_AT, $creationTime);
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     *
     * @return QuestionInterface
     */
    public function setUpdateAt($updateTime)
    {
        return $this->setData(self::UPDATE_AT, $updateTime);
    }

    /**
     * Set is Answered
     *
     * @param bool $isAnswered
     *
     * @return QuestionInterface
     */
    public function setIsAnswered($isAnswered)
    {
        return $this->setData(self::IS_ANSWERED, $isAnswered);
    }

    /**
     * Prepare question's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [
            self::STATUS_NOT_ANSWERED => __('No Answer'),
            self::STATUS_ANSWERED     => __('Answered'),
        ];
    }
}
