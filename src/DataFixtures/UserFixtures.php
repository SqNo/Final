<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $password = $this->encoder->encodePassword($user, 'admin');
        $user->setPassword($password);
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setDiscr('user');

        $manager->persist($user);
        $manager->flush();
    }
}
