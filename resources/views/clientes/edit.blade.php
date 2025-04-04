<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="editForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Código Interno</label>
                        <input type="text" name="codigointerno" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Razão Social</label>
                        <input type="text" name="razaosocial" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Pessoa</label>
                        <select name="pessoa" class="form-select" required>
                            <option value="F">Física</option>
                            <option value="J">Jurídica</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">CPF</label>
                        <input type="text" name="cpf" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">RG</label>
                        <input type="text" name="rg" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">CEP</label>
                        <input type="text" name="cep" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Endereço</label>
                        <input type="text" name="endereco" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Número</label>
                        <input type="text" name="numero" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Complemento</label>
                        <input type="text" name="complemento" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Bairro</label>
                        <input type="text" name="bairro" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Cidade</label>
                        <input type="text" name="cidade" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Estado</label>
                        <input type="text" name="estado" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">País</label>
                        <input type="text" name="pais" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ativo</label>
                        <select name="ativo" class="form-select">
                            <option value="Sim">Sim</option>
                            <option value="Não">Não</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </div>
        </form>
    </div>
</div>
