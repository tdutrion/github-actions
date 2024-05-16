<?php

declare(strict_types=1);

namespace App\Tests\Integration\Controller;

use App\Controller\MoviesListController;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;

final class MoviesListControllerTest extends KernelTestCase
{
    private ?MoviesListController $controller;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->controller = $kernel->getContainer()
            ->get(MoviesListController::class)
        ;
    }

    public function testSearchByName(): void
    {
        $response = $this->controller->__invoke();

        $this->assertEquals(expected: Response::HTTP_OK, actual: $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString(
            expectedJson: '[{"id":"018f7f33-9e80-3abf-dcfc-f88ce3bfff79","title":"Skyscraper","description":"A security expert must infiltrate a burning skyscraper, 225 stories above ground, when his family is trapped inside by criminals."}]',
            actualJson: $response->getContent(),
        );
    }
}
