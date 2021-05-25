<?php

namespace App\Services;

use App\SQLiteConnection;
use App\SQLiteSelect;

/**
 * Class NodeService
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-24
 */
class NodeService implements NodeServiceInterface{
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
        $nodes = $this->selectSql->selecionarTodos('products', ['*']);
        return $this->limparArray($nodes);
    }

    /**
     * @inheritDoc
     */
    public function obterPorCriterios($dados): array
    {
        $pagina = isset($dados['pagina']) && is_numeric($dados['pagina']) ? $dados['pagina'] : 1;
        $limite = isset($dados['limite']) && is_numeric($dados['limite']) ? $dados['limite'] : 10;

        $produtos = $this->selectSql->selecionarPaginado('nodes n1', [
            'n1.node_id',
            'n1.node_desc',
            'n1.node_value',
            'n1.node_master',
            '(SELECT SUM(n2.node_value) FROM nodes n2 WHERE n2.node_master = n1.node_id) AS filhos_valor',
            '(CASE WHEN node_master IS NULL THEN \'\' ELSE (SELECT n3.node_desc FROM nodes n3 WHERE n3.node_id = n1.node_master) END) master_nome '
        ], '', [], 'ORDER BY n1.node_id DESC', $pagina, $limite);

        $produtos["dados"] = $this->limparArray($produtos["dados"]);

        return $produtos;
    }

    /**
     * @inheritDoc
     */
    public function obterPorId($id): array
    {
        $produtos = $this->selectSql->selecionarTodos('nodes', ['*'], 'nodeid = ?', [$id]);
        return $this->limparArray($produtos);
    }

    /**
     * @param array $array
     * @return array
     */
    private function limparArray($array): array
    {
        foreach ($array as $key1 => $value1) {
            if (is_array($value1)) {
                foreach ($value1 as $key2 => $value2) {
                    if(is_numeric($key2)) unset($array[$key1][$key2]);
                }
                $array[$key1]["subordinados_valor"] = $this->verificarValorSubordinados(
                    $array[$key1]["node_id"]
                );
                if ($array[$key1]["filhos_valor"] == null) {
                    $array[$key1]["filhos_valor"] = "0";
                }
            }
        }

        return $array;
    }

    /**
     * @param string $id
     * @return string
     */
    private function verificarValorSubordinados($id): string
    {
        $totalAtual = 0;

        $produtos = $this->selectSql->selecionarTodos('nodes', [
            'SUM(node_value) AS total_atual', 'GROUP_CONCAT(node_id) AS id_atual'
        ], 'node_master IN (' . $id . ')');

        if ($produtos[0]["id_atual"] != null) {
            $totalAtual += (float) $this->verificarValorSubordinados($produtos[0]["id_atual"]);

            $totalAtual += $produtos[0]["total_atual"];
        }

        return (string) $totalAtual;
    }
}
