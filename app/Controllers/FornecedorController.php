<?php

namespace App\Controllers;

use App\Services\FornecedorService;

/**
 * Class FornecedorController
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-24
 */
class FornecedorController {
    /** @var \App\Services\FornecedorService $fornecedorServico */
    private $fornecedorServico;

    public function __construct()
    {
        $this->fornecedorServico = new FornecedorService();
    }

    public function obterTodos()
    {
        try {
            $resposta = $this->fornecedorServico->obterTodos();
            return json_encode(["mensagem" => "ok", "data" => $resposta]);
        } catch (\Exception $erro) {
            $mensagem = "Erro ao buscar fornecedors";
            http_response_code(404);
            return json_encode(["mensagem" => $mensagem]);
        }
    }

    public function obterPorId($id)
    {
        try {
            $resposta = $this->fornecedorServico->obterPorId($id);
            return json_encode(["mensagem" => "ok", "data" => $resposta]);
        } catch (\Exception $erro) {
            $mensagem = "Erro ao buscar fornecedors";
            http_response_code(404);
            return json_encode(["mensagem" => $mensagem]);
        }
    }
}
