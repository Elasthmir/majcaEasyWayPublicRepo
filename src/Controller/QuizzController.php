<?php

namespace App\Controller;
use App\Repository\LinearAlgebraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\TopicHandlerInterface;

class QuizzController extends AbstractController
{
    private iterable $handlers;

    public function __construct(iterable $handlers)
    {
        $this->handlers = $handlers;
    }

    #[Route('/quizz', name: 'app_quizz')]
    public function index(Request $request)
    {
        $topic = $request->query->get('topic');
        $selectedImage = $request->query->get('selectedImage');

        if (!$topic || !$selectedImage) {
            // Jeśli brakuje danych, przekieruj z powrotem na stronę główną
            return $this->redirectToRoute('app_home');
        }

        // Ustalanie limitu na podstawie wybranego obrazka
        if ($selectedImage === 'fastQuizz') {
            $limit = 1;
        } elseif ($selectedImage === '40Questions') {
            $limit = 40;
        } else {
            // Domyślny limit lub obsługa błędu
            $limit = 1;
        }

        $records = [];

        foreach ($this->handlers as $handler) {
            if ($handler->supports($topic)) {
                $records = $handler->handle($limit);
                break;
            }
        }

            
        return $this->render('quizz/index.html.twig', [
            'records' => $records,
            'topic' => $topic,
            'selectedImage' => $selectedImage
        ]);
    }
}

