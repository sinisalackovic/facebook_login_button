<?php

namespace Model\Domain\Facebook;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Exceptions\FacebookResponseException;

class FacebookTokenRepository
{
    private $accessToken;
    private $oAuth2Client;
    private $helper;

    public function __construct(Facebook $fb)
    {
        $this->helper       = $fb->getRedirectLoginHelper();
        $this->oAuth2Client = $fb->getOAuth2Client();
        $this->accessToken  = $this->setToken();
    }

    public function getToken()
    {
        return $this->accessToken;
    }

    public function getTokenLongLived()
    {
        if (!$this->accessToken->isLongLived()) {
            try {
                return $this->oAuth2Client->getLongLivedAccessToken($this->accessToken);
            } catch (FacebookSDKException $e) {
                throw new \Exception("Error getting long-lived access token: " . $this->helper->getMessage());
            }
        }
        return $this->accessToken;
    }
    
    private function setToken()
    {
        try {
            $this->accessToken = $this->helper->getAccessToken();
        } catch(FacebookResponseException $e) {
            throw new \Exception('Graph returned an error: ' . $e->getMessage());
        } catch(FacebookSDKException $e) {
            throw new \Exception('Facebook SDK returned an error: ' . $e->getMessage());
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return $this->accessToken;
    }
}