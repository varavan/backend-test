<?php

namespace Caravelo\Modules\Survey\Infrastructure\Repository;


use Caravelo\Modules\Survey\Domain\Model\Question;
use Caravelo\Modules\Survey\Infrastructure\Component\FilesystemYmlReader;
use Caravelo\Modules\Survey\Infrastructure\Factory\AnswerFactory;

class QuestionRepositoryFilesystem
{
    /**
     * @var FilesystemYmlReader
     */
    private $questionFilesystemYmlReader;
    /**
     * @var AnswerFactory
     */
    private $answerFactory;

    public function __construct(
        FilesystemYmlReader $questionFilesystemYmlReader,
        AnswerFactory $answerFactory
    )
    {
        $this->questionFilesystemYmlReader = $questionFilesystemYmlReader;
        $this->answerFactory = $answerFactory;
    }

    /**
     * @param $surveySlug
     * @return Question[]
     */
    public function findBySurveySlug($surveySlug)
    {

        $questionsRaw = $this->questionFilesystemYmlReader->findByAttribute('survey', $surveySlug);

        return ($questionsRaw == false)
            ? []
            : array_map(
                function ($questionRaw) {
                    $question =  new Question(
                        $questionRaw['id'],
                        $questionRaw['title'],
                        new \DateTime($questionRaw['createdAt'])
                    );

                    for($i = 0; $i <= 3; $i++){
                        $question->addAnswer($this->answerFactory->makeAnswer($this->fakeConsistentId($question, $i)));
                    }

                    return $question;
                }, $questionsRaw
            );
    }

    /**
     * @param Question $question
     * @param $i
     * @return mixed
     */
    private function fakeConsistentId(Question $question, $i)
    {
        return ($question->getId() * 100) + $i;
    }
}