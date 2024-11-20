<?php

namespace App\Controller;
use App\Repository\LinearAlgebraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class QuizzController extends AbstractController
{
    #[Route('/quizz', name: 'app_quizz')]
    public function index(Request $request, LinearAlgebraRepository $algebraRepository)
    {
        // Retrieve the selected image and topic from the query parameters
        $selectedImage = $request->query->get('selectedImage');
        $topic = $request->query->get('topic');
        if ($topic == "Algebra (równania i nierówności liniowe)") {
            //dd("nigger");
        }
        //dd($selectedImage);
        // Now you have both the selected image and topic values
        // You can use them to render a template, perform logic, etc.
        
        return $this->render('quizz/index.html.twig', [
            'selectedImage' => $selectedImage,
            'topic' => $topic,
        ]);
    }
}
