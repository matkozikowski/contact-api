<?php 

declare(strict_types=1);

namespace App\Response\Contact;

class Messages
{
    private array $data = [];

    public function addData(Message $message)
    {
        $this->data[] = $message;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
