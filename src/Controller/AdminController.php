<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\AppUtilities;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    public function __construct(private readonly UserRepository $userRepository, private readonly AppUtilities $appUtils)
    {
    }

    #[Route(path: '{_locale}/admin/settings', name: 'app_settings', requirements: ['_locale' => '%app.supported_locales%'])]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }

    #[Route(path: '{_locale}/admin/settings/users', name: 'app_settings_users', requirements: ['_locale' => '%app.supported_locales%'])]
    public function user_list(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TECH_ADMIN');

        $users = $this->userRepository->findAll();

        return $this->render('admin/settings/users.html.twig', [
            'controller_name' => 'SettingsController',
            'users' => $users,
            'roles' => $this->appUtils->getRolesArrayFromUsers($users),
        ]);
    }
}