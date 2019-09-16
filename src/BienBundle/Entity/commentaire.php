<?php

namespace BienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="BienBundle\Repository\commentaireRepository")
 */
class commentaire
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
     * @ORM\Column(name="auteurCom", type="string", length=255)
     */
    private $auteurCom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCom", type="datetime")
     */
    private $dateCom;

    /**
     * @var string
     *
     * @ORM\Column(name="messageCom", type="string", length=255)
     */
    private $messageCom;


    /**
     * @var string
     *
     * @ORM\Column(name="publierCom", type="string", length=255)
     */
    private $publierCom;


    /**
     * @var int
     *
     * @ORM\OneToMany(targetEntity="BienBundle\Entity\note", mappedBy="commentaire")
     */
    private $notes;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="BienBundle\Entity\sousCommentaire", mappedBy="commentaire")
     */
    private $sousCommentaires;

    /**
     * @ORM\ManyToOne(targetEntity="BienBundle\Entity\bien", inversedBy="commentaires")
     */
    private $bien;


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
     * Set auteurCom
     *
     * @param string $auteurCom
     *
     * @return commentaire
     */
    public function setAuteurCom($auteurCom)
    {
        $this->auteurCom = $auteurCom;

        return $this;
    }

    /**
     * Get auteurCom
     *
     * @return string
     */
    public function getAuteurCom()
    {
        return $this->auteurCom;
    }

    /**
     * Set dateCom
     *
     * @param \DateTime $dateCom
     *
     * @return commentaire
     */
    public function setDateCom($dateCom)
    {
        $this->dateCom = $dateCom;

        return $this;
    }

    /**
     * Get dateCom
     *
     * @return \DateTime
     */
    public function getDateCom()
    {
        return $this->dateCom;
    }

    /**
     * Set messageCom
     *
     * @param string $messageCom
     *
     * @return commentaire
     */
    public function setMessageCom($messageCom)
    {
        $this->messageCom = $messageCom;

        return $this;
    }

    /**
     * Get messageCom
     *
     * @return string
     */
    public function getMessageCom()
    {
        return $this->messageCom;
    }

    /**
     * Set publierCom
     *
     * @param string $publierCom
     *
     * @return commentaire
     */
    public function setPublierCom($publierCom)
    {
        $this->publierCom = $publierCom;

        return $this;
    }

    /**
     * Get publierCom
     *
     * @return string
     */
    public function getPublierCom()
    {
        return $this->publierCom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->notes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sousCommentaires = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add note
     *
     * @param \BienBundle\Entity\note $note
     *
     * @return commentaire
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

    /**
     * Add sousCommentaire
     *
     * @param \BienBundle\Entity\sousCommentaire $sousCommentaire
     *
     * @return commentaire
     */
    public function addSousCommentaire(\BienBundle\Entity\sousCommentaire $sousCommentaire)
    {
        $this->sousCommentaires[] = $sousCommentaire;

        return $this;
    }

    /**
     * Remove sousCommentaire
     *
     * @param \BienBundle\Entity\sousCommentaire $sousCommentaire
     */
    public function removeSousCommentaire(\BienBundle\Entity\sousCommentaire $sousCommentaire)
    {
        $this->sousCommentaires->removeElement($sousCommentaire);
    }

    /**
     * Get sousCommentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSousCommentaires()
    {
        return $this->sousCommentaires;
    }

    /**
     * Set bien
     *
     * @param \BienBundle\Entity\bien $bien
     *
     * @return commentaire
     */
    public function setBien(\BienBundle\Entity\bien $bien = null)
    {
        $this->bien = $bien;

        return $this;
    }

    /**
     * Get bien
     *
     * @return \BienBundle\Entity\bien
     */
    public function getBien()
    {
        return $this->bien;
    }
}
