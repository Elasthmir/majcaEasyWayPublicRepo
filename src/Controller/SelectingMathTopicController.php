<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SelectingMathTopicController extends AbstractController
{
    #[Route('/selecting/math/topic', name: 'app_selecting_math_topic')]
    public function index(): Response
    {
        return $this->render('selecting_math_topic/index.html.twig', [
            'controller_name' => 'SelectingMathTopicController',
        ]);
    }
}
