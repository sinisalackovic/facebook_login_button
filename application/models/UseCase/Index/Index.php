<?php

namespace Model\UseCase\Index;

use Facebook\Facebook;
use G4\CleanCore\UseCase\UseCaseAbstract;
use Model\Domain\Facebook\FacebookConstants;

class Index extends UseCaseAbstract
{
    public function run()
    {
        $fb = new Facebook([
            FacebookConstants::APP_ID_NAME     => FacebookConstants::APP_ID,
            FacebookConstants::APP_SECRET_NAME => FacebookConstants::APP_SECRET,
        ]);

        $this->getResponse()->addPartToResponseObject(FacebookConstants::FB_LOGIN_URL, $this->getLoginUrl($fb));
    }

    private function getLoginUrl(Facebook $fb)
    {
        return $fb->getRedirectLoginHelper()->getLoginUrl(FacebookConstants::FB_CALLBACK_URL);
    }
}