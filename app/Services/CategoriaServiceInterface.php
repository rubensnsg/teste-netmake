<?php

namespace App\Services;

/**
 * Interface CategoriaServiceInterface
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-24
 */
interface CategoriaServiceInterface
{
    /**
     * @return array
     */
    public function obterTodos(): array;

    /**
     * @param int $id
     * @return array
     */
    public function obterPorID($id): array;
}
