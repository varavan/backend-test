<?php

namespace Caravelo\Bundle\ApiBundle\Model;

use Caravelo\Modules\Survey\Domain\Model\Question;

class QuestionDto
{
    public $id;

    public $title;

    public $createdAt;

    public $answers = [];

    public function parseQuestion(Question $question)
    {
        $this->id = $question->getId();
        $this->title = $question->getTitle();
        $this->createdAt = $question->getCreatedAt()->format('Y-M-D\TH:I');


        foreach($question->getAnswers() as $answer)
        {
            $answerDto = new AnswerDto();
            $answerDto->parseAnswer($answer);
            $this->answers[] = $answerDto;
        }
    }
}