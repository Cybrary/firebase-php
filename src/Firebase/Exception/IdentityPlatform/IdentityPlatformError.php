<?php

declare(strict_types=1);

namespace Kreait\Firebase\Exception\Auth;

use Kreait\Firebase\Exception\IdentityPlatformException;
use RuntimeException;

final class IdentityPlatformError extends RuntimeException implements IdentityPlatformException
{
}
