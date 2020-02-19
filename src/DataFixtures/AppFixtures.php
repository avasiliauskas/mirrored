<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Group;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $manager->persist($this->userFactory('admin', 'password', User::ROLE_ADMIN));

        foreach (range(0, 10) as $i) {
            $user = $this->userFactory('user' . $i, 'password', User::ROLE_USER);
            $group = $this->groupFactory('group' . $i);
            $group->assignUser($user);

            $manager->persist($user);
            $manager->persist($group);
        }

        $manager->flush();
    }

    private function groupFactory(string $name): Group
    {
        $group = new Group();
        $group->setName($name);

        return $group;
    }

    private function userFactory(string $name, string $password, string $role = null): User
    {
        $user = new User();
        $user->setName($name);
        $password = $this->encoder->encodePassword($user, $password);
        $user->setPassword($password);
        $user->setRoles([$role]);

        return $user;
    }
}
