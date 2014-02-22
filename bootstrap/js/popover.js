$(function(){

	$('[data-toggle="popover"]').popover({
		trigger: 'click',
		'placement': 'bottom',
		'content': 
		'<a href="javascript:;" class="btn btn-sm btn-danger simpleCart_empty">Empty Cart</a>&nbsp;<a href="viewcart.php" class="btn btn-sm btn-info">View Cart</a>&nbsp;<a href="javascript:;" class="btn btn-sm btn-success simpleCart_checkout">Checkout</a>',
		'html': 'true'
	});
	
});
