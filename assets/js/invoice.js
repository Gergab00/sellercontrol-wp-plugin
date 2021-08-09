//let products = {};
jQuery(function($) {
$(document).ready(function(){
	$(document).on('click', '#checkAll', function() {          	
		$(".itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow', function() {  	
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	let count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() { 
		count++;
		let htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="itemRow" type="checkbox"></td>';          
		htmlRows += '<td><input type="text" list="asinOptions" name="productCode[]" id="productCode_'+count+'" class="form-control" autocomplete="off">';
		htmlRows += '<datalist id="asinOptions">';
		for (let i = 0; i < Object.keys(products).length; i++) {
			let a = Object.keys(products)[i];
			htmlRows+='<option value="'+a+'">';
		}
		htmlRows += '</datalist></td>';
		htmlRows += '<td><input type="text" list="productNameOptions" name="productName[]" id="productName_'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<datalist id="productNameOptions">';
		for (let i = 0; i < Object.values(products).length; i++) {
			let a = Object.values(products)[i];
			htmlRows+='<option value="'+a+'">';
		}
		htmlRows += '</datalist></td>';
		htmlRows += '<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="form-control quantity" autocomplete="off"></td>';   		
		htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" autocomplete="off"></td>';		 
		htmlRows += '<td><input type="number" name="total[]" id="total_'+count+'" class="form-control total" autocomplete="off"></td>';          
		htmlRows += '</tr>';
		$('#invoiceItem').append(htmlRows);
	}); 
	$(document).on('click', '#removeRows', function(){
		$(".itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});		
	$(document).on('blur', "[id^=quantity_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=price_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "#taxRate", function(){		
		calculateTotal();
	});	
	$(document).on('blur', "#amountPaid", function(){
		let amountPaid = $(this).val();
		let totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {
			$('#amountDue').val(totalAftertax);
		}	
	});	
	$(document).on('click', '.deleteInvoice', function(){
		let id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this?")){
			$.ajax({
				url:"action.php",
				method:"POST",
				dataType: "json",
				data:{id:id, action:'delete_invoice'},				
				success:function(response) {
					if(response.status == 1) {
						$('#'+id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});

	$(document).on('focus', "[id^=product]",function(e) {
		let id;
		e.preventDefault();
		id = $(this).attr("id");
		console.log("Focus on id", id);

		if (id.includes("product")) {
			let r = id.slice(-1);
			console.log("Substring: ",r)
			$('#productCode_'+r).change(function (e) {
                e.preventDefault();
                let value = $('#productCode_'+r).val();
                let res = products[value];
                //console.log(res);
                $("#productName_"+r).val(res);

            });
		}
	});
});	


function calculateTotal(){
	let totalAmount = 0; 
	$("[id^='price_']").each(function() {
		let id = $(this).attr('id');
		id = id.replace("price_",'');
		let price = $('#price_'+id).val();
		let quantity  = $('#quantity_'+id).val();
		if(!quantity) {
			quantity = 1;
		}
		let total = price*quantity;
		$('#total_'+id).val(parseFloat(total));
		totalAmount += total;			
	});
	$('#subTotal').val(parseFloat(totalAmount));	
	let taxRate = $("#taxRate").val();
	let subTotal = $('#subTotal').val();	
	if(subTotal) {
		let taxAmount = subTotal*taxRate/100;
		$('#taxAmount').val(taxAmount);
		subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
		$('#totalAftertax').val(subTotal);		
		let amountPaid = $('#amountPaid').val();
		let totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {		
			$('#amountDue').val(subTotal);
		}
	}
}});