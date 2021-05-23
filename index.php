<?php

require 'vendor/autoload.php';

use App\SQLiteConnection;
use App\SQLiteInsert;

$conn = (new SQLiteConnection())->connect();
$inserirSql = new SQLiteInsert($conn);

echo $inserirSql->inserir('nodes', [
    'node_id' => 18, 'node_desc' => 'Node Q', 'node_value' => 34.5, 'node_master' => 2
]);
/*
use App\SQLiteConnection;

$pdo = new SQLiteConnection();
$pdo->connect();
if ($pdo != null)
    echo 'Connected to the SQLite database successfully!';
else
    echo 'Whoops, could not connect to the SQLite database!';
*/