<?php

namespace Sales\OrderBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SizeType
 *
 * @ORM\Table(name="size_type")
 * @ORM\Entity(repositoryClass="Sales\OrderBundle\Repository\SizeTypeRepository")
 * @UniqueEntity("name")
 */
class SizeType
{
    /**
     * @var int
     *
     * @Groups({"size_type_list", "size_list"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Groups({"size_type_list", "size_list"})
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @Groups({"size_type_list"})
     * @ORM\OneToMany(targetEntity="Size", mappedBy="type", cascade={"remove"})
     */
    private $sizes;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sizes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SizeType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add size
     *
     * @param \Sales\OrderBundle\Entity\Size $size
     *
     * @return SizeType
     */
    public function addSize(\Sales\OrderBundle\Entity\Size $size)
    {
        $this->sizes[] = $size;

        return $this;
    }

    /**
     * Remove size
     *
     * @param \Sales\OrderBundle\Entity\Size $size
     */
    public function removeSize(\Sales\OrderBundle\Entity\Size $size)
    {
        $this->sizes->removeElement($size);
    }

    /**
     * Get sizes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSizes()
    {
        return $this->sizes;
    }
}
