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

    /**
     * @return \Caravelo\Modules\Survey\Domain\Model\Survey[]
     */
    public function getSurveys()
    {

        return $this->surveyRepositoryInterface->findAll();
    }

    /**
     * @param $slug
     * @return \Caravelo\Modules\Survey\Domain\Model\Survey | false
     */
    public function getSurvey($slug)
    {
        return $this->surveyRepositoryInterface->findOneBySlug($slug);
    }

}