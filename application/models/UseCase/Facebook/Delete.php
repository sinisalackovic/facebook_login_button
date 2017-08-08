<?php

namespace Model\UseCase\Facebook;

use G4\CleanCore\UseCase\UseCaseAbstract;
use Model\Domain\ValueObject\IntegerNumber;
use Model\Domain\Facebook\FacebookConstants;
use Model\Domain\Facebook\FacebookProfileRepository;

class Delete extends UseCaseAbstract
{
    public function run()
    {
        if(isset($_REQUEST['signed_request'])) {
            $this->parseSignedRequest($_REQUEST['signed_request']);
        }
    }

    public function parseSignedRequest($request)
    {
        list($encodedSig, $payload) = explode('.', $request, 2);

        $sig         = $this->urlDecode($encodedSig);
        $data        = json_decode($this->urlDecode($payload), true);
        $expectedSig = hash_hmac('sha256', $payload, FacebookConstants::APP_SECRET, true);

        if($sig == $expectedSig) {
            (new FacebookProfileRepository())->setInactive(new IntegerNumber($data['user_id']));
        } else {
            throw new \Exception('Bad Signed JSON signature.');
        }
    }

    public function urlDecode($input)
    {
        return base64_decode(strtr($input, '-_', '+/'));
    }
}