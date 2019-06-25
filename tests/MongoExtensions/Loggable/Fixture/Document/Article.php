<?php

namespace MongoExtensions\Tests\Loggable\Fixture\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use MongoExtensions\Mapping\Annotation as MongoExtensions;

/**
 * @ODM\Document(collection="articles")
 * @MongoExtensions\Loggable
 */
class Article
{
    /** @ODM\Id */
    private $id;

    /**
     * @MongoExtensions\Versioned
     * @ODM\Field(type="string")
     */
    private $title;

    /**
     * @ODM\EmbedOne(targetDocument=Author::class)
     * @MongoExtensions\Versioned
     */
    private $author;

    public function __toString()
    {
        return $this->title;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }
}
