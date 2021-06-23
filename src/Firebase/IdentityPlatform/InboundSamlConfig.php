<?php
namespace Kreait\Firebase\IdentityPlatform;

use Kreait\Firebase\Exception\InvalidArgumentException;

class InboundSamlConfig
{
    private string $name;
    private ?IdpConfig $idpConfig;
    private ?SpConfig $spConfig;
    private ?string $displayName;
    private ?bool $enabled;

    public const FIELDS = ['name', 'idpConfig', 'spConfig', 'displayName', 'enabled'];

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

        if (!isset($properties['name'])) {
            throw new InvalidArgumentException('name property is a required string');
        }

        foreach ($properties as $key => $value) {
            switch ($key) {
                case 'name':
                    $instance->name = $value;
                    break;
                case 'idpConfig':
                    $instance->idpConfig = $value instanceof IdpConfig ? $value : IdpConfig::withProperties($value);
                    break;
                case 'spConfig':
                    $instance->spConfig = $value instanceof SpConfig ? $value : SpConfig::withProperties($value);
                     break;
                case 'displayName':
                    $instance->displayName = $value;
                    break;
                case 'enabled':
                    $instance->enabled = $value;
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
            'name'        => $this->name,
            'idpConfig'   => $this->idpConfig,
            'spConfig'    => $this->spConfig,
            'displayName' => $this->displayName,
            'enabled'     => $this->enabled,
        ];
    }
}
