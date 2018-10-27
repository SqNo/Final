<?php

namespace App\DataFixtures;

use App\Entity\Manager;
use App\Entity\Siege;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ManagerFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Manager();
        $user->setUsername('gest');
        $password = $this->encoder->encodePassword($user, 'gest');
        $user->setPassword($password);
        $user->setRoles(array('ROLE_MANAGER'));
        $user->setDiscr('manager');

        $manager->persist($user);
        $manager->flush();
    }
}
