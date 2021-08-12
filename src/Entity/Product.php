<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @Vich\Uploadable()
 */ 
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uniqueName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hubTitle;

    /**
     * @ORM\OneToMany(targetEntity=WeeklyOrderableProduct::class, mappedBy="product")
     */
    private $weeklyOrderableProducts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    public function __construct()
    {
        $this->weeklyOrderableProducts = new ArrayCollection();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUniqueName(): ?string
    {
        return $this->uniqueName;
    }

    public function setUniqueName(string $uniqueName): self
    {
        $this->uniqueName = $uniqueName;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescr(): ?string
    {
        return $this->descr;
    }

    public function setDescr(?string $descr): self
    {
        $this->descr = $descr;

        return $this;
    }

    public function getHubTitle(): ?string
    {
        return $this->hubTitle;
    }

    public function setHubTitle(string $hubTitle): self
    {
        $this->hubTitle = $hubTitle;

        return $this;
    }

    /**
     * @return Collection|WeeklyOrderableProduct[]
     */
    public function getWeeklyOrderableProducts(): Collection
    {
        return $this->weeklyOrderableProducts;
    }

    public function addWeeklyOrderableProduct(WeeklyOrderableProduct $weeklyOrderableProduct): self
    {
        if (!$this->weeklyOrderableProducts->contains($weeklyOrderableProduct)) {
            $this->weeklyOrderableProducts[] = $weeklyOrderableProduct;
            $weeklyOrderableProduct->setProduct($this);
        }

        return $this;
    }

    public function removeWeeklyOrderableProduct(WeeklyOrderableProduct $weeklyOrderableProduct): self
    {
        if ($this->weeklyOrderableProducts->removeElement($weeklyOrderableProduct)) {
            // set the owning side to null (unless already changed)
            if ($weeklyOrderableProduct->getProduct() === $this) {
                $weeklyOrderableProduct->setProduct(null);
            }
        }

        return $this;
    }
    public function __toString(): string{
        return $this->uniqueName;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
     /**
     * @return mixed
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param mixed $imageFile
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
