<?php

namespace App\Repository;

use App\Entity\Personne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @extends ServiceEntityRepository<Personne>
 */
class PersonneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private PaginatorInterface $paginator)
    {
        parent::__construct($registry, Personne::class);
    }

    public function paginatePersonnes(int $page)
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

    public function searchPersonne(string $query)
    {
        return $this->createQueryBuilder('p')
        ->where('p.Nom LIKE :query')
        ->orWhere('p.Prenom LIKE :query')
        ->orWhere('p.Societe LIKE :query')
        ->setParameter('query', value:'%'.$query.'%')
        ->getQuery()
        ->getResult()
        ;
    }



//    /**
//     * @return Personne[] Returns an array of Personne objects
//     */
//    public function findByExampleField($value): array
//   
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Personne
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
