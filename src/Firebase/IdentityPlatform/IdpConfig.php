<?php
namespace Kreait\Firebase\IdentityPlatform;

use InvalidArgumentException;
use Kreait\Firebase\Value\Url;
use Kreait\Firebase\Value\Certificate;

class IdpConfig
{
    private string $idpEntityId;
    private Url $ssoUrl;
    /**
     * @var array<Certificate>
     */
    private array $idpCertificates;
    private bool $signRequest;

    public const FIELDS = ['idpEntityId', 'ssoUrl', 'idpCertificates', 'signRequest'];

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
                case 'idpEntityId':
                    $instance->idpEntityId = $value;
                    break;
                case 'ssoUrl':
                    $instance->ssoUrl = $value instanceof Url ? $value : Url::fromValue($value);
                    break;
                case 'idpCertificates':
                    if (!is_array($value)) {
                        throw new InvalidArgumentException(sprintf('%s must be an array', $key));
                    }
                    $instance->idpCertificates = array_map(fn ($certificate) => $certificate instanceof Certificate ? $certificate : new Certificate($certificate), $value);
                    break;
                case 'signRequest':
                    if (!is_bool($value)) {
                        throw new InvalidArgumentException(sprintf('%s is not a valid property', $key));
                    }
                    $instance->signRequest = $value;
                    // no break
                default:
                 throw new InvalidArgumentException(sprintf('%s is not a valid property', $key));
            }
        }

        return $instance;
    }

    public function toArray() : array
    {
        return [
            'idpEntityId' => $this->idpEntityId,
            'ssoUrl' => $this->ssoUrl,
            'idpCertificates' => $this->idpCertificates,
            'signRequest' => $this->signRequest,
        ];
    }
}
