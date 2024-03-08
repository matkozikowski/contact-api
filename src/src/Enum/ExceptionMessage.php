<?php

declare(strict_types=1);

namespace App\Enum;

enum ExceptionMessage: string
{
  case CREATE_ENTITY_FAILD = 'There was a problem saving the data.';

  case QUERY_ENTITY_FAILD = 'There was a problem with getting data.';
}
