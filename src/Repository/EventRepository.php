<?php

namespace App\Repository;

use App\Entity\Data;
use App\Entity\Event;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use ApiPlatform\Doctrine\Orm\Paginator as ApiPlatformPaginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function save(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Event[] Returns an array of Event objects
     */
    public function findBySearch(?string $search = '', ?int $page = 1, ?int $limit = Data::PAGINATION_ITEMS_PER_PAGE): ApiPlatformPaginator
    {
        if ($search == null) {
            $search = '';
        }
        if ($page == null) {
            $page = 1;
        }
        if ($limit == null) {
            $page = Data::PAGINATION_ITEMS_PER_PAGE;
        }
        $firstResult = ($page - 1) * $limit;

        $searchs = $this->searchService->explodeStringByWhitespace($search);

        $query = $this->createQueryBuilder('e');

        $searchWhere = '';
        $first = true;
        foreach ($searchs as $key => $s) {
            if ($first) {
                $first = false;
            } else {
                $searchWhere .= ' OR ';
            }
            $searchWhere .= 'e.name LIKE :val' . $key . ' OR e.place LIKE :val' . $key . ' OR e.link LIKE :val' . $key;
        }

        $query
            ->andWhere($searchWhere)
        ;

        foreach ($searchs as $key => $s) {
            $query->setParameter('val' . $key, '%' . $s . '%');
        }

        $query = $query
            ->orderBy('e.date', 'DESC')
            ->getQuery()
            ->setFirstResult($firstResult)
            ->setMaxResults($limit)
        ;
        $doctrinePaginator = new Paginator($query);
        $paginator = new ApiPlatformPaginator($doctrinePaginator);

        return $paginator;
    }

//    public function findOneBySomeField($value): ?Event
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
