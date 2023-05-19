<?php

namespace App\Repository;

use App\Entity\Project;
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
    public function __construct(ManagerRegistry $registry)
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
    public function findBySearch(string $search, ?int $page = 1, ?int $limit = 2): ApiPlatformPaginator
    {
        $query = $this->createQueryBuilder('p')
            ->leftJoin('p.type', 'type')
            ->leftJoin('p.titles', 'title')
            ->andWhere('p.name LIKE :val OR type.name LIKE :val OR title.name LIKE :val OR title.lyrics LIKE :val')
            ->setParameter('val', '%' . $search . '%')
            ->orderBy('p.date', 'DESC')
            ->getQuery()
            ->setFirstResult($page)
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
