<?php

namespace frontend\components;
use yii\authclient\OAuth2;


class Employee extends OAuth2
{
    
    public $authUrl = 'https://hemis.samdchti.uz/oauth/authorize';
    public $tokenUrl = 'https://hemis.samdchti.uz/oauth/access-token';
    public $apiBaseUrl = 'https://hemis.samdchti.uz/oauth/api';
    public $scope = 'public_profile';
    public $attributeNames = ['id', 'email'];

    protected function initUserAttributes()
    {
        return $this->api('user', 'GET', ['fields' => implode(',', $this->attributeNames)]);
    }

    public function applyAccessTokenToRequest($request, $accessToken)
    {
        $request->getHeaders()->add('Authorization', 'Bearer ' . $accessToken->getToken());
    }
}