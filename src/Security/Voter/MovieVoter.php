<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class MovieVoter extends Voter
{
    const MOVIE_CREATE = 'MOVIE_CREATE';
    const MOVIE_EDIT = 'MOVIE_EDIT';

    private Security $security;

    public function __construct (Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::MOVIE_CREATE, self::MOVIE_EDIT])
            && $subject instanceof \App\Entity\Movie;
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
            case self::MOVIE_CREATE:
                return $this->canCreate();
                break;
            case self::MOVIE_EDIT:
                return $this->canEdit();
                break;
        }

        return false;
    }

    private function canCreate (): bool
    {
        return $this->security->isGranted('ROLE_CONTRIBUTOR');
    }

    private function canEdit (): bool
    {
        return $this->security->isGranted('ROLE_CONTRIBUTOR');
    }
}
