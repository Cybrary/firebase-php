<?php

namespace Kreait\Firebase\Request;

use Kreait\Firebase\IdentityPlatform\OauthIdpConfig as IdentityPlatformOauthIdpConfig;
use JsonSerializable;

class OauthIdpConfig extends IdentityPlatformOauthIdpConfig implements JsonSerializable
{
    public function jsonSerialize()
    {
        return \array_filter($this->toArray(), static fn ($value) => $value !== null);
    }
}
