
		<script src="../../js/bootstrap.js"> </script>
		<script src="../../js/datetimepicker.js"></script>

		<script>
			$.datetimepicker.setLocale('pl');

			$('#teltime').datetimepicker({
				datepicker:false,
				format:'H:i',
				theme: 'dark',
				step:5
			});

			$('#teldate').datetimepicker({
				timepicker:false,
				format:'d/m/Y',
				formatDate:'d/m/Y',
				theme:'dark'
			});

			$('#rectime').datetimepicker({
				datepicker:false,
				format:'H:i',
				theme: 'dark',
				step:5
			});

			$('#recdate').datetimepicker({
				timepicker:false,
				format:'d/m/Y',
				formatDate:'d/m/Y',
				theme:'dark'
			});

			var date = new Date();
			var year = date.getYear();
			var month = date.getMonth();
			var day = date.getDate();

			var hour = date.getHours();
			var min = date.getMinutes();

			$('#teldate').datetimepicker({value: day + '/' + month + '/' + year});
			$('#teltime').datetimepicker({value: hour + ':' + min});
		</script>
	</body>
</html>
