document.addEventListener('DOMContentLoaded', function () {
    const modalCriar = document.getElementById('modalCriarTransportadora');
    if (modalCriar) {
        modalCriar.addEventListener('hidden.bs.modal', () => {
            const form = modalCriar.querySelector('form');
            if (form) {
                form.reset();
            }
        });
    }
});
