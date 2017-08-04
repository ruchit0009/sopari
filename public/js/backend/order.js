/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    var productIndex = $('.product-list').find('.form-group').length;

    for (i = 0; i < productIndex; i++) {
        $('.product-list').find('.form-group').find('.product_id' + i).attr('name', 'product[' + i + '][product_id]');
        $('.product-list').find('.form-group').find('.qty' + i).attr('name', 'product[' + i + '][qty]');
        $('.product-list').find('.form-group').find('.price' + i).attr('name', 'product[' + i + '][price]');
        $('.product-list').find('.form-group').find('.id' + i).attr('name', 'product[' + i + '][id]');
        var pval = $('.product-list').find('.form-group').find('.product_id' + i).val();
        $(".product_id" + i + " option:contains('Product')").remove();
        if( pval == ''){
             $(".product_id" + i).prepend("<option value='' selected='selected' >Select Product</option>");
        } else {
             $(".product_id" + i).prepend("<option value='' >Select Product</option>");
        }
       
        
    }
    $('.product-clone').hide();
    $('body').on('click', '.avail_plus', function () {
        var productClone = $('.product-clone').clone();
        productClone.find('#product_id').attr('name', 'product[' + productIndex + '][product_id]');
        productClone.find('#qty').attr('name', 'product[' + productIndex + '][qty]');
        productClone.find('#price').attr('name', 'product[' + productIndex + '][price]');
        productClone.find('#poid').attr('name', 'product[' + productIndex + '][id]');

        $('.product-list').append(productClone);
        $('.product-list').find('.product-clone').css('display', 'block');
        $('.product-list').find('.product-clone').find('#product_id').addClass('product_id' + productIndex);
        $('.product-list').find('.product-clone').find('#qty').addClass('qty' + productIndex);
        $('.product-list').find('.product-clone').find('#price').addClass('price' + productIndex);
        $('.product-list').find('.product-clone').find('#poid').addClass('id' + productIndex);
        $(".product_id" + productIndex + " option:contains('Product')").remove();
        $(".product_id" + productIndex).prepend("<option value='' selected='selected'>Select Product</option>");
//     
        $('.product-list').find('.product-clone').removeClass('product-clone');
        productIndex += Number(1);

    });
    $('body').on('click', '.avail_minus', function () {
        $(this).parents('.form-group').remove();
    });
    $('body').on('change', '.prod', function () {
        var productVal;
        if($(this).val() !== ''){
        for (i = 0; i < productIndex; i++) {
            if ($(this).attr('name') !== $('.product-list').find('.form-group').find('.product_id' + i).attr('name')) {
                if ($('.product-list').find('.form-group').find('.product_id' + i).val() == $(this).val()) {
                   $(this).val('');
                    alert('this product already selected.')

                }
            }

        }
    }

    });

});


 