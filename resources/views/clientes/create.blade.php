<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('clientes.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Cadastrar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body row g-3">
        @foreach([
          'codigointerno' => 'Código Interno',
          'razaosocial' => 'Razão Social',
          'fantasia' => 'Fantasia',
          'cpf' => 'CPF',
          'rg' => 'RG',
          'cnpj' => 'CNPJ',
          'inscrestadual' => 'Inscrição Estadual',
          'cep' => 'CEP',
          'endereco' => 'Endereço',
          'numero' => 'Número',
          'bairro' => 'Bairro',
          'cidade' => 'Cidade',
          'estado' => 'Estado',
          'pais' => 'País',
          'complemento' => 'Complemento',
          'telefone' => 'Telefone',
        ] as $field => $label)
          <div class="col-md-6">
            <label>{{ $label }}</label>
            <input type="text" name="{{ $field }}" class="form-control">
          </div>
        @endforeach

        <div class="col-md-6">
          <label>Pessoa</label>
          <select name="pessoa" class="form-control">
            <option value="F">Física</option>
            <option value="J">Jurídica</option>
          </select>
        </div>

        <div class="col-md-6">
          <label>Ativo</label>
          <select name="ativo" class="form-control">
            <option value="Sim">Sim</option>
            <option value="Não">Não</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Salvar</button>
      </div>
    </form>
  </div>
</div>
