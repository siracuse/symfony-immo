<?php

namespace BienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * zoneGeo
 *
 * @ORM\Table(name="zone_geo")
 * @ORM\Entity(repositoryClass="BienBundle\Repository\zoneGeoRepository")
 */
class zoneGeo
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
     * @ORM\OneToMany(targetEntity="adresse", mappedBy="zoneGeo")
     */
    private $adresses;


    /**
     * @var string
     *
     * @ORM\Column(name="nomZone", type="string", length=50)
     */
    private $nomZone;


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
     * Set nomZone
     *
     * @param string $nomZone
     *
     * @return zoneGeo
     */
    public function setNomZone($nomZone)
    {
        $this->nomZone = $nomZone;

        return $this;
    }

    /**
     * Get nomZone
     *
     * @return string
     */
    public function getNomZone()
    {
        return $this->nomZone;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->adresses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add adress
     *
     * @param \BienBundle\Entity\adresse $adress
     *
     * @return zoneGeo
     */
    public function addAdress(\BienBundle\Entity\adresse $adress)
    {
        $this->adresses[] = $adress;

        return $this;
    }

    /**
     * Remove adress
     *
     * @param \BienBundle\Entity\adresse $adress
     */
    public function removeAdress(\BienBundle\Entity\adresse $adress)
    {
        $this->adresses->removeElement($adress);
    }

    /**
     * Get adresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdresses()
    {
        return $this->adresses;
    }
}
