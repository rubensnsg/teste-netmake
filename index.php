<?php

require 'vendor/autoload.php';

use App\SQLiteConnection;
use App\SQLiteInsert;
use App\SQLiteUpdate;
use App\SQLiteDelete;
use App\SQLiteSelect;

$conn = (new SQLiteConnection())->connect();
$inserirSql = new SQLiteInsert($conn);
$atualizarSql = new SQLiteUpdate($conn);
$apagarSql = new SQLiteDelete($conn);
$selectSql = new SQLiteSelect($conn);

$idNovo = $inserirSql->inserir('nodes', ['node_desc' => 'Node Q', 'node_value' => 34.5, 'node_master' => 3]);
echo "<br />Inserido ID: #" . $idNovo . "<br />";


$atualizarSql->atualizar('nodes', [
    'node_desc' => 'Node X' . ($idNovo - 1), 'node_value' => 3.99, 'node_master' => null
], 'node_id = ' . ($idNovo - 1));
echo "<br />Atualizado ID: #" . ($idNovo - 1) . "<br />";


echo "<br />Apagado ID #" . ($idNovo - 2) . ", resultado: ";
print_r($apagarSql->apagar('nodes', 'node_id = ?', [($idNovo - 2)]));


echo "<br />Selecionar paginado:<br />";
$registrosPaginados = $selectSql->selecionarPaginado('nodes', ['*'], 'node_id >= 1', [], '', 4, 5);
print_r($registrosPaginados);


echo "<br />Selecionar todos:<br />";
$todosDados = $selectSql->selecionarTodos('nodes', ['*'], 'node_id > ?', [13]);
print_r($todosDados);

/*
use App\SQLiteConnection;
$pdo = new SQLiteConnection();
$pdo->connect();
if ($pdo != null)
    echo 'Connected to the SQLite database successfully!';
else
    echo 'Whoops, could not connect to the SQLite database!';
*/