<?php

namespace App;

/**
 * apagar registro no SQLite
 * Class SQLiteDelete
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-23
 */
class SQLiteDelete {
    /** @var object $pdo */
    private $pdo;

    /**
     * Inicia o objeto PDO
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @param string $tabela - nome da tabela no banco de dados
     * @param string $where - comando where para o delete
     * @param array  $parametros - somente valores, campo opcional para utilizar bindValue
     * @return bool
     * @throws \Exception
     */
    public function apagar($tabela, $where = '', array $parametros = []) {
        if (trim($where) == '') {
            throw new \Exception("Parâmetro where não foi informado.");
        }

        $query = 'DELETE FROM ' . $tabela . ' WHERE ' . $where . ' ';

        $stmt = $this->pdo->prepare($query);
        foreach ($parametros as $chave => $valor) {
            $campo = $chave + 1;
            $stmt->bindValue($campo, $valor);
        }

        if (!$stmt->execute()) {
            throw new \Exception("Erro ao atualizar registro no banco de dados");
        }

        return true;
    }
}