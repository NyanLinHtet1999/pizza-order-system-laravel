$(document).ready(function(){
    $('.btn-plus').click(function(){

        $parentNode = $(this).parents('tr');
        $price = Number($($parentNode).find('#price').text().replace('Ks',''));
        $qty = Number($($parentNode).find('#qty').val());
        $total = $price * $qty;
        // console.log($price);
        $($parentNode).find('#total').html($total+"Ks");
        summary();
    });
    $('.btn-minus').click(function(){

        $parentNode = $(this).parents('tr');
        $price = Number($($parentNode).find('#price').text().replace('Ks',''));
        $qty = Number($($parentNode).find('#qty').val());
        $total = $price * $qty;
        // console.log($price);
        $($parentNode).find('#total').html($total+"Ks");
        summary();
    });
    function summary(){
        $subTotal=0;
        $('#pizzaData tr').each(function(index,row) {
            $subTotal += Number($(row).find('#total').text().replace("Ks",'')) ;
        });
        $("#subTotal").html($subTotal+'Ks');
        $('#final').html($subTotal+3000+'Ks')
    };
});
