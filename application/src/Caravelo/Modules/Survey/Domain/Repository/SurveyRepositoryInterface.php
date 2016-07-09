<?php

namespace Caravelo\Modules\Survey\Domain\Repository;

use Caravelo\Modules\Survey\Domain\Model\Survey;

interface SurveyRepositoryInterface
{
    /**
     * @return Survey[]
     */
    public function findAll();

    /**
     * @param $slug
     * @return Survey | false
     */
    public function findOneBySlug($slug);
}