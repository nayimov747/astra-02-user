<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Component\User\UserFactory;
use App\Component\User\UserManager;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserCreateAction extends AbstractController
{
    public function __construct(private UserFactory $userFactory, private UserManager $userManager, private ValidatorInterface $validator)
    {
    }
    public function __invoke(User $user):User
    {
        $this->validator->validate($user);

        $user = $this->userFactory->create(
            $user->getEmail(),
            $user->getPassword(),
            $user->getFirstName(),
            $user->getAge(),
            $user->getGender(),
        );
        $this->userManager->save($user, true);
        return $user;
    }
}
