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
        $resultado = $consultorio->insert("paciente, idade, diagnostico", "$paciente, $idade, $diagnostico");
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