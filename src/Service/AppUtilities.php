<?php

namespace App\Service;
use App\Entity\User;
use Symfony\Contracts\Translation\TranslatorInterface;

class AppUtilities
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    public function getStringFromRole(string $role): string
    {
        return $this->translator->trans('roles.' . $role, [], 'messages');
    }

    public function getPrintableRolesFromUser(User $user): array
    {
        $roles = $user->getRoles();
        $printableRoles = [];
        foreach ($roles as $role) {
            $printableRoles[] = $this->getStringFromRole($role);
        }
        return $printableRoles;
    }

    public function getRolesArrayFromUsers(array $users): array
    {
        $rolesArray = [];
        foreach ($users as $user) {
            $rolesArray[] = $this->getPrintableRolesFromUser($user);
        }
        return $rolesArray;
    }
}