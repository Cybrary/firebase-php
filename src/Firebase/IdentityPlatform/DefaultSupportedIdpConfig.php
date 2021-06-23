<?php

declare(strict_types=1);

namespace Kreait\Firebase\IdentityPlatform;

use Kreait\Firebase\Exception\InvalidArgumentException;

class DefaultSupportedIdpConfig
{
    private string $name;
    private ?bool $enabled;
    private ?string $clientId;
    private ?string $clientSecret;

    public const FIELDS = ['name', 'enabled', 'clientId', 'clientSecret'];

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
        if (!$name = $properties['name'] ?? null) {
            throw new InvalidArgumentException('name property is a required string');
        }

        array_walk(self::FIELDS, fn ($field) => $this->$instance = $properties[$field] ?? null);

        return $instance;
    }

    /**
     * To Array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
                'name' => $this->name,
                'enabled' => $this->enabled,
                'clientId' => $this->clientId,
                'clientSecret' => $this->clientSecret,
        ];
    }

    /**
     * Returns the name
     *
     * @return void
     */
    public function getName() : string
    {
        return $this->name;
    }
}
