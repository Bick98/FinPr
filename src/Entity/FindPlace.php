<?php

namespace App\Entity;

use App\Repository\FindPlaceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FindPlaceRepository::class)
 */
class FindPlace
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Art::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $artName;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Place;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtName(): ?Art
    {
        return $this->artName;
    }

    public function setArtName(Art $artName): self
    {
        $this->artName = $artName;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->Place;
    }

    public function setPlace(?Place $Place): self
    {
        $this->Place = $Place;

        return $this;
    }
}
