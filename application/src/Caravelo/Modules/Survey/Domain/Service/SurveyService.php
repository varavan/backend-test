<?php

namespace Caravelo\Modules\Survey\Domain\Service;

use Caravelo\Modules\Survey\Domain\Repository\SurveyRepositoryInterface;

class SurveyService
{
    /**
     * @var SurveyRepositoryInterface
     */
    private $surveyRepositoryInterface;

    public function __construct(SurveyRepositoryInterface $surveyRepositoryInterface)
    {
        $this->surveyRepositoryInterface = $surveyRepositoryInterface;
    }

    public function getSurveys()
    {

        return $this->surveyRepositoryInterface->findAll();
    }

    public function getSurvey($slug)
    {
        return $this->getSurvey($slug);
    }

}