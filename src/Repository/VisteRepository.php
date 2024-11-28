<?php

namespace App\Repository;

use App\Entity\Viste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @extends ServiceEntityRepository<Viste>
 */
class VisteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry$registry, private PaginatorInterface $paginator)
    {
        parent::__construct($registry, Viste::class);
    }

    public function paginateVisites(int $page)
    {
        return $this->paginator->paginate(
            $this->createQueryBuilder('r'),
            $page,
            6,
            [
                'distinct' => false,
                'sortFieldAllowList' => ['r.id', 'r.Nom_V']
            ]
        );
    }

    public function search(string $query)
    {
        return $this->createQueryBuilder('v')
        ->where('v.Nom_V LIKE :query')
        ->orWhere('v.Prenom_V LIKE :query')
        ->setParameter('query', value:'%'.$query.'%')
        ->getQuery()
        ->getResult()
        ;
    }

//    /**
//     * @return Viste[] Returns an array of Viste objects
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

//    public function findOneBySomeField($value): ?Viste
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
