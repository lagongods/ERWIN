<script>
	document.addEventListener("DOMContentLoaded", () => {
		Livewire.hook('message.processed', (component) => {
			setTimeout(function() {
				$('#alert').fadeOut('fast');
			}, 5000);
		});
	});

	window.livewire.on('closeCustomerModal', () => {
		$('#customerModal').modal('hide');
	});

	window.livewire.on('openCustomerModal', () => {
		$('#customerModal').modal('show');
	});
</script>
