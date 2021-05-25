<?php

namespace App\Controllers;

use App\Services\ProdutoService;

/**
 * Class ProdutoController
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-24
 */
class ProdutoController {
    /** @var \App\Services\ProdutoService $produtoServico */
    private $produtoServico;

    public function __construct()
    {
        $this->produtoServico = new ProdutoService();
    }

    public function obterTodos()
    {
        try {
            $resposta = $this->produtoServico->obterTodos();
            return json_encode(["mensagem" => "ok", "data" => $resposta]);
        } catch (\Exception $erro) {
            $mensagem = "Erro ao buscar produtos";
            http_response_code(404);
            return json_encode(["mensagem" => $mensagem]);
        }
    }

    public function obterPorCriterios($dados)
    {
        try {
            $resposta = $this->produtoServico->obterPorCriterios($dados);
            return json_encode(["mensagem" => "ok", "data" => $resposta]);
        } catch (\Exception $erro) {
            $mensagem = "Erro ao buscar produtos";
            http_response_code(404);
            return json_encode(["mensagem" => $mensagem]);
        }
    }

    public function obterPorId($id)
    {
        try {
            $resposta = $this->produtoServico->obterPorId($id);
            return json_encode(["mensagem" => "ok", "data" => $resposta]);
        } catch (\Exception $erro) {
            $mensagem = "Erro ao buscar produtos";
            http_response_code(404);
            return json_encode(["mensagem" => $mensagem]);
        }
    }

    public function inserirProduto($dados)
    {
        try {
            $resposta = $this->produtoServico->inserirProduto($dados);
            return json_encode(["mensagem" => "ok", "data" => $resposta]);
        } catch (\Exception $erro) {
            $mensagem = "Erro ao inserir produtos";
            http_response_code(404);
            return json_encode(["mensagem" => $mensagem]);
        }
    }

    public function apagarProduto($id)
    {
        try {
            $resposta = $this->produtoServico->apagarProduto($id);
            return json_encode(["mensagem" => "ok", "data" => $resposta]);
        } catch (\Exception $erro) {
            $mensagem = $erro->getMessage();
            http_response_code(404);
            return json_encode(["mensagem" => $mensagem]);
        }
    }
}
