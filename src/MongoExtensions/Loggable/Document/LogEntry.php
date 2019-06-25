<?php

namespace MongoExtensions\Loggable\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoODM;

/**
 *
 *
 * @MongoODM\Document(
 *     repositoryClass="MongoExtensions\Loggable\Document\Repository\LogEntryRepository",
 *     indexes={
 *         @MongoODM\Index(keys={"objectId"="asc", "objectClass"="asc", "version"="asc"}),
 *         @MongoODM\Index(keys={"loggedAt"="asc"}),
 *         @MongoODM\Index(keys={"objectClass"="asc"}),
 *         @MongoODM\Index(keys={"username"="asc"})
 *     }
 * )
 */
class LogEntry extends MappedSuperclass\AbstractLogEntry
{
    /**
     * All required columns are mapped through inherited superclass
     */
}
