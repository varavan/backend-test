<?php

namespace Caravelo\Bundle\ApiBundle\BusinessCase;

use Caravelo\Bundle\ApiBundle\Model\SurveyDto;
use Caravelo\Bundle\ApiBundle\Model\TagDto;
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
            $surveysDto = array_filter(
                $surveysDto,
                function (SurveyDto $surveyDto) use ($tagSlug) {
                    return $this->checkIfTagSlugExists($surveyDto, $tagSlug);
                });
        }

        return $surveysDto;
    }


    /**
     * @param SurveyDto $surveyDto
     * @param $tagSlug
     * @return bool
     */
    private function checkIfTagSlugExists(SurveyDto $surveyDto, $tagSlug)
    {
        $val = false;
        array_walk(
            $surveyDto->tags,
            function (TagDto $tagDto) use (&$val, $tagSlug) {
                if ($tagDto->slug == $tagSlug) {
                    $val = true;
                }
            }
        );

        return $val;
    }
}