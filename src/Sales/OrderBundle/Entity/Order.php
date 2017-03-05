<?php

namespace Sales\OrderBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Order
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="Sales\OrderBundle\Repository\OrderRepository")
 */
class Order
{
    /**
     * @var int
     *
     * @Groups({"order_list"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     * @Groups({"order_list"})
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @Groups({"order_list"})
     * @ORM\Column(name="number", type="string", length=255, nullable=true)
     */
    private $number;

    /**
     * @var string
     *
     * @Groups({"order_list"})
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @Groups({"order_list"})
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @Groups({"order_list"})
     * @ORM\Column(name="delivery", type="text", nullable=true)
     */
    private $delivery;

    /**
     * @var string
     *
     * @Groups({"order_list"})
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var Source
     *
     * @Groups({"order_list"})
     * @ORM\ManyToOne(targetEntity="Source", inversedBy="orders")
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id")
     */
    private $source;

    /**
     * @var OrderStatus
     *
     * @Assert\NotBlank()
     * @Groups({"order_list"})
     * @ORM\ManyToOne(targetEntity="OrderStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    private $status;

    /**
     * @var ArrayCollection
     *
     * @Assert\NotBlank()
     * @Groups({"order_list"})
     * @ORM\OneToMany(targetEntity="OrderRow", mappedBy="order", cascade={"remove", "persist"})
     */
    private $rows;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rows = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Order
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return Order
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Order
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Order
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set delivery
     *
     * @param string $delivery
     *
     * @return Order
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * Get delivery
     *
     * @return string
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Order
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set source
     *
     * @param \Sales\OrderBundle\Entity\Source $source
     *
     * @return Order
     */
    public function setSource(\Sales\OrderBundle\Entity\Source $source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return \Sales\OrderBundle\Entity\Source
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set status
     *
     * @param \Sales\OrderBundle\Entity\OrderStatus $status
     *
     * @return Order
     */
    public function setStatus(\Sales\OrderBundle\Entity\OrderStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Sales\OrderBundle\Entity\OrderStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add row
     *
     * @param \Sales\OrderBundle\Entity\OrderRow $row
     *
     * @return Order
     */
    public function addRow(\Sales\OrderBundle\Entity\OrderRow $row)
    {
        $this->rows[] = $row;

        return $this;
    }

    /**
     * Remove row
     *
     * @param \Sales\OrderBundle\Entity\OrderRow $row
     */
    public function removeRow(\Sales\OrderBundle\Entity\OrderRow $row)
    {
        $this->rows->removeElement($row);
    }

    /**
     * Get rows
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRows()
    {
        return $this->rows;
    }
}
