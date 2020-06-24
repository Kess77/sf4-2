<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * Récuperer les nouveaux produits créés il y a moins d'1mois
     */
    public function findNews()
    {
        // création de queryBuilder (constructeur de requête)
        return $this->createQueryBuilder('p')                                   #'p' = alias de product
                    ->where('p.createdAt >= :last_month')
                    ->setParameter('last_month',new \DateTime('-1month')) // equivalent de bindValue
                    ->orderBy('p.createdAt','DESC')
                    ->getQuery()                                                     //recuperer les resultat et obtenir la requete
                    ->getResult();                                                   //retourne resultat avec un tableau
    }

    /*
     * SELECT t0.id , t0.name,
     * FROM product t0
     * WHERE t0.created_at <= :last_month
     * ORDER BY t0.created_at
     */
}
