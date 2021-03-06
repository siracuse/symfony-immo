<?php

namespace BienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * typeBien
 *
 * @ORM\Table(name="type_bien")
 * @ORM\Entity(repositoryClass="BienBundle\Repository\typeBienRepository")
 */
class typeBien
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\OneToMany(targetEntity="BienBundle\Entity\bien", mappedBy="typeBien")
     */
    private $biens;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionType", type="text")
     */
    private $descriptionType;


    /**
     * @var string
     *
     * @ORM\Column(name="nomTypeBien", type="string", length=255)
     */
    private $nomTypeBien;


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
     * Set nomTypeBien
     *
     * @param string $nomTypeBien
     *
     * @return typeBien
     */
    public function setNomTypeBien($nomTypeBien)
    {
        $this->nomTypeBien = $nomTypeBien;

        return $this;
    }

    /**
     * Get nomTypeBien
     *
     * @return string
     */
    public function getNomTypeBien()
    {
        return $this->nomTypeBien;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->biens = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add bien
     *
     * @param \BienBundle\Entity\bien $bien
     *
     * @return typeBien
     */
    public function addBien(\BienBundle\Entity\bien $bien)
    {
        $this->biens[] = $bien;

        return $this;
    }

    /**
     * Remove bien
     *
     * @param \BienBundle\Entity\bien $bien
     */
    public function removeBien(\BienBundle\Entity\bien $bien)
    {
        $this->biens->removeElement($bien);
    }

    /**
     * Get biens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBiens()
    {
        return $this->biens;
    }

    /**
     * Set descriptionType
     *
     * @param string $descriptionType
     *
     * @return typeBien
     */
    public function setDescriptionType($descriptionType)
    {
        $this->descriptionType = $descriptionType;

        return $this;
    }

    /**
     * Get descriptionType
     *
     * @return string
     */
    public function getDescriptionType()
    {
        return $this->descriptionType;
    }
}
