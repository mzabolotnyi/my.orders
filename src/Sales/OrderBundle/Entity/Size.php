<?php

namespace Sales\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Size
 *
 * @ORM\Table(name="size")
 * @ORM\Entity(repositoryClass="Sales\OrderBundle\Repository\SizeRepository")
 */
class Size
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var SizeType
     *
     * @ORM\ManyToOne(targetEntity="SizeType", inversedBy="sizes")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     */
    private $type;

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
     * @return Size
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
     * Set type
     *
     * @param \Sales\OrderBundle\Entity\SizeType $type
     *
     * @return Size
     */
    public function setType(\Sales\OrderBundle\Entity\SizeType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Sales\OrderBundle\Entity\SizeType
     */
    public function getType()
    {
        return $this->type;
    }
}
