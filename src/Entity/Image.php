<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Entity\Traits\HasDescriptionTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasPriorityTrait;
use App\Entity\Traits\HasTimestampTrait;
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Delete(),
    ]
)]
class Image
{
    use HasIdTrait;
    use HasDescriptionTrait;
    use HasTimestampTrait;
    use HasPriorityTrait;

    #[ORM\Column(length: 255)]
    #[Groups('get')]
    private ?string $path = null;

    #[ORM\Column]
    private ?int $size = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Recipe $recipe = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Step $step = null;

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): static
    {
        $this->size = $size;

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

    public function getStep(): ?Step
    {
        return $this->step;
    }

    public function setStep(?Step $step): static
    {
        $this->step = $step;

        return $this;
    }
}
