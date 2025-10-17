<?php

class Produto
{
    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function get_produtos(): array
    {
        $sql = 'SELECT id, nome, descricao, fornecedor, marca, categoria, preco_compra, preco_venda, estoque, estoque_minimo, unidade_medida, ncm, validade, data_cadastro FROM produto';
        $resultado = $this->mysql->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
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
        // Validar campos obrigatórios
        if (empty($nome) || empty($preco_compra) || empty($preco_venda) || empty($estoque) || empty($estoque_minimo)) {
            echo "<script>alert('Preencha todos os campos obrigatórios!');</script>";
            return false;
        }

        // Escapar strings
        $nome = $this->mysql->real_escape_string($nome);
        $descricao = $this->mysql->real_escape_string($descricao);
        $fornecedor = $this->mysql->real_escape_string($fornecedor);
        $marca = $this->mysql->real_escape_string($marca);
        $categoria = $this->mysql->real_escape_string($categoria);
        $unidade_medida = $this->mysql->real_escape_string($unidade_medida);
        $ncm = $this->mysql->real_escape_string($ncm);
        $validade = $validade ? $this->mysql->real_escape_string($validade) : null;

        // Garantir tipos corretos
        $preco_compra = floatval($preco_compra);
        $preco_venda = floatval($preco_venda);
        $estoque = intval($estoque);
        $estoque_minimo = intval($estoque_minimo);

        $sql = "INSERT INTO produto 
                (nome, descricao, fornecedor, marca, categoria, preco_compra, preco_venda, estoque, estoque_minimo, unidade_medida, ncm, validade)
                VALUES 
                ('$nome', '$descricao', '$fornecedor', '$marca', '$categoria', $preco_compra, $preco_venda, $estoque, $estoque_minimo, '$unidade_medida', '$ncm', " . ($validade ? "'$validade'" : "NULL") . ")";

        if ($this->mysql->query($sql)) {
            echo "<script>alert('Produto cadastrado com sucesso!'); window.location='estoque.php';</script>";
            return true;
        } else {
            echo "<script>alert('Erro ao cadastrar produto: " . $this->mysql->error . "');</script>";
            return false;
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
