<?php

/**
 * Classe para realizar operações com informações de usuários.
 */
class Usuario{

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
     * @return array informações de usuarios do BD.
     */
    public function get_usuarios(): array
    {
        // String da consulta para o BD em ordem alfabética
        $sql = 'SELECT matricula, nome, email, telefone, tipo_usuario FROM usuario ORDER BY nome ASC';

        // Consulta no BD
        $resultado = $this->mysql->query($sql);

        // Retorna um array associativo
        $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

        return $usuarios;
    }

    public function cadastrar_usuario($matricula, $nome, $email, $telefone, $senha, $tipo_usuario): bool
    {
        if (empty($matricula) || empty($nome) || empty($email) || empty($telefone) || empty($senha)) {
            echo "<script>alert('Preencha todos os campos!');</script>";
            return false;
        } else {
            // Usando $this->mysql ao invés de $conexao
            $matricula = $this->mysql->real_escape_string($matricula);
            $nome = $this->mysql->real_escape_string($nome);
            $email = $this->mysql->real_escape_string($email);
            $telefone = $this->mysql->real_escape_string($telefone);
            $senha = $this->mysql->real_escape_string($senha);
            $tipo_usuario = $this->mysql->real_escape_string($tipo_usuario ?? 'padrao');

            $check_sql = "SELECT * FROM usuario WHERE matricula = '$matricula'";
            $check_query = $this->mysql->query($check_sql);

            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            if ($check_query && $check_query->num_rows > 0) {
                echo "<script>alert('Matrícula já cadastrada!');</script>";
                return false;
            } else {
                $sql_code = "INSERT INTO usuario (matricula, nome, email, telefone, senha, tipo_usuario)
                            VALUES ('$matricula', '$nome', '$email', '$telefone', '$senha_hash', '$tipo_usuario')";

                if ($this->mysql->query($sql_code)) {
                    echo "<script>alert('Funcionário cadastrado com sucesso!'); window.location='login.php';</script>";
                    return true;
                } else {
                    echo "<script>alert('Erro ao cadastrar funcionário: " . $this->mysql->error . "');</script>";
                    return false;
                }
            }
        }
    }
}

?>