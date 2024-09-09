<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function hello(): Response
    {
        $greeting = 'Hello World';
        return $this->render('home/hello.html.twig', [
            'greeting' => $greeting,
        ]);
    }
}