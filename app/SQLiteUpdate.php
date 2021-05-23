<?php

namespace App;

/**
 * inserir registro no SQLite
 * Class SQLiteUpdate
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-22
 */
class SQLiteUpdate {
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
     * @param string $tabela
     * @param array  $campos
     * @param string $where
     * @return string
     * @throws \Exception
     */
    public function atualizar($tabela, array $campos = [], $where = '') {
        if (count($campos) < 1) {
            throw new \Exception("Não foram enviado campos para inserir no banco de dados.");
        }

        $query = 'UPDATE ' . $tabela . ' SET ';
        $flagPrimeiroCampo = 1;
        foreach ($campos as $coluna => $valor) {
            $campo = trim(':' . $coluna);
            if ($flagPrimeiroCampo != 1) {
                $query .= ',';
            }
            $query .= ' ' . $coluna . ' = ' . $campo;
            $flagPrimeiroCampo = 0;
        }
        $query .= ' WHERE ' . $where . ' ';
        echo $query;
        exit;

        $stmt = $this->pdo->prepare($query);
        foreach ($campos as $coluna => $valor) {
            $campo = trim(':' . $coluna);
            $stmt->bindValue($campo, $valor);
        }

        if (!$stmt->execute()) {
            throw new \Exception("Erro ao atualizar registro no banco de dados");
        }

        return $campos;
    }
}
