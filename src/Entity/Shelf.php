<?php

namespace App\Entity;

use App\Repository\ShelfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShelfRepository::class)]
class Shelf
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $transfered_date = null;

    #[ORM\ManyToOne(inversedBy: 'shelves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Folder $folder = null;

    /**
     * @var Collection<int, DocumentFiling>
     */
    #[ORM\OneToMany(targetEntity: DocumentFiling::class, mappedBy: 'category')]
    private Collection $documentFilings;

    public function __construct()
    {
        $this->documentFilings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getTransferedDate(): ?\DateTimeImmutable
    {
        return $this->transfered_date;
    }

    public function setTransferedDate(\DateTimeImmutable $transfered_date): static
    {
        $this->transfered_date = $transfered_date;
        return $this;
    }

    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    public function setFolder(?Folder $folder): static
    {
        $this->folder = $folder;
        return $this;
    }

    public function getDocumentFilings(): Collection
    {
        return $this->documentFilings;
    }

    public function addDocumentFiling(DocumentFiling $documentFiling): static
    {
        if (!$this->documentFilings->contains($documentFiling)) {
            $this->documentFilings->add($documentFiling);
            $documentFiling->setCategory($this);
        }

        return $this;
    }

    public function removeDocumentFiling(DocumentFiling $documentFiling): static
    {
        if ($this->documentFilings->removeElement($documentFiling)) {
            if ($documentFiling->getCategory() === $this) {
                $documentFiling->setCategory(null);
            }
        }

        return $this;
    }
}