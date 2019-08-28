<?php
/**
 * Teleb Contact question delete button
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Block\Adminhtml\Question\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 *
 * @package Teleb\Contact\Block\Adminhtml\Question\Edit
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [
            'label' => __('Delete Question'),
            'class' => 'delete',
            'on_click' => 'deleteConfirm(\'' . __(
                'Are you sure you want delete this question?'
            ) . '\', \'' . $this->getDeleteUrl() . '\')',
            'sort_order' => 30,
        ];

        return $data;
    }

    /**
     * Get URL FOR delete button
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getQuestionId()]);
    }
}
