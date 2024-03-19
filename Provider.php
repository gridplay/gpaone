<?php
namespace GPAONE;
use GuzzleHttp\RequestOptions;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;
class Provider extends AbstractProvider {
    public const IDENTIFIER = 'GPAONE';
    protected $scopes = ['users'];
    protected $scopeSeparator = ' ';
    protected function getAuthUrl($state) {
        return $this->buildAuthUrlFromBase(
            'https://gpa.one/oauth/authorize',
            $state
        );
    }
    protected function getTokenUrl() {
        return 'https://gpa.one/oauth/token';
    }
    protected function getUserByToken($token) {
        $response = $this->getHttpClient()->get(
            'https://gpa.one/api/user',
            [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer '.$token,
                ],
            ]
        );

        return json_decode((string) $response->getBody(), true);
    }
    protected function mapUserToObject(array $user) {
        return (new User())->setRaw($user)->map([
            'id'    => $user['id'],
            'name' => $user['name'],
            'grid' => $user['grid'],
            'uuid' => $user['uuid']
        ]);
    }
}
