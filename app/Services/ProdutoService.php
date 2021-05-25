<?php

namespace App\Services;

use App\SQLiteConnection;
use App\SQLiteSelect;
use App\SQLiteInsert;
use App\SQLiteDelete;

/**
 * Class ProdutoService
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-24
 */
class ProdutoService implements ProdutoServiceInterface{
    /** @var \App\SQLiteConnection $conn */
    private $conn;

    /** @var \App\SQLiteSelect $selectSql */
    private $selectSql;

    /** @var \App\SQLiteInsert $insertSql */
    private $insertSql;

    /** @var \App\SQLiteDelete $deleteSql */
    private $deleteSql;

    public function __construct() {
        $this->conn = (new SQLiteConnection())->connect();
        $this->selectSql = new SQLiteSelect($this->conn);
        $this->insertSql = new SQLiteInsert($this->conn);
        $this->deleteSql = new SQLiteDelete($this->conn);
    }

    /**
     * @inheritDoc
     */
    public function obterTodos(): array
    {
        $produtos = $this->selectSql->selecionarTodos('products', ['*']);
        return $this->limparArray($produtos);
    }

    /**
     * @inheritDoc
     */
    public function obterPorCriterios($dados): array
    {
        $pagina = isset($dados['pagina']) && is_numeric($dados['pagina']) ? $dados['pagina'] : 1;
        $limite = isset($dados['limite']) && is_numeric($dados['limite']) ? $dados['limite'] : 10;

        $produtos = $this->selectSql->selecionarPaginado(
            'products p LEFT JOIN suppliers s ON s.supplierid = p.supplierid LEFT JOIN categories c ON c.categoryid = p.categoryid',
            ['productid', 'productname', 's.companyname', 'c.categoryname', 'unitsinstock', 'totalvalue', 'discontinued'],
            '',
            [],
            'ORDER BY productid DESC',
            $pagina,
            $limite);

        $produtos["dados"] = $this->limparArray($produtos["dados"]);

        return $produtos;
    }

    /**
     * @inheritDoc
     */
    public function obterPorId($id): array
    {
        $produtos = $this->selectSql->selecionarTodos('products', ['*'], 'productid = ?', [$id]);
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
            }
        }

        return $array;
    }

    /**
     * @inheritDoc
     */
    public function inserirProduto($dados): string
    {
        $produto = $this->selectSql->selecionarTodos('products', ['MAX(productid) AS maior']);
        $id = 1;

        if (isset($produto[0][0]) && is_numeric($produto[0][0])) {
            $id += $produto[0][0];
        }

        if ( (!isset($dados['discontinued'])) ) {
            $dados['discontinued'] = 1;
        }
        if ($dados['discontinued'] > 0) {
            $dados['discontinued'] = 1;
        }

        $dados['productid'] = $id;

        return $this->insertSql->inserir('products', $dados);
    }

    /**
     * @inheritDoc
     */
    public function apagarProduto($id): array
    {
        $produtos = $this->selectSql->selecionarTodos('products', ['*'], 'productid = ?', [$id]);

        if (count($produtos) == 0) {
            throw new \Exception("Produto não encontrado.");
        }

        if (!$this->deleteSql->apagar('products', 'productid = ?', [$id])) {
            throw new \Exception("Erro ao apagar produto.");
        }

        return $this->limparArray($produtos);
    }
}
