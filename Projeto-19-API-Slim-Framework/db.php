<?php
if (PHP_SAPI != 'cli') {
    exit('Rodar via CLI');
}

require __DIR__ . '/vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/src/dependencies.php';

$db = $container->get('db');

$schema = $db->schema();
$table = 'produtos';

$schema->dropIfExists( $table );

//Create a table products
$schema->create($table, function($table){
    $table->increments('id');
    $table->string('titulo', 100);
    $table->text('descricao');
    $table->decimal('preco', 11, 2);
    $table->string('fabricante', 60);
    $table->timestamps();
});
//Populate table products
$db->table($table)->insert([
    'titulo' => 'Samatphone Motorola',
    'descricao' => 'Android Oreo',
    'preco' => 899.00,
    'fabricante' => 'Motorola',
    'created_at' => '2019-10-22',
    'updated_at' => '2019-10-22'
]);
$db->table($table)->insert([
    'titulo' => 'Iphone',
    'descricao' => 'IOS 12 4GB',
    'preco' => 4999.00,
    'fabricante' => 'Apple',
    'created_at' => '2023-04-03',
    'updated_at' => '2023-04-03'
]);
$db->table($table)->insert([
    'titulo' => 'Nokia Tijolão',
    'descricao' => 'Inquebrável',
    'preco' => 500.00,
    'fabricante' => 'Nokia',
    'created_at' => '2023-04-03',
    'updated_at' => '2023-04-03'
]);