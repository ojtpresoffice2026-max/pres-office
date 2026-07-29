<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(message: 'Username should not be blank.')]
    #[Assert\Length(
        min: 3,
        max: 180,
        minMessage: 'Username should be at least {{ limit }} characters long.',
        maxMessage: 'Username should not exceed {{ limit }} characters.'
    )]
    private ?string $username = null;

    /**
     * Hashed password — stored. Never validate this field directly.
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * Raw password typed by the user — NOT persisted, only used in forms.
     */
    #[Assert\NotBlank(message: 'Password should not be blank.')]
    #[Assert\Length(
        min: 8,
        max: 4096,
        minMessage: 'Password should be at least {{ limit }} characters long.',
        maxMessage: 'Password should not exceed {{ limit }} characters.'
    )]
    private ?string $plainPassword = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message: 'Role should not be blank.')]
    #[Assert\Choice(
        choices: ['ROLE_USER', 'ROLE_ADMIN'],
        message: 'Choose a valid role.'
    )]
    private ?string $role = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): static
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): static
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): static
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Required by UserInterface — Symfony Security expects an array of role strings.
     */
    public function getRoles(): array
    {
        $roles = [$this->role ?? 'ROLE_USER'];
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    /**
     * Required by UserInterface — the identifier Symfony uses to load the user.
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * Required by UserInterface — clear any temporary sensitive data after auth.
     */
    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }
}