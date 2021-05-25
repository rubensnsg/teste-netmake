<?php

require 'vendor/autoload.php';

use App\Controllers\CategoriaController;
use App\Controllers\FornecedorController;
use App\Controllers\ProdutoController;
use App\Controllers\NodeController;

$request = $_SERVER['REQUEST_URI'];

$variaveis = explode("/", $request);
$rota = $variaveis[1];
$id = 0;

if (isset($variaveis[2])) {
    $id = $variaveis[2];
}

// echo $rota . ' - ' . $id;

switch ($rota) {
    case '' :
    case 'index' :
    case 'home' :
        require __DIR__ . '/html/index.php';
        break;
    case 'produtos' :
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            echo (new ProdutoController())->obterPorCriterios($_GET);
        }
        break;
    case 'produto' :
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            if ($id > 0) {
                echo (new ProdutoController())->obterPorId($id);
            } else {
                require __DIR__ . '/html/produto.php';
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            echo (new ProdutoController())->inserirProduto($_POST);
        }
        if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
            if ($id > 0) {
                echo (new ProdutoController())->apagarProduto($id);
            }
        }
        break;
    case 'filhos' :
        require __DIR__ . '/html/filhos.php';
        break;
    case 'recursivo' :
    case 'recursiva' :
        require __DIR__ . '/html/recursiva.php';
        break;
    case 'nodes' :
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            echo (new NodeController())->obterPorCriterios($_GET);
        }
        break;
    case 'categorias' :
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            echo (new CategoriaController())->obterTodos();
        }
        break;
    case 'categoria' :
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            echo (new CategoriaController())->obterPorId($id);
        }
        break;
    case 'fornecedores' :
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            echo (new FornecedorController())->obterTodos();
        }
        break;
    case 'fornecedor' :
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            echo (new FornecedorController())->obterPorId($id);
        }
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/html/index.php';
        break;
}
