# JardisPort Repository

Repository interface and contracts for Jardis CRUD persistence.

## Installation

```bash
composer require jardisport/repository
```

## Interfaces

```php
use JardisPort\Repository\RepositoryInterface;
use JardisPort\Repository\PrimaryKey\PkStrategy;
use JardisPort\Repository\Exception\PersistException;
use JardisPort\Repository\Exception\RecordNotFoundException;
```

## Purpose

This package defines the contract for generic CRUD repository operations with raw data (no entities, no hydration). It provides:

- **RepositoryInterface** — Insert, update, delete, find by ID, find by query, exists
- **PkStrategy** — Enum for primary key generation (AUTOINCREMENT, INTEGER, NONE)
- **PersistException** — Thrown on failed persist operations
- **RecordNotFoundException** — Thrown when a record does not exist

### Implemented by

- **jardissupport/repository** — Full implementation with ConnectionPool/PDO support, read/write splitting

### Dependencies

- **jardisport/dbquery** — `DbQueryBuilderInterface` used in `findByQuery()`

## Requirements

- PHP >= 8.2

## License

MIT
