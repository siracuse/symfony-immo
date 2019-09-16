<?php

namespace BienBundle\Repository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * agenceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class agenceRepository extends \Doctrine\ORM\EntityRepository
{

    public function getAgenceWithAdresse()
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->Join('a.adresse', 'ad')
            ->addSelect('ad');

        return $qb
            ->getQuery()
            ->getResult();
    }

    public function getAgentInAgence($id)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->Join('a.agents', 'agent')
            ->addSelect('agent')
            ->where('agent = :id')
            ->setParameter('id', $id);
        return $qb
            ->getQuery()
            ->getResult();
    }

    public function getAgenceWithAdresse2()
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->Join('a.adresse', 'ad')
            ->addSelect('ad')
            ->setMaxResults(5)
            ;

        return $qb
            ->getQuery()
            ->getResult();
    }

    public function getAgenceWithBien($id)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->Join('a.biens', 'b')
            ->addSelect('b')
            ->where('b = :id')
            ->setParameter('id', $id)
        ;
        return $qb
            ->getQuery()
            ->getResult();
    }

    public function getAgencePrincipale()
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->where('a.agencePrincipale = :agence')
            ->setParameter('agence', 'oui')
        ;
        try {
            return $qb
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    public function getAgenceWithAdresseGoogleMap($id)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->Join('a.adresse', 'ad')
            ->addSelect('ad')
            ->where('a = :id')
            ->setParameter('id', $id)
        ;
        return $qb
            ->getQuery()
            ->getResult();
    }


}
