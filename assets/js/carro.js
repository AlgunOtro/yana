var data = {"total":0,"rows":[]};
var totalCost = 0;
var totalProd = 0;

$(function(){
	$('#cartcontent').datagrid({
		singleSelect:true,
		onLoadSuccess:function(data){
			console.log(data);
		}
	});
	$('.item').draggable({
		revert:true,
		proxy:'clone',
		onStartDrag:function(){
			$(this).draggable('options').cursor = 'not-allowed';
			$(this).draggable('proxy').css('z-index',10);
		},
		onStopDrag:function(){
			$(this).draggable('options').cursor='move';
		}
	});
	$('.cart').droppable({
		onDragEnter:function(e,source){
			$(source).draggable('options').cursor='auto';
		},
		onDragLeave:function(e,source){
			$(source).draggable('options').cursor='not-allowed';
		},
		onDrop:function(e,source){
			var id = $(source).find('p:eq(0)').html();
			var name = $(source).find('p:eq(1)').html();
			var price = $(source).find('p:eq(2)').html();
			addProduct(id,name, parseFloat(price.split('$')[1]));
		}
	});
});

function addProduct(id,name,price){
	function add(){
		for(var i=0; i<data.total; i++){
			var row = data.rows[i];
			if (row.name == name){
				row.quantity += 1;
				return;
			}
		}
		data.total += 1;
		data.rows.push({
			id:id,
			name:name,
			quantity:1,
			price:price
		});
	}
	add();
	totalCost += price;
	$('#cartcontent').datagrid('loadData', data);
	/*Esta pasando por POST todos los productos que se van agregando al carro*/
	$.ajax({
		type: 'POST',
		url: 'agregar_producto',
		data: {data: JSON.stringify(data.rows)},
		dataType: 'json'
	})
	.done( function( d ) {
    	console.log('done');
	    console.log(d);
	})
	.fail( function( d ) {
    	console.log('fail');
	    console.log(d);
	});
	$('div.cart .total').html('Total: $'+totalCost);
}

function comprar() {
	
	totalProd = 0;
	for(var i=0; i<data.total; i++){
		var row = data.rows[i];
		totalProd += row.quantity;
	}
	$.messager.confirm('Confirmación', 'Comprar ' + totalProd + ' productos a $' + totalCost + '?', function(r){
	if (r){
		alert('HACKED!!');
	}
});
}