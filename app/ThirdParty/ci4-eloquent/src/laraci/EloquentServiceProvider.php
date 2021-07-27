<?php 

namespace Fluent\Laraci;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher as Dispatcher;
use Illuminate\Container\Container as Container;
use PDO;

class EloquentServiceProvider 
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public static function register()
    {
        static::registerConnectionServices();
    }

    /**
     * Eloquent manager
     * 
     * @return Capsule
     */
    public static function registerConnectionServices()
    {
        $capsule = new Capsule;
 
        $capsule->addConnection(static::dbConfig());

        $capsule->setAsGlobal();
        
        $capsule->setEventDispatcher(new Dispatcher(new Container));

        $capsule->bootEloquent();

        return $capsule;
    }

    /**
     * Database settings
     * 
     * @return array
     */
    private static function dbConfig()
    {
        $db = config('Database');
        $drivers = [
            'MySQLi'  => 'mysql',
            'Postgre' => 'pgsql'
        ];
        
        return array(
            'driver'    => $drivers[$db->default['DBDriver']],
            'database'  => $db->default['database'],
            'host'      => $db->default['hostname'],
            'port'      => $db->default['port'],
            'username'  => $db->default['username'],
            'password'  => $db->default['password'],
            'charset'   => $db->default['charset'],
            'collation' => $db->default['DBCollat'],
            'prefix'    => $db->default['DBPrefix'],
            'options'   => [
                // Turn off persistent connections
                PDO::ATTR_PERSISTENT => false,
                // Enable exceptions
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // Emulate prepared statements
                PDO::ATTR_EMULATE_PREPARES => true,
                // Set default fetch mode to array
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // Set character set
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
            ]
        );
    }
}