<?php

namespace BienBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * acquerir
 *
 * @ORM\Table(name="acquerir")
 * @ORM\Entity(repositoryClass="BienBundle\Repository\acquerirRepository")
 */
class acquerir
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="BienBundle\Entity\User", inversedBy="acquisitionU")
     */
    private $user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="BienBundle\Entity\bien", inversedBy="acquisitionB")
     */
    private $bien;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAcquisition", type="datetime")
     */
    private $dateAcquisition;



    /**
     * Set dateAcquisition
     *
     * @param \DateTime $dateAcquisition
     *
     * @return acquerir
     */
    public function setDateAcquisition($dateAcquisition)
    {
        $this->dateAcquisition = $dateAcquisition;

        return $this;
    }

    /**
     * Get dateAcquisition
     *
     * @return \DateTime
     */
    public function getDateAcquisition()
    {
        return $this->dateAcquisition;
    }

    /**
     * Set user
     *
     * @param \BienBundle\Entity\User $user
     *
     * @return acquerir
     */
    public function setUser(\BienBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BienBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set bien
     *
     * @param \BienBundle\Entity\bien $bien
     *
     * @return acquerir
     */
    public function setBien(\BienBundle\Entity\bien $bien)
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
