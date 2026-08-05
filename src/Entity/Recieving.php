<?php

namespace App\Entity;

use App\Repository\RecievingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecievingRepository::class)]
class Recieving
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $number_of_comm = null;

    #[ORM\Column(length: 255)]
    private ?string $document_code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bearer_of_letter = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $date_receive = null;

    #[ORM\Column(length: 255)]
    private ?string $time_receive = null;

    #[ORM\Column(length: 255)]
    private ?string $receiving_staff = null;

    #[ORM\Column(length: 255)]
    private ?string $letter_sender = null;

    #[ORM\Column(length: 255)]
    private ?string $office_designation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $Date_of_the_letter = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $other_note_remarks = null;

    #[ORM\Column(length: 255)]
    private ?string $receiving_staff_action = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOfComm(): ?string
    {
        return $this->number_of_comm;
    }

    public function setNumberOfComm(string $number_of_comm): static
    {
        $this->number_of_comm = $number_of_comm;

        return $this;
    }

    public function getDocumentCode(): ?string
    {
        return $this->document_code;
    }

    public function setDocumentCode(string $document_code): static
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

    public function getDateReceive(): ?\DateTime
    {
        return $this->date_receive;
    }

    public function setDateReceive(?\DateTime $date_receive): static
    {
        $this->date_receive = $date_receive;

        return $this;
    }

    public function getTimeReceive(): ?string
    {
        return $this->time_receive;
    }

    public function setTimeReceive(string $time_receive): static
    {
        $this->time_receive = $time_receive;

        return $this;
    }

    public function getReceivingStaff(): ?string
    {
        return $this->receiving_staff;
    }

    public function setReceivingStaff(string $receiving_staff): static
    {
        $this->receiving_staff = $receiving_staff;

        return $this;
    }

    public function getLetterSender(): ?string
    {
        return $this->letter_sender;
    }

    public function setLetterSender(string $letter_sender): static
    {
        $this->letter_sender = $letter_sender;

        return $this;
    }

    public function getOfficeDesignation(): ?string
    {
        return $this->office_designation;
    }

    public function setOfficeDesignation(string $office_designation): static
    {
        $this->office_designation = $office_designation;

        return $this;
    }

    public function getDateOfTheLetter(): ?\DateTime
    {
        return $this->Date_of_the_letter;
    }

    public function setDateOfTheLetter(\DateTime $Date_of_the_letter): static
    {
        $this->Date_of_the_letter = $Date_of_the_letter;

        return $this;
    }

    public function getOtherNoteRemarks(): ?string
    {
        return $this->other_note_remarks;
    }

    public function setOtherNoteRemarks(?string $other_note_remarks): static
    {
        $this->other_note_remarks = $other_note_remarks;

        return $this;
    }

    public function getReceivingStaffAction(): ?string
    {
        return $this->receiving_staff_action;
    }

    public function setReceivingStaffAction(string $receiving_staff_action): static
    {
        $this->receiving_staff_action = $receiving_staff_action;

        return $this;
    }
}
