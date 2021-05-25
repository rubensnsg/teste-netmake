<?php

namespace App\Services;

/**
 * Interface NodeServiceInterface
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-24
 */
interface NodeServiceInterface
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
}
