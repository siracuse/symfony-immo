<?php

namespace BienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * bien
 *
 * @ORM\Table(name="bien")
 * @ORM\Entity(repositoryClass="BienBundle\Repository\bienRepository")
 */
class bien
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
     * @ORM\ManyToOne(targetEntity="BienBundle\Entity\typeBien", inversedBy="biens" , cascade={"persist"})
     */
    private $typeBien;

    /**
     * @ORM\ManyToOne (targetEntity="BienBundle\Entity\proprietaire", inversedBy="biens", cascade={"persist", "remove"})
     */
    private $proprietaire;


    /**
     * @ORM\ManyToMany (targetEntity="BienBundle\Entity\agence", inversedBy="biens")
     */
    private $agences;

    /**
     * @ORM\ManyToOne (targetEntity="BienBundle\Entity\adresse", inversedBy="biens" , cascade={"persist", "remove"})
     */
    private $adresse;


    /**
     * @ORM\OneToMany (targetEntity="BienBundle\Entity\acquerir", mappedBy="bien")
     * @ORM\JoinTable(name="bien_agence")
     */
    private $acquisitionB;

    /**
     * @ORM\ManyToMany (targetEntity="BienBundle\Entity\agent", inversedBy="biens")
     * @ORM\JoinTable(name="bien_agent")
     */
    private $agents;

    /**
     * @ORM\ManyToMany (targetEntity="BienBundle\Entity\detailsBien", inversedBy="biens")
     * @ORM\JoinTable(name="bien_details_bien")
     */
    private $detailsBiens;


    /**
     * @ORM\OneToMany (targetEntity="BienBundle\Entity\commentaire", mappedBy="bien", cascade={"remove"})
     */
    private $commentaires;

    /**
     * @var string
     *
     * @ORM\Column(name="titreBien", type="string", length=255)
     */
    private $titreBien;

    /**
     * @var int
     *
     * @ORM\Column(name="surfaceBien", type="integer")
     */
    private $surfaceBien;

    /**
     * @var int
     *
     * @ORM\Column(name="nbPieceBien", type="integer")
     */
    private $nbPieceBien;

    /**
     * @var int
     *
     * @ORM\Column(name="nbChambreBien", type="integer")
     */
    private $nbChambreBien;

    /**
     * @var int
     *
     * @ORM\Column(name="nbSalleDeBainBien", type="integer")
     */
    private $nbSalleDeBainBien;

    /**
     * @var string
     *
     * @ORM\Column(name="descripBien", type="text")
     */
    private $descripBien;

    /**
     * @var float
     *
     * @ORM\Column(name="prixBien", type="float")
     */
    private $prixBien;

    /**
     * @var string
     *
     * @ORM\Column(name="statutBien", type="string", length=255)
     */
    private $statutBien;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDepotBien", type="datetime")
     */
    private $dateDepotBien;

    /**
     * @var string
     *
     * @ORM\Column(name="typeVenteBien", type="string", length=255)
     */
    private $typeVenteBien;


    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="BienBundle\Entity\photo", mappedBy="bien")
     */
    private $photos;


//////////////////////////////////////////////



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
     * Set titreBien
     *
     * @param string $titreBien
     *
     * @return bien
     */
    public function setTitreBien($titreBien)
    {
        $this->titreBien = $titreBien;

        return $this;
    }

    /**
     * Get titreBien
     *
     * @return string
     */
    public function getTitreBien()
    {
        return $this->titreBien;
    }

    /**
     * Set surfaceBien
     *
     * @param integer $surfaceBien
     *
     * @return bien
     */
    public function setSurfaceBien($surfaceBien)
    {
        $this->surfaceBien = $surfaceBien;

        return $this;
    }

    /**
     * Get surfaceBien
     *
     * @return int
     */
    public function getSurfaceBien()
    {
        return $this->surfaceBien;
    }

    /**
     * Set nbPieceBien
     *
     * @param integer $nbPieceBien
     *
     * @return bien
     */
    public function setNbPieceBien($nbPieceBien)
    {
        $this->nbPieceBien = $nbPieceBien;

        return $this;
    }

    /**
     * Get nbPieceBien
     *
     * @return int
     */
    public function getNbPieceBien()
    {
        return $this->nbPieceBien;
    }

    /**
     * Set nbChambreBien
     *
     * @param integer $nbChambreBien
     *
     * @return bien
     */
    public function setNbChambreBien($nbChambreBien)
    {
        $this->nbChambreBien = $nbChambreBien;

        return $this;
    }

    /**
     * Get nbChambreBien
     *
     * @return int
     */
    public function getNbChambreBien()
    {
        return $this->nbChambreBien;
    }

    /**
     * Set nbSalleDeBainBien
     *
     * @param integer $nbSalleDeBainBien
     *
     * @return bien
     */
    public function setNbSalleDeBainBien($nbSalleDeBainBien)
    {
        $this->nbSalleDeBainBien = $nbSalleDeBainBien;

        return $this;
    }

    /**
     * Get nbSalleDeBainBien
     *
     * @return int
     */
    public function getNbSalleDeBainBien()
    {
        return $this->nbSalleDeBainBien;
    }

    /**
     * Set descripBien
     *
     * @param string $descripBien
     *
     * @return bien
     */
    public function setDescripBien($descripBien)
    {
        $this->descripBien = $descripBien;

        return $this;
    }

    /**
     * Get descripBien
     *
     * @return string
     */
    public function getDescripBien()
    {
        return $this->descripBien;
    }

    /**
     * Set prixBien
     *
     * @param float $prixBien
     *
     * @return bien
     */
    public function setPrixBien($prixBien)
    {
        $this->prixBien = $prixBien;

        return $this;
    }

    /**
     * Get prixBien
     *
     * @return float
     */
    public function getPrixBien()
    {
        return $this->prixBien;
    }

    /**
     * Set statutBien
     *
     * @param string $statutBien
     *
     * @return bien
     */
    public function setStatutBien($statutBien)
    {
        $this->statutBien = $statutBien;

        return $this;
    }

    /**
     * Get statutBien
     *
     * @return string
     */
    public function getStatutBien()
    {
        return $this->statutBien;
    }

    /**
     * Set dateDepotBien
     *
     * @param \DateTime $dateDepotBien
     *
     * @return bien
     */
    public function setDateDepotBien($dateDepotBien)
    {
        $this->dateDepotBien = $dateDepotBien;

        return $this;
    }

    /**
     * Get dateDepotBien
     *
     * @return \DateTime
     */
    public function getDateDepotBien()
    {
        return $this->dateDepotBien;
    }

    /**
     * Set typeVenteBien
     *
     * @param string $typeVenteBien
     *
     * @return bien
     */
    public function setTypeVenteBien($typeVenteBien)
    {
        $this->typeVenteBien = $typeVenteBien;

        return $this;
    }

    /**
     * Get typeVenteBien
     *
     * @return string
     */
    public function getTypeVenteBien()
    {
        return $this->typeVenteBien;
    }

    /**
     * Set typeBien
     *
     * @param \BienBundle\Entity\typeBien $typeBien
     *
     * @return bien
     */
    public function setTypeBien(\BienBundle\Entity\typeBien $typeBien = null)
    {
        $this->typeBien = $typeBien;

        return $this;
    }

    /**
     * Get typeBien
     *
     * @return \BienBundle\Entity\typeBien
     */
    public function getTypeBien()
    {
        return $this->typeBien;
    }



    /**
     * Add photo
     *
     * @param \BienBundle\Entity\photo $photo
     *
     * @return bien
     */
    public function addPhoto(\BienBundle\Entity\photo $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \BienBundle\Entity\photo $photo
     */
    public function removePhoto(\BienBundle\Entity\photo $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Set proprietaire
     *
     * @param \BienBundle\Entity\proprietaire $proprietaire
     *
     * @return bien
     */
    public function setProprietaire(\BienBundle\Entity\proprietaire $proprietaire = null)
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    /**
     * Get proprietaire
     *
     * @return \BienBundle\Entity\proprietaire
     */
    public function getProprietaire()
    {
        return $this->proprietaire;
    }



    /**
     * Set adresse
     *
     * @param \BienBundle\Entity\adresse $adresse
     *
     * @return bien
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
     * Add acquisitionB
     *
     * @param \BienBundle\Entity\acquerir $acquisitionB
     *
     * @return bien
     */
    public function addAcquisitionB(\BienBundle\Entity\acquerir $acquisitionB)
    {
        $this->acquisitionB[] = $acquisitionB;

        return $this;
    }

    /**
     * Remove acquisitionB
     *
     * @param \BienBundle\Entity\acquerir $acquisitionB
     */
    public function removeAcquisitionB(\BienBundle\Entity\acquerir $acquisitionB)
    {
        $this->acquisitionB->removeElement($acquisitionB);
    }

    /**
     * Get acquisitionB
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcquisitionB()
    {
        return $this->acquisitionB;
    }

    /**
     * Add agent
     *
     * @param \BienBundle\Entity\agent $agent
     *
     * @return bien
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
     * Add detailsBien
     *
     * @param \BienBundle\Entity\detailsBien $detailsBien
     *
     * @return bien
     */
    public function addDetailsBien(\BienBundle\Entity\detailsBien $detailsBien)
    {
        $this->detailsBiens[] = $detailsBien;

        return $this;
    }

    /**
     * Remove detailsBien
     *
     * @param \BienBundle\Entity\detailsBien $detailsBien
     */
    public function removeDetailsBien(\BienBundle\Entity\detailsBien $detailsBien)
    {
        $this->detailsBiens->removeElement($detailsBien);
    }

    /**
     * Get detailsBiens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetailsBiens()
    {
        return $this->detailsBiens;
    }

    /**
     * Add agence
     *
     * @param \BienBundle\Entity\agence $agence
     *
     * @return bien
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
     * @var string
     *
     * @ORM\Column(name="photoBien", type="string", length=255, nullable=true)
     *
     *
     */
    private $photoBien;

    public function getPhotoBien()
    {
        return $this->photoBien;
    }

    public function setPhotoBien($photoBien)
    {
        $this->photoBien = $photoBien;

        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->agences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->acquisitionB = new \Doctrine\Common\Collections\ArrayCollection();
        $this->agents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->detailsBiens = new \Doctrine\Common\Collections\ArrayCollection();
        $this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add commentaire
     *
     * @param \BienBundle\Entity\commentaire $commentaire
     *
     * @return bien
     */
    public function addCommentaire(\BienBundle\Entity\commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \BienBundle\Entity\commentaire $commentaire
     */
    public function removeCommentaire(\BienBundle\Entity\commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }
}
