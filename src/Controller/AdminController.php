<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    #[Route(path: '/admin/settings', name: 'app_settings')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }

    #[Route(path: '/admin/settings/users', name: 'app_settings_users')]
    public function user_list(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TECH_ADMIN');

        $users = $this->userRepository->findAll();

        return $this->render('admin/settings/users.html.twig', [
            'controller_name' => 'SettingsController',
            'users' => $users,
        ]);
    }
}