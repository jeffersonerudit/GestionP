<?php

namespace App\Repository;

use App\Entity\RendezVous;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @extends ServiceEntityRepository<RendezVous>
 */
class RendezVousRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private PaginatorInterface $paginator)
    {
        parent::__construct($registry, RendezVous::class);
    }

    public function paginateRendezvouss(int $page)
    {
        return $this->paginator->paginate(
            $this->createQueryBuilder('r'),
            $page,
            6,
            [
                'distinct' => false,
                'sortFieldAllowList' => ['r.id', 'r.Nom']
            ]
        );
    }

    public function searchRendezvous(string $query)
    {
        return $this->createQueryBuilder('r')
            ->where('r.Nom_Rdv LIKE :query')
            ->orWhere('r.Type_Rdv LIKE :query')
            ->orWhere('r.Lieu LIKE :query')
            ->orWhere('r.Description LIKE :query')
            ->setParameter('query', value: '%' . $query . '%')
            ->getQuery()
            ->getResult()
        ;
    }
//    /**
//     * @return RendezVous[] Returns an array of RendezVous objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RendezVous
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
