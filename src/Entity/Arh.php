<?php

namespace App\Entity;

use App\Repository\ArhRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArhRepository::class)
 */
class Arh
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $arhName;

    /**
     * @ORM\ManyToMany(targetEntity=Art::class, mappedBy="arh2")
     */
    private $art;

    /**
     * @ORM\ManyToMany(targetEntity=Art::class, mappedBy="Arh")
     */
    private $art2;

    public function __construct()
    {
        $this->art = new ArrayCollection();
        $this->art2 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArhName(): ?string
    {
        return $this->arhName;
    }

    public function setArhName(string $arhName): self
    {
        $this->arhName = $arhName;

        return $this;
    }
    public function __toString():string{
        // to show the name of the Category in the select
        return $this->arhName;
    }

    /**
     * @return Collection<int, Art>
     */
    public function getArt(): Collection
    {
        return $this->art;
    }

    public function addArt(Art $art): self
    {
        if (!$this->art->contains($art)) {
            $this->art[] = $art;
            $art->addArh2($this);
        }

        return $this;
    }

    public function removeArt(Art $art): self
    {
        if ($this->art->removeElement($art)) {
            $art->removeArh2($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Art>
     */
    public function getArt2(): Collection
    {
        return $this->art2;
    }

    public function addArt2(Art $art2): self
    {
        if (!$this->art2->contains($art2)) {
            $this->art2[] = $art2;
            $art2->addArh($this);
        }

        return $this;
    }

    public function removeArt2(Art $art2): self
    {
        if ($this->art2->removeElement($art2)) {
            $art2->removeArh($this);
        }

        return $this;
    }
}
