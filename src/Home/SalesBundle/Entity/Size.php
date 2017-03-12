<?php

namespace Home\SalesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Size
 *
 * @ORM\Table(name="size", uniqueConstraints={@UniqueConstraint(name="size_unique", columns={"name", "category_id"})})
 * @ORM\Entity
 * @UniqueEntity(fields={"name", "category"})
 */
class Size
{
    /**
     * @var int
     *
     * @Groups({"size_list", "size_type_list", "order_list"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Groups({"size_list", "size_type_list", "order_list"})
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var SizeCategory
     *
     * @Assert\NotBlank
     * @Groups({"size_list"})
     * @ORM\ManyToOne(targetEntity="SizeCategory", inversedBy="sizes")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    private $category;

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
     * Set category
     *
     * @param \Home\SalesBundle\Entity\SizeCategory $category
     *
     * @return Size
     */
    public function setCategory(\Home\SalesBundle\Entity\SizeCategory $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Home\SalesBundle\Entity\SizeCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
}
