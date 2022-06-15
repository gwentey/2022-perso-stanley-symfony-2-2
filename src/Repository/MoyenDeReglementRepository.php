<?php

namespace App\Repository;

use App\Entity\MoyenDeReglement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MoyenDeReglement>
 *
 * @method MoyenDeReglement|null find($id, $lockMode = null, $lockVersion = null)
 * @method MoyenDeReglement|null findOneBy(array $criteria, array $orderBy = null)
 * @method MoyenDeReglement[]    findAll()
 * @method MoyenDeReglement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoyenDeReglementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MoyenDeReglement::class);
    }

    public function add(MoyenDeReglement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MoyenDeReglement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MoyenDeReglement[] Returns an array of MoyenDeReglement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MoyenDeReglement
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
