<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GroupFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        foreach (range(0, 10) as $i) {
            $group = $this->groupFactory('group' . $i);
            $group->assignUser($this->getReference(UserFixtures::USER_NAME . $i));

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
}
