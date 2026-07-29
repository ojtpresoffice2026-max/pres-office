<?php

namespace App\Entity;

use App\Repository\DocumentFilingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentFilingRepository::class)]
class DocumentFiling
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $document_no = null;

    #[ORM\ManyToOne(inversedBy: 'documentFilings')]
    private ?shelf $category = null;

    #[ORM\Column(length: 255)]
    private ?string $document_status = null;

    #[ORM\Column(length: 255)]
    private ?string $filed_by = null;

    #[ORM\Column(length: 255)]
    private ?string $indexed_by = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_index = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDocumentNo(): ?string
    {
        return $this->document_no;
    }

    public function setDocumentNo(string $document_no): static
    {
        $this->document_no = $document_no;

        return $this;
    }

    public function getCategory(): ?shelf
    {
        return $this->category;
    }

    public function setCategory(?shelf $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getDocumentStatus(): ?string
    {
        return $this->document_status;
    }

    public function setDocumentStatus(string $document_status): static
    {
        $this->document_status = $document_status;

        return $this;
    }

    public function getFiledBy(): ?string
    {
        return $this->filed_by;
    }

    public function setFiledBy(string $filed_by): static
    {
        $this->filed_by = $filed_by;

        return $this;
    }

    public function getIndexedBy(): ?string
    {
        return $this->indexed_by;
    }

    public function setIndexedBy(string $indexed_by): static
    {
        $this->indexed_by = $indexed_by;

        return $this;
    }

    public function getDateIndex(): ?\DateTimeImmutable
    {
        return $this->date_index;
    }

    public function setDateIndex(\DateTimeImmutable $date_index): static
    {
        $this->date_index = $date_index;

        return $this;
    }
}
