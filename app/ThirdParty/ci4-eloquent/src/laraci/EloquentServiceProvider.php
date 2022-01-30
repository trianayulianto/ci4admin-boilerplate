<?php 

namespace Fluent\Laraci;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher as Dispatcher;
use Illuminate\Container\Container as Container;

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

        // Enabling query log
        if (CI_DEBUG) {
            $capsule->connection()->enableQueryLog();
        }

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
            'prefix'    => $db->default['DBPrefix']
        );
    }
}