<?php
class Crud
{
  private $tabela;
  public function __construct($tabela)
  {
    $this->tabela = $tabela;
  }
  public function select($campos = "*", $condicao = NULL)
  {
    $conexao = Transaction::get();
    if (!$condicao) {
      $sql = "SELECT $campos FROM $this->tabela";
    } else {
      $sql = "SELECT $campos FROM $this->tabela WHERE $condicao";
    }
    $resultado = $conexao->query($sql);
    if ($resultado->rowCount() > 0) {
      while ($registros = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $lista[] = $registros;
      }
      return $lista;
    } else {
      echo "Nenhum registro encontrado!";
      return false;
    }
  }
}