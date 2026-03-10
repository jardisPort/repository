<?php

declare(strict_types=1);

namespace JardisPort\Repository\Exception;

use RuntimeException;

/**
 * Thrown when a requested record does not exist.
 */
class RecordNotFoundException extends RuntimeException
{
}
