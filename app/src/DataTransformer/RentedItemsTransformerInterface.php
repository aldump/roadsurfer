<?php

declare(strict_types=1);

namespace App\DataTransformer;

interface RentedItemsTransformerInterface
{
    /**
     * @param array<array<string>> $items
     * @return array<array<array<array|string>|string>|string>
     */
    public function transform(array $items): array;
}
