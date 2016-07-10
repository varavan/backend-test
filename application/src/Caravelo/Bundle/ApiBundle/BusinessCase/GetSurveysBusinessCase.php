<?php

namespace Caravelo\Bundle\ApiBundle\BusinessCase;

use Caravelo\Bundle\ApiBundle\Component\SurveyMatchTagFilter;
use Caravelo\Bundle\ApiBundle\Model\SurveyDto;
use Caravelo\Bundle\ApiBundle\Model\TagDto;
use Caravelo\Modules\Survey\Domain\Service\SurveyService;

class GetSurveysBusinessCase
{
    /**
     * @var SurveyService
     */
    private $surveyService;
    /**
     * @var SurveyMatchTagFilter
     */
    private $surveyMatchTagFilter;

    public function __construct(
        SurveyService $surveyService,
        SurveyMatchTagFilter $surveyMatchTagFilter)
    {
        $this->surveyService = $surveyService;
        $this->surveyMatchTagFilter = $surveyMatchTagFilter;
    }

    /**
     * @param bool $tagSlug
     * @return \Caravelo\Bundle\ApiBundle\Model\SurveyDto[]
     */
    public function getSurveys($tagSlug = false)
    {
        $surveys = $this->surveyService->getSurveys();
        $surveysDto = [];

        foreach ($surveys as $survey) {
            $surveyDto = new SurveyDto();
            $surveyDto->parseSurvey($survey);
            $surveysDto[] = $surveyDto;
        }

        if ($tagSlug != false) {

            $surveysDto = $this->surveyMatchTagFilter->filter($surveysDto, $tagSlug);
        }

        return $surveysDto;
    }
}