<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'ccje')]
class Ccje
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $no_of_comm = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $document_code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bearer_of_letter = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $date_receive = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $time_receive = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $receiving_staff = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $letter_sender = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $office_designation = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $date_of_the_letter = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $content_of_the_letter = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $other_note = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoOfComm(): ?string
    {
        return $this->no_of_comm;
    }

    public function setNoOfComm(?string $no_of_comm): static
    {
        $this->no_of_comm = $no_of_comm;

        return $this;
    }

    public function getDocumentCode(): ?string
    {
        return $this->document_code;
    }

    public function setDocumentCode(?string $document_code): static
    {
        $this->document_code = $document_code;

        return $this;
    }

    public function getBearerOfLetter(): ?string
    {
        return $this->bearer_of_letter;
    }

    public function setBearerOfLetter(?string $bearer_of_letter): static
    {
        $this->bearer_of_letter = $bearer_of_letter;

        return $this;
    }

    public function getDateReceive(): ?\DateTimeImmutable
    {
        return $this->date_receive;
    }

    public function setDateReceive(?\DateTimeImmutable $date_receive): static
    {
        $this->date_receive = $date_receive;

        return $this;
    }

    public function getTimeReceive(): ?string
    {
        return $this->time_receive;
    }

    public function setTimeReceive(?string $time_receive): static
    {
        $this->time_receive = $time_receive;

        return $this;
    }

    public function getReceivingStaff(): ?string
    {
        return $this->receiving_staff;
    }

    public function setReceivingStaff(?string $receiving_staff): static
    {
        $this->receiving_staff = $receiving_staff;

        return $this;
    }

    public function getLetterSender(): ?string
    {
        return $this->letter_sender;
    }

    public function setLetterSender(?string $letter_sender): static
    {
        $this->letter_sender = $letter_sender;

        return $this;
    }

    public function getOfficeDesignation(): ?string
    {
        return $this->office_designation;
    }

    public function setOfficeDesignation(?string $office_designation): static
    {
        $this->office_designation = $office_designation;

        return $this;
    }

    public function getDateOfTheLetter(): ?\DateTimeImmutable
    {
        return $this->date_of_the_letter;
    }

    public function setDateOfTheLetter(?\DateTimeImmutable $date_of_the_letter): static
    {
        $this->date_of_the_letter = $date_of_the_letter;

        return $this;
    }

    public function getContentOfTheLetter(): ?string
    {
        return $this->content_of_the_letter;
    }

    public function setContentOfTheLetter(?string $content_of_the_letter): static
    {
        $this->content_of_the_letter = $content_of_the_letter;

        return $this;
    }

    public function getOtherNote(): ?string
    {
        return $this->other_note;
    }

    public function setOtherNote(?string $other_note): static
    {
        $this->other_note = $other_note;

        return $this;
    }
}
