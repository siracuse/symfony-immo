<?php

namespace BienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * detailsBien
 *
 * @ORM\Table(name="details_bien")
 * @ORM\Entity(repositoryClass="BienBundle\Repository\detailsBienRepository")
 */
class detailsBien
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
     * @ORM\ManyToMany (targetEntity="BienBundle\Entity\bien", mappedBy="detailsBiens")
     */
    private $biens;

    /**
     * @var string
     *
     * @ORM\Column(name="nomDetails", type="string", length=255)
     */
    private $nomDetails;


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
     * Set nomDetails
     *
     * @param string $nomDetails
     *
     * @return detailsBien
     */
    public function setNomDetails($nomDetails)
    {
        $this->nomDetails = $nomDetails;

        return $this;
    }

    /**
     * Get nomDetails
     *
     * @return string
     */
    public function getNomDetails()
    {
        return $this->nomDetails;
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
     * @return detailsBien
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
}
