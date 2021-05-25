<?php

namespace App\Services;

/**
 * Interface ProdutoServiceInterface
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-24
 */
interface ProdutoServiceInterface
{
    /**
     * @return array
     */
    public function obterTodos(): array;

    /**
     * @param array $dados
     * @return array
     */
    public function obterPorCriterios($dados): array;

    /**
     * @param int $id
     * @return array
     */
    public function obterPorID($id): array;

    /**
     * @param array $dados
     * @return string
     */
    public function inserirProduto($dados): string;

    /**
     * @param int $id
     * @return array
     */
    public function apagarProduto($id): array;
}
