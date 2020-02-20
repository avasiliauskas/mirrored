<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const USER_NAME = 'user';

    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $manager->persist($this->userFactory('admin', 'password', User::ROLE_ADMIN));

        foreach (range(0, 10) as $i) {
            $user = $this->userFactory(self::USER_NAME . $i, 'password', User::ROLE_USER);
            $manager->persist($user);
        }

        $manager->flush();
    }

    private function userFactory(string $name, string $password, string $role = null): User
    {
        $user = new User();
        $user->setName($name);
        $password = $this->encoder->encodePassword($user, $password);
        $user->setPassword($password);
        $user->setRoles([$role]);

        $this->addReference($name, $user);

        return $user;
    }
}
