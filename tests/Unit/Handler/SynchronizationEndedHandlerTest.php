<?php

declare(strict_types=1);

namespace Tests\CommerceWeavers\SyliusAlsoBoughtPlugin\Unit\Handler;

use CommerceWeavers\SyliusAlsoBoughtPlugin\Entity\ProductSynchronization;
use CommerceWeavers\SyliusAlsoBoughtPlugin\Event\SynchronizationEnded;
use CommerceWeavers\SyliusAlsoBoughtPlugin\Handler\SynchronizationEndedHandler;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Uid\Uuid;

final class SynchronizationEndedHandlerTest extends TestCase
{
    use ProphecyTrait;

    public function testHandlingSynchronizationEndedEvent(): void
    {
        $id = Uuid::v4();
        $endDate = new \DateTimeImmutable('2021-01-01 10:00:10');

        $productSynchronizationRepository = $this->prophesize(RepositoryInterface::class);
        $productSynchronization = $this->prophesize(ProductSynchronization::class);

        $productSynchronizationRepository->find($id)->willReturn($productSynchronization);

        $productSynchronization->end($endDate, 10, ['product1', 'product2'])->shouldBeCalled();

        (new SynchronizationEndedHandler($productSynchronizationRepository->reveal()))(
            new SynchronizationEnded($id, $endDate, 10, ['product1', 'product2'])
        );
    }
}
