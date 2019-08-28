<?php
/**
 * Teleb Contact SendButton
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Block\Adminhtml\Question\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SendButton
 *
 * @package Teleb\Contact\Block\Adminhtml\Question\Edit
 */
class SendButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [
            'label' => __('Send Answer'),
            'class' => 'send primary',
            'on_click' => sprintf("location.href = '%s';", $this->getSendAnswerUrl()),
            'sort_order' => 90,
        ];

        return $data;
    }

    /**
     * Get URL FOR send email button
     *
     * @return string
     */
    public function getSendAnswerUrl()
    {
        return $this->getUrl('*/*/send', ['id' => $this->getQuestionId()]);
    }
}
