<?php

namespace BienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * couleur
 *
 * @ORM\Table(name="couleur")
 * @ORM\Entity(repositoryClass="BienBundle\Repository\couleurRepository")
 */
class couleur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="nomCouleur", type="string", length=255)
     */
    private $nomCouleur;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomCouleur
     *
     * @param string $nomCouleur
     *
     * @return couleur
     */
    public function setNomCouleur($nomCouleur)
    {
        $this->nomCouleur = $nomCouleur;

        return $this;
    }

    /**
     * Get nomCouleur
     *
     * @return string
     */
    public function getNomCouleur()
    {
        return $this->nomCouleur;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return couleur
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
