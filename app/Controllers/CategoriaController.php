<?php

namespace App\Controllers;

use App\Services\CategoriaService;

/**
 * Class CategoriaController
 *
 * @author  Rubens Nelson Santos Gonçalves <rubensnsg@hotmail.com.br>
 * @since   2021-05-24
 */
class CategoriaController {
    /** @var \App\Services\CategoriaService $categoriaServico */
    private $categoriaServico;

    public function __construct()
    {
        $this->categoriaServico = new CategoriaService();
    }

    public function obterTodos()
    {
        try {
            $resposta = $this->categoriaServico->obterTodos();
            return json_encode(["mensagem" => "ok", "data" => $resposta]);
        } catch (\Exception $erro) {
            $mensagem = "Erro ao buscar categorias";
            http_response_code(404);
            return json_encode(["mensagem" => $mensagem]);
        }
    }

    public function obterPorId($id)
    {
        try {
            $resposta = $this->categoriaServico->obterPorId($id);
            return json_encode(["mensagem" => "ok", "data" => $resposta]);
        } catch (\Exception $erro) {
            $mensagem = "Erro ao buscar categorias";
            http_response_code(404);
            return json_encode(["mensagem" => $mensagem]);
        }
    }
}
