<?php
/**
 * Teleb Contact Question Interface
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Api\Data;

/**
 * Interface QuestionInterface
 *
 * @package Teleb\Contact\Api\Data
 */
interface QuestionInterface
{
    /**
     * Table name
     */
    const TABLE_NAME = 'teleb_contact_question';

    /**#@+
     * Constants defined for keys of data array.
     */
    const ID          = 'id';
    const NAME        = 'name';
    const EMAIL       = 'email';
    const TELEPHONE   = 'telephone';
    const THEME       = 'theme';
    const COMMENT     = 'comment';
    const ANSWER      = 'answer';
    const CREATED_AT  = 'created_at';
    const UPDATE_AT   = 'update_at';
    const IS_ANSWERED = 'is_answered';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int
     */
    public function getId();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone();

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme();

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment();

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer();

    /**
     * Get creation time
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Get update time
     *
     * @return string
     */
    public function getUpdateAt();

    /**
     * Get is answered
     *
     * @return bool
     */
    public function getIsAnswered();

    /**
     * Set ID
     *
     * @param int $id
     *
     * @return QuestionInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param string $name
     *
     * @return QuestionInterface
     */
    public function setName($name);

    /**
     * Set email
     *
     * @param string $email
     *
     * @return QuestionInterface
     */
    public function setEmail($email);

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return QuestionInterface
     */
    public function setTelephone($telephone);

    /**
     * Set theme
     *
     * @param string $theme
     *
     * @return QuestionInterface
     */
    public function setTheme($theme);

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return QuestionInterface
     */
    public function setComment($comment);

    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return QuestionInterface
     */
    public function setAnswer($answer);

    /**
     * Set creation time
     *
     * @param string $creationTime
     *
     * @return QuestionInterface
     */
    public function setCreatedAt($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     *
     * @return QuestionInterface
     */
    public function setUpdateAt($updateTime);

    /**
     * Set question is answered
     *
     * @param bool $isAnswered
     *
     * @return QuestionInterface
     */
    public function setIsAnswered($isAnswered);
}
