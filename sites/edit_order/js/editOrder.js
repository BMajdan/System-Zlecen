var editOrder = {
	init: function(){

		$("#editButton").on("click", function(){
			var data = {
				orderKNumber: $("#orderKNumber").val(),
				lastVersion: document.getElementsByTagName("option")[0].value,
				orderType: $("#orderType").val(),
				flat: $("#flat").val(),
				street: $("#street").val(), 
				house: $("#house").val(),
				recdate: $("#recdate").val(),
				rectime: $("#rectime").val(),
				teldate: $("#teldate").val(),
				teltime: $("#teltime").val(),
				phoneNumber: $("#phoneNumber").val(),
				customerID: $("#customerID").val(),
				description: $("#description").val(),
				status: $("#changeStatus").val(),
				worker: $("#changeWorker").val(),
				typeEdit: $("#changeWorker").val(),
				hiddencomment: $("#hiddencomment").val(),
				hardBrand: $("#hardBrand").val(),
				hardModel: $("#hardModel").val(),
				hardSN: $("#hardSN").val(),
				hardWarning: $("#hardWarning").val(),
				hardDown: $("#hardDown").val()
			}


			$.ajax({
            	type:"POST",
            	url:"../../components/editOrder.php",
            	data: {dane: data},

                success:function() {
                	console.log()
                    window.location.href= "../see_order/index.php?tel=" + $("#identVersion").val() + "_" + (parseInt(document.getElementsByTagName("option")[0].value) + 1)
                }
        	});
		});

		$("#backButton").on("click", function(){
			window.location.href= "../see_order/index.php?tel=" + $("#identVersion").val() + "_" + (parseInt(document.getElementsByTagName("option")[0].value))
		})

		$("#orderVersion").on("input", function(){
			window.location.href= "index.php?tel=" + $("#identVersion").val() + "_" + $(this).val();
		})

	}
}