<?php

declare(strict_types=1);

namespace CommerceWeavers\SyliusAlsoBoughtPlugin\Entity;

use Sylius\Component\Product\Model\ProductAssociationInterface;

interface BoughtTogetherProductsAwareInterface
{
    public const BOUGHT_TOGETHER_ASSOCIATION_TYPE_CODE = 'bought_together';

    /** @return array<string, int> */
    public function getBoughtTogetherProducts(): array;

    public function increaseBoughtTogetherProductsCount(array $codes): void;

    public function getBoughtTogetherAssociation(): ?ProductAssociationInterface;
}
