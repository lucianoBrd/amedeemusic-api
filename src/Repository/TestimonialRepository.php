<?php

namespace App\Repository;

use App\Entity\Data;
use App\Entity\Testimonial;
use App\Service\SearchService;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use ApiPlatform\Doctrine\Orm\Paginator as ApiPlatformPaginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Testimonial>
 *
 * @method Testimonial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Testimonial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Testimonial[]    findAll()
 * @method Testimonial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestimonialRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private SearchService $searchService,
    )
    {
        parent::__construct($registry, Testimonial::class);
    }

    public function save(Testimonial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Testimonial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Testimonial[] Returns an array of Testimonial objects
     */
    public function findBySearch(string $local, ?string $search = '', ?int $page = 1, ?int $limit = Data::PAGINATION_ITEMS_PER_PAGE): ApiPlatformPaginator
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

        $query = $this->createQueryBuilder('t')
            ->leftJoin('t.local', 'local')
        ;

        $searchWhere = '';
        $first = true;
        foreach ($searchs as $key => $s) {
            if ($first) {
                $first = false;
            } else {
                $searchWhere .= ' OR ';
            }
            $searchWhere .= 't.citation LIKE :val' . $key . ' OR t.name LIKE :val' . $key . ' OR t.designation LIKE :val' . $key . ' OR t.link LIKE :val' . $key;
        }

        $query
            ->andWhere($searchWhere)
            ->andWhere('local.local = :localVal')
        ;

        foreach ($searchs as $key => $s) {
            $query->setParameter('val' . $key, '%' . $s . '%');
        }

        $query = $query
            ->setParameter('localVal', $local)
            ->orderBy('t.id', 'DESC')
            ->getQuery()
            ->setFirstResult($firstResult)
            ->setMaxResults($limit)
        ;
        
        $doctrinePaginator = new Paginator($query);
        $paginator = new ApiPlatformPaginator($doctrinePaginator);

        return $paginator;
    }

//    public function findOneBySomeField($value): ?Testimonial
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
