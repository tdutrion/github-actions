<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Ulid;

final class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $skyscraperMovie = new Movie(
            Ulid::fromRfc4122('018f7f33-9e80-3abf-dcfc-f88ce3bfff79'),
            'Skyscraper',
            'A security expert must infiltrate a burning skyscraper, 225 stories above ground, when his family is trapped inside by criminals.'
        );
        $manager->persist($skyscraperMovie);

        $manager->flush();
    }
}
