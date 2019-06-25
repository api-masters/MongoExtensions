<?php

namespace MongoExtensions\Tests\Loggable\Fixture\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use MongoExtensions\Mapping\Annotation as MongoExtensions;

/**
 * @ODM\EmbeddedDocument
 * @MongoExtensions\Loggable
 */
class Author
{
    /**
     * @MongoExtensions\Versioned
     * @ODM\Field(type="string")
     */
    private $name;

    /**
     * @MongoExtensions\Versioned
     * @ODM\Field(type="string")
     */
    private $email;

    public function __toString()
    {
        return $this->getName();
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
