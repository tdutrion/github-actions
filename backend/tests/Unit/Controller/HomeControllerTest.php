<?php

declare(strict_types=1);

namespace Tests\Unit\Controller;

use App\Controller\HomeController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Clock\Clock;
use Symfony\Component\Clock\MockClock;
use Symfony\Component\HttpFoundation\JsonResponse;

final class HomeControllerTest extends TestCase
{
    public function test_successfull_invokation(): void
    {
        Clock::set(new MockClock('2024-01-01 00:00:00'));
        $clock = Clock::get();
        $controller = new HomeController($clock);

        $response = $controller->__invoke();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals('{"success":true,"datetime":{"date":"2024-01-01 00:00:00.000000","timezone_type":3,"timezone":"UTC"}}', $response->getContent());
    }
}
