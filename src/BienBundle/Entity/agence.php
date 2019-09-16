<?php

namespace BienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * agence
 *
 * @ORM\Table(name="agence")
 * @ORM\Entity(repositoryClass="BienBundle\Repository\agenceRepository")
 */
class agence
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
     * @ORM\ManyToMany(targetEntity="BienBundle\Entity\bien", mappedBy="agences")
     */
    private $biens;

    /**
     * @ORM\ManyToOne (targetEntity="BienBundle\Entity\adresse", inversedBy="agences", cascade={"persist", "remove"})
     */
    private $adresse;

    /**
     * @ORM\ManyToMany (targetEntity="BienBundle\Entity\agent", inversedBy="agences")
     * @ORM\JoinTable(name="agence_agent")
     */
    private $agents;

    /**
     * @var string
     *
     * @ORM\Column(name="nomAgence", type="string", length=255)
     */
    private $nomAgence;

    /**
     * @var string
     *
     * @ORM\Column(name="telAgence", type="string", length=255)
     */
    private $telAgence;

    /**
     * @var string
     *
     * @ORM\Column(name="emailAgence", type="string", length=255)
     */
    private $emailAgence;

    /**
     * @var string
     *
     * @ORM\Column(name="descripAgence", type="text")
     */
    private $descripAgence;

    /**
     * @var string
     *
     * @ORM\Column(name="agencePrincipale", type="text", nullable=true)
     */
    private $agencePrincipale;


//////////////////////////////////////////
    /**
     * @var string
     *
     * @ORM\Column(name="photoAgence", type="string", length=255, nullable=true)
     */
    private $photoAgence;

    public function getPhotoAgence()
    {
        return $this->photoAgence;
    }

    public function setPhotoAgence($photoAgence)
    {
        $this->photoAgence = $photoAgence;

        return $this;
    }


    //////////////////////////////////::
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
     * Set nomAgence
     *
     * @param string $nomAgence
     *
     * @return agence
     */
    public function setNomAgence($nomAgence)
    {
        $this->nomAgence = $nomAgence;

        return $this;
    }

    /**
     * Get nomAgence
     *
     * @return string
     */
    public function getNomAgence()
    {
        return $this->nomAgence;
    }

    /**
     * Set telAgence
     *
     * @param string $telAgence
     *
     * @return agence
     */
    public function setTelAgence($telAgence)
    {
        $this->telAgence = $telAgence;

        return $this;
    }

    /**
     * Get telAgence
     *
     * @return string
     */
    public function getTelAgence()
    {
        return $this->telAgence;
    }

    /**
     * Set emailAgence
     *
     * @param string $emailAgence
     *
     * @return agence
     */
    public function setEmailAgence($emailAgence)
    {
        $this->emailAgence = $emailAgence;

        return $this;
    }

    /**
     * Get emailAgence
     *
     * @return string
     */
    public function getEmailAgence()
    {
        return $this->emailAgence;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->biens = new \Doctrine\Common\Collections\ArrayCollection();
        $this->agents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add bien
     *
     * @param \BienBundle\Entity\bien $bien
     *
     * @return agence
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
     * Set adresse
     *
     * @param \BienBundle\Entity\adresse $adresse
     *
     * @return agence
     */
    public function setAdresse(\BienBundle\Entity\adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \BienBundle\Entity\adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Add agent
     *
     * @param \BienBundle\Entity\agent $agent
     *
     * @return agence
     */
    public function addAgent(\BienBundle\Entity\agent $agent)
    {
        $this->agents[] = $agent;

        return $this;
    }

    /**
     * Remove agent
     *
     * @param \BienBundle\Entity\agent $agent
     */
    public function removeAgent(\BienBundle\Entity\agent $agent)
    {
        $this->agents->removeElement($agent);
    }

    /**
     * Get agents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAgents()
    {
        return $this->agents;
    }

    /**
     * Set descripAgence
     *
     * @param string $descripAgence
     *
     * @return agence
     */
    public function setDescripAgence($descripAgence)
    {
        $this->descripAgence = $descripAgence;

        return $this;
    }

    /**
     * Get descripAgence
     *
     * @return string
     */
    public function getDescripAgence()
    {
        return $this->descripAgence;
    }

    /**
     * Set agencePrincipale
     *
     * @param string $agencePrincipale
     *
     * @return agence
     */
    public function setAgencePrincipale($agencePrincipale)
    {
        $this->agencePrincipale = $agencePrincipale;

        return $this;
    }

    /**
     * Get agencePrincipale
     *
     * @return string
     */
    public function getAgencePrincipale()
    {
        return $this->agencePrincipale;
    }
}
