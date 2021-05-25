<?php

namespace App\Services;

use App\SQLiteConnection;
use App\SQLiteSelect;

/**
 * Class CategoriaService
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-24
 */
class CategoriaService implements CategoriaServiceInterface{
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
        $categorias = $this->selectSql->selecionarTodos('categories', ['*']);
        return $this->limparArray($categorias);
    }

    /**
     * @inheritDoc
     */
    public function obterPorId($id): array
    {
        $categorias = $this->selectSql->selecionarTodos('categories', ['*'], 'categoryid = ?', [$id]);
        return $this->limparArray($categorias);
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
            if ($array[$key1]["picture"] != null) {                
                $array[$key1]["picture"] = base64_encode($array[$key1]["picture"]);
            }
        }

        return $array;
    }
}
