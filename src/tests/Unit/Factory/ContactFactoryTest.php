<?php

declare(strict_types=1);

namespace App\Tests\Unit\Factory;

use App\Entity\Contact;
use App\Factory\ContactFactory;
use App\Request\Dto\CreateMessageDto;

class ContactFactoryTest extends \Codeception\Test\Unit
{

    public function testCreateContactEntity(): void
    {
        $name = 'Test';
        $surname = 'Test';
        $email = 'test.test@local.lc';
        $message = 'Lorem ipsum dolor';
        $terms = true;

        $messageDto = new CreateMessageDto(
            name: $name,
            surname: $surname,
            email: $email,
            message: $message,
            terms: $terms,
        );

        $this->assertInstanceOf(Contact::class, ContactFactory::create($messageDto));
    }
}
