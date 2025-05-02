<!-- Modal Editar Fornecedor -->
<div class="modal fade" id="editarFornecedorModal-{{ $fornecedor->id }}" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form method="POST" action="{{ route('fornecedores.update', $fornecedor->id) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Fornecedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body container-fluid">
                    <div class="row">
                        @php
                            $camposObrigatorios = ['codigointerno', 'razaosocial', 'cnpj'];
                            $campos = [
                                'codigointerno' => 'Código Interno',
                                'razaosocial' => 'Razão Social',
                                'fantasia' => 'Nome Fantasia',
                                'pessoa' => 'Pessoa (F/J)',
                                'cnpj' => 'CNPJ',
                                'inscrestadual' => 'Inscrição Estadual',
                                'cpf' => 'CPF',
                                'rg' => 'RG',
                                'tipoentidade' => 'Tipo Entidade',
                                'inscricaosuframa' => 'Inscrição SUFRAMA',
                                'cnpjdepositante' => 'CNPJ Depositante',
                                'cep' => 'CEP',
                                'endereco' => 'Endereço',
                                'numero' => 'Número',
                                'bairro' => 'Bairro',
                                'cidade' => 'Cidade',
                                'estado' => 'Estado',
                                'pais' => 'País',
                                'complemento' => 'Complemento',
                                'telefone' => 'Telefone',
                                'codendereco' => 'Código Endereço',
                                'codigosorter' => 'Código Sorter',
                                'sigla' => 'Sigla',
                                'endentrega' => 'Endereço de Entrega',
                                'endcobranca' => 'Endereço de Cobrança',
                                'controleshelflife' => 'Controle Shelf Life',
                                'valorshelflife' => 'Valor Shelf Life',
                                'agente' => 'Agente'
                            ];
                        @endphp

                        @foreach ($campos as $campo => $label)
                        <div class="col-md-4 mb-2">
                            <label class="form-label text-start d-block">{{ $label }}{{ in_array($campo, $camposObrigatorios) ? ' *' : '' }}</label>
                            <input type="{{ $campo === 'valorshelflife' ? 'number' : 'text' }}"
                                   name="{{ $campo }}"
                                   class="form-control"
                                   value="{{ $fornecedor->$campo ?? '' }}"
                                   {{ in_array($campo, $camposObrigatorios) ? 'required' : '' }}>
                        </div>
                        @endforeach

                        <div class="col-md-4 mb-2">
                            <label class="form-label text-start d-block">Ativo</label>
                            <select name="ativo" class="form-control">
                                <option value="Sim" {{ $fornecedor->ativo === 'Sim' ? 'selected' : '' }}>Sim</option>
                                <option value="Não" {{ $fornecedor->ativo === 'Não' ? 'selected' : '' }}>Não</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>
