<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderRow
 *
 * @ORM\Table(name="order_row")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderRowRepository")
 */
class OrderRow
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
     * @ORM\Column(name="product", type="string", length=255)
     */
    private $product;

    /**
     * @var int
     *
     * @ORM\Column(name="purchase_price", type="integer")
     */
    private $purchasePrice;

    /**
     * @var int
     *
     * @ORM\Column(name="selling_price", type="integer")
     */
    private $sellingPrice;

    /**
     * @var bool
     *
     * @ORM\Column(name="weight_included", type="boolean")
     */
    private $weightIncluded;

    /**
     * @var int
     *
     * @ORM\Column(name="weight_cost", type="integer")
     */
    private $weightCost;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var Order
     *
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="rows")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id", nullable=false)
     */
    private $order;

    /**
     * @var SizeType
     *
     * @ORM\ManyToOne(targetEntity="SizeType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     */
    private $type;

    /**
     * @var Size
     *
     * @ORM\ManyToOne(targetEntity="Size")
     * @ORM\JoinColumn(name="size_id", referencedColumnName="id", nullable=false)
     */
    private $size;

    /**
     * @var Shop
     *
     * @ORM\ManyToOne(targetEntity="Shop")
     * @ORM\JoinColumn(name="shop_id", referencedColumnName="id", nullable=false)
     */
    private $shop;
}
