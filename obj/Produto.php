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
    
    public function cadastrar_produto($nome, $descricao, $fornecedor, $marca, $categoria, $preco_compra, $preco_venda, $estoque, $estoque_minimo, $unidade_medida, $ncm, $validade): bool
    {
        // Campos obrigatórios
        $required = ['nome', 'preco_compra', 'preco_venda', 'estoque', 'estoque_minimo'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                echo "<script>alert('Preencha todos os campos obrigatórios!');</script>";
                exit();
            }
        }

        $nome = $conexao->real_escape_string($_POST['nome']);
        $descricao = $conexao->real_escape_string($_POST['descricao']);
        $fornecedor = $conexao->real_escape_string($_POST['fornecedor']);
        $marca = $conexao->real_escape_string($_POST['marca']);
        $categoria = $conexao->real_escape_string($_POST['categoria']);
        $preco_compra = floatval($_POST['preco_compra']);
        $preco_venda = floatval($_POST['preco_venda']);
        $estoque = intval($_POST['estoque']);
        $estoque_minimo = intval($_POST['estoque_minimo']);
        $unidade_medida = $conexao->real_escape_string($_POST['unidade_medida']);
        $ncm = $conexao->real_escape_string($_POST['ncm']);
        $validade = !empty($_POST['validade']) ? $conexao->real_escape_string($_POST['validade']) : null;

        $sql = "INSERT INTO produto 
            (nome, descricao, fornecedor, marca, categoria, preco_compra, preco_venda, estoque, estoque_minimo, unidade_medida, ncm, validade)
            VALUES 
            ('$nome', '$descricao', '$fornecedor', '$marca', '$categoria', $preco_compra, $preco_venda, $estoque, $estoque_minimo, '$unidade_medida', '$ncm', " . ($validade ? "'$validade'" : "NULL") . ")";

        if ($conexao->query($sql)) {
            echo "<script>alert('Produto cadastrado com sucesso!'); window.location='add-produto.php';</script>";
            header('Location: estoque.php');
        } else {
            echo "<script>alert('Erro ao cadastrar produto: " . $conexao->error . "');</script>";
        }
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