<?php

namespace MongoExtensions\SoftDeletable\Filter;

use Doctrine\ODM\MongoDB\Query\Filter\BsonFilter;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use MongoExtensions\SoftDeletable\SoftDeletableListener;

class SoftDeletableFilter extends BsonFilter
{
    protected $listener;
    protected $documentManager;
    protected $disabled = array();

    /**
     * Gets the criteria part to add to a query.
     *
     * @param ClassMetadata $class
     *
     * @return array The criteria array, if there is available, empty array otherwise
     */
    public function addFilterCriteria(ClassMetadata $class): array
    {
        $className = $class->getName();
        if (array_key_exists($className, $this->disabled) && $this->disabled[$className] === true) {
            return array();
        } elseif (array_key_exists($class->rootDocumentName, $this->disabled) && $this->disabled[$class->rootDocumentName] === true) {
            return array();
        }

        $config = $this->getListener()->getConfiguration($this->getDocumentManager(), $class->name);

        if (!isset($config['softDeleteable']) || !$config['softDeleteable']) {
            return array();
        }

        $column = $class->fieldMappings[$config['fieldName']];

        if (isset($config['timeAware']) && $config['timeAware']) {
            return array(
                '$or' => array(
                    array($column['fieldName'] => null),
                    array($column['fieldName'] => array('$gt' => new \DateTime('now'))),
                ),
            );
        }

        return array(
            $column['fieldName'] => null,
        );
    }

    protected function getListener()
    {
        if ($this->listener === null) {
            $em = $this->getDocumentManager();
            $evm = $em->getEventManager();

            foreach ($evm->getListeners() as $listeners) {
                foreach ($listeners as $listener) {
                    if ($listener instanceof SoftDeletableListener) {
                        $this->listener = $listener;

                        break 2;
                    }
                }
            }

            if ($this->listener === null) {
                throw new \RuntimeException('Listener "SoftDeletableListener" was not added to the EventManager!');
            }
        }

        return $this->listener;
    }

    protected function getDocumentManager()
    {
        if ($this->documentManager === null) {
            $refl = new \ReflectionProperty('Doctrine\ODM\MongoDB\Query\Filter\BsonFilter', 'dm');
            $refl->setAccessible(true);
            $this->documentManager = $refl->getValue($this);
        }

        return $this->documentManager;
    }

    public function disableForDocument($class)
    {
        $this->disabled[$class] = true;
    }

    public function enableForDocument($class)
    {
        $this->disabled[$class] = false;
    }
}
