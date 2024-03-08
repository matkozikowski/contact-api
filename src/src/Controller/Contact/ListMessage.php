<?php 

declare(strict_types=1);

namespace App\Controller\Contact;

use App\Response\Messages as MessagesResponse;
use App\Query\Messages as MessagesQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Response\MessageBuilder as MessageBuilderResponse;
use OpenApi\Attributes as Docs;
use App\Response\Contact\Message;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route('/contact/message', methods: ['GET'])]
final class ListMessage extends AbstractController
{ 
    #[Docs\Response(
        response: 200,
        description: 'Returns message collection.',
        content: new Docs\JsonContent(
            type: 'array',
            items: new Docs\Items(ref: new Model(type: Message::class, groups: ['response']))
        )
    )]
    #[Docs\Tag(name: 'contact')]
    public function __invoke(
        SerializerInterface $serializer, 
        MessagesQuery $messagesQuery, 
        MessageBuilderResponse $messageBuilderResponse
    ): JsonResponse {
        try {
            $messages = $messagesQuery->all();

            return $this->json($serializer->normalize($messageBuilderResponse->build($messages)));
        } catch (\Exception $e) {
            return $this->json(['detail' => $e->getMessage(), 'status' => $e->getCode()], $e->getCode());
        }
    }
}
