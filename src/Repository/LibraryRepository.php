<?php

namespace App\Repository;

use App\Entity\Library;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Library>
 *
 * @method Library|null find($id, $lockMode = null, $lockVersion = null)
 * @method Library|null findOneBy(array $criteria, array $orderBy = null)
 * @method Library[]    findAll()
 * @method Library[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LibraryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Library::class);
    }

    /**
     * Saves changes to a specific book
     */
    public function save(Library $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Removes a specific book
     */
    public function remove(Library $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Library[] Returns an array of Library objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

// public function findOneBySomeField($value): ?Library
// {
//     return $this->createQueryBuilder('l')
//         ->andWhere('l.exampleField = :val')
//         ->setParameter('val', $value)
//         ->getQuery()
//         ->getOneOrNullResult()
//     ;
// }

    /**
     * Returns a specific book by ISBN
     * @return Library object
     */
    public function findOneByIsbn(string $value): ?Library
    {
        $result = $this->createQueryBuilder('l')
            ->andWhere('l.isbn = :isbn')
            ->setParameter('isbn', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        if (!$result instanceOf Library) {
            $result = null;
        }
        return $result;
    }
}
