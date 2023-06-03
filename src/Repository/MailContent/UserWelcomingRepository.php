<?php

namespace App\Repository\MailContent;

use App\Entity\MailContent\UserWelcoming;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserWelcoming>
 *
 * @method UserWelcoming|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserWelcoming|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserWelcoming[]    findAll()
 * @method UserWelcoming[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserWelcomingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserWelcoming::class);
    }

    public function save(UserWelcoming $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserWelcoming $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return UserWelcoming[] Returns an array of UserWelcoming objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserWelcoming
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
