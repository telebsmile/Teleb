<?php
/**
 * Teleb Contact Update Button
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Block\Adminhtml\Question\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class UpdateButton
 *
 * @package Teleb\Contact\Block\Adminhtml\Question\Edit
 */
class UpdateButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [
            'label' => __('Update'),
            'class' => 'change-status',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 40,
        ];

        return $data;
    }
}
