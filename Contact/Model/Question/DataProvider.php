<?php
/**
 * Teleb Contact Question DataProvider
 *
 * @category  Teleb
 * @package   Teleb\Contact
 * @author    Tetiana Lebed <teleb@smile.fr>
 * @copyright 2019 Smile
 */
namespace Teleb\Contact\Model\Question;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Store\Model\StoreManagerInterface;
use Teleb\Contact\Model\ResourceModel\Question\Collection as QuestionCollection;
use Teleb\Contact\Model\ResourceModel\Question\CollectionFactory;

/**
 * Class DataProvider
 *
 * @package Teleb\Contact\Model\Question
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * Question collection
     *
     * @var QuestionCollection
     */
    protected $collection;

    /**
     * Data persistor interface
     *
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * Loaded data
     *
     * @var array
     */
    private $loadedData;

    /**
     * Store manager
     *
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * DataProvider constructor
     *
     * @param string                 $name
     * @param string                 $primaryFieldName
     * @param string                 $requestFieldName
     * @param CollectionFactory      $questionCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param StoreManagerInterface  $storeManager
     * @param array                  $meta
     * @param array                  $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $questionCollectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $questionCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if ($this->loadedData === null) {
            $this->loadedData = [];
            $items = $this->collection->getItems();

            foreach ($items as $question) {
                $this->loadedData[$question->getId()] = $question->getData();
            }

            $data = $this->dataPersistor->get('teleb_contact_question');
            if (!empty($data)) {
                $question = $this->collection->getNewEmptyItem();
                $question->setData($data);
                $this->loadedData[$question->getId()] = $question->getData();
                $this->dataPersistor->clear('teleb_contact_question');
            }
        }

        return $this->loadedData;
    }
}
