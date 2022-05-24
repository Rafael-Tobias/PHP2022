<?php
// auto load
spl_autoload_extensions('.php');
function classLoader($class)
{
    $nomeArquivo = $class . "php";
    $pastas = array(
        "shared/controller",
        "shared/model",
        "public/controller",
        "public/model"
    );
    foreach ($pastas as $pasta) {
        $arquivo = "{$pasta}/{$nomeArquivo}";
        if (file_exists($arquivo)) {
            require_once($arquivo);
        }
    }
}
spl_autoload_register("classLoader");

// Front Controller
class Aplicacao
{
    static private $path = "/modelo";
    static private $uri = "/modelo/restrita.php";
    public static function run()
    {
        $layout = new Template("restrict/view/layout.html");
        $layout->set("uri", self::$uri);
        $layout->set("path", self::$path);
        if (isset($_GET["class"])) {
            $class = $_GET["class"];
        } else {
            $class = "Inicio";
        }
        if (isset($_GET["method"])) {
            $method = $_GET["method"];
        } else {
            $method = "";
        }
        if (empty($class)) {
            $class = "Inicio";
        }
        if (class_exists($class)) {
            $pagina = new $class();
            if (method_exists($pagina, $method)) {
                $pagina->$method();
            } else {
                $pagina->controller();
            }
            $layout->set('conteudo', $pagina->getMessage());
        }
        $layout->set("nome", Session::getValue("nome"));
        echo $layout->saida();
    }
}
Aplicacao::run();
