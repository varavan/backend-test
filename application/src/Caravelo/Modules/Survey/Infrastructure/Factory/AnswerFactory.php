<?php

namespace Caravelo\Modules\Survey\Infrastructure\Factory;

use Caravelo\Modules\Survey\Domain\Model\Answer;
use Caravelo\Modules\Survey\Infrastructure\Component\FilesystemYmlReader;

class AnswerFactory
{
    /**
     * @var FilesystemYmlReader
     */
    private $answerFilesystemYmlReader;
    /**
     * @var array
     */
    private $answerTemplate;

    public function __construct(FilesystemYmlReader $answerFilesystemYmlReader)
    {
        $this->answerFilesystemYmlReader = $answerFilesystemYmlReader;
        $content = $this->answerFilesystemYmlReader->getContent();
        $this->answerTemplate = end($content);
    }

    public function makeAnswer($id)
    {
        return new Answer(
            $id,
            $this->answerTemplate['content'],
            new \DateTime($this->answerTemplate['createdAt'])
        );
    }
}