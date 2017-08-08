<?php

namespace Model\Domain\Facebook;

use App\IoCContainer;
use Facebook\Facebook;
use G4\DataMapper\Builder;
use G4\DataMapper\Common\Identity;
use Model\Domain\ValueObject\IntegerNumber;
use Facebook\Exceptions\FacebookSDKException;
use G4\DataMapper\Engine\MySQL\MySQLTableName;
use Facebook\Exceptions\FacebookResponseException;

class FacebookProfileRepository
{
    const TABLE_NAME = 'facebook_profiles';

    public function add(FacebookProfileEntity $profile)
    {
        $mapper = $this->makeMapper();
        $mapper->insert(new FacebookProfileMap($profile));

        return $this;
    }

    public function find(Facebook $fb)
    {
        try {
            $profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
        } catch(FacebookResponseException $e) {
            throw new \Exception('Graph returned an error: ' . $e->getMessage());
        } catch(FacebookSDKException $e) {
            throw new \Exception('Facebook SDK returned an error: ' . $e->getMessage());
        }

        return FacebookProfileEntityFactory::create($profileRequest->getGraphNode()->asArray());
    }

    public function setInactive(IntegerNumber $id)
    {
        $identity = new Identity();
        $identity
            ->field(FacebookConstants::ID)
            ->equal($id->getValue());

        $mapper = $this->makeMapper();
        $mapper->update((new FacebookProfileUpdateMap())->map(), $identity);

        return $this;
    }

    private function makeMapper()
    {
        return Builder::create()
            ->adapter(IoCContainer::mysqlAdapterNew())
            ->collectionName(new MySQLTableName(self::TABLE_NAME))
            ->buildMapper();
    }
}