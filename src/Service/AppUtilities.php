<?php

namespace App\Service;
use App\Entity\User;

class AppUtilities
{
    public function getStringFromRole(string $role): string
    {
        $roles = [
            'ROLE_ADMIN' => 'Admin',
            'ROLE_TECH_ADMIN' => 'Tech Admin',
            'ROLE_EMPLOYEE' => 'Employee',
            'ROLE_USER' => 'User',
        ];
        if (array_key_exists($role, $roles)) {
            return $roles[$role];
        } else {
            return 'Unknown';
        }
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