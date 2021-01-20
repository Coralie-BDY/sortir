<?php

namespace App\Repository;

use App\Entity\Campus;
use App\Entity\Sortie;
use App\Entity\User;
use App\Entity\SearchSortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }

//    public function findByPast()
//    {
//        $req = $this->createQueryBuilder('s')
//            ->andWhere('s.etatsSortie = :etat')
//            ->setParameter('etat',
//                $this->getEntityManager()->getRepository(Sortie::class)->find(5));
//        return $req->getQuery()->getResult();
//
//    }

    public function findByCampus(SearchSortie $data, User $user){

        $req = $this->createQueryBuilder('s')
            ->select('s')
            ->andWhere('IDENTITY(s.campus) LIKE :campus')
            ->setParameter('campus', $data->getCampus())
            ->andWhere('IDENTITY(s.organisateur) LIKE :organisateur')
            ->setParameter('organisateur', $user);
        return $req->getQuery()->getResult();


    }

    public function findSearch(SearchSortie $data, User $user)
    {
        $req = $this->createQueryBuilder('s')
            //recherche par nom
            ->select('s')
            ->andWhere('s.nom LIKE :nom')
            ->setParameter('nom',"%" . $data->getNomSortie() . "%");

        //recherche par campus
        if($data->getCampus())
        {
            $req->andWhere('IDENTITY(s.campus) LIKE :campus')
                ->setParameter('campus', $data->getCampus());
        }

             //recherche par organisateur
        if($data->getOrganisateur())
        {
            $req->andWhere('IDENTITY(s.organisateur) LIKE :organisateur')
                ->setParameter('organisateur', $user);
        }

        //recherche par inscription
        if($data->getInscription())
        {
            $req->innerJoin('s.users', 'u', 'WITH', 'u.id = :userId')
                ->setParameter('userId', $user->getId());
        }

       if($data->getInscription())
       {
           $req->andWhere(':user NOT MEMBER OF s.users')
               ->setParameter('user', $user->getId());
       }
        //recherche par sortie passée
        if($data->getSortiePassee())
        {
            $req->andWhere('s.etatsSortie = :etat')
                ->setParameter('etat',
                    $this->getEntityManager()->getRepository(Sortie::class)->find(5));
        }

        //recherche par date
        if($data->getDateDebut())
        {
            $req->andWhere('s.date >= :dateDebut')
                ->setParameter('dateDebut', $data->getDateDebut());
        }

        if($data->getDateFin())
        {
            $req->andWhere('s.clotureinscription <= :dateFin')
                ->setParameter('dateFin', $data->getDateFin());
        }


        return $req->getQuery()->getResult();

    }


    // /**
    //  * @return Sortie[] Returns an array of Sortie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sortie
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
