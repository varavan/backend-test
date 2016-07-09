<?php

namespace Caravelo\Bundle\ApiBundle\BusinessCase;


use Caravelo\Bundle\ApiBundle\Model\SurveyDto;
use Caravelo\Modules\Survey\Domain\Service\SurveyService;

class GetSurveyBusinessCase
{
    /**
     * @var SurveyService
     */
    private $surveyService;

    public function __construct(SurveyService $surveyService)
    {
        $this->surveyService = $surveyService;
    }

    /**
     * @param $surveySlug
     * @return bool|SurveyDto
     */
    public function getSurvey($surveySlug)
    {
        $survey = $this->surveyService->getSurvey($surveySlug);

        if($survey == false)
        {
            return false;
        }

        $surveyDto = new SurveyDto();
        $surveyDto->parseSurvey($survey);

        return $surveyDto;
    }
}