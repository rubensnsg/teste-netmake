<?php

namespace App;

/**
 * atualizar registro no SQLite
 * Class SQLiteUpdate
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-23
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
     * @param string $tabela - nome da tabela no banco de dados
     * @param array  $campos - coluna = nome da coluna no BD, valor = valor
     * @param string $where - comando where para o update
     * @return string
     * @throws \Exception
     */
    public function atualizar($tabela, array $campos = [], $where = '') {
        if (count($campos) < 1) {
            throw new \Exception("Não foram enviado campos para inserir no banco de dados.");
        }
        if (trim($where) == '') {
            throw new \Exception("Parâmetro where não foram enviados");
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