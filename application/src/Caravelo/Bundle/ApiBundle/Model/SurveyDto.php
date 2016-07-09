<?php
namespace Caravelo\Bundle\ApiBundle\Model;

use Caravelo\Modules\Survey\Domain\Model\Survey;

class SurveyDto
{
    public $name;

    public $slug;

    public $description;

    public $tags = [];

    public $questions = [];

    /**
     * @param Survey $survey
     * @return $this
     */
    public function parseSurvey(Survey $survey)
    {
        $this->name = $survey->getName();
        $this->slug = $survey->getSlug();
        $this->description = $survey->getDescription();

        foreach ($survey->getQuestions() as $question) {
            $questionDto = new QuestionDto();
            $questionDto->parseQuestion($question);
            $this->questions[] = $questionDto;
        }

        foreach ($survey->getTags() as $tag) {
            $tagDto = new TagDto();
            $tagDto->parseTag($tag);
            $this->tags[] = $tagDto;
        }

        return $this;
    }
}