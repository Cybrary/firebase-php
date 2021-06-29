<?php
namespace Kreait\Firebase\IdentityPlatform;

use InvalidArgumentException;
use Kreait\Firebase\Value\Url;

class SpConfig
{
    private string $spEntityId;
    private Url $callbackUri;
    /**
     * @var array<SpCertificate>
     */
    private array $spCertificates;

    public const FIELDS = ['spEntityId', 'callbackUri', 'spCertificates'];

    private function __construct()
    {
    }

    public static function new(): self
    {
        return new self();
    }

    /**
     * @param array<string, mixed> $properties
     *
     * @throws InvalidArgumentException when invalid properties have been provided
     */
    public static function withProperties(array $properties): self
    {
        $instance = new self();

        foreach ($properties as $key => $value) {
            switch ($key) {
                case 'spEntityId':
                    $instance->spEntityId = $value;
                    break;
                case 'callbackUri':
                    $instance->ssoUrl = $value instanceof Url ? $value : Url::fromValue($value);
                    break;
                case 'spCertificates':
                    if (!is_array($value)) {
                        throw new InvalidArgumentException(sprintf('%s must be an array'));
                    }
                    $instance->spCertificates = array_map(fn ($certificate) => $certificate instanceof SpCertificate ? $certificate : new SpCertificate($certificate), $value);
                    break;
                default:
                 throw new InvalidArgumentException(sprintf('%s is not a valid property', $key));
            }
        }

        return $instance;
    }

    public function toArray() : array
    {
        return [
            'spEntityId' => $this->spEntityId,
            'ssoUrl' => $this->callbackUri,
            'spCertificates' => $this->spCertificates,
        ];
    }
}
