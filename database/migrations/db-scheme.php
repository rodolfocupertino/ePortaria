<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require_once "includes/init.php";


Capsule::schema()->create('visitantes', function($table)
{
    $table->increments('id');
    $table->string('nome');
    $table->string('rg');
    $table->string('telefone');
    $table->string('cracha_numero');
    $table->timestamp('entrada');
    $table->timestamp('saida');
    $table->string('foto');
    $table->timestamps();
});

// Visitante::create(array(
//     'nome' => 'foo@bar.com',
//     'telefone' => 'foo@bar.com',
//     'rg' => 'foo@bar.com',
//     'cracha_numero' => '123',
//     'entrada' => date() ,
//     'saida' => date()
// ) );


// Capsule::schema()->create('users', function($table)
// {
//     $table->increments('id');
//     $table->string('name');
//     $table->string('username');
//     $table->string('password');
//     $table->string('email');
//     $table->integer('status');
//     $table->activation_key('name');
//     $table->timestamps();
// });



// `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
//   `name` varchar(255) DEFAULT NULL,
//   `username` varchar(255) DEFAULT NULL,
//   `password` varchar(255) DEFAULT NULL,
//   `email` varchar(255) DEFAULT NULL,
//   `status` int(2) DEFAULT NULL,
//   `activation_key` varchar(255) DEFAULT NULL,
//   `display_name` varchar(255) DEFAULT NULL,
//   `is_seller` int(10) DEFAULT '0',
//   `is_technician` int(10) DEFAULT '0',
//   `created_at` datetime NOT NULL,
//   `updated_at` datetime NOT NULL,
//   `deleted_at` datetime DEFAULT NULL,

// 
