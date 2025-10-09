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
     * @return array informações de atores do BD.
     */
    public function get_atores(): array
    {
        // String da consulta para o BD em ordem alfabética
        $sql = 'SELECT matricula, nome, email, telefone, tipo_usuario FROM usuario ORDER BY nome ASC';

        // Consulta no BD
        $resultado = $this->mysql->query($sql);

        // Retorna um array associativo
        $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

        return $usuarios;
    }
}

?>