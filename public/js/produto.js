document.addEventListener("DOMContentLoaded", function () {
    console.log("JS de Produtos carregado.");

    // Exemplo: foco automático no primeiro campo do modal de criação
    const criarModal = document.getElementById('modalCriarProduto');
    if (criarModal) {
        criarModal.addEventListener('shown.bs.modal', function () {
            const primeiroInput = criarModal.querySelector('input, select, textarea');
            if (primeiroInput) primeiroInput.focus();
        });
    }

    // Exemplo: confirm antes de deletar (caso você queira um adicional)
    const deleteForms = document.querySelectorAll("form[onsubmit]");
    deleteForms.forEach(form => {
        form.addEventListener("submit", function (e) {
            const confirmText = form.getAttribute("onsubmit");
            if (!confirm(confirmText.replace("return ", "").replace(/['"]+/g, ""))) {
                e.preventDefault();
            }
        });
    });
});
