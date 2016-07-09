<?php

namespace Caravelo\Modules\Survey\Domain\Model;


class Question
{
    /** @var int $id */
    private $id;

    /** @var  string $title */
    private $title;

    /** @var  Answer[] $answers */
    private $answers = [];

    /** @var  \DateTime $createdAt */
    private $createdAt;

    /**
     * Question constructor.
     * @param int $id
     * @param string $title
     * @param \DateTime $createdAt
     */
    public function __construct($id, $title, \DateTime $createdAt)
    {
        $this->id = $id;
        $this->title = $title;
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return Answer[]
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function addAnswer(Answer $answer)
    {
        $this->answers[] = $answer;
    }
}