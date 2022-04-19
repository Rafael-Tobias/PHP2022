
<?php
class Form
{
  private $message = "";
  public function controller()
  {
    $form = new Template("view/form.html");
    $this->message = $form->saida();
  }
  public function salvar()
  {
    print_r($_POST);
  }
  public function getMessage()
  {
    return $this->message;
  }
}