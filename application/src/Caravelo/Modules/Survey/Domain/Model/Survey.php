<?php

namespace Caravelo\Modules\Survey\Domain\Model;

use Caravelo\Component\Slugify;

class Survey
{
    /** @var  string $name */
    private $name;

    /** @var  string $slug */
    private $slug;

    /** @var  string $description */
    private $description;

    /** @var  Tag[] $tags */
    private $tags = [];

    /** @var  Question[] */
    private $questions = [];

    /** @var  \DateTime $createdAt */
    private $createdAt;

    /**
     * Survey constructor.
     * @param string $name
     * @param string $description
     * @param \DateTime $createdAt
     */
    public function __construct($name, $description, \DateTime $createdAt)
    {
        $this->name = $name;
        $this->slug = Slugify::resolve($name);
        $this->description = $description;
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return Question[]
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * @param Question $question
     */
    public function addQuestion(Question $question)
    {
        $this->questions[] = $question;
    }

    /**
     * @param array $questions
     */
    public function addQuestions($questions){
        array_walk(
            $questions,
            function(Question $question){
                $this->addQuestion($question);
            }
        );
    }

    /**
     * @param array $tags
     */
    public function addTags($tags){
        array_walk(
            $tags,
            function(Tag $tag){
                $this->addTag($tag);
            }
        );
    }
}