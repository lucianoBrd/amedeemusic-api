<?php

namespace App\Repository;

use App\Entity\Data;
use App\Entity\Project;
use App\Service\SearchService;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use ApiPlatform\Doctrine\Orm\Paginator as ApiPlatformPaginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Project>
 *
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private SearchService $searchService,
    )
    {
        parent::__construct($registry, Project::class);
    }

    public function save(Project $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Project $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Project[] Returns an array of Project objects
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

        $query = $this->createQueryBuilder('p')
            ->leftJoin('p.type', 'type')
            ->leftJoin('p.titles', 'title')
        ;

        $searchWhere = '';
        $first = true;
        foreach ($searchs as $key => $s) {
            if ($first) {
                $first = false;
            } else {
                $searchWhere .= ' OR ';
            }
            $searchWhere .= 'p.name LIKE :val' . $key . ' OR type.name LIKE :val' . $key . ' OR title.name LIKE :val' . $key . ' OR title.lyrics LIKE :val' . $key;
        }

        $query
            ->andWhere($searchWhere)
        ;

        foreach ($searchs as $key => $s) {
            $query->setParameter('val' . $key, '%' . $s . '%');
        }

        $query = $query
            ->orderBy('p.date', 'DESC')
            ->getQuery()
            ->setFirstResult($firstResult)
            ->setMaxResults($limit)
        ;
        $doctrinePaginator = new Paginator($query);
        $paginator = new ApiPlatformPaginator($doctrinePaginator);

        return $paginator;
    }

//    public function findOneBySomeField($value): ?Project
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
