<?php

namespace App\Entity;

use App\Entity\Image;
use App\Entity\Movie;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @Vich\Uploadable
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=image::class, inversedBy="featuredForCategory", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $featuredImage;

    /**
     * @ORM\OneToOne(targetEntity=Movie::class, inversedBy="featuredForCategory", cascade={"persist"})
     */
    private $featuredMovie;

    /**
     * @ORM\Column(type="text")
     */
    private $explanatoryText;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFeaturedImage(): ?image
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage(image $featuredImage): self
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    public function getFeaturedMovie(): ?Movie
    {
        return $this->featuredMovie;
    }

    public function setFeaturedMovie(?Movie $featuredMovie): self
    {
        $this->featuredMovie = $featuredMovie;

        return $this;
    }

    public function getExplanatoryText(): ?string
    {
        return $this->explanatoryText;
    }

    public function setExplanatoryText(string $explanatoryText): self
    {
        $this->explanatoryText = $explanatoryText;

        return $this;
    }
}
