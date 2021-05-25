<?php

namespace App\Services;

use App\SQLiteConnection;
use App\SQLiteSelect;

/**
 * Class FornecedorService
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-24
 */
class FornecedorService implements FornecedorServiceInterface{
    /** @var \App\SQLiteConnection $conn */
    private $conn;

    /** @var \App\SQLiteSelect $selectSql */
    private $selectSql;

    public function __construct() {
        $this->conn = (new SQLiteConnection())->connect();
        $this->selectSql = new SQLiteSelect($this->conn);
    }

    /**
     * @inheritDoc
     */
    public function obterTodos(): array
    {
        $fornecedors = $this->selectSql->selecionarTodos('suppliers', ['*']);
        return $this->limparArray($fornecedors);
    }

    /**
     * @inheritDoc
     */
    public function obterPorId($id): array
    {
        $fornecedors = $this->selectSql->selecionarTodos('suppliers', ['*'], 'supplierid = ?', [$id]);
        return $this->limparArray($fornecedors);
    }

    /**
     * @inheritDoc
     */
    private function limparArray($array): array
    {
        foreach ($array as $key1 => $value1) {
            foreach ($value1 as $key2 => $value2) {
                if(is_numeric($key2)) unset($array[$key1][$key2]);
            }
        }

        return $array;
    }
}
