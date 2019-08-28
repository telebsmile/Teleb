<?php
/**
 * Teleb Contact question actions
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Teleb\Contact\Model\Question;

/**
 * Class QuestionActions
 *
 * @package Teleb\Contact\Ui\Component\Listing\Column
 */
class QuestionActions extends Column
{
    /**
     * Url path
     */
    const URL_PATH_EDIT = 'teleb_contact/question/edit';
    const URL_PATH_ANSWER = 'teleb_contact/question/send';
    const URL_PATH_DELETE = 'teleb_contact/question/delete';

    /**
     * Url builder
     *
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data
        );
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href'  => $this->urlBuilder->getUrl(
                            static::URL_PATH_EDIT,
                            [
                                'id' => $item['id'],
                            ]
                        ),
                        'label' => __('Edit'),
                    ],
                    'delete' => [
                        'href'  => $this->urlBuilder->getUrl(
                            static::URL_PATH_DELETE,
                            [
                                'id' => $item['id'],
                            ]
                        ),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete question from user %1', $item['name']),
                            'message' => __('Are you sure you want to delete a question from user %1 ?', $item['name'])
                        ]
                    ],
                ];

                if ($item['answer'] && !$item['is_answered']) {
                    $item[$this->getData('name')]['send'] = [
                            'href'  => $this->urlBuilder->getUrl(
                                static::URL_PATH_ANSWER,
                                [
                                    'id' => $item['id'],
                                ]
                            ),
                            'label' => __('Send'),
                    ];
                }
            }
        }

        return $dataSource;
    }
}
