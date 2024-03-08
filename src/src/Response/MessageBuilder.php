<?php

declare(strict_types=1);

namespace App\Response;

use App\Response\Contact\Message;
use App\Response\Contact\Messages;

class MessageBuilder
{
  public function build(array $data): Messages
  {
    $messages = new Messages();

    foreach ($data as $item) {
      $message = new Message();
      $message->setId($item->getId());
      $message->setName($item->getName());
      $message->setSurname($item->getSurname());
      $message->setEmail($item->getEmail());
      $message->setMessage($item->getMessage());
      $message->setTerms($item->getTerms());
      
      $messages->addData($message);
    }

    return $messages;
  }
}