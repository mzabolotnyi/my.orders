<?php

namespace Home\SalesBundle\Entity;

use AppBundle\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Home\MediaBundle\Entity\Media;
use JMS\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Source
 *
 * @ORM\Table(name="sales_source")
 * @ORM\Entity
 * @UniqueEntity("name")
 */
class Source
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

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
     * @Assert\NotBlank
     * @Groups({"source_list", "order_list"})
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\Url
     * @Groups({"source_list", "order_list"})
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @Groups({"source_list", "order_list"})
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var Media
     *
     * @Groups({"source_list", "order_list"})
     * @ORM\ManyToOne(targetEntity="Home\MediaBundle\Entity\Media", cascade={"persist"})
     */
    private $icon;

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
     * Set url
     *
     * @param string $url
     *
     * @return Source
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
     * Set icon
     *
     * @param \Home\MediaBundle\Entity\Media $icon
     *
     * @return Source
     */
    public function setIcon(\Home\MediaBundle\Entity\Media $icon = null)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return \Home\MediaBundle\Entity\Media
     */
    public function getIcon()
    {
        return $this->icon;
    }
}
