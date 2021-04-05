<?php

declare(strict_types=1);

namespace App\Controller;

use App\DataTransformer\RentedItemsTransformerInterface;
use App\Repository\RentItemRepository;
use DateTime;
use InvalidArgumentException;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Tag(name="Rent")
 * @OA\Response(
 *     response="500",
 *     ref="#/components/responses/GeneralError",
 * )
 */

#[Route("rents")]
class RentController
{
    private RentItemRepository $rentItemRepository;
    private RentedItemsTransformerInterface $transformer;

    public function __construct(
        RentItemRepository $rentItemRepository,
        RentedItemsTransformerInterface $transformer
    ) {
        $this->rentItemRepository = $rentItemRepository;

        $this->transformer = $transformer;
    }

    /**
     * @OA\Get(
     *     description="Get rented itmes by day",
     *     summary="Returns items rented specified day",
     *     @OA\Response(
     *          response="200",
     *          description="Success",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/rented_info"
     *          ),
     *     ),
     *     @OA\Parameter(
     *          name="date",
     *          in="query",
     *          schema=@OA\Schema(type="string", format="date"),
     *          required=true,
     *          description="Date",
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound",
     *     )
     * )
     */
    #[Route('/by-day', name: "rents:items-by-day", methods: ["GET"])]
    public function getItemsByDay(
        Request $request
    ): JsonResponse {
        if ($request->get('date') === null) {
            throw new InvalidArgumentException('Date should be specified');
        }

        $date = new DateTime($request->get('date'));

        return new JsonResponse(
            $this->transformer->transform($this->rentItemRepository->getRentedItemsByDate($date)),
        );
    }

    /**
     * @OA\Get(
     *     description="Get rented itmes",
     *     summary="Returns items rented",
     *     @OA\Response(
     *          response="200",
     *          description="Success",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/rented_info"
     *          ),
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound",
     *     )
     * )
     */
    #[Route('', name: "rents:items", methods: ["GET"])]
    public function getRentedItems(): JsonResponse
    {
        return new JsonResponse(
            $this->transformer->transform($this->rentItemRepository->getRentedItems()),
        );
    }
}
