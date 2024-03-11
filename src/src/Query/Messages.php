<?php 

declare(strict_types=1);

namespace App\Query;

use App\Exception\QueryEntityException;
use App\Repository\ContactRepository;

class Messages
{
    public function __construct(private readonly ContactRepository $contactRepository)
    {
    }

    public function all(): array
    {
        try {
            return $this->contactRepository->findAll();
        } catch(\Throwable $e) {
            throw new QueryEntityException();
        }
    }
}
