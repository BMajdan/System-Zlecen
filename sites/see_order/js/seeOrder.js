var seeOrder = {
	init: function(){

		$("#editButton").on("click", function(){
			window.location.href = "../edit_order/index.php?tel=" + $("#typeEdit").val();
		});

		$("#backButton").on("click", function(){
			window.location.href = "../add_order/index.php?tel=" + $("#telInfo").val();
		})

		$("#orderVersion").on("input", function(){
			window.location.href= "index.php?tel=" + $("#identVersion").val() + "_" + $(this).val();
		})

		$("#changeStatus").on("input", function(){
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
                    window.location.href= "index.php?tel=" + $("#identVersion").val() + "_" + (parseInt(document.getElementsByTagName("option")[0].value) + 1)
                }
        	});
    	});

		$("#changeWorker").on("input", function(){
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
			console.log($("#hardBrand").val())

			$.ajax({
            	type:"POST",
            	url:"../../components/editOrder.php",
            	data: {dane: data},

                success:function() {
                	console.log()
                    window.location.href= "index.php?tel=" + $("#identVersion").val() + "_" + (parseInt(document.getElementsByTagName("option")[0].value) + 1)
                }
        	});
		}) 

	}
}