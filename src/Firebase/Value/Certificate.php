<?php

declare(strict_types=1);

namespace Kreait\Firebase\Value;

use Kreait\Firebase\Exception\InvalidArgumentException;

class Certificate implements \JsonSerializable
{
    private string $value;
    /**
     * @var array<string, mixed>
     */
    private ?array $certificate;

    public function __construct($certificate)
    {
        if (is_array($certificate)) {
            $certificate = $certificate['x509Certificate'] ?? null;
        }
        $parsedCertificate = \openssl_x509_parse($certificate);

        if ($parsedCertificate === false) {
            throw new InvalidArgumentException('Invalid X.509 Certificate');
        }
        $this->value = $certificate;
        $this->certificate = $parsedCertificate;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }

    /**
     * OpenSSL parse results for certificate.
     *
     * @return array<string,mixed>|null
     */
    public function details(): ?array
    {
        return $this->certificate;
    }

    /**
     * @param self|string $other
     */
    public function equalsTo($other): bool
    {
        return $this->value === (string) $other;
    }
}