<?php

namespace Caravelo\Modules\Survey\Infrastructure\Repository;


use Caravelo\Modules\Survey\Domain\Model\Tag;
use Caravelo\Modules\Survey\Infrastructure\Component\FilesystemYmlReader;

class TagRepositoryFilesystem
{

    /**
     * @var FilesystemYmlReader
     */
    private $tagFilesystemYmlReader;

    public function __construct(
        FilesystemYmlReader $tagFilesystemYmlReader
    )
    {
        $this->tagFilesystemYmlReader = $tagFilesystemYmlReader;
    }

    /**
     * @param $surveySlug
     * @return Tag[]
     */
    public function findBySurveySlug($surveySlug)
    {
        $tagsRaw = $this->tagFilesystemYmlReader->findByAttribute('survey', $surveySlug);

        return ($tagsRaw == false)
            ? []
            : array_map(
                function ($tagRaw) {
                    return new Tag(
                        $tagRaw['name'],
                        $tagRaw['description'],
                        new \DateTime($tagRaw['createdAt'])
                    );
                }, $tagsRaw
            );
    }

}