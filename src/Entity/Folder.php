<?php

namespace App\Entity;

use App\Repository\FolderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FolderRepository::class)]
class Folder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $scanned_folder_no = null;

    /**
     * @var Collection<int, Shelf>
     */
    #[ORM\OneToMany(targetEntity: Shelf::class, mappedBy: 'folder')]
    private Collection $shelves;

    public function __construct()
    {
        $this->shelves = new ArrayCollection();
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

    public function getScannedFolderNo(): ?string
    {
        return $this->scanned_folder_no;
    }

    public function setScannedFolderNo(string $scanned_folder_no): static
    {
        $this->scanned_folder_no = $scanned_folder_no;
        return $this;
    }

    public function getShelves(): Collection
    {
        return $this->shelves;
    }

    public function addShelf(Shelf $shelf): static
    {
        if (!$this->shelves->contains($shelf)) {
            $this->shelves->add($shelf);
            $shelf->setFolder($this);
        }

        return $this;
    }

    public function removeShelf(Shelf $shelf): static
    {
        if ($this->shelves->removeElement($shelf)) {
            if ($shelf->getFolder() === $this) {
                $shelf->setFolder(null);
            }
        }

        return $this;
    }
}