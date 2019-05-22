<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TechnologyRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class Technology
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Groups({"TechnologyDetail", "ActivityDetails"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Groups({"TechnologyDetail"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"TechnologyDetail"})
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"TechnologyDetail"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"TechnologyDetail"})
     */
    private $updatedAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
