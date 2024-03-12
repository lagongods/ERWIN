<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeGenderModal', () => {
        $('#genderModal').modal('hide');
    });

    window.livewire.on('openGenderModal', () => {
        $('#genderModal').modal('show');
    });
</script>
