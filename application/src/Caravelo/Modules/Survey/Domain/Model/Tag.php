<?php

namespace Caravelo\Modules\Survey\Domain\Model;


use Caravelo\Component\Slugify;

class Tag
{

    /** @var  string $name */
    private $name;

    /** @var  string $slug */
    private $slug;

    /** @var  string $description */
    private $description;

    /** @var  \DateTime $createdAt */
    private $createdAt;

    /**
     * Tag constructor.
     * @param string $name
     * @param string $slug
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
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}