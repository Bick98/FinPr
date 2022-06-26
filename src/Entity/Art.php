<?php

namespace App\Entity;

use App\Repository\ArtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtRepository::class)
 */
class Art
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Arh::class)
     */
    private $arh;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artName;

    /**
     * @ORM\ManyToMany(targetEntity=Arh::class, inversedBy="art")
     */
    private $arh2;

    /**
     * @ORM\ManyToMany(targetEntity=Arh::class, inversedBy="art2")
     */
    private $Arh;

    public function __construct()
    {
        $this->arh = new ArrayCollection();
        $this->arh2 = new ArrayCollection();
        $this->Arh = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Arh>
     */
    public function getarh(): Collection
    {
        return $this->arh;
    }

    public function addArh(Arh $arh): self
    {
        if (!$this->arh->contains($arh)) {
            $this->arh[] = $arh;
             $arh->addArtName($this);
        }

        return $this;
    }

   /* public function removeArh(Arh $arh): self
    {
        $this->arh->removeElement($arh);

        return $this;
    }*/

    public function getArtName(): ?string
    {
        return $this->artName;
    }

    public function setArtName(string $artName): self
    {
        $this->artName = $artName;

        return $this;
    }
    public function __toString():string{
        // to show the name of the Category in the select
        return $this->artName;
    }

    /**
     * @return Collection<int, Arh>
     */
    public function getArh2(): Collection
    {
        return $this->arh2;
    }

    public function addArh2(Arh $arh2): self
    {
        if (!$this->arh2->contains($arh2)) {
            $this->arh2[] = $arh2;
        }

        return $this;
    }

    public function removeArh2(Arh $arh2): self
    {
        $this->arh2->removeElement($arh2);

        return $this;
    }

    public function removeArh(Arh $arh): self
    {
        $this->Arh->removeElement($arh);

        return $this;
    }
    
    
}
