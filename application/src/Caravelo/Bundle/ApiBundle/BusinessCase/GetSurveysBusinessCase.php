<?php

namespace Caravelo\Bundle\ApiBundle\BusinessCase;

use Caravelo\Bundle\ApiBundle\Model\SurveyDto;
use Caravelo\Modules\Survey\Domain\Service\SurveyService;

class GetSurveysBusinessCase
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
     * @return SurveyDto[]
     */
    public function getSurveys()
    {
        $surveys =  $this->surveyService->getSurveys();
        $surveysDto = [];

        foreach($surveys as $survey)
        {
            $surveyDto = new SurveyDto();
            $surveyDto->parseSurvey($survey);
            $surveysDto[] = $surveyDto;
        }

        return $surveysDto;
    }
}