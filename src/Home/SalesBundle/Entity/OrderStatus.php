<?php

namespace Home\SalesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * OrderStatus
 *
 * @ORM\Table(name="sales_order_status")
 * @ORM\Entity
 */
class OrderStatus
{
    /**
     * @var int
     *
     * @Groups({"order_status_list", "order_list"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Groups({"order_status_list", "order_list"})
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @Groups({"order_status_list", "order_list"})
     * @ORM\Column(name="color", type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @var string
     *
     * @Groups({"order_status_list", "order_list"})
     * @ORM\Column(name="icon", type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @var boolean
     *
     * @Groups({"order_status_list", "order_list"})
     * @ORM\Column(name="as_closed", type="boolean", nullable=true)
     */
    private $asClosed;

    /**
     * @var boolean
     *
     * @Groups({"order_status_list", "order_list"})
     * @ORM\Column(name="no_color", type="boolean", nullable=true)
     */
    private $noColor;


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
     * @return OrderStatus
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
     * Set color
     *
     * @param string $color
     *
     * @return OrderStatus
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set asClosed
     *
     * @param boolean $asClosed
     *
     * @return OrderStatus
     */
    public function setAsClosed($asClosed)
    {
        $this->asClosed = $asClosed;

        return $this;
    }

    /**
     * Get asClosed
     *
     * @return boolean
     */
    public function getAsClosed()
    {
        return $this->asClosed;
    }

    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return OrderStatus
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set noColor
     *
     * @param boolean $noColor
     *
     * @return OrderStatus
     */
    public function setNoColor($noColor)
    {
        $this->noColor = $noColor;

        return $this;
    }

    /**
     * Get noColor
     *
     * @return boolean
     */
    public function getNoColor()
    {
        return $this->noColor;
    }
}
