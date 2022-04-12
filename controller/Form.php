<?php
class Form
{
  private $message = "";
  public function controller()
  {
    $this->message = "Estou na classe Form";
  }
  public function getMessage()
  {
    return $this->message;
  }
}
