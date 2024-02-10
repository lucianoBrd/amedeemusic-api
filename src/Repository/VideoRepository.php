<?php

namespace App\Repository;

use App\Entity\Data;
use App\Entity\Video;
use App\Service\SearchService;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use ApiPlatform\Doctrine\Orm\Paginator as ApiPlatformPaginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Video>
 *
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private SearchService $searchService,
    )
    {
        parent::__construct($registry, Video::class);
    }

    public function save(Video $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Video $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Video[] Returns an array of Video objects
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

        $query = $this->createQueryBuilder('v')
            ->leftJoin('v.videoDescriptions', 'vd')
        ;

        $searchWhere = '';
        $first = true;
        foreach ($searchs as $key => $s) {
            if ($first) {
                $first = false;
            } else {
                $searchWhere .= ' OR ';
            }
            $searchWhere .= 'v.name LIKE :val' . $key . ' OR vd.description LIKE :val' . $key . ' OR v.link LIKE :val' . $key;
        }

        $query
            ->andWhere($searchWhere)
        ;

        foreach ($searchs as $key => $s) {
            $query->setParameter('val' . $key, '%' . $s . '%');
        }

        $query = $query
            ->orderBy('v.id', 'DESC')
            ->getQuery()
            ->setFirstResult($firstResult)
            ->setMaxResults($limit)
        ;
        $doctrinePaginator = new Paginator($query);
        $paginator = new ApiPlatformPaginator($doctrinePaginator);

        return $paginator;
    }

//    /**
//     * @return Video[] Returns an array of Video objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Video
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
