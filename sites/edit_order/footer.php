	</form>
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
		</script>
	</body>
</html>
