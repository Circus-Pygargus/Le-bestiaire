<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @Vich\Uploadable
 */
class Image
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
     * @ORM\Column(type="string", length=255)
     */
    private $fileName;

    /**
     * @Vich\UploadableField(mapping="bestiaire_images", fileNameProperty="file_name")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $postedBy;

    /**
     * @var \DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity=Category::class, mappedBy="featuredImage", cascade={"persist"})
     */
    private $featuredForCategory;

    /**
     * @ORM\OneToOne(targetEntity=Monster::class, mappedBy="featuredImage", cascade={"persist"})
     */
    private $featuredForMonster;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
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

    public function setFileName(?string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile(File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getPostedBy(): ?User
    {
        return $this->postedBy;
    }

    public function setPostedBy(?User $postedBy): self
    {
        $this->postedBy = $postedBy;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function getFeaturedForCategory(): ?Category
    {
        return $this->featuredForCategory;
    }

    public function setFeaturedForCategory(Category $featuredForCategory): self
    {
        // set the owning side of the relation if necessary
        if ($featuredForCategory->getFeaturedImage() !== $this) {
            $featuredForCategory->setFeaturedImage($this);
        }

        $this->featuredForCategory = $featuredForCategory;

        return $this;
    }

    public function getFeaturedForMonster (): ?Monster
    {
        return $this->featuredForMonster;
    }

    public function setFeaturedForMonster (Monster $featuredForMonster): self
    {
        if ($featuredForMonster->getFeaturedImage() !== $this) {
            $featuredForMonster->setFeaturedImage($this);
        }

        $this->featuredForMonster = $featuredForMonster;

        return $this;
    }
}
