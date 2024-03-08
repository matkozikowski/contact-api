<?php 

declare(strict_types=1);

namespace App\Response\Contact;

use OpenApi\Attributes as Docs;
use Symfony\Component\Serializer\Annotation\Groups;

class Message
{
    #[Groups(["response"])]
    #[Docs\Property(description: 'Unique ID message')]
    private int $id;
    
    #[Groups(["response"])]
    #[Docs\Property(description: 'Customer name')]
    private string $name;

    #[Groups(["response"])]
    #[Docs\Property(description: 'Customer surname')]
    private string $surname;

    #[Groups(["response"])]
    #[Docs\Property(description: 'Customer email address')]
    private string $email;

    #[Groups(["response"])]
    #[Docs\Property(description: 'Message from customer')]
    private string $message;

    #[Groups(["response"])]
    #[Docs\Property(description: 'Information if customer checked terms and conditions')]
    private bool $terms;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getTerms(): bool
    {
        return $this->terms;
    }

    public function setTerms(bool $terms): void
    {
        $this->terms = $terms;
    }
}
