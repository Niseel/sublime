// //ajax Product

function getProduct(numpage, i, limit, id){
	$.ajax({
		type : "POST",
		url: "../sublime/action/getProducts.php",
		data: { num : numpage, id : id, i : i, limit : limit}
	}).done(function(data){
		$(".product_grid").html(data);
		document.querySelectorAll('li.pagination-item.is-active')[0].className = "pagination-item";
		document.querySelectorAll('li.pagination-item')[i-1].className = "pagination-item is-active";
	});
}
//get product for search by name
function getProduct_ver2(numpage, i, limit, id, name){
	$.ajax({
		type : "POST",
		url: "../sublime/action/getProduct_forname.php",
		data: { num : numpage, id : id, i : i, limit : limit, name : name}
	}).done(function(data){
		$(".product_grid").html(data);
		document.querySelectorAll('li.pagination-item.is-active')[0].className = "pagination-item";
		document.querySelectorAll('li.pagination-item')[i-1].className = "pagination-item is-active";
	});
}
//dead
function getProduct_ver3(i, start, limit){
	$.ajax({
		type : "POST",
		url: "../sublime/action/getProducts_verSes_index.php",
		data: { i : i , num : start, limit : limit }
	}).done(function(data){
		$(".product_grid").html(data);
		document.querySelectorAll('li.pagination-item.is-active')[0].className = "pagination-item";
		document.querySelectorAll('li.pagination-item')[i-1].className = "pagination-item is-active";
	});
}
//dead fro cate
function getProduct_ver4(i, start, limit){
	$.ajax({
		type : "POST",
		url: "../sublime/action/getProducts_verSes_cate.php",
		data: { i : i, num : start, limit : limit }
	}).done(function(data){
		$(".product_grid").html(data);
		document.querySelectorAll('li.pagination-item.is-active')[0].className = "pagination-item";
		document.querySelectorAll('li.pagination-item')[i-1].className = "pagination-item is-active";
	});
}
//Ajax for advaned search in category page // not yet
function adSearch($id){
	const x = $('#sort_by').val();
	const y = $('#brand_by').val();
	const a = document.getElementsByName('price_start')[0].value;
	const b = document.getElementsByName('price_end')[0].value;

	// alert(x);
	// alert(y);
	// alert(a);
	// alert(b);
	$.ajax({
		type : "POST",
		url: "../sublime/action/getProducts_adSearch.php",
		data: { category : $id, sortBy : x, brand : y, start : a, end : b}
	}).done(function(data){
		$("#for_load").html(data);
	});
}

//Ajax for advaned search in index page
function adSearch_noAgru(){
	const x = $('#sort_by').val();
	const y = $('#brand_by').val();
	const z = $('#category_by').val();
	const a = document.getElementsByName('price_start')[0].value;
	const b = document.getElementsByName('price_end')[0].value;

	 // alert(x);
	 // alert(y);
	 // alert(z);
	 // alert(a);
	 // alert(b);
	$.ajax({
		type : "POST",
		url: "../sublime/action/getProducts_adSearch_index.php",
		data: { sortBy : x, brand : y, category : z, start : a, end : b }
	}).done(function(data){
		$("#con_load").html(data);
		//alert(data);
	});
}

//search by name
$(document).ready(function(){
	$('#search_box').keypress(function(e){
		var keycode = (e.keycode ? e.keycode : e.which);
		if(keycode == '13'){
			$content_search = $(this).val();
			$.ajax({
				type : "POST",
				url : "../sublime/action/search_byname.php",
				data : { content_search : $content_search },
				success : function(data) {
			        $("#con_load").html(data);
			        //alert(data);
			    },
			    error: function(jqXHR, textStatus, errorThrown) {
				    // When AJAX call has failed
				    alert('AJAX call failed.');
				    alert(textStatus + ': ' + errorThrown);
				    console.log(errorThrown)
				}
			});
		}
	});
});

