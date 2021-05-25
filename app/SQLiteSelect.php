<?php

namespace App;

/**
 * atualizar registro no SQLite
 * Class SQLiteSelect
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-23
 */
class SQLiteSelect {
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
     * @param string $tabela - nome da tabela no banco de dados, pode colocar LEFT JOIN
     * @param array  $campos - somente valores, campos a serem selecionados no SELECT 
     * @param string $where - (opcional)comando WHERE para o comando sql
     * @param array  $parametros - (opcional)somente valores, campo opcional para utilizar bindValue
     * @param string $fimSql - (opcional)comando GROUP BY, ORDER BY e LIMIT
     * @return array
     * @throws \Exception
     */
    public function selecionarTodos($tabela, array $campos = [], $where = '', array $parametros = [], $fimSql = '') {
        $querySQL = "SELECT ".implode(", ", $campos)." FROM ".$tabela;
        if (trim($where) != '') {
            $querySQL .= ' WHERE ' . $where . ' ';
        }
        if (trim($fimSql) != '') {
            $querySQL .= ' ' . $fimSql;
        }

        $stmt = $this->pdo->prepare($querySQL);
        foreach ($parametros as $chave => $valor) {
            $campo = $chave + 1;
            $stmt->bindValue($campo, $valor);
        }

        if (!$stmt->execute()) {
            throw new \Exception("Erro ao selecionar registros no banco de dados");
        }

        return $stmt->fetchAll();
    }

    /**
     * @param string $tabela - nome da tabela no banco de dados, pode colocar LEFT JOIN
     * @param array  $campos - somente valores, campos a serem selecionados no SELECT 
     * @param string $where - (opcional)comando WHERE para o comando sql
     * @param array  $parametros - (opcional)somente valores, campo opcional para utilizar bindValue
     * @param string $fimSql - (opcional)comando GROUP BY, ORDER BY e LIMIT
     * @param int    $paginaAtual - (opcional) valor padrão página 1
     * @param int    $quantidadePorPagina - (opcional) valor padrão limite de 10 registros
     * @return array
     * @throws \Exception
     */
    public function selecionarPaginado($tabela, array $campos = [], $where = '', array $parametros = [], $fimSql = '', $paginaAtual = 1, $quantidadePorPagina = 10) {

        $numeroInicio = ($paginaAtual * $quantidadePorPagina) - $quantidadePorPagina;
        $limitNoSql = " LIMIT " . $numeroInicio . ", " . $quantidadePorPagina . "";

        $totalNoSql = 0;
        $registrosSql = $this->selecionarTodos($tabela, ["COUNT(*)"], $where, $parametros, $fimSql);
        if (isset($registrosSql[0][0]) && is_numeric($registrosSql[0][0]) && $registrosSql[0][0] > 0) { // Quantidade de linhas no SELECT
            $totalNoSql = $registrosSql[0][0];
        }

        $paginaFinal = (string) (ceil($totalNoSql / $quantidadePorPagina));

        $fimSql .= $limitNoSql;

        $retorno = $this->selecionarTodos($tabela, $campos, $where, $parametros, $fimSql);

        return [
            'paginaInicial' => '1',
            'paginaAtual' => $paginaAtual,
            'paginaFinal' => $paginaFinal,
            'quantidadeTotal' => $totalNoSql,
            'quantidadePorPagina' => $quantidadePorPagina,
            'dados' => $retorno
        ];
    }
}