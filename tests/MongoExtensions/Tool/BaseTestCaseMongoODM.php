<?php

namespace MongoExtensions\Tests\Tool;

use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Common\EventManager;
use MongoDB\Client;
use MongoDB\Collection;
use MongoExtensions\SoftDeletable\SoftDeletableListener;


/**
 * Base test case contains common mock objects
 * and functionality among all extensions using
 * ORM object manager
 *
 * @author Gediminas Morkevicius <gediminas.morkevicius@gmail.com>
 * @link http://www.gediminasm.org
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
abstract class BaseTestCaseMongoODM extends \PHPUnit\Framework\TestCase
{
    /**
     * @var DocumentManager
     */
    protected $dm;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        if (!class_exists('MongoDB\Client')) {
            $this->markTestSkipped('Missing MongoDB extension.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function expectException($exception) : void
    {
        if (method_exists('PHPUnit\\Framework\\TestCase', 'setExpectedException')) {
            parent::setExpectedException($exception);
        }

        parent::expectException($exception);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown() : void
    {
        if ($this->dm) {
            foreach ($this->dm->getDocumentDatabases() as $db) {
                foreach ($db->listCollections() as $collectionInfo) {
                    $collection = new Collection($this->dm->getClient()->getManager(), 'gedmo_extensions_test', $collectionInfo->getName());
                    $collection->drop();
                }
            }
            $this->dm->close();
            $this->dm = null;
        }
    }

    /**
     * DocumentManager mock object together with
     * annotation mapping driver and database
     *
     * @param EventManager $evm
     *
     * @return DocumentManager
     */
    protected function getMockDocumentManager(EventManager $evm = null, $config = null)
    {
        $conn = new Client('mongodb://shadz3rg:101010@127.0.0.1', [], ['typeMap' => DocumentManager::CLIENT_TYPEMAP]);

        $config = $config ? $config : $this->getMockAnnotatedConfig();

        try {
            $this->dm = DocumentManager::create($conn, $config, $evm ?: $this->getEventManager());
            //$this->dm->getConnection()->connect();
        } catch (\MongoException $e) {
            $this->markTestSkipped('Doctrine MongoDB ODM failed to connect');
        }

        return $this->dm;
    }

    /**
     * DocumentManager mock object with
     * annotation mapping driver
     *
     * @param EventManager $evm
     *
     * @return DocumentManager
     */
    protected function getMockMappedDocumentManager(EventManager $evm = null, $config = null)
    {
        $conn = $this->getMockBuilder('Doctrine\\MongoDB\\Connection')->getMock();

        $config = $config ? $config : $this->getMockAnnotatedConfig();

        $this->dm = DocumentManager::create($conn, $config, $evm ?: $this->getEventManager());

        return $this->dm;
    }

    /**
     * Creates default mapping driver
     *
     * @return \Doctrine\ORM\Mapping\Driver\Driver
     */
    protected function getMetadataDriverImplementation()
    {
        return new AnnotationDriver($_ENV['annotation_reader']);
    }

    /**
     * Build event manager
     *
     * @return EventManager
     */
    private function getEventManager()
    {
        $evm = new EventManager();
        /*$evm->addEventSubscriber(new SluggableListener());
        $evm->addEventSubscriber(new LoggableListener());
        $evm->addEventSubscriber(new TranslatableListener());
        $evm->addEventSubscriber(new TimestampableListener());*/
        $evm->addEventSubscriber(new SoftDeletableListener());

        return $evm;
    }

    /**
     * Get annotation mapping configuration
     *
     * @return Configuration
     */
    protected function getMockAnnotatedConfig()
    {
        $config = new Configuration();
        $config->addFilter("softdeleteable", 'MongoExtensions\\SoftDeletable\\Filter\\ODM\\SoftDeletableFilter');
        $config->setProxyDir(__DIR__."/../../temp");
        $config->setHydratorDir(__DIR__."/../../temp");
        $config->setProxyNamespace("Proxy");
        $config->setHydratorNamespace("Hydrator");
        $config->setDefaultDB("gedmo_extensions_test");
        $config->setAutoGenerateProxyClasses(Configuration::AUTOGENERATE_EVAL);
        $config->setAutoGenerateHydratorClasses(Configuration::AUTOGENERATE_EVAL);
        $config->setMetadataDriverImpl($this->getMetadataDriverImplementation());
        return $config;
    }
}
