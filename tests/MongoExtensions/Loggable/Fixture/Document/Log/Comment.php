<?php

namespace MongoExtensions\Tests\Loggable\Fixture\Document\Log;

use MongoExtensions\Loggable\Document\MappedSuperclass\AbstractLogEntry;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(
 *     collection="test_comment_log_entries",
 *     repositoryClass="MongoExtensions\Loggable\Document\Repository\LogEntryRepository"
 * )
 */
class Comment extends AbstractLogEntry
{
}
