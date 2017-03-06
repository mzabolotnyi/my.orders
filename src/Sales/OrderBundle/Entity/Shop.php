<?php

namespace Sales\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Shop
 *
 * @ORM\Table(name="shop")
 * @ORM\Entity(repositoryClass="Sales\OrderBundle\Repository\ShopRepository")
 * @UniqueEntity("name")
 */
class Shop
{
    /**
     * @var int
     *
     * @Groups({"shop_list", "order_list"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Groups({"shop_list", "order_list"})
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @Groups({"shop_list", "order_list"})
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var File
     *
     * @Assert\Image()
     * @Groups({"shop_list", "order_list"})
     * @ORM\Column(name="icon", type="string", nullable=true)
     */
    private $icon;

    /**
     * @var string
     *
     * @Groups({"shop_list"})
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var File
     *
     * @Assert\Image()
     * @Groups({"shop_list"})
     * @ORM\Column(name="size_guide", type="string", nullable=true)
     */
    private $sizeGuide;

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
     * @return Shop
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
     * Set link
     *
     * @param string $link
     *
     * @return Shop
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
     * Set icon
     *
     * @param File $icon
     *
     * @return Shop
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return File
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Shop
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
     * Set sizeGuide
     *
     * @param File $sizeGuide
     *
     * @return Shop
     */
    public function setSizeGuide($sizeGuide)
    {
        $this->sizeGuide = $sizeGuide;

        return $this;
    }

    /**
     * Get sizeGuide
     *
     * @return File
     */
    public function getSizeGuide()
    {
        return $this->sizeGuide;
    }
}
