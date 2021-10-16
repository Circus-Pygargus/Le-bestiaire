<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class ImageVoter extends Voter
{
    const IMAGE_CREATE = 'IMAGE_CREATE';
    const IMAGE_EDIT = 'IMAGE_EDIT';

    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::IMAGE_CREATE, self::IMAGE_EDIT])
            && $subject instanceof \App\Entity\Image;
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
            case self::IMAGE_CREATE:
                return $this->canCreate();
                break;
            case self::IMAGE_EDIT:
                return $this->canEdit();
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
