<?php

namespace App;

/**
 * inserir registro no SQLite
 * Class SQLiteInsert
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-22
 */
class SQLiteInsert {
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
     * @param string  $tabela - Nome da tabela no banco de dados
     * @param array   $campos - coluna = nome da coluna no BD, valor = valor
     * @return int o último id inserido via lastInsertId()
     * @throws \Exception
     */
    public function inserir(string $tabela, array $campos = []) {
        if (count($campos) < 1) {
            throw new \Exception("Não foram enviado campos para inserir no banco de dados.");
        }

        $query = 'INSERT INTO ' . $tabela . '(' . implode(", ",array_keys($campos));
        $query .= ') VALUES(:' . implode(", :",array_keys($campos)) . ')';
        
        $stmt = $this->pdo->prepare($query);
        foreach ($campos as $coluna => $valor) {
            $campo = trim(':' . $coluna);
            $stmt->bindValue($campo, $valor);
        }

        if (!$stmt->execute()) {
            throw new \Exception("Erro ao inserir no banco de dados");
        }

        return $this->pdo->lastInsertId();
    }
}
