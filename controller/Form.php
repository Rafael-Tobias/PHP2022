<?php
class Form
{
  private $message = "";
  public function __construct()
  {
    Transaction::open();
  }
  public function controller()
  {
    $form = new Template("view/form.html");
    $form->set("id", "");
    $form->set("paciente", "");
    $form->set("idade", "");
    $form->set("diagnostico", "");
    $this->message = $form->saida();
  }
  public function salvar()
  {
    if (isset($_POST["paciente"]) && isset($_POST["idade"]) && isset($_POST["diagnostico"])) {
      try {
        $conexao = Transaction::get();
        $consultorio = new Crud("consultorio");
        $paciente = $conexao->quote($_POST["paciente"]);
        $idade = $conexao->quote($_POST["idade"]);
        $diagnostico = $conexao->quote($_POST["diagnostico"]);
        if (empty($_POST["id"])) {
          $consultorio->insert(
            "paciente, idade, diagnostico",
            "$paciente, $idade, $diagnostico"
          );
        } else {
          $id = $conexao->quote($_POST["id"]);
          $consultorio->update(
            "paciente = $paciente, idade = $idade, diagnostico = $diagnostico",
            "id = $id"
          );
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
  }
  public function editar()
  {
    if (isset($_GET["id"])) {
      try {
        $conexao = Transaction::get();
        $id = $conexao->quote($_GET["id"]);
        $consultorio = new Crud("consultorio");
        $resultado = $consultorio->select("*", "id = $id");
        $form = new Template("view/form.html");
        foreach ($resultado[0] as $cod => $diagnostico) {
          $form->set($cod, $diagnostico);
        }
        $this->message = $form->saida();
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
  }
  public function getMessage()
  {
    return $this->message;
  }
  public function __destruct()
  {
    Transaction::close();
  }
}