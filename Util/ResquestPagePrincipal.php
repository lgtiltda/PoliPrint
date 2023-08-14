<?php
$pagina = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_STRING);

$arrayPaginas = array(
    "home" => "View/home.php", //Página inicial
    "carinhocompras" => "View/CarinhoView.php", //Página Para Montar Pedido
    "s1" => "View/s1.php", //Página Para Montar Pedido
    "s2" => "View/s2.php" ,//Página Para Montar Pedido
    "e1" => "View/e1.php", //Página Para Montar Pedido
    "inst" => "View/inst.php", //Página Para Montar Pedido
    "sup" => "View/sup.php", //Página Para Montar Pedido
    "cont" => "View/cont.php", //Página Para Montar Pedido
    "gov" => "View/gov.php", //Página Para Montar Pedido
    "ind" => "View/ind.php", //Página Para Montar Pedido
    "var" => "View/var.php", //Página Para Montar Pedido
    "saud" => "View/saud.php", //Página Para Montar Pedido
    "log" => "View/log.php", //Página Para Montar Pedido
    "edu" => "View/edu.php", //Página Para Montar Pedido
    "out-imp" => "View/out-imp.php", //Página Para Montar Pedido
    "out-ti" => "View/out-ti.php", //Página Para Montar Pedido
    "vend-comp" => "View/vend-comp.php", //Página Para Montar Pedido
    "vend-imp" => "View/vend-imp.php", //Página Para Montar Pedido
    "vend-sup" => "View/vend-sup.php", //Página Para Montar Pedido
    "dig-doc" => "View/dig-doc.php", //Página Para Montar Pedido
    
);

if ($pagina) {
    $encontrou = false;

    foreach ($arrayPaginas as $page => $key) {
        if ($pagina == $page) {
            $encontrou = true;
            require_once($key);
        }
    }

    if (!$encontrou) {
        require_once("View/home.php");
    }
} else {
    require_once("View/home.php");
}
?>