<?php 

declare(strict_types=1);

namespace App\Controller\Contact;

use App\Handler\CreateMessage as CreateMessageHandler;
use App\Request\Dto\CreateMessageDto;
use OpenApi\Attributes as Docs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/contact/message', methods: ['POST'])]
final class CreateMessage extends AbstractController
{
    #[Docs\Response(
        response: Response::HTTP_NO_CONTENT,
        description: 'Create contact message.',
        content: null
    )]
    #[Docs\Tag(name: 'contact')]
    public function __invoke(
        Request $request,
        RateLimiterFactory $anonymousApiLimiter,
        CreateMessageHandler $createMessageHandler,
        #[MapRequestPayload] CreateMessageDto $createMessageDto
    ): JsonResponse {

        $limiter = $anonymousApiLimiter->create($request->getClientIp());

        if (false === $limiter->consume(1)->isAccepted()) {
            throw new TooManyRequestsHttpException();
        }

        try {
            $createMessageHandler->handle($createMessageDto);
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return $this->json(['detail' => $e->getMessage(), 'status' => $e->getCode()], $e->getCode());
        }
    }
}
