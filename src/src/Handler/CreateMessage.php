<?php 

declare(strict_types=1);

namespace App\Handler;

use App\Exception\CreateEntityException;
use App\Factory\ContactFactory;
use App\Repository\ContactRepository;
use App\Request\Dto\CreateMessageDto;

class CreateMessage
{
  public function __construct(private readonly ContactRepository $contactRepository)
  {
  }

  public function handle(CreateMessageDto $createMessageDto): void
  {
    try {
      $this->contactRepository->create(ContactFactory::create($createMessageDto));
    } catch (\Throwable $ex) {
      throw new CreateEntityException();
    }
  }
}
