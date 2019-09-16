<?php

namespace BienBundle\Repository;


class bienSearchRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAnnonceByParameters($data)
    {
        $qb = $this
            ->createQueryBuilder('b')
            ->where('typeBien = :typeBien')
            ->setParameter('typeBien', $data)
            ;
        return $qb
            ->getQuery()
            ->getResult();

    }
}
