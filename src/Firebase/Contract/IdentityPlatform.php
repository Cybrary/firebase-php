<?php

declare(strict_types=1);

namespace Kreait\Firebase\Contract;

use Psr\Http\Message\ResponseInterface;

interface IdentityPlatform
{
    /**
     * List all default supported Idps.
     *
     * @return ResponseInterface
     *
     * @throws Exception\FirebaseException
     * @throws Exception\AuthException
     */
    public function listAllDefaultSupportedIdpConfigs() : ResponseInterface;

    /**
     * List Default Supported Idps
     *
     * @return ResponseInterface
     *
     * @throws Exception\FirebaseException
     * @throws Exception\AuthException
     */
    public function listDefaultSupportedIdpConfigs() : ResponseInterface;

    /**
     * Create a default supported Idp configuration for an Identity Toolkit project.
     *
     * @param array<string, mixed>|Request\DefaultSupportedIdpConfig $properties $properties
     * @return ResponseInterface
     *
     * @throws Exception\AuthException
     * @throws Exception\FirebaseException
     */

    public function createDefaultSupportedIdpConfigs($properties) : ResponseInterface;
    /**
     * Delete a default supported Idp configuration for an Identity Toolkit project.
     *
     * @param string $name
     * @return ResponseInterface
     *
     * @throws Exception\AuthException
     * @throws Exception\FirebaseException
     */

    public function deleteDefaultSupportedIdpConfigs(string $name) : ResponseInterface;
    /**
     * Retrieve a default supported Idp configuration for an Identity Toolkit project.
     *
     * @param string $name
     * @return ResponseInterface
     *
     * @throws Exception\AuthException
     * @throws Exception\FirebaseException
     */
    public function getDefaultSupportedIdpConfigs(string $name) : ResponseInterface;

    /**
     * Update a default supported Idp configuration for an Identity Toolkit project.
     *
     * @param string $name
     * @param array<string, mixed>|Request\DefaultSupportedIdpConfig $properties
     * @return ResponseInterface
     *
     * @throws Exception\AuthException
     * @throws Exception\FirebaseException
     */
    public function updateDefaultSupportedIdpConfigs(string $name, $properties) : ResponseInterface;

    /**
     * Create an inbound SAML configuration for an Identity Toolkit project.
     *
     * @param array<string, mixed>|Request\InboundSamlConfig $properties
     * @return ResponseInterface
     *
     * @throws Exception\AuthException
     * @throws Exception\FirebaseException
     */
    public function createInboundSamlConfigs($properties) : ResponseInterface;
    /**
     * Delete an inbound SAML configuration for an Identity Toolkit project.
     *
     * @param string $name
     * @return ResponseInterface
     *
     * @throws Exception\AuthException
     * @throws Exception\FirebaseException
     */
    public function deleteInboundSamlConfigs(string $name) : ResponseInterface;
    /**
     * Get an inbound SAML configuration for an Identity Toolkit project.
     *
     * @param string $name
     * @return ResponseInterface
     *
     * @throws Exception\AuthException
     * @throws Exception\FirebaseException
     */
    public function getInboundSamlConfigs(string $name) : ResponseInterface;
    /**
     * Update an inbound SAML configuration for an Identity Toolkit project.
     *
     * @param string $name
     * @param array<string, mixed>|Request\InboundSamlConfig $properties
     * @return ResponseInterface
     */
    public function updateInboundSamlConfigs(string $name, $properties) : ResponseInterface;

    /**
     * Create an Oidc Idp configuration for an Identity Toolkit project.
     *
     * @param array<string, mixed>|Request\OauthIdpConfig $properties
     * @return ResponseInterface
     *
     * @throws Exception\AuthException
     * @throws Exception\FirebaseException
     */
    public function createOauthIdpConfigs($properties) : ResponseInterface;
    /**
     * Delete an Oidc Idp configuration for an Identity Toolkit project.
     *
     * @param string $name
     * @return ResponseInterface
     *
     * @throws Exception\AuthException
     * @throws Exception\FirebaseException
     */
    public function deleteOauthIdpConfigs(string $name) : ResponseInterface;

    /**
     * Get an Oidc Idp configuration for an Identity Toolkit project.
     *
     * @param string $name
     * @return ResponseInterface
     *
     * @throws Exception\AuthException
     * @throws Exception\FirebaseException
     */
    public function getOauthIdpConfigs(string $name) : ResponseInterface;

    /**
     * Update Oidc Idp configuration for an Identity Toolkit project.
     *
     * @param string $name
     * @param array<string, mixed>|Request\OauthIdpConfig $properties
     * @return ResponseInterface
     *
     * @throws Exception\AuthException
     * @throws Exception\FirebaseException
     */
    public function updateOauthIdpConfigs(string $name, $properties) : ResponseInterface;



    //TODO
    // public function finalizeMfaEnrollment() : ResponseInterface;
    // public function startMfaEnrollment(): ResponseInterface;
    // public function withdrawMfaEnrollment(): ResponseInterface;

    // public function startMfaSignIn(): ResponseInterface;
    // public function finalizeMfaSignIn(): ResponseInterface;
}
