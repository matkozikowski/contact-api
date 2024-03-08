<?php 

declare(strict_types=1);

namespace App\Request\Dto;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class CreateMessageDto
{
  public function __construct(
    #[NotBlank(message: 'Name is required.')]
    #[Type('string')]
    public readonly string $name,

    #[NotBlank(message: 'Surname is required.')]
    #[Type('string')]
    public readonly string $surname,

    #[NotBlank(message: 'Email is required.')]
    #[Type('string')]
    public readonly string $email,

    #[NotBlank(message: 'Message is required.')]
    #[Type('string')]
    public readonly string $message,

    #[NotBlank(message: 'Terms is required.')]
    #[Type('bool')]
    public readonly bool $terms,
  ) {

  }
}
