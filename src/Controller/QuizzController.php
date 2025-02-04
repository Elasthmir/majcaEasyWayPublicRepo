<?php

namespace App\Controller;

use App\Entity\Score;
use App\Entity\MathTopics;
use App\Repository\LinearAlgebraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\TopicHandlerInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Doctrine\ORM\EntityManagerInterface;
class QuizzController extends AbstractController
{
    private iterable $handlers;

    public function __construct(iterable $handlers)
    {
        $this->handlers = $handlers;
        //dd($handlers);
    }
    
    #[Route('/quizz', name: 'app_quizz')]
    public function index(Request $request)
    {
        $command = $request->query->get('command');
        $topic = $request->query->get('topic');
        $topicId = $request->query->get('topicId');
        $selectedImage = $request->query->get('selectedImage');
        
        //if (!$topic || !$selectedImage) {
            // Jeśli brakuje danych, przekieruj z powrotem na stronę główną
          //  return $this->redirectToRoute('app_home');
       // }

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
            //dd($topic);
            if ($handler->supports($topic)) {
                $records = $handler->handle($limit);
                
                //dd($records);
                break;
            }
        }
        $csrfToken = $this->container->get('security.csrf.token_manager')->getToken('save_score');
        

        return $this->render('quizz/index.html.twig', [
            'records' => $records,
            'topic' => $topic,
            'topicId' => $topicId,
            'selectedImage' => $selectedImage,
            '$command' => $command,
            'csrf_token' => $csrfToken
        ]);
    }
    /**
     * @Route("/save-score", name="save_score", methods={"POST"})
     */
    public function saveScore(Request $request, EntityManagerInterface $entityManager)
    {
        //dd('saveScore method called');
        // Get the submitted data
        $scoreValue = $request->request->get('score');
        $csrfToken = $request->request->get('_csrf_token');
        $topic = $request->request->get('topic');
        $topicId = $request->request->get('topicId');
        //dd($topic, $csrfToken, $scoreValue);  
        // Validate CSRF token
        if (!$this->isCsrfTokenValid('save_score', $csrfToken)) {
            throw new InvalidCsrfTokenException('Invalid CSRF token.');
        }

        if ($scoreValue === null || !is_numeric($scoreValue)) {
            // Handle invalid data
            return new Response('Invalid data', Response::HTTP_BAD_REQUEST);
        }
        
        $mathTopic = $entityManager->getRepository(MathTopics::class)->findOneBy(['topicName' => $topic]);
        //dd($mathTopic);
        $scoreEntity = new Score();
        $scoreEntity->setScore((int)$scoreValue);
        $scoreEntity->setTopic($topic);
        $scoreEntity->setCreatedAt(new \DateTime());
        $scoreEntity->setTopicId($mathTopic);
        $topicId = $mathTopic->getId();
        // Set the user (can be null if unauthenticated users are allowed)
        $user = $this->getUser();
        
        $scoreEntity->setUserId($user);
       
        
        $entityManager->persist($scoreEntity);
        $entityManager->flush();
        //dd($topicId);
        // Redirect to a confirmation page or render a response
        return $this->redirectToRoute('app_score_rank',['id' => $topicId]);
    }

    /**
     * @Route("/score-confirmation", name="score_confirmation")
     */
    public function scoreConfirmation()
    {
        return $this->render('quizz/score_confirmation.html.twig');
    }
}

