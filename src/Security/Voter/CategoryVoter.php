<?php

namespace App\Security\Voter;

use App\Entity\Category;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class CategoryVoter extends Voter
{
    const CATEGORY_CREATE = 'CATEGORY_CREATE';
    const CATEGORY_EDIT = 'CATEGORY_EDIT';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $category): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::CATEGORY_CREATE, self::CATEGORY_EDIT])
            && $category instanceof Category;
    }

    protected function voteOnAttribute(string $condition, $category, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($condition) {
            case self::CATEGORY_CREATE:
                return $this->canCreate($user);
                break;
            case self::CATEGORY_EDIT:
                return $this->canEdit($user);
                break;
        }

        return false;
    }

    private function canCreate (User $user): bool
    {
        return $this->security->isGranted('ROLE_CONTRIBUTOR');
    }

    private function canEdit (User $user): bool
    {
        return $this->security->isGranted('ROLE_ADMIN');
    }
}
