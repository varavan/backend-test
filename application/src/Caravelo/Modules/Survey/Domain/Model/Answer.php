<?php

namespace Caravelo\Modules\Survey\Domain\Model;


class Answer
{

    /** @var  int $id */
    private $id;

    /** @var string $content */
    private $content;

    /** @var  \DateTime $createdAt */
    private $createdAt;

    /**
     * Answer constructor.
     * @param int $id
     * @param string $content
     * @param \DateTime $createdAt
     */
    public function __construct($id, $content, \DateTime $createdAt)
    {
        $this->id = $id;
        $this->content = $content;
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}