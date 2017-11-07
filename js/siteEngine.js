var siteEngine = {
	init: function(){

		checkNumber();
		advancedSearch();
		workerSearch();
		getWorker("Bartek")

		function advancedSearch(){
			var advancedSearchSetting = document.getElementById("advancedSearchSetting");
			advancedSearchSetting.addEventListener("input", function(){
				changeInput(advancedSearchSetting.value)
			})
		}

		function workerSearch(){
			var workerSearch = document.getElementById("workerSelect");
			workerSearch.addEventListener("input", function(){
				getWorker(workerSearch.value)
			})
		}

		function getWorker(workerOrder){
			if (window.XMLHttpRequest) {
            	xmlhttp = new XMLHttpRequest();
        	} else {
            	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        	}
        	xmlhttp.onreadystatechange = function() {
            	if (this.readyState == 4 && this.status == 200) {
                	document.getElementById("ifOrderResult").innerHTML = this.responseText;
            	}
        	};
        	xmlhttp.open("GET","components/getWorker.php?workerOrder="+workerOrder,true);
        	xmlhttp.send();
		}

		function changeInput(settingValue){
			$.datetimepicker.setLocale('pl');
			document.getElementById("firstInputD").innerHTML = ""
			document.getElementById("ifAdvResult").innerHTML = ""
			var firstInput = document.createElement("input")
			var firstInputP = document.createElement("p")
			firstInputP.id = "firstInputP"
			firstInput.type = "text"
			firstInput.id = "firstInput"
			firstInput.name = "firstInput"

			switch(settingValue){
				case "address":
					firstInputP.innerHTML = "Adres:"
					firstInput.placeholder = "Kobierzyńska@57/6"
					document.getElementById("firstInputD").appendChild(firstInputP)
					document.getElementById("firstInputD").appendChild(firstInput)
					break;
				case "deliveryDate":
					firstInputP.innerHTML = "Data odebrania:"
					document.getElementById("firstInputD").appendChild(firstInputP)
					document.getElementById("firstInputD").appendChild(firstInput)
					$("#firstInput").datetimepicker({
						timepicker:false,
						format:'d/m/Y',
						formatDate:'d/m/Y',
						theme:'dark'
					});
					break;
				case "telephoneDate":
					firstInputP.innerHTML = "Data telefonu:"
					document.getElementById("firstInputD").appendChild(firstInputP)
					document.getElementById("firstInputD").appendChild(firstInput)

					$("#firstInput").datetimepicker({
						timepicker:false,
						format:'d/m/Y',
						formatDate:'d/m/Y',
						theme:'dark'
					});
					break;
			}
		}

		function checkNumber(){
			var customerNumber = document.getElementById("inputSearchNumber")
			customerNumber.addEventListener("keydown", function(keyEvent){
				//Disable Function Button
				if ((keyEvent.keyCode < 48 || keyEvent.keyCode > 57) && (keyEvent.keyCode < 96 || keyEvent.keyCode > 105)
					&& (keyEvent.keyCode != 116 && keyEvent.keyCode != 8
						&& keyEvent.keyCode != 13)) {
        			keyEvent.preventDefault();
    			}

    			if(!(keyEvent.keyCode < 48 || keyEvent.keyCode > 57) || !(keyEvent.keyCode < 96 || keyEvent.keyCode > 105)){
    				searchNumber((customerNumber.value) + keyEvent.key)
    			}
    			
			}, false);

			customerNumber.addEventListener("input", function(){
    			searchNumber(customerNumber.value)
			}, false);
		}

		function searchNumber(customerNumber){
			if (window.XMLHttpRequest) {
            	xmlhttp = new XMLHttpRequest();
        	} else {
            	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        	}
        	xmlhttp.onreadystatechange = function() {
            	if (this.readyState == 4 && this.status == 200) {
                	document.getElementById("ifNumberResult").innerHTML = this.responseText;
            	}
        	};
        	xmlhttp.open("GET","components/getNumber.php?customerNumber="+customerNumber,true);
        	xmlhttp.send();
		}

		$("#searchButton").on("click", function(){

			console.log()

			switch(document.getElementById("advancedSearchSetting").value){
				case "address": 
					searchAddress();
				break;
				case "deliveryDate":
					searchDeliveryDate();
				break;
				case "telephoneDate":
					searchTelephoneDate();
				break;
			}
		})

		function searchAddress(){
			var data = {
				type: "address",
				address: $("#firstInput").val()
			}

			$.ajax({
            	type:"POST",
            	url:"../../components/advSearch.php",
            	data: {dane: data},

                success:function(data) {
                	document.getElementById("ifAdvResult").innerHTML = data;
                }
        	});
		}

		function searchDeliveryDate(){
			var data = {
				type: "dev",
				deliveryDate: $("#firstInput").val()
			}

			$.ajax({
            	type:"POST",
            	url:"../../components/advSearch.php",
            	data: {dane: data},

                success:function(data) {
                	document.getElementById("ifAdvResult").innerHTML = data;
                }
        	});
		}

		function searchTelephoneDate(){
			var data = {
				type: "tel",
				telephoneDate: $("#firstInput").val()
			}

			$.ajax({
            	type:"POST",
            	url:"../../components/advSearch.php",
            	data: {dane: data},

                success:function(data) {
                	document.getElementById("ifAdvResult").innerHTML = data;
                }
        	});
		}
	}
}