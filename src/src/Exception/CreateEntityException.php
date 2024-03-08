<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use App\Enum\ExceptionMessage;

class CreateEntityException extends \Exception
{
  public function __construct()
  {
    parent::__construct(ExceptionMessage::CREATE_ENTITY_FAILD->value, Response::HTTP_BAD_REQUEST);
  }
}
