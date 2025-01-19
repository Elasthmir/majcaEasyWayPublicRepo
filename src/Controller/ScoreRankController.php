<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\MathTopics;
use App\Entity\Score;
use App\Repository\LinearAlgebraRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Service\TopicHandlerInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Doctrine\ORM\EntityManagerInterface;

class ScoreRankController extends AbstractController
{
    #[Route('/score/rank/{id}', name: 'app_score_rank')]
    public function index(EntityManagerInterface $entityManager, int $id): Response
    {
        $mathTable = $entityManager->getRepository(MathTopics::class);
        $mathTopics = $mathTable->findAll();

        $product = $entityManager->getRepository(MathTopics::class)->find($id);
        $topicName = $product->getTopicName();
        //dd($topicName);
        $qb = $entityManager->createQueryBuilder();
        $qb->select('IDENTITY(scr.user_id) AS user_id_id, scr.topic, scr.score, umb.nickName')
        ->from('App\Entity\Score', 'scr')
        ->join('scr.user_id', 'umb')
        ->where('scr.topic_id = :topic')
        ->setParameter('topic', $product)
        ->orderBy('scr.score', 'DESC');
        $scores = $entityManager->getRepository(Score::class)->findBy(['id' => $product]);
        
        $product1 = $qb->getQuery()->getResult();
        if (!$product1) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        } 
        //dd($product1);
        //dump($product1);
        //eturn new Response('Check out this great product: '.$product1);

        return $this->render('score_rank/index.html.twig', [
            'mathTopics' => $mathTopics,
            'product1' => $product1,
            'scores' => $scores,
            'id' => $id,
        ]);
    }
}




