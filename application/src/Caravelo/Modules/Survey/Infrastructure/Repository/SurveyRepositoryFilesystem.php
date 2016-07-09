<?php

namespace Caravelo\Modules\Survey\Infrastructure\Repository;

use Caravelo\Modules\Survey\Domain\Model\Survey;
use Caravelo\Modules\Survey\Domain\Repository\SurveyRepositoryInterface;
use Caravelo\Modules\Survey\Infrastructure\Component\FilesystemYmlReader;

class SurveyRepositoryFilesystem implements SurveyRepositoryInterface
{

    /**
     * @var FilesystemYmlReader
     */
    private $surveyFilesystemYmlReader;
    /**
     * @var QuestionRepositoryFilesystem
     */
    private $questionRepositoryFilesystem;
    /**
     * @var TagRepositoryFilesystem
     */
    private $tagRepositoryFilesystem;

    public function __construct(
        FilesystemYmlReader $surveyFilesystemYmlReader,
        QuestionRepositoryFilesystem $questionRepositoryFilesystem,
        TagRepositoryFilesystem $tagRepositoryFilesystem
    )
    {
        $this->surveyFilesystemYmlReader = $surveyFilesystemYmlReader;
        $this->questionRepositoryFilesystem = $questionRepositoryFilesystem;
        $this->tagRepositoryFilesystem = $tagRepositoryFilesystem;
    }

    /**
     * @return Survey[]
     */
    public function findAll()
    {
        $surveysRaw = $this->surveyFilesystemYmlReader->getContent();

        return ($surveysRaw == false || $surveysRaw == [])
            ? []
            : array_map(
                function ($surveyRaw) {
                    return $this->makeSurvey($surveyRaw);
                }, $surveysRaw
            );
    }

    /**
     * @param $slug
     * @return Survey | false
     */
    public function findOneBySlug($slug)
    {
        $surveyRaw = $this->surveyFilesystemYmlReader->findByAttribute('slug', $slug);
        return ($surveyRaw == false || empty($surveyRaw))
            ? false
            : $this->makeSurvey(end($surveyRaw));
    }

    /**
     * @param $surveyRaw
     * @return Survey
     */
    private function makeSurvey($surveyRaw)
    {
        $survey = new Survey(
            $surveyRaw['name'],
            $surveyRaw['description'],
            new \DateTime($surveyRaw['createdAt'])
        );

        $survey->addQuestions($this->questionRepositoryFilesystem->findBySurveySlug($survey->getSlug()));
        $survey->addTags($this->tagRepositoryFilesystem->findBySurveySlug($survey->getSlug()));

        return $survey;
    }
}