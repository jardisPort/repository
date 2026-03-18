# Jardis Repository Port

![Build Status](https://github.com/jardisPort/repository/actions/workflows/ci.yml/badge.svg)
[![License: PolyForm Shield](https://img.shields.io/badge/License-PolyForm%20Shield-blue.svg)](LICENSE.md)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D8.2-777BB4.svg)](https://www.php.net/)
[![PHPStan Level](https://img.shields.io/badge/PHPStan-Level%208-brightgreen.svg)](phpstan.neon)
[![PSR-12](https://img.shields.io/badge/Code%20Style-PSR--12-blue.svg)](phpcs.xml)

> Part of the **[Jardis Business Platform](https://jardis.io)** — Enterprise-grade PHP components for Domain-Driven Design

Repository contract for raw-data CRUD persistence. Defines insert, update, delete, find, and exists operations with pluggable primary key strategies. Works with arrays — no entity coupling, no ORM dependency. The implementation can route reads and writes to separate database connections without your domain code knowing about it.

---

## Interfaces

### **RepositoryInterface**

`JardisPort\Repository\RepositoryInterface`

Generic CRUD contract operating on associative arrays. All operations target a named table with an explicit primary key column.

| Method | Signature | Description |
|--------|-----------|-------------|
| `insert` | `insert(string $table, string $pkColumn, array $values, PkStrategy $pkStrategy = PkStrategy::AUTOINCREMENT): int\|string` | Insert a record. Returns the generated primary key. |
| `update` | `update(string $table, string $pkColumn, int\|string $id, array $values): bool` | Update an existing record by primary key. |
| `delete` | `delete(string $table, string $pkColumn, int\|string $id): bool` | Delete a single record by primary key. |
| `deleteAll` | `deleteAll(string $table, string $pkColumn, array $ids): void` | Delete multiple records by a list of primary keys. |
| `findById` | `findById(string $table, string $pkColumn, int\|string $id): ?array` | Find a single record by primary key. Returns `null` when not found. |
| `findByQuery` | `findByQuery(DbQueryBuilderInterface $query): array` | Execute a fully built SELECT query and return all matching rows. |
| `exists` | `exists(string $table, string $pkColumn, int\|string $id): bool` | Check whether a record with the given primary key exists. |

### **PkStrategy**

`JardisPort\Repository\PrimaryKey\PkStrategy`

Enum controlling how the primary key is generated on insert.

| Case | Description |
|------|-------------|
| `AUTOINCREMENT` | Database generates the key (standard auto-increment). |
| `INTEGER` | Caller provides an integer key. |
| `NONE` | No primary key handling — composite keys or special cases. |

### Exceptions

| Class | Description |
|-------|-------------|
| `PersistException` | Thrown when an insert, update, or delete operation fails. |
| `RecordNotFoundException` | Thrown when a required record does not exist. |

---

## Installation

```bash
composer require jardisport/repository
```

## Usage

```php
use JardisPort\Repository\RepositoryInterface;
use JardisPort\Repository\PrimaryKey\PkStrategy;
use JardisPort\Repository\Exception\RecordNotFoundException;

class ProductRepository
{
    public function __construct(
        private readonly RepositoryInterface $repository,
    ) {}

    public function create(array $data): int|string
    {
        return $this->repository->insert('products', 'id', $data, PkStrategy::AUTOINCREMENT);
    }

    public function findOrFail(int $id): array
    {
        $record = $this->repository->findById('products', 'id', $id);

        if ($record === null) {
            throw new RecordNotFoundException("Product $id not found");
        }

        return $record;
    }

    public function remove(int $id): bool
    {
        return $this->repository->delete('products', 'id', $id);
    }
}
```

## Implemented by

- **[jardissupport/repository](https://github.com/jardisSupport/repository)** — PDO-based implementation with read/write splitting, connection pool support, and configurable primary key strategies

## Documentation

Full documentation, guides, and API reference:

**[jardis.io/docs/port/repository](https://jardis.io/docs/port/repository)**

## License

This package is licensed under the [PolyForm Shield License 1.0.0](LICENSE.md). Free for all use except building competing frameworks or developer tooling.

---

**[Jardis](https://jardis.io)** · [Documentation](https://jardis.io/docs) · [Headgent](https://headgent.com)
