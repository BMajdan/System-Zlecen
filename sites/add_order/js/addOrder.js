var addOrder = {
	init: function(){

		$(".getAddress").on("click", function(){
			var count = ($(this).attr("id").split("@"))[1]
			var address = (document.getElementById("address@" + count).value).split("@")
			var flat = address[1].split("/")

			$("#street").attr("value", address[0])
			$("#house").attr("value", flat[0])
			$("#flat").attr("value", flat[1])
		})

		checkNumber();

		$("#backButton").on("click", function(){
			window.location.href= "../../index.php";
		})

		function checkNumber(){
			var phoneNumber = document.getElementById("phoneNumber")
			phoneNumber.addEventListener("keydown", function(keyEvent){
				//Disable Function Button
				if ((keyEvent.keyCode < 48 || keyEvent.keyCode > 57) && (keyEvent.keyCode < 96 || keyEvent.keyCode > 105)
					&& (keyEvent.keyCode != 116 && keyEvent.keyCode != 8
						&& keyEvent.keyCode != 13)) {
        			keyEvent.preventDefault();
    			}
    			
			}, false);

			document.getElementById("changeNumber").addEventListener("click", function(){
				var identType = document.getElementById("identType");
				if(identType.value == "O"){
					window.location.href= "index.php?tel=O" + phoneNumber.value
				}else{
					window.location.href= "index.php?tel=Q" + phoneNumber.value
				}
				
			})

			$('input[type=radio][name=orderType]').change(function() {
        		if (this.value == 'O') {
            		window.location.href= "index.php?tel=O" + phoneNumber.value
        		}
        		else if (this.value == 'Q') {
            		window.location.href= "index.php?tel=Q" + phoneNumber.value
        		}
    		});
		}
	}
}