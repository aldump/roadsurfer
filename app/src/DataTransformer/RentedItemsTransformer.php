<?php

declare(strict_types=1);

namespace App\DataTransformer;

class RentedItemsTransformer implements RentedItemsTransformerInterface
{
    /**
     * @param array<array<string>> $items
     * @return array<array<array<array|string>|string>|string>
     */
    public function transform(array $items): array
    {
        $data = [];

        foreach ($items as $item) {
            if (!isset($data[$item['dt']])) {
                $data[$item['dt']] = [
                    'date' => $item['dt'],
                    'stations' => [],
                ];
            }

            if (!isset($data[$item['dt']]['stations'][$item['station_id']])) {
                $data[$item['dt']]['stations'][$item['station_id']] = [
                    'id' => $item['station_id'],
                    'name' => $item['station_name'],
                    'rented_items' => [],
                ];
            }

            $data[$item['dt']]['stations'][$item['station_id']]['rented_items'][] = [
                'name' => $item['name'],
                'quantity' => $item['quantity'],
            ];
        }

        return $data;
    }
}
