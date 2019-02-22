<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'sistema_financeiro',
    'username'  => 'root',
    'password'  => 'mysql',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);


// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

// Set the event dispatcher used by Eloquent models... (optional).
use Illuminate\Events\Dispatcher;
$capsule->setEventDispatcher(new Dispatcher);

// Set the cache manager instance used by connections... (optionaL).
// use Illuminate\Support\Container;
// use Illuminate\Cache\CacheManager;
// $cache = new CacheManager(new Container);
// $cache->driver('apc');
// $capsule->setCacheManager($cache);

// Make this Capsule instance available globally via static methods... (optional).
$capsule->setAsGlobal();

