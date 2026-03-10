<?php

declare(strict_types=1);

namespace JardisPort\Repository\PrimaryKey;

/**
 * Strategy for primary key generation during insert operations.
 */
enum PkStrategy
{
    case AUTOINCREMENT;
    case INTEGER;
    case NONE;
}
