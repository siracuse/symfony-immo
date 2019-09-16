<?php

namespace BienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="BienBundle\Repository\noteRepository")
 */
class note
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
     * @var int
     *
     * @ORM\Column(name="note", type="integer")
     */
    private $note;

    /**
     * @ORM\ManyToOne (targetEntity="BienBundle\Entity\commentaire", inversedBy="notes")
     */
    private $commentaire;


    /**
     * @ORM\ManyToOne (targetEntity="BienBundle\Entity\sousCommentaire", inversedBy="notes")
     */
    private $sousCommentaire;


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
     * Set note
     *
     * @param integer $note
     *
     * @return note
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set commentaire
     *
     * @param \BienBundle\Entity\commentaire $commentaire
     *
     * @return note
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
     * Set sousCommentaire
     *
     * @param \BienBundle\Entity\sousCommentaire $sousCommentaire
     *
     * @return note
     */
    public function setSousCommentaire(\BienBundle\Entity\sousCommentaire $sousCommentaire = null)
    {
        $this->sousCommentaire = $sousCommentaire;

        return $this;
    }

    /**
     * Get sousCommentaire
     *
     * @return \BienBundle\Entity\sousCommentaire
     */
    public function getSousCommentaire()
    {
        return $this->sousCommentaire;
    }
}
