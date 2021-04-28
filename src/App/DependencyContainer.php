<?php

namespace Fira\App;

use Fira\Domain\Entity\UserEntity;
use Fira\Domain\Repository\LocationRepository;
use Fira\Domain\Repository\UserRepository;
use Fira\Infrastructure\Database\Sql\AbstractSqlDriver;
use Fira\Infrastructure\Database\Sql\Mysql\MySqlDriver;
use RuntimeException;

final class DependencyContainer
{
    protected static array $dependencies = [];

    public static function setAuthenticatedUserEntity(UserEntity $userEntity): void
    {
        self::$dependencies['authenticatedUserEntity'] = $userEntity;
    }

    public static function getAuthenticatedUserEntity(): ?UserEntity
    {
        return self::$dependencies['authenticatedUserEntity'] ?? null;
    }

    public static function getSqlDriver(): AbstractSqlDriver
    {
        if (!isset(self::$dependencies['sqlDriver'])) {
            self::$dependencies['sqlDriver'] = new MysqlDriver('mysqlHost', 'username', 'password', 'fira_location', 15456);
        }

        return self::$dependencies['sqlDriver'];
    }

    public static function getLocationRepository(): LocationRepository
    {
        if (!isset(self::$dependencies['locationRepo'])) {
            self::$dependencies['locationRepo'] = new \Fira\Infrastructure\Database\Sql\Mysql\LocationRepository();
        }

        return self::$dependencies['locationRepo'];
    }

    public static function getUserRepository(): UserRepository
    {
        throw new RuntimeException('Not implemented yet!');
    }
}
