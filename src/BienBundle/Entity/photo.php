<?php

namespace BienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="BienBundle\Repository\photoRepository")
 */
class photo
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
     * @ORM\ManyToOne (targetEntity="BienBundle\Entity\bien", inversedBy="photos", cascade={"persist"})
     *
     */
    private $bien;

    /**
     * @var string
     *
     * @ORM\Column(name="nomPhoto", type="string", length=255)
     */
    private $nomPhoto;


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
     * Set nomPhoto
     *
     * @param string $nomPhoto
     *
     * @return photo
     */
    public function setNomPhoto($nomPhoto)
    {
        $this->nomPhoto = $nomPhoto;

        return $this;
    }

    /**
     * Get nomPhoto
     *
     * @return string
     */
    public function getNomPhoto()
    {
        return $this->nomPhoto;
    }

    /**
     * Set bien
     *
     * @param \BienBundle\Entity\bien $bien
     *
     * @return photo
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
