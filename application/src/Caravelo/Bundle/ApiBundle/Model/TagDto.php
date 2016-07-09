<?php

namespace Caravelo\Bundle\ApiBundle\Model;


use Caravelo\Modules\Survey\Domain\Model\Tag;

class TagDto
{
    public $name;

    public $slug;

    public $description;

    public $createdAt;

    /**
     * @param Tag $tag
     * @return $this
     */
    public function parseTag(Tag $tag)
    {
        $this->name = $tag->getName();
        $this->slug = $tag->getSlug();
        $this->description = $tag->getDescription();
        $this->createdAt = $tag->getCreatedAt()->format('Y-M-D\TH:I');

        return $this;
    }
}