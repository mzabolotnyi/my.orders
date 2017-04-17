<?php

namespace Home\SalesBundle\Entity;

use AppBundle\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Size
 *
 * @ORM\Table(name="sales_size")
 * @ORM\Entity
 */
class Size
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

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
     * @ORM\ManyToOne(targetEntity="SizeCategory", inversedBy="sizes")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
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
