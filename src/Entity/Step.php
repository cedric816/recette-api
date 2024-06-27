<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasTimestampTrait;
use App\Repository\StepRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StepRepository::class)]
class Step
{
    use HasIdTrait;
    use HasTimestampTrait;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $priority = null;

    #[ORM\ManyToOne(inversedBy: 'steps')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recipe $recipe = null;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'step', orphanRemoval: true)]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): static
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setStep($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getStep() === $this) {
                $image->setStep(null);
            }
        }

        return $this;
    }
}