$(document).ready(function(){
    $('.updatecart').click(function(e){
        e.preventDefault();
        $qty = $(this).parents('.cart_item').find('#ai').val();
        $key = $(this).attr('data-key');

    	$.ajax({
			type : "POST",
			url : "../sublime/action/update_cart.php",
			data : { qty : $qty, key : $key },
			success : function(data) {
		        if(data == 1){
					alert('Update cart successful');
					location.href='cart.php';
				}else{
					alert('Only ' + data +' products left in stock');
					location.href='cart.php';
				}
				//alert(data);
		    },
		    error: function(jqXHR, textStatus, errorThrown) {
			    // When AJAX call has failed
			    alert('AJAX call failed.');
			    alert(textStatus + ': ' + errorThrown);
			    console.log(errorThrown)
			}
		});
		return false;
    });
});

$(document).ready(function(){
    $('.clear_cart_button').click(function(e){
        e.preventDefault();
        $cart_length = $(this).attr('data-key');
        for (var i = 0; i < $cart_length; i++) {
        	$k = document.getElementsByClassName('updatecart')[i];
			$key = ($k.dataset.key);
			$.ajax({
				type : "POST",
				url : "../sublime/action/clear_cart.php",
				data : { key : $key },
				success : function(data) {
			        if(data == 1){
			        	$nofi = 'Clear cart successful';
			        	//alert('Clear cart successful');
					}
			    },
			    error: function(jqXHR, textStatus, errorThrown) {
				    // When AJAX call has failed
				    $nofi = 'Clear cart fail';
				    // alert('AJAX call failed.');
				    // alert(textStatus + ': ' + errorThrown);
				    // console.log(errorThrown)
				}
			});
        }
        alert('Clear cart successful');
		location.href='cart.php';
		return false;
    });
});

$(document).ready(function(){
    $('.update_cart_button').click(function(e){
        e.preventDefault();
        $cart_length = $(this).attr('data-key');
        for (var i = 0; i < $cart_length; i++) {
        	$qty = document.getElementsByClassName('cart_number')[i].value;
        	$k = document.getElementsByClassName('updatecart')[i];
			$key = ($k.dataset.key);
			$.ajax({
				type : "POST",
				url : "../sublime/action/update_cart.php",
				data : { qty : $qty, key : $key },
				success : function(data) {
			        if(data == 1){
			        	$nofi = 'Update cart successful';
					}
			    },
			    error: function(jqXHR, textStatus, errorThrown) {
				    // When AJAX call has failed
				    $nofi = 'Update cart fail';
				    // alert('AJAX call failed.');
				    // alert(textStatus + ': ' + errorThrown);
				    // console.log(errorThrown)
				}
			});
        }
  	//       $qty = document.getElementsByClassName('cart_number')[0].value;
  	//       $k = document.getElementsByClassName('updatecart')[0];
	// 		 $key = ($k.dataset.key);
  	//       alert($qty + ' ' + $key);

		alert('Update cart successful');
		location.href='cart.php';
		return false;
    });
});

$(document).ready(function(){
    $('.cart_button').click(function(e){
        e.preventDefault();
        $qty = document.getElementById('ai').value;
        $key = $(this).attr('data-key');
        //alert($qty);
        //alert($key);
    	$.ajax({
			type : "POST",
			url : "../sublime/action/add_cart_product.php",
			data : { qty : $qty, key : $key },
			success : function(data) {
		        if(data == 1){
					alert('Update cart successful');
					//location.href='cart.php';
				}else{
					alert('Only ' + data +' products left in stock');
					//location.href='cart.php';
				}
				//alert(data);

		    },
		    error: function(jqXHR, textStatus, errorThrown) {
			    // When AJAX call has failed
			    alert('AJAX call failed.');
			    alert(textStatus + ': ' + errorThrown);
			    console.log(errorThrown)
			}
		});
		return false;
    });
});
//
