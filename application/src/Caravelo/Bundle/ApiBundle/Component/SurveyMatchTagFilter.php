<?php

namespace Caravelo\Bundle\ApiBundle\Component;

use Caravelo\Bundle\ApiBundle\Model\SurveyDto;
use Caravelo\Bundle\ApiBundle\Model\TagDto;

class SurveyMatchTagFilter
{
    public function filter($surveys, $tagSlug)
    {
        return array_filter(
            $surveys,
            function (SurveyDto $surveyDto) use ($tagSlug) {
                return $this->checkIfTagSlugExists($surveyDto, $tagSlug);
            });
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