<?php

namespace Kreait\Firebase;

use Kreait\Firebase\IdentityPlatform\ApiClient;
use Kreait\Firebase\IdentityPlatform\DefaultSupportedIdpConfig;
use Kreait\Firebase\IdentityPlatform\InboundSamlConfig;
use Kreait\Firebase\IdentityPlatform\OauthIdpConfig;
use Kreait\Firebase\Request\DefaultSupportedIdpConfig as DefaultSupportedIdpConfigRequest;
use Kreait\Firebase\Request\InboundSamlConfig as InboundSamlConfigRequest;
use Kreait\Firebase\Request\OauthIdpConfig as OauthIdpConfigRequest;
use Psr\Http\Message\ResponseInterface;
use Kreait\Firebase\Util\JSON;

class IdentityPlatform implements Contract\IdentityPlatform
{
    private ApiClient $client;

    /**
     * @param iterable<ApiClient|null>|ApiClient|null ...$x
     *
     * @internal
     */
    public function __construct(...$x)
    {
        foreach ($x as $arg) {
            if ($arg instanceof ApiClient) {
                $this->client = $arg;
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function listAllDefaultSupportedIdpConfigs() : ResponseInterface
    {
        return $this->client->listAllDefaultSupportedIdpConfigs();
    }

    /**
     * @inheritDoc
     */
    public function listDefaultSupportedIdpConfigs() : ResponseInterface
    {
        return $this->client->listDefaultSupportedIdpConfigs();
    }

    /**
     * @inheritDoc
     */

    public function createDefaultSupportedIdpConfigs($properties) : DefaultSupportedIdpConfig
    {
        $request = $properties instanceof DefaultSupportedIdpConfigRequest ? $properties : DefaultSupportedIdpConfigRequest::withProperties($properties);
        $response = $this->client->createDefaultSupportedIdpConfigs($request);

        return DefaultSupportedIdpConfig::withProperties($this->getResponseAsArray($response));
    }

    /**
     * @inheritDoc
     */

    public function deleteDefaultSupportedIdpConfigs(string $name) : ResponseInterface
    {
        return $this->client->deleteDefaultSupportedIdpConfigs($name);
    }

    /**
     * @inheritDoc
     */
    public function getDefaultSupportedIdpConfigs(string $name) : DefaultSupportedIdpConfig
    {
        $response = $this->client->getDefaultSupportedIdpConfigs($name);
        return DefaultSupportedIdpConfig::withProperties($this->getResponseAsArray($response));
    }

    /**
     * @inheritDoc
     */
    public function updateDefaultSupportedIdpConfigs(string $name, $properties) : DefaultSupportedIdpConfig
    {
        $request = $properties instanceof DefaultSupportedIdpConfigRequest ? $properties : DefaultSupportedIdpConfigRequest::withProperties($properties);
        $response = $this->client->updateDefaultSupportedIdpConfigs($name, $request);

        return DefaultSupportedIdpConfig::withProperties($this->getResponseAsArray($response));
    }

    /**
     * @inheritDoc
     */
    public function createInboundSamlConfigs($properties) : InboundSamlConfig
    {
        $request = $properties instanceof InboundSamlConfigRequest ? $properties : InboundSamlConfigRequest::withProperties($properties);
        $response = $this->client->createInboundSamlConfigs($request);

        return InboundSamlConfig::withProperties($this->getResponseAsArray($response));
    }

    /**
     * @inheritDoc
     */
    public function deleteInboundSamlConfigs(string $name) : ResponseInterface
    {
        return $this->client->deleteInboundSamlConfigs($name);
    }

    /**
     * @inheritDoc
     */
    public function getInboundSamlConfigs(string $name) : InboundSamlConfig
    {
        $response = $this->client->getInboundSamlConfigs($name);
        return InboundSamlConfig::withProperties($this->getResponseAsArray($response));
    }

    /**
     * @inheritDoc
     */
    public function updateInboundSamlConfigs(string $name, $properties) : InboundSamlConfig
    {
        $request = $properties instanceof InboundSamlConfigRequest ? $properties : InboundSamlConfigRequest::withProperties($properties);
        $response = $this->client->updateInboundSamlConfigs($name, $request);

        return InboundSamlConfig::withProperties($this->getResponseAsArray($response));
    }

    /**
     * @inheritDoc
     */

    public function createOauthIdpConfigs($properties) : OauthIdpConfig
    {
        $request = $properties instanceof OauthIdpConfigRequest ? $properties : OauthIdpConfigRequest::withProperties($properties);
        $response = $this->client->createOauthIdpConfigs($request);

        return OauthIdpConfig::withProperties($this->getResponseAsArray($response));
    }

    /**
     * @inheritDoc
     */
    public function deleteOauthIdpConfigs(string $name) : ResponseInterface
    {
        return $this->client->deleteOauthIdpConfigs($name);
    }

    /**
     * @inheritDoc
     */
    public function getOauthIdpConfigs(string $name) : OauthIdpConfig
    {
        $response = $this->client->getOauthIdpConfigs($name);
        return OauthIdpConfig::withProperties($this->getResponseAsArray($response));
    }

    /**
     * @inheritDoc
     */
    public function updateOauthIdpConfigs(string $name, $properties) : OauthIdpConfig
    {
        $request = $properties instanceof OauthIdpConfigRequest ? $properties : OauthIdpConfigRequest::withProperties($properties);
        $response = $this->client->updateOauthIdpConfigs($name, $request);

        return OauthIdpConfig::withProperties($this->getResponseAsArray($response));
    }

    private function getResponseAsArray(ResponseInterface $response) : array
    {
        return JSON::decode((string) $response->getBody(), true);
    }
}
