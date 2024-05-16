<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final readonly class MoviesListController
{
    public function __construct(private MovieRepository $movieRepository)
    {
    }

    #[Route('/movies', name: 'movies', methods: [Request::METHOD_GET])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(data: $this->movieRepository->retrieveAllMovies(), status: Response::HTTP_OK);
    }
}
