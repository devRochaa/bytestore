<?php


class card
{
    function CREATE_CARD($id, $title, $price, $discount, $img, $owner)
    {
        $actual_price = $price - $discount;
        $parcel = $actual_price / 96;
        $discount = 10;
        $discount_text = $actual_price - 10;

        $formatted_number = number_format($actual_price, 2, ',', '.'); 
        $formatted_currency = 'R$ ' . $formatted_number; 

        if(strlen($title) > 40){
            $title = substr($title, 0, 35) . "...";
        }
        if(strlen($title) < 40){
            $title = substr($title, 0, 35) . "                ";
        }

        $parcel = number_format((float)$parcel, 2, '.', '');
        $parcel = str_replace(".", ",", str_replace(",", ".", $parcel));

        $discount_text = '';

        return ('
<div class="rounded-md drop-shadow-lg w-[12rem] bg-[#FDFDFD]">
    <a href="/anuncio?id=' . $id . '">
        <img src="../Assets/imgs/products/' . $img . '" alt="aaaaaa" class="w-full h-44 rounded-t-md" title="aaaaa" />
        <div class="p-2 h-32 max-sm:w-1">
            <h1 class="text-[0.80rem] font-medium">' . $title . '</h1>
            <div class="container"><h3 class="text-gray-500 text-[0.8rem] pt-5 mb-[-0.4rem]"><span class="line-through">de: R$' . $price . '</span> por:</h3>
                <h2><span class="text-[#42A000] pb-[-2rem] font-bold">' . $formatted_currency . ' <span class="text-xs align-middle">à vista</span></span></h2>
                <h4 class="text-gray-600 text-[0.8rem] mt-[-0.5rem]">96x de R$' . $parcel . ' sem juros</h4>
            </div>
        </div>
        <a href="/anuncio?id=' . $id . '"><button class="bg-[#00A000] text-sm rounded-sm font-medium text-white w-full h-10 rounded-b-md transition-colors duration-300 ease-in-out hover:bg-[#00B000] hover:text-[#101010]"> Adicionar ao carrinho</button></a>
    </a>
</div>
');
    }
}
