<?php

declare(strict_types=1);

namespace App\Tests\Api\Controller\Contact;

use App\Tests\Support\ApiTester;
use Symfony\Component\HttpFoundation\Response;

class CreateMessageCest
{
    public function tryToCreateMessage(ApiTester $I): void
    {
        $data = [
            'name' => 'RestTest',
            'surname' => 'RestTest',
            'email' => 'resttest@local.lc',
            'message' => 'RestTestMessage',
            'terms' => true,
        ];

        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendPost('/contact/message', $data);
        $I->seeResponseCodeIs(Response::HTTP_NO_CONTENT);
    }

    public function tryToValidateMissingBody(ApiTester $I): void
    {
        $details = <<<EOF
        name: This value should be of type string.
        surname: This value should be of type string.
        email: This value should be of type string.
        message: This value should be of type string.
        terms: This value should be of type bool.
        EOF;

        $response = [
            'type' => 'https://symfony.com/errors/validation',
            'title' => 'Validation Failed',
            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'detail' => $details,
            'violations' => [
                [
                    'propertyPath' => 'name',
                    'title' => 'This value should be of type string.',
                    'template' => 'This value should be of type {{ type }}.',
                    'parameters' => [
                        '{{ type }}' => 'string',
                        'hint' => 'Failed to create object because the class misses the "name" property.'
                    ]
                ],
                [
                    'propertyPath' => 'surname',
                    'title' => 'This value should be of type string.',
                    'template' => 'This value should be of type {{ type }}.',
                    'parameters' => [
                        '{{ type }}' => 'string',
                        'hint' => 'Failed to create object because the class misses the "surname" property.'
                    ]
                ],
                [
                    'propertyPath' => 'email',
                    'title' => 'This value should be of type string.',
                    'template' => 'This value should be of type {{ type }}.',
                    'parameters' => [
                        '{{ type }}' => 'string',
                        'hint' => 'Failed to create object because the class misses the "email" property.'
                    ]
                ],
                [
                    'propertyPath' => 'message',
                    'title' => 'This value should be of type string.',
                    'template' => 'This value should be of type {{ type }}.',
                    'parameters' => [
                        '{{ type }}' => 'string',
                        'hint' => 'Failed to create object because the class misses the "message" property.'
                    ]
                ],
                [
                    'propertyPath' => 'terms',
                    'title' => 'This value should be of type bool.',
                    'template' => 'This value should be of type {{ type }}.',
                    'parameters' => [
                        '{{ type }}' => 'bool',
                        'hint' => 'Failed to create object because the class misses the "terms" property.'
                    ]
                ],
            ]
        ];

        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendPost('/contact/message', []);
        $I->seeResponseCodeIs(Response::HTTP_UNPROCESSABLE_ENTITY);
        $I->seeResponseContainsJson($response);
    }

    public function tryToCheckInvalidEmailInBody(ApiTester $I): void
    {
        $response = [
            'type' => 'https://symfony.com/errors/validation',
            'title' => 'Validation Failed',
            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'detail' => 'email: The email "resttestlocal.lc" is not a valid email.',
            'violations' => [
                [
                    'propertyPath' => 'email',
                    'title' => 'The email "resttestlocal.lc" is not a valid email.',
                    'template' => 'The email {{ value }} is not a valid email.',
                    'parameters' => [
                        '{{ value }}' => '"resttestlocal.lc"',
                    ],
                    'type' => 'urn:uuid:bd79c0ab-ddba-46cc-a703-a7a4b08de310'
                ],
            ]
        ];

        $data = [
            'name' => 'RestTest',
            'surname' => 'RestTest',
            'email' => 'resttestlocal.lc',
            'message' => 'RestTestMessage',
            'terms' => true,
        ];

        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendPost('/contact/message', $data);
        $I->seeResponseCodeIs(Response::HTTP_UNPROCESSABLE_ENTITY);
        $I->seeResponseContainsJson($response);
    }

    public function tryToCheckUncheckedTermsInBody(ApiTester $I): void
    {
        $response = [
            'type' => 'https://symfony.com/errors/validation',
            'title' => 'Validation Failed',
            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'detail' => 'terms: Terms is required.',
            'violations' => [
                [
                    'propertyPath' => 'terms',
                    'title' => 'Terms is required.',
                    'template' => 'Terms is required.',
                    'parameters' => [
                        '{{ value }}' => 'false',
                    ],
                    'type' => 'urn:uuid:c1051bb4-d103-4f74-8988-acbcafc7fdc3'
                ],
            ]
        ];

        $data = [
            'name' => 'RestTest',
            'surname' => 'RestTest',
            'email' => 'resttest@local.lc',
            'message' => 'RestTestMessage',
            'terms' => false,
        ];

        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendPost('/contact/message', $data);
        $I->seeResponseCodeIs(Response::HTTP_UNPROCESSABLE_ENTITY);
        $I->seeResponseContainsJson($response);
    }
}


