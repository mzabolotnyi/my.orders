<?php

namespace Home\SalesBundle\Entity;

use AppBundle\Traits\TimestampableEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Order
 *
 * @ORM\Table(name="sales_orders")
 * @ORM\Entity(repositoryClass="Home\SalesBundle\Repository\OrderRepository")
 */
class Order
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

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
     * @Assert\Url
     * @Groups({"order_list"})
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @Assert\Url
     * @Groups({"order_list"})
     * @ORM\Column(name="url_chat", type="string", length=255, nullable=true)
     */
    private $urlChat;

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
     * @var string
     *
     * @Groups({"order_list"})
     * @ORM\Column(name="is_own", type="boolean", nullable=true)
     */
    private $isOwn;

    /**
     * @var Source
     *
     * @Groups({"order_list"})
     * @ORM\ManyToOne(targetEntity="Source")
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
     * Set url
     *
     * @param string $url
     *
     * @return Order
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set urlChat
     *
     * @param string $urlChat
     *
     * @return Order
     */
    public function setUrlChat($urlChat)
    {
        $this->urlChat = $urlChat;

        return $this;
    }

    /**
     * Get urlChat
     *
     * @return string
     */
    public function getUrlChat()
    {
        return $this->urlChat;
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
     * @param \Home\SalesBundle\Entity\Source $source
     *
     * @return Order
     */
    public function setSource(\Home\SalesBundle\Entity\Source $source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return \Home\SalesBundle\Entity\Source
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set status
     *
     * @param \Home\SalesBundle\Entity\OrderStatus $status
     *
     * @return Order
     */
    public function setStatus(\Home\SalesBundle\Entity\OrderStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Home\SalesBundle\Entity\OrderStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add row
     *
     * @param \Home\SalesBundle\Entity\OrderRow $row
     *
     * @return Order
     */
    public function addRow(\Home\SalesBundle\Entity\OrderRow $row)
    {
        $this->rows[] = $row;

        return $this;
    }

    /**
     * Remove row
     *
     * @param \Home\SalesBundle\Entity\OrderRow $row
     */
    public function removeRow(\Home\SalesBundle\Entity\OrderRow $row)
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

    /**
     * Set isOwn
     *
     * @param boolean $isOwn
     *
     * @return Order
     */
    public function setIsOwn($isOwn)
    {
        $this->isOwn = $isOwn;

        return $this;
    }

    /**
     * Get isOwn
     *
     * @return boolean
     */
    public function getIsOwn()
    {
        return $this->isOwn;
    }
}
