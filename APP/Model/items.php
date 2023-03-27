<?php

function get_5_random_products(){

    $retornar = "";
    
    $conexao = new mysql();
    $mysqli = $conexao->getConexao();
    $com = ("select * from ". $conexao::$db_table_products. " ORDER BY RAND() LIMIT 5;");
    $getrandom5products = mysqli_query($mysqli, $com);
    if (mysqli_num_rows($getrandom5products) > 0) {
        while ($linha = mysqli_fetch_assoc($getrandom5products)) {
            $title_short = mb_strimwidth($linha["title"], 0, 23, "...");
            $retornar = $retornar. '<div class="col"> <a href="/product?id='. $linha["id"] .'" style="text-decoration: none;"> <div data-aos="fade-up" data-aos-duration="1000" data-aos-anchor-placement="top-bottom" class="card" style="width: 17rem;height: 18rem;"> <img   src="./Assets/imgs/products/'. $linha["image"]. '"   class="card-img-top cardimg"> <div class="card-body">   <h5 class="card-title text-start card-titulo">'. $title_short .'</h5>   <h6 class="text-start card-preco">R$'. $linha["price"] .'</h6> </div> </div> </a> </div>';
        }
    }


    return $retornar;
}

?>