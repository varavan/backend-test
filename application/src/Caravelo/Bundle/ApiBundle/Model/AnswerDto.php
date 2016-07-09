<?php

namespace Caravelo\Bundle\ApiBundle\Model;

use Caravelo\Modules\Survey\Domain\Model\Answer;

class AnswerDto
{
    public $id;

    public $content;

    public $createdAt;

    public function parseAnswer(Answer $answer)
    {
        $this->id = $answer->getId();
        $this->content = $answer->getContent();
        $this->createdAt = $answer->getCreatedAt()->format('Y-M-D\TH:I');
    }
}