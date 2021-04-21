<?php

namespace Fira\App;

use Fira\Domain\Repository\LocationRepository;
use Fira\Infrastructure\Database\Sql\AbstractSqlDriver;
use Fira\Infrastructure\Database\Sql\Mysql\MySqlDriver;

final class DependencyContainer
{
    protected static array $dependencies = [];

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
}
