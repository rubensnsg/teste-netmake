<?php

namespace App\Controllers;

use App\Services\NodeService;

/**
 * Class NodeController
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-24
 */
class NodeController {
    /** @var \App\Services\NodeService $nodeServico */
    private $nodeServico;

    public function __construct()
    {
        $this->nodeServico = new NodeService();
    }

    public function obterTodos()
    {
        try {
            $resposta = $this->nodeServico->obterTodos();
            return json_encode(["mensagem" => "ok", "data" => $resposta]);
        } catch (\Exception $erro) {
            $mensagem = "Erro ao buscar nodes";
            http_response_code(404);
            return json_encode(["mensagem" => $mensagem]);
        }
    }

    public function obterPorCriterios($dados)
    {
        try {
            $resposta = $this->nodeServico->obterPorCriterios($dados);
            return json_encode(["mensagem" => "ok", "data" => $resposta]);
        } catch (\Exception $erro) {
            $mensagem = "Erro ao buscar nodes";
            http_response_code(404);
            return json_encode(["mensagem" => $mensagem]);
        }
    }

    public function obterPorId($id)
    {
        try {
            $resposta = $this->nodeServico->obterPorId($id);
            return json_encode(["mensagem" => "ok", "data" => $resposta]);
        } catch (\Exception $erro) {
            $mensagem = "Erro ao buscar nodes";
            http_response_code(404);
            return json_encode(["mensagem" => $mensagem]);
        }
    }
}
