<?php

declare(strict_types=1);

namespace Kreait\Firebase\IdentityPlatform;

use Kreait\Firebase\Auth\TenantId;

use GuzzleHttp\ClientInterface;

use Kreait\Firebase\Exception\IdentityPlatformApiExceptionConverter;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Project\ProjectId;
use Kreait\Firebase\Request\DefaultSupportedIdpConfig as DefaultSupportedIdpConfigRequest;
use Kreait\Firebase\Request\InboundSamlConfig as InboundSamlConfigRequest;
use Kreait\Firebase\Request\OauthIdpConfig as OauthIdpConfigRequest;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * @internal
 */
class ApiClient
{
    private ClientInterface $client;
    private ?TenantId $tenantId;
    private ProjectId $projectId;
    private IdentityPlatformApiExceptionConverter $errorHandler;

    /**
     * @internal
     */
    public function __construct(ClientInterface $client, ProjectId $projectId, ?TenantId $tenantId = null)
    {
        $this->client = $client;
        $this->projectId = $projectId;
        $this->tenantId = $tenantId;
        $this->errorHandler = new IdentityPlatformApiExceptionConverter();
    }

    /**
     * @throws AuthException
     * @throws FirebaseException
     */
    public function listAllDefaultSupportedIdpConfigs() : ResponseInterface
    {
        return $this->requestApi('GET', 'defaultSupportedIdps', []);
    }

    /**
     * @throws AuthException
     * @throws FirebaseException
     */
    public function listDefaultSupportedIdpConfigs() : ResponseInterface
    {
        $uri = 'defaultSupportedIdpConfigs';
        return $this->requestApiWithProjectId($uri, [], 'GET');
    }

    /**
     * @param DefaultSupportedIdpConfigRequest $request
     * @throws AuthException
     * @throws FirebaseException
     */
    public function createDefaultSupportedIdpConfigs(DefaultSupportedIdpConfigRequest $request) : ResponseInterface
    {
        $uri = 'defaultSupportedIdpConfigs';
        return $this->requestApiWithProjectId($uri, $request->jsonSerialize());
    }

    /**
     * @param string $name
     * @throws AuthException
     * @throws FirebaseException
     */    public function deleteDefaultSupportedIdpConfigs(string $name) : ResponseInterface
    {
        $uri = sprintf('defaultSupportedIdpConfigs/%s', $name);
        return $this->requestApiWithProjectId($uri, [], 'DELETE');
    }

    /**
     * @param string $name
     * @throws AuthException
     * @throws FirebaseException
     */
    public function getDefaultSupportedIdpConfigs(string $name) : ResponseInterface
    {
        $uri = sprintf('defaultSupportedIdpConfigs/%s', $name);
        return $this->requestApiWithProjectId($uri, [], 'GET');
    }

    /**
     * @param string $name
     * @param DefaultSupportedIdpConfigRequest $request
     * @throws AuthException
     * @throws FirebaseException
     */
    public function updateDefaultSupportedIdpConfigs(string $name, DefaultSupportedIdpConfigRequest $request) : ResponseInterface
    {
        $uri = sprintf('defaultSupportedIdpConfigs/%s', $name);
        return $this->requestApiWithProjectId($uri, $request->jsonSerialize(), 'PATCH');
    }

    /**
     * @param InboundSamlConfigRequest $request
     * @throws AuthException
     * @throws FirebaseException
     */
    public function createInboundSamlConfigs(InboundSamlConfigRequest $request) : ResponseInterface
    {
        $uri = 'inboundSamlConfigs';
        return $this->requestApiWithProjectId($uri, $request->jsonSerialize());
    }

    /**
     * @param string $name
     * @throws AuthException
     * @throws FirebaseException
     */
    public function deleteInboundSamlConfigs(string $name) : ResponseInterface
    {
        $uri = sprintf('inboundSamlConfigs/%s', $name);
        return $this->requestApiWithProjectId($uri, [], 'DELETE');
    }

    /**
     * @param string $name
     * @throws AuthException
     * @throws FirebaseException
     */
    public function getInboundSamlConfigs(string $name) : ResponseInterface
    {
        $uri = sprintf('inboundSamlConfigs/%s', $name);
        return $this->requestApiWithProjectId($uri, [], 'GET');
    }

    /**
     * @param string $name
     * @param InboundSamlConfigRequest $request
     * @throws AuthException
     * @throws FirebaseException
     */
    public function updateInboundSamlConfigs(string $name, InboundSamlConfigRequest $request) : ResponseInterface
    {
        $uri = sprintf('inboundSamlConfigs/%s', $name);
        return $this->requestApiWithProjectId($uri, $request->jsonSerialize(), 'PATCH');
    }

    /**
     * @param OauthIdpConfigRequest $request
     * @throws AuthException
     * @throws FirebaseException
     */
    public function createOauthIdpConfigs(OauthIdpConfigRequest $request) : ResponseInterface
    {
        $uri = 'oauthIdpConfigs';
        return $this->requestApiWithProjectId($uri, $request->jsonSerialize());
    }

    /**
     * @param  string $name
     * @throws AuthException
     * @throws FirebaseException
     */
    public function deleteOauthIdpConfigs(string $name) : ResponseInterface
    {
        $uri = sprintf('oauthIdpConfigs/%s', $name);
        return $this->requestApiWithProjectId($uri, [], 'DELETE');
    }

    /**
     * @param  string $name
     * @throws AuthException
     * @throws FirebaseException
     */    public function getOauthIdpConfigs(string $name) : ResponseInterface
    {
        $uri = sprintf('oauthIdpConfigs/%s', $name);
        return $this->requestApiWithProjectId($uri, [], 'GET');
    }

    /**
     * @param  string $name
     * @param OauthIdpConfigRequest $request
     * @throws AuthException
     * @throws FirebaseException
     */
    public function updateOauthIdpConfigs(string $name, $request) : ResponseInterface
    {
        $uri = sprintf('oauthIdpConfigs/%s', $name);
        return $this->requestApiWithProjectId($uri, $request->jsonSerialize(), 'PATCH');
    }

    /**
     * @internal
     * @throws AuthException
     * @throws FirebaseException
     */
    private function requestApiWithProjectId(string $uri, array $data, string $method = 'POST'): ResponseInterface
    {
        $uri = sprintf('%s/%s', $this->projectId->value(), $uri);

        return $this->requestApi($method, $uri, $data);
    }


    /**
     * @param string $method
     * @param string $url
     * @param array<mixed> $data
     *
     * @throws AuthException
     * @throws FirebaseException
     */
    private function requestApi(string $method, string $uri, array $data): ResponseInterface
    {
        $options = [];

        if ($this->tenantId) {
            $data['tenantId'] = $this->tenantId->toString();
        }

        if (!empty($data)) {
            $options['json'] = $data;
        }

        try {
            return $this->client->request($method, $uri, $options);
        } catch (Throwable $e) {
            throw $this->errorHandler->convertException($e);
        }
    }
}
