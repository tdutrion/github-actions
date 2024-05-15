<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Clock\ClockInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final readonly class HomeController
{
    private const ROUTE_NAME = 'app_home';
    private const ROUTE_PATH = '/';

    public function __construct(
        private ClockInterface $clock
    ) {}

    #[Route(path: self::ROUTE_PATH, name: self::ROUTE_NAME, methods: [Request::METHOD_GET])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(data: [
            'success' => true,
            'datetime' => $this->clock->now(),
        ], status: Response::HTTP_OK);
    }
}