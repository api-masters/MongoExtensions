<?php

namespace MongoExtensions\Tests\Loggable\Fixture\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use MongoExtensions\Mapping\Annotation as MongoExtensions;

/**
 * @ODM\Document
 * @MongoExtensions\Loggable
 */
class RelatedArticle
{
    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @MongoExtensions\Versioned
     * @ODM\Field(type="string")
     */
    private $title;

    /**
     * @MongoExtensions\Versioned
     * @ODM\Field(type="string")
     */
    private $content;

    /**
     * @ODM\ReferenceMany(targetDocument=Comment::class, mappedBy="article")
     */
    private $comments;

    public function getId()
    {
        return $this->id;
    }

    public function addComment(Comment $comment)
    {
        $comment->setArticle($this);
        $this->comments[] = $comment;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
}
