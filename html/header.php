<!doctype html>
<html lang="pt-Br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title><?php echo $nomeProjeto; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="src/css/bootstrap.min.css" rel="stylesheet" />
    <style type="text/css">
      .procurando{
        box-shadow: none !important;
        vertical-align: middle;
        text-align: center;
      }
      .imagem-lupa{
        margin: 28px auto 6px auto;
        max-width: 44px;
        border: 0;
      }
    </style>

  </head>
  <body class="bg-light">
    <div class="container">
      <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
          <span class="fs-4"> &nbsp;Teste</span>
        </a>

        <ul class="nav nav-pills">
          <li class="nav-item mx-2">
            <a href="home" class="nav-link <?php if ($nomeProjeto == "Teste para Netmake") { 
              ?> active<?php } ?>" aria-current="page">Lista de Produto</a>
          </li>
          <li class="nav-item mx-2">
            <a href="filhos" class="nav-link <?php if ($nomeProjeto == "Árvore filhos") { 
              ?> active<?php } ?>" aria-current="filhos">Árvore(filhos)</a>
          </li>
          <li class="nav-item mx-2">
            <a href="recursiva" class="nav-link <?php if ($nomeProjeto == "Árvore recursivo") { 
              ?> active<?php } ?>" aria-current="recursiva">Árvora(recursiva)</a>
          </li>
        </ul>
      </header>
    </div>
    <div class="container">
      <main>