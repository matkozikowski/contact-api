<?php

declare(strict_types=1);

namespace App\Tests\Unit\Response;

use App\Entity\Contact;
use App\Response\Contact\Message;
use App\Response\Contact\Messages;
use App\Response\MessageBuilder;
use App\Repository\ContactRepository;
use App\Query\Messages as MessagesQuery;

use App\Tests\Support\Helper\ContactTestEntity;

class MessageBuilderTest extends \Codeception\Test\Unit
{
    private ContactRepository $contactRepository;


    public function _before(): void
    {
        $contactOne = (new ContactTestEntity)
            ->setName('TestOne')
            ->setSurname('TestOne')
            ->setEmail('testone.testone@local.lc')
            ->setMessage('Lorem ipsum dolor amit')
            ->setTerms(true)
        ;

        $contactTwo = (new ContactTestEntity)
            ->setName('TestTwo')
            ->setSurname('TestTwo')
            ->setEmail('testtwo.testtwo@local.lc')
            ->setMessage('Lorem ipsum dolor')
            ->setTerms(true)
        ;
        
        $this->contactRepository = $this->createMock(ContactRepository::class);
        $this->contactRepository->expects($this->once())->method('findAll')->willReturn([$contactOne, $contactTwo]);
    }

    // tests
    public function testMessageBuilder(): void
    {
        $messageOne = new Message();
        $messageOne->setId(123);
        $messageOne->setName('TestOne');
        $messageOne->setSurname('TestOne');
        $messageOne->setEmail('testone.testone@local.lc');
        $messageOne->setMessage('Lorem ipsum dolor amit');
        $messageOne->setTerms(true);

        $messageTwo = new Message();
        $messageTwo->setId(123);
        $messageTwo->setName('TestTwo');
        $messageTwo->setSurname('TestTwo');
        $messageTwo->setEmail('testtwo.testtwo@local.lc');
        $messageTwo->setMessage('Lorem ipsum dolor');
        $messageTwo->setTerms(true);

        $expectedMessages = new Messages();
        $expectedMessages->addData($messageOne);
        $expectedMessages->addData($messageTwo);

        $messageQuery = new MessagesQuery($this->contactRepository);
        $messages = $messageQuery->all();
        
        $messageBuilder = new MessageBuilder();
        $result = $messageBuilder->build($messages);


        $this->assertEquals($expectedMessages, $result);
    }
}
