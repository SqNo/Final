<?php

namespace App\DataFixtures;

use App\Entity\Siege;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SiegeFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Siege();
        $user->setUsername('sub');
        $password = $this->encoder->encodePassword($user, 'sub');
        $user->setPassword($password);
        $user->setRoles(array('ROLE_SIEGE'));
        $user->setDiscr('siege');

        $manager->persist($user);
        $manager->flush();
    }
}
