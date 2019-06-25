<?php

namespace MongoExtensions\Tests\Loggable\Fixture\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use MongoExtensions\Mapping\Annotation as MongoExtensions;

/**
 * @ODM\Document
 * @MongoExtensions\Loggable(logEntryClass="MongoExtensions\Tests\Loggable\Fixture\Document\Log\Comment")
 */
class Comment
{
    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @MongoExtensions\Versioned
     * @ODM\Field(type="string")
     */
    private $subject;

    /**
     * @MongoExtensions\Versioned
     * @ODM\Field(type="string")
     */
    private $message;

    /**
     * @MongoExtensions\Versioned
     * @ODM\ReferenceOne(targetDocument=RelatedArticle::class, inversedBy="comments")
     */
    private $article;

    /**
     * @ODM\EmbedOne(targetDocument=Author::class)
     * @MongoExtensions\Versioned
     */
    private $author;

    public function setArticle($article)
    {
        $this->article = $article;
    }

    public function getArticle()
    {
        return $this->article;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
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
