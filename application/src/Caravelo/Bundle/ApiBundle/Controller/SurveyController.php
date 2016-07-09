<?php

namespace Caravelo\Bundle\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class SurveyController extends Controller
{
    /**
     * @Route("/surveys", name="api_surveys")
     */
    public function surveysAction()
    {
        $businessCase  = $this->get('caravelo.api.businesscase.get_surveys');

        return new JsonResponse($businessCase->getSurveys());
    }
}