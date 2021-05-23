<?php

require 'vendor/autoload.php';

use App\SQLiteConnection;
use App\SQLiteInsert;

$conn = (new SQLiteConnection())->connect();
$inserirSql = new SQLiteInsert($conn);
$atualizarSql = new SQLiteUpdate($conn);

echo $inserirSql->inserir('nodes', [
    'node_id' => 18, 'node_desc' => 'Node Q', 'node_value' => 34.5, 'node_master' => 2
]);

$atualizarSql->atualizar('nodes', [
    'node_id' => 18, 'node_desc' => 'Node x', 'node_value' => 3.45, 'node_master' => null
], 'node_id = ' . 18);
/*
use App\SQLiteConnection;

$pdo = new SQLiteConnection();
$pdo->connect();
if ($pdo != null)
    echo 'Connected to the SQLite database successfully!';
else
    echo 'Whoops, could not connect to the SQLite database!';
*/