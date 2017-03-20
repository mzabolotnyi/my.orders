<?php

namespace Home\SalesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * OrderRow
 *
 * @ORM\Table(name="sales_order_row")
 * @ORM\Entity
 */
class OrderRow
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
     * @var string
     *
     * @Assert\NotBlank()
     * @Groups({"order_list"})
     * @ORM\Column(name="product", type="string", length=255)
     */
    private $product;

    /**
     * @var int
     *
     * @Assert\GreaterThanOrEqual(value="0")
     * @Groups({"order_list"})
     * @ORM\Column(name="purchase_price", type="integer")
     */
    private $purchasePrice;

    /**
     * @var int
     *
     * @Assert\GreaterThanOrEqual(value="0")
     * @Groups({"order_list"})
     * @ORM\Column(name="selling_price", type="integer")
     */
    private $sellingPrice;

    /**
     * @var bool
     *
     * @Groups({"order_list"})
     * @ORM\Column(name="weight_included", type="boolean", nullable=true)
     */
    private $weightIncluded;

    /**
     * @var int
     *
     * @Groups({"order_list"})
     * @ORM\Column(name="weight_cost", type="integer", nullable=true, options={"default":0})
     */
    private $weightCost;

    /**
     * @var string
     *
     * @Groups({"order_list"})
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var Order
     *
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="rows")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $order;

    /**
     * @var Size
     *
     * @Assert\NotBlank()
     * @Groups({"order_list"})
     * @ORM\ManyToOne(targetEntity="Size")
     * @ORM\JoinColumn(name="size_id", referencedColumnName="id")
     */
    private $size;

    /**
     * @var Shop
     *
     * @Groups({"order_list"})
     * @ORM\ManyToOne(targetEntity="Shop")
     * @ORM\JoinColumn(name="shop_id", referencedColumnName="id")
     */
    private $shop;

    public function __construct()
    {
        $this->weightIncluded = false;
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
     * Set product
     *
     * @param string $product
     *
     * @return OrderRow
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set purchasePrice
     *
     * @param integer $purchasePrice
     *
     * @return OrderRow
     */
    public function setPurchasePrice($purchasePrice)
    {
        $this->purchasePrice = $purchasePrice;

        return $this;
    }

    /**
     * Get purchasePrice
     *
     * @return integer
     */
    public function getPurchasePrice()
    {
        return $this->purchasePrice;
    }

    /**
     * Set sellingPrice
     *
     * @param integer $sellingPrice
     *
     * @return OrderRow
     */
    public function setSellingPrice($sellingPrice)
    {
        $this->sellingPrice = $sellingPrice;

        return $this;
    }

    /**
     * Get sellingPrice
     *
     * @return integer
     */
    public function getSellingPrice()
    {
        return $this->sellingPrice;
    }

    /**
     * Set weightIncluded
     *
     * @param boolean $weightIncluded
     *
     * @return OrderRow
     */
    public function setWeightIncluded($weightIncluded)
    {
        $this->weightIncluded = $weightIncluded;

        return $this;
    }

    /**
     * Get weightIncluded
     *
     * @return boolean
     */
    public function getWeightIncluded()
    {
        return $this->weightIncluded;
    }

    /**
     * Set weightCost
     *
     * @param integer $weightCost
     *
     * @return OrderRow
     */
    public function setWeightCost($weightCost)
    {
        $this->weightCost = $weightCost;

        return $this;
    }

    /**
     * Get weightCost
     *
     * @return integer
     */
    public function getWeightCost()
    {
        return $this->weightCost;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return OrderRow
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
     * Set order
     *
     * @param \Home\SalesBundle\Entity\Order $order
     *
     * @return OrderRow
     */
    public function setOrder(\Home\SalesBundle\Entity\Order $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Home\SalesBundle\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set size
     *
     * @param \Home\SalesBundle\Entity\Size $size
     *
     * @return OrderRow
     */
    public function setSize(\Home\SalesBundle\Entity\Size $size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return \Home\SalesBundle\Entity\Size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set shop
     *
     * @param \Home\SalesBundle\Entity\Shop $shop
     *
     * @return OrderRow
     */
    public function setShop(\Home\SalesBundle\Entity\Shop $shop)
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get shop
     *
     * @return \Home\SalesBundle\Entity\Shop
     */
    public function getShop()
    {
        return $this->shop;
    }
}
