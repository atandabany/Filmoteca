<?php

namespace App\Core;

class DatabaseConnection
{
    private static ?\PDO $connection = null;

    private const DB_HOST = 'db';
    private const DB_PORT = 3306;
    private const DB_NAME = 'filmoteca';
    private const DB_USER = 'filmoteca_user';
    private const DB_PASSWORD = 'filmoteca_password';


    /**
     * Get de PDO connection instance
     * 
     * @return \PDO
     * @throws \PDOException
     */
    public static function getConnection(): \PDO
    {
        if (self::$connection === null){
            try {
                $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4', self::DB_HOST, self::DB_PORT, self::DB_NAME);

                self::$connection = new \PDO($dsn, self::DB_USER, self::DB_PASSWORD);
                self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            } catch (\PDOException $exception){
                throw new \PDOException('Database connection error: ' . $exception->getMessage());
            }
        }
        return self::$connection;
    }
}
