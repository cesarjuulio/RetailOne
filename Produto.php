<?php

/**
 * Classe para realizar operações com informações de usuários.
 */
class Produto{

    private $mysql;

    /**
     * Método responsável por criar um objeto do tipo Ator.
     * 
     * @param $mysql uma conexão ao BD.
     * 
     * @return um objeto do tipo Ator.
     */
    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }


    /**
     * Método responsável por retornar informações de atores do BD.
     * 
     * @param Nenhum parâmetro de entrada.
     * 
     * @return array informações de atores do BD.
     */
    public function get_produtos(): array
    {
        // String da consulta para o BD em ordem alfabética
        $sql = 'SELECT id, nome, descricao, fornecedor, marca, categoria, preco_compra, preco_venda, estoque, estoque_minimo, unidade_medida, ncm, validade, data_cadastro FROM produto';

        // Consulta no BD
        $resultado = $this->mysql->query($sql);

        // Retorna um array associativo
        $produtos = $resultado->fetch_all(MYSQLI_ASSOC);

        return $produtos;
    }

    public function get_produto($id)
    {
        $id = intval($id);
        $sql = "SELECT id, nome, descricao, fornecedor, marca, categoria, preco_compra, preco_venda, estoque, estoque_minimo, unidade_medida, ncm, validade, data_cadastro 
                FROM produto WHERE id = $id";

        $resultado = $this->mysql->query($sql);
        return $resultado->fetch_assoc();
    }

    public function excluir_produto($id)
    {
        $id = intval($id);
        $sql = "DELETE FROM produto WHERE id = ?";
        $stmt = $this->mysql->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

?>