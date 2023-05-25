<?php
class BD {
    private $host = "localhost";
    private $dbname = "pet_prog";
    private $port = 3306;
    private $usuario = "root";
    private $senha = "";
    private $db_charset = "utf8";

    public function conn(){
        $conn = "mysql:host=$this->host;dbname=$this->dbname;port=$this->port";

        return new PDO(
            $conn,
            $this->usuario,
            $this->senha,
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ". $this->db_charset]
        );
    }

    public function inserir($dados){
        $conn = $this->conn();
        $sql = "INSERT INTO pet (nome, idade, peso, tutor) VALUES (?, ?, ?, ?);";
        $st = $conn->prepare($sql);
        $st->execute([$dados['nome'], $dados['idade'], $dados['peso'], $dados['tutor']]);
    }

    public function atualizar($dados){
        $id = $dados['id'];
        $conn = $this->conn();
        $sql = "UPDATE pet SET nome=?, idade=?, peso=?, tutor=? WHERE id = $id ";
        $st = $conn->prepare($sql);
        $st->execute([$dados['nome'], $dados['idade'], $dados['peso'], $dados['tutor']]);
    }

    public function select(){
        $conn = $this->conn();
        $sql = "SELECT * FROM pet;";
        $st = $conn->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function buscar($id){
        $conn = $this->conn();
        $sql = "SELECT * FROM pet WHERE id=?;";
        $st = $conn->prepare($sql);
        $st->execute([$id]);
        return $st->fetchObject();
    }

    public function deletar($id){
        $conn = $this->conn();
        $sql = "DELETE FROM pet WHERE id = ?";
        $st = $conn->prepare($sql);
        $st->execute([$id]);
    }

    public function pesquisar($dados){

        $campo = $dados['campo'];
        $valor = $dados['valor'];

        $conn = $this->conn();
        $sql = "SELECT * FROM pet WHERE $campo LIKE ?;";
        $st = $conn->prepare($sql);
        $st->execute(["%".$valor."%"]);

        return $st->fetchAll(PDO::FETCH_CLASS); 
    }


}