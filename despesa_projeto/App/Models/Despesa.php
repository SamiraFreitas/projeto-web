<?php

namespace App\Models;

use MF\Model\Model;

class Despesa extends Model {
    private $id; 
    private $id_usuario;
    private $despesa; 
    private $valor;
    private $data;

    public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}
//salvar 

public function salvar(){

  
  $query = "insert into despesas(id_usuario, despesa, valor)values(:id_usuario, :despesa, :valor)";
  $stmt = $this->db->prepare($query);
  $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
  $stmt->bindValue(':despesa', $this->__get('despesa'));
  $stmt->bindValue(':valor', $this->__get('valor')); 
  $stmt->execute();

  return $this;

}

//recuperar 
public function getAll(){
  $query = "
  select id, id_usuario, despesa, valor, data from despesas where id_usuario = :id_usuario
  ";
  $stmt = $this->db->prepare($query);
  $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
  $stmt->execute();

  return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

 

}