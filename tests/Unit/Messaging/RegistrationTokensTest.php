<?php

declare(strict_types=1);

namespace Kreait\Firebase\Tests\Unit\Messaging;

use InvalidArgumentException;
use Kreait\Firebase\Messaging\RegistrationToken;
use Kreait\Firebase\Messaging\RegistrationTokens;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @internal
 */
final class RegistrationTokensTest extends TestCase
{
    /**
     * @dataProvider validValuesWithExpectedCounts
     */
    public function testItCanBeCreatedFromValues(int $expectedCount, mixed $value): void
    {
        $tokens = RegistrationTokens::fromValue($value);

        $this->assertCount($expectedCount, $tokens);
        $this->assertSame(!$expectedCount, $tokens->isEmpty());
    }

    /**
     * @dataProvider invalidValues
     */
    public function testItRejectsInvalidValues(mixed $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        RegistrationTokens::fromValue($value);
    }

    public function testItReturnsStrings(): void
    {
        $token = RegistrationToken::fromValue('foo');

        $tokens = RegistrationTokens::fromValue([$token, $token]);
        $this->assertEqualsCanonicalizing(['foo', 'foo'], $tokens->asStrings());
    }

    /**
     * @return array<string, array<int, int|mixed>>
     */
    public static function validValuesWithExpectedCounts(): array
    {
        $foo = RegistrationToken::fromValue('foo');

        return [
            'string' => [1, 'foo'],
            'token object' => [1, $foo],
            'collection' => [2, new RegistrationTokens($foo, $foo)],
            'array with mixed values' => [2, [$foo, 'bar']],
        ];
    }

    /**
     * @return array<string, list<mixed>>
     */
    public static function invalidValues(): array
    {
        return [
            'invalid object' => [new stdClass()],
        ];
    }
}
