<?php

namespace BienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * agent
 *
 * @ORM\Table(name="agent")
 * @ORM\Entity(repositoryClass="BienBundle\Repository\agentRepository")
 */
class agent
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
     * @ORM\ManyToOne (targetEntity="BienBundle\Entity\adresse", inversedBy="agents", cascade={"persist", "remove"})
     */
    private $adresse;

    /**
     * @ORM\ManyToMany (targetEntity="BienBundle\Entity\agence", mappedBy="agents")
     */
    private $agences;

    /**
     * @ORM\ManyToMany (targetEntity="BienBundle\Entity\bien", mappedBy="agents")
     */
    private $biens;

    /**
     * @var string
     *
     * @ORM\Column(name="nomAgent", type="string", length=255)
     */
    private $nomAgent;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomAgent", type="string", length=255)
     */
    private $prenomAgent;

    /**
     * @var string
     *
     * @ORM\Column(name="telAgent", type="string", length=255)
     */
    private $telAgent;

    /**
     * @var string
     *
     * @ORM\Column(name="emailAgent", type="string", length=255)
     */
    private $emailAgent;


//////////////////////////////////////////////

    /**
     * @var string
     *
     * @ORM\Column(name="photoAgent", type="string", length=255, nullable=true)
     */
    private $photoAgent;

    public function getPhotoAgent()
    {
        return $this->photoAgent;
    }

    public function setPhotoAgent($photoAgent)
    {
        $this->photoAgent = $photoAgent;

        return $this;
    }

///////////////////////////////////////////



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
     * Set nomAgent
     *
     * @param string $nomAgent
     *
     * @return agent
     */
    public function setNomAgent($nomAgent)
    {
        $this->nomAgent = $nomAgent;

        return $this;
    }

    /**
     * Get nomAgent
     *
     * @return string
     */
    public function getNomAgent()
    {
        return $this->nomAgent;
    }

    /**
     * Set prenomAgent
     *
     * @param string $prenomAgent
     *
     * @return agent
     */
    public function setPrenomAgent($prenomAgent)
    {
        $this->prenomAgent = $prenomAgent;

        return $this;
    }

    /**
     * Get prenomAgent
     *
     * @return string
     */
    public function getPrenomAgent()
    {
        return $this->prenomAgent;
    }

    /**
     * Set telAgent
     *
     * @param string $telAgent
     *
     * @return agent
     */
    public function setTelAgent($telAgent)
    {
        $this->telAgent = $telAgent;

        return $this;
    }

    /**
     * Get telAgent
     *
     * @return string
     */
    public function getTelAgent()
    {
        return $this->telAgent;
    }

    /**
     * Set emailAgent
     *
     * @param string $emailAgent
     *
     * @return agent
     */
    public function setEmailAgent($emailAgent)
    {
        $this->emailAgent = $emailAgent;

        return $this;
    }

    /**
     * Get emailAgent
     *
     * @return string
     */
    public function getEmailAgent()
    {
        return $this->emailAgent;
    }

    /**
     * Set adresse
     *
     * @param \BienBundle\Entity\adresse $adresse
     *
     * @return agent
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
     * Constructor
     */
    public function __construct()
    {
        $this->agences = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add agence
     *
     * @param \BienBundle\Entity\agence $agence
     *
     * @return agent
     */
    public function addAgence(\BienBundle\Entity\agence $agence)
    {
        $this->agences[] = $agence;

        return $this;
    }

    /**
     * Remove agence
     *
     * @param \BienBundle\Entity\agence $agence
     */
    public function removeAgence(\BienBundle\Entity\agence $agence)
    {
        $this->agences->removeElement($agence);
    }

    /**
     * Get agences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAgences()
    {
        return $this->agences;
    }

    /**
     * Add bien
     *
     * @param \BienBundle\Entity\bien $bien
     *
     * @return agent
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
