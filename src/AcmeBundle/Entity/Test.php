<?php

namespace App\AcmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DMS\Filter\Rules as Filter;
use App\AcmeBundle\Validator\Constraints as MyAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\AcmeBundle\Repository\TestRepository")
 * @MyAssert\Authorization()
 */
class Test
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @Groups({"elastica"})
     *
     * @Filter\Trim()
     * @Assert\NotBlank(message="post.title.empty")
     * @Filter\StripTags()
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    protected $approved = false;

    public function getApproved()
    {
        return $this->approved;
    }

    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Set title of this entity
     *
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the title of this Entity
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
