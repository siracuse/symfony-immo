<?php

namespace BienBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     *
     * @ORM\ManyToOne(targetEntity="BienBundle\Entity\adresse", inversedBy="users", cascade={"persist"})
     */
    private $adresse;

    /**
     * @ORM\OneToMany (targetEntity="BienBundle\Entity\acquerir", mappedBy="user")
     */
    private $acquisitionU;

    /**
     * @ORM\Column(name="nom_user", type="string", nullable=true)
     */
    private $nomUser;

    /**
     * @ORM\Column(name="prenom_user", type="string", nullable=true)
     */
    private $prenomUser;

    /**
     * @ORM\Column (name="tel_user", type="string", nullable=true)
     */
    private $telUser;

    /**
     * @ORM\Column(name="url_user", type="string", nullable=true)
     */
    private $urlUser;


    private $photoUser;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nomUser
     *
     * @param string $nomUser
     *
     * @return User
     */
    public function setNomUser($nomUser)
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    /**
     * Get nomUser
     *
     * @return string
     */
    public function getNomUser()
    {
        return $this->nomUser;
    }

    /**
     * Set prenomUser
     *
     * @param string $prenomUser
     *
     * @return User
     */
    public function setPrenomUser($prenomUser)
    {
        $this->prenomUser = $prenomUser;

        return $this;
    }

    /**
     * Get prenomUser
     *
     * @return string
     */
    public function getPrenomUser()
    {
        return $this->prenomUser;
    }

    /**
     * Set telUser
     *
     * @param string $telUser
     *
     * @return User
     */
    public function setTelUser($telUser)
    {
        $this->telUser = $telUser;

        return $this;
    }

    /**
     * Get telUser
     *
     * @return string
     */
    public function getTelUser()
    {
        return $this->telUser;
    }


    public function setPhotoUser($photoUser)
    {
        $this->photoUser = $photoUser;

        return $this;
    }


    public function getPhotoUser()
    {
        return $this->photoUser;
    }

    /**
     * Set adresse
     *
     * @param \BienBundle\Entity\adresse $adresse
     *
     * @return User
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
     * Add acquisitionU
     *
     * @param \BienBundle\Entity\acquerir $acquisitionU
     *
     * @return User
     */
    public function addAcquisitionU(\BienBundle\Entity\acquerir $acquisitionU)
    {
        $this->acquisitionU[] = $acquisitionU;

        return $this;
    }

    /**
     * Remove acquisitionU
     *
     * @param \BienBundle\Entity\acquerir $acquisitionU
     */
    public function removeAcquisitionU(\BienBundle\Entity\acquerir $acquisitionU)
    {
        $this->acquisitionU->removeElement($acquisitionU);
    }

    /**
     * Get acquisitionU
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcquisitionU()
    {
        return $this->acquisitionU;
    }

    /**
     * Set urlUser
     *
     * @param string $urlUser
     *
     * @return User
     */
    public function setUrlUser($urlUser)
    {
        $this->urlUser = $urlUser;

        return $this;
    }

    /**
     * Get urlUser
     *
     * @return string
     */
    public function getUrlUser()
    {
        return $this->urlUser;
    }

}
