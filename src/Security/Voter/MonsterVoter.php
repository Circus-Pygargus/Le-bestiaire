<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class MonsterVoter extends Voter
{
    const MONSTER_CREATE = 'MONSTER_CREATE';
    const MONSTER_EDIT = 'MONSTER_EDIT';

    private $security;

    public function __construct (Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::MONSTER_CREATE, self::MONSTER_EDIT])
            && $subject instanceof \App\Entity\Monster;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::MONSTER_CREATE:
                return $this->canCreate($user);
                break;
            case self::MONSTER_EDIT:
                return $this->canEdit($user);
                break;
        }

        return false;
    }

    private function canCreate (User $user): bool
    {
        return $this->security->isGranted('ROLE_CONTRIBUTOR');
    }

    private function canEdit (User $user): bool{
        return $this->security->isGranted('ROLE_CONTRIBUTOR');
    }
}
