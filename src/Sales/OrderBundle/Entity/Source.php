<?php

namespace Sales\OrderBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Source
 *
 * @ORM\Table(name="source")
 * @ORM\Entity(repositoryClass="Sales\OrderBundle\Repository\SourceRepository")
 * @UniqueEntity("name")
 * @Vich\Uploadable()
 */
class Source
{
    /**
     * @var int
     *
     * @Groups({"source_list", "order_list"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Groups({"source_list", "order_list"})
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @Groups({"source_list", "order_list"})
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @Groups({"source_list"})
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var File
     *
     * @Vich\UploadableField(mapping="image", fileNameProperty="imageName")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $imageName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Order", mappedBy="source", cascade={"remove"})
     */
    private $orders;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orders = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Source
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
     * @return Source
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
     * Set comment
     *
     * @param string $comment
     *
     * @return Source
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
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Source
     */
    public function setImage(File $image = null)
    {
        $this->image = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $imageName
     *
     * @return Source
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Add order
     *
     * @param \Sales\OrderBundle\Entity\Order $order
     *
     * @return Source
     */
    public function addOrder(\Sales\OrderBundle\Entity\Order $order)
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \Sales\OrderBundle\Entity\Order $order
     */
    public function removeOrder(\Sales\OrderBundle\Entity\Order $order)
    {
        $this->orders->removeElement($order);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
