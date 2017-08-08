<?php

namespace Model\UseCase\Facebook;

use Facebook\Facebook;
use G4\CleanCore\UseCase\UseCaseAbstract;
use Model\Domain\ValueObject\StringLiteral;
use Model\Domain\Facebook\FacebookConstants;
use Model\Domain\Facebook\FacebookProfileEntity;
use Model\Domain\Facebook\FacebookTokenRepository;
use Model\Domain\Facebook\FacebookProfileRepository;

class Index extends UseCaseAbstract
{
    public function run()
    {
        //TODO Sinisa - perhaps to move to DI
        $fb = new Facebook([
            FacebookConstants::APP_ID_NAME      => FacebookConstants::APP_ID,
            FacebookConstants::APP_SECRET_NAME  => FacebookConstants::APP_SECRET,
        ]);

        $tokenLongLived = new StringLiteral($this->getLongLivedToken($fb));
        $fb->setDefaultAccessToken((string) $tokenLongLived);

        $profileEntity = $this->getProfileEntity($fb);
        $profileEntity->setToken($tokenLongLived);

        $this->addProfileToDatabase($profileEntity);

        $this->getResponse()->addPartToResponseObject(
            FacebookConstants::PROFILE_RESPONSE, $profileEntity
        );

        $this->getResponse()->addPartToResponseObject(
            FacebookConstants::LOGOUT_RESPONSE, $this->getLogoutUrl($fb, $tokenLongLived)
        );
    }

    private function getProfileEntity(Facebook $fb)
    {
        return (new FacebookProfileRepository())->find($fb);
    }

    private function getLongLivedToken(Facebook $fb)
    {
        return (new FacebookTokenRepository($fb))->getTokenLongLived()->getValue();
    }

    private function addProfileToDatabase(FacebookProfileEntity $profileEntity)
    {
        (new FacebookProfileRepository())->add($profileEntity);
        return $this;
    }

    private function getLogoutUrl(Facebook $fb, StringLiteral $tokenLongLived)
    {
        return $fb
            ->getRedirectLoginHelper()
            ->getLogoutUrl((string) $tokenLongLived, FacebookConstants::FB_LOGOUT_URL);
    }
}