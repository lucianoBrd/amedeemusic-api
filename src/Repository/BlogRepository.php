<?php

namespace App\Repository;

use App\Entity\Blog;
use App\Entity\Data;
use App\Service\SearchService;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use ApiPlatform\Doctrine\Orm\Paginator as ApiPlatformPaginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Blog>
 *
 * @method Blog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blog[]    findAll()
 * @method Blog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private SearchService $searchService,
    )
    {
        parent::__construct($registry, Blog::class);
    }

    public function save(Blog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Blog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Blog[] Returns an array of Blog objects
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

        $query = $this->createQueryBuilder('b')
            ->leftJoin('b.local', 'local')
        ;

        $searchWhere = '';
        $first = true;
        foreach ($searchs as $key => $s) {
            if ($first) {
                $first = false;
            } else {
                $searchWhere .= ' OR ';
            }
            $searchWhere .= 'b.title LIKE :val' . $key . ' OR b.content LIKE :val' . $key;
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
            ->orderBy('b.date', 'DESC')
            ->getQuery()
            ->setFirstResult($firstResult)
            ->setMaxResults($limit)
        ;
        
        $doctrinePaginator = new Paginator($query);
        $paginator = new ApiPlatformPaginator($doctrinePaginator);

        return $paginator;
    }

//    public function findOneBySomeField($value): ?Blog
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
