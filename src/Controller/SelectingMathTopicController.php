<?php

namespace App\Controller;
use App\Entity\MathTopics;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SelectingMathTopicController extends AbstractController
{
    #[Route('/selecting/math/topic', name: 'app_selecting_math_topic')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $product = new MathTopics();
        $product->setTopicName('Funkcja Liniowa');
        
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->render('selecting_math_topic/index.html.twig', [
            'controller_name' => 'SelectingMathTopicController',
        ]);
    }
}
