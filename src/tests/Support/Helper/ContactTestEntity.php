<?php

declare(strict_types=1);

namespace App\Tests\Support\Helper;

use App\Entity\Contact;

class ContactTestEntity extends Contact
{
  public function getId():int
  {
    return 123;
  }
}
