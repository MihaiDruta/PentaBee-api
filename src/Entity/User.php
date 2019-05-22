<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class User
{
    public const SENIORITY_JUNIOR = 0;
    public const SENIORITY_MIDDLE = 1;
    public const SENIORITY_SENIOR = 2;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Groups({"UserDetail", "ActivityDetails"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     * @Groups({"UserDetail"})
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     * @Groups({"UserDetail"})
     */
    private $position;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Groups({"UserDetail"})
     */
    private $seniority = self::SENIORITY_JUNIOR;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     * @Groups({"UserDetail"})
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     * @Groups({"UserDetail"})
     */
    private $surname;

    /**
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     * @Groups({"UserDetail"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     * @Groups({"UserDetail"})
     */
    private $updatedAt;

    /**
     * @var Collection|Technology[]
     * @ORM\ManyToMany(targetEntity="Technology")
     * @Serializer\Expose()
     * @Groups({"UserDetail"})
     */
    protected $technologies;

    public function __construct()
    {
        $this->technologies = new ArrayCollection();
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * @param Technology $technology
     */
    public function addTechnology(Technology $technology): void
    {
        if ($this->technologies->contains($technology)) {
            return;
        }
        $this->technologies->add($technology);
    }

    /**
     * @param Technology $technology
     */
    public function removeTechnology(Technology $technology): void
    {
        if (!$this->technologies->contains($technology)) {
            return;
        }
        $this->technologies->removeElement($technology);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function getSeniority(): ?string
    {
        return $this->seniority;
    }

    public function setSeniority(string $seniority): void
    {
        $this->seniority = $seniority;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
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
