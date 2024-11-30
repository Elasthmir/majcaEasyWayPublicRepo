<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Score;
use App\Repository\LinearAlgebraRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Service\TopicHandlerInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Doctrine\ORM\EntityManagerInterface;

class ScoreRankController extends AbstractController
{
    #[Route('/score/rank/{topic}', name: 'app_score_rank')]
    public function index(EntityManagerInterface $entityManager, string $topic): Response
    {

        $product = $entityManager->getRepository(Score::class)->find($topic);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }

        return new Response('Check out this great product: '.$product->getTopic());

        //return $this->render('score_rank/index.html.twig', [
        //    'controller_name' => 'ScoreRankController',
        //]);
    }
}
