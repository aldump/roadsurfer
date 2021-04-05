<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\RentItem;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RentItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<RentItem> findAll()
 * @method array<RentItem> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentItem::class);
    }

    /**
     * @return array<array<string>>
     */
    public function getRentedItemsByDate(DateTimeInterface $dateTime): array
    {
        return $this->prepareQuiery()
            ->where('DATE_FORMAT(b.startDate, \'%Y-%m-%d\') = :date')
            ->setParameter('date', $dateTime->format('Y-m-d'))
            ->getQuery()->getResult();
    }

    /**
     * @return array<array<string>>
     */
    public function getRentedItems(): array
    {
        return $this->prepareQuiery()
            ->getQuery()->getResult();
    }

    private function prepareQuiery(): QueryBuilder
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->from(RentItem::class, 'r')
            ->select('r.name as name')
            ->addSelect('r.id as id')
            ->addSelect('SUM(ri.quantity) as quantity')
            ->addSelect('DATE_FORMAT(b.startDate, \'%Y-%m-%d\') as dt')
            ->addSelect('s.id as station_id')
            ->addSelect('s.name as station_name')
            ->join('r.rentedItems', 'ri')
            ->join('ri.booking', 'b')
            ->join('b.station', 's')
            ->groupBy('r.id, dt, s.id')
            ->orderBy('dt');
    }
}
