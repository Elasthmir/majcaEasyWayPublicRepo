<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use App\Form\Type\TaskType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $userRepository, Request $request, EntityManagerInterface $em): Response
    {

        $user = $userRepository
                    ->find(1);
        $task = new User();
        $task->setName('Rekin');
        $task->setLastName('Nikgerowski');



        if (!$user) {
            throw $this->createNotFoundException('The product does not exist');
                
            // the above is just a shortcut for:
            // throw new NotFoundHttpException('The product does not exist');
        }
        $form = $this->createForm(UserType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($task);
            $em->flush();
            # what other actions you need. e.g redirect to success page
        }
        return $this->render('user/index.html.twig',[
            'user' => $user, // Pass the product object to the template
            'form' => $form->createView(),
        ]);
    }
    
}
