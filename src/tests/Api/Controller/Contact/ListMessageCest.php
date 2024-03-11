<?php

declare(strict_types=1);

namespace App\Tests\Api;

use App\Tests\Support\ApiTester;
use Symfony\Component\HttpFoundation\Response;

class ListMessageCest
{
    public function tryToGetMessageList(ApiTester $I): void
    {
        $structure = [
            'data' => [
                [
                    'id' => 'integer',
                    'name' => 'string',
                    'surname' => 'string',
                    'email' => 'string:email',
                    'message' => 'string',
                    'terms' => 'boolean',
                ]
            ]
        ];

        $I->sendGet('/contact/message');
        
        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType($structure);
    }
}
