<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;

final readonly class MovieRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @return Movie[]
     */
    public function retrieveAllMovies(): array
    {
        return $this->entityManager->getRepository(Movie::class)->findAll();
    }
}
