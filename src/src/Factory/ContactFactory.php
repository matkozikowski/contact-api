<?php 

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Contact;
use App\Request\Dto\CreateMessageDto;

class ContactFactory
{
  public static function create(CreateMessageDto $messageDto): Contact
  {
    $contact = new Contact();

    $contact->setName($messageDto->name);
    $contact->setSurname($messageDto->surname);
    $contact->setEmail($messageDto->email);
    $contact->setMessage($messageDto->message);
    $contact->setTerms($messageDto->terms);

    return $contact;
  }
}
