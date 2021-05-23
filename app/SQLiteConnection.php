<?php

namespace App;

/**
 * SQLite connnection
 * Class SQLiteConnection
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-22
 */
class SQLiteConnection {
    /** @var object $pdo */
    private $pdo;

    /**
     * retorna objeto PDO que conecta a base SQLite
     * @return \PDO
     */
    public function connect() {
        try {
           $this->pdo = new \PDO("sqlite:" . Config::CAMINHO_ARQUIVO_BD_SQLITE);
        } catch (\PDOException $erro) {
            echo "Ocorreu um erro ao tentar conectar ao banco de dados, segue abaixo mais detalhes:<br />";
            print_r($erro->getMessage());
        }
        return $this->pdo;
    }
}