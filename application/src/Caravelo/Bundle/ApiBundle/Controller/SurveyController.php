<?php

namespace Caravelo\Bundle\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class SurveyController extends Controller
{
    /**
     * @Route("/surveys", name="api_surveys")
     * @param Request $request
     * @return JsonResponse
     */
    public function surveysAction(Request $request)
    {
        $businessCase  = $this->get('caravelo.api.businesscase.get_surveys');
        $tag = $request->get('tag', false);

        return new JsonResponse($businessCase->getSurveys($tag));
    }

    /**
     * @Route("/survey/{slug}", name="api_survey")
     * @param $slug
     * @return JsonResponse
     */
    public function surveyAction($slug)
    {
        $businessCase  = $this->get('caravelo.api.businesscase.get_survey');

        return (($surveyDto = $businessCase->getSurvey($slug)) == false)
            ? new Response('', Response::HTTP_NOT_FOUND)
            : new JsonResponse($surveyDto);
    }
}