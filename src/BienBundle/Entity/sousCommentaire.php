<?php

namespace BienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * sousCommentaire
 *
 * @ORM\Table(name="sous_commentaire")
 * @ORM\Entity(repositoryClass="BienBundle\Repository\sousCommentaireRepository")
 */
class sousCommentaire
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
     * @var string
     *
     * @ORM\Column(name="auteurSouscom", type="string", length=255)
     */
    private $auteurSouscom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSouscom", type="datetime")
     */
    private $dateSouscom;

    /**
     * @var string
     *
     * @ORM\Column(name="messageSouscom", type="string", length=255)
     */
    private $messageSouscom;

    /**
     * @var string
     *
     * @ORM\Column(name="publierSouscom", type="string", length=255)
     */
    private $publierSouscom;


    /**
     * @ORM\ManyToOne(targetEntity="BienBundle\Entity\commentaire", inversedBy="sousCommentaires")
     */
    private $commentaire;

    /**
     * @var int
     *
     * @ORM\OneToMany (targetEntity="BienBundle\Entity\note", mappedBy="sousCommentaire")
     */
    private $notes;





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
     * Set auteurSouscom
     *
     * @param string $auteurSouscom
     *
     * @return sousCommentaire
     */
    public function setAuteurSouscom($auteurSouscom)
    {
        $this->auteurSouscom = $auteurSouscom;

        return $this;
    }

    /**
     * Get auteurSouscom
     *
     * @return string
     */
    public function getAuteurSouscom()
    {
        return $this->auteurSouscom;
    }

    /**
     * Set dateSouscom
     *
     * @param \DateTime $dateSouscom
     *
     * @return sousCommentaire
     */
    public function setDateSouscom($dateSouscom)
    {
        $this->dateSouscom = $dateSouscom;

        return $this;
    }

    /**
     * Get dateSouscom
     *
     * @return \DateTime
     */
    public function getDateSouscom()
    {
        return $this->dateSouscom;
    }

    /**
     * Set messageSouscom
     *
     * @param string $messageSouscom
     *
     * @return sousCommentaire
     */
    public function setMessageSouscom($messageSouscom)
    {
        $this->messageSouscom = $messageSouscom;

        return $this;
    }

    /**
     * Get messageSouscom
     *
     * @return string
     */
    public function getMessageSouscom()
    {
        return $this->messageSouscom;
    }

    /**
     * Set publierSouscom
     *
     * @param string $publierSouscom
     *
     * @return sousCommentaire
     */
    public function setPublierSouscom($publierSouscom)
    {
        $this->publierSouscom = $publierSouscom;

        return $this;
    }

    /**
     * Get publierSouscom
     *
     * @return string
     */
    public function getPublierSouscom()
    {
        return $this->publierSouscom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->notes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set commentaire
     *
     * @param \BienBundle\Entity\commentaire $commentaire
     *
     * @return sousCommentaire
     */
    public function setCommentaire(\BienBundle\Entity\commentaire $commentaire = null)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return \BienBundle\Entity\commentaire
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Add note
     *
     * @param \BienBundle\Entity\note $note
     *
     * @return sousCommentaire
     */
    public function addNote(\BienBundle\Entity\note $note)
    {
        $this->notes[] = $note;

        return $this;
    }

    /**
     * Remove note
     *
     * @param \BienBundle\Entity\note $note
     */
    public function removeNote(\BienBundle\Entity\note $note)
    {
        $this->notes->removeElement($note);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotes()
    {
        return $this->notes;
    }
}
