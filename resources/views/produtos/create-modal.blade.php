<!-- Modal de Criação de Produto -->
<div class="modal fade" id="modalCriarProduto" tabindex="-1" aria-labelledby="modalCriarProdutoLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form method="POST" action="{{ route('produtos.store') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6 class="fw-bold mb-2">Informações do Produto</h6>
                <div class="row">
                    @php $camposProduto = [
                        'codigointerno' => 'Código Interno',
                        'codreferencia' => 'Código de Referência',
                        'descr' => 'Descrição',
                        'tipoprod' => 'Tipo de Produto',
                        'subtipoprod' => 'Subtipo de Produto',
                        'marca' => 'Marca',
                        'submarca' => 'Submarca',
                        'ncm' => 'NCM',
                        'codtipoprod' => 'Código Tipo Produto',
                        'codigoprodanvisa' => 'Código Produto ANVISA',
                        'cnpjfamilia' => 'CNPJ Família',
                        'prazovalidade' => 'Prazo de Validade (dias)',
                        'prazocomercializacao' => 'Prazo de Comercialização (dias)',
                        'prazocritico' => 'Prazo Crítico (dias)',
                        'precomax' => 'Preço Máximo',
                        'estoque' => 'Estoque'
                    ]; @endphp

                    @foreach ($camposProduto as $campo => $label)
                    <div class="col-md-4 mb-2">
                        <label class="form-label">{{ $label }}</label>
                        <input type="{{ $campo === 'precomax' ? 'number' : 'text' }}" step="0.01" name="{{ $campo }}" class="form-control">
                    </div>
                    @endforeach

                    <div class="col-md-4 mb-2">
                        <label class="form-label">Manufaturado</label>
                        <select name="manufaturado" class="form-control">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Sazonal</label>
                        <select name="sazonal" class="form-control">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Ativo</label>
                        <select name="ativo" class="form-control">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                </div>

                <hr class="my-3">

                <h6 class="fw-bold mb-2">Informações da Embalagem</h6>
                <div class="row">
                    @php $camposEmbalagem = [
                        'descrereduzida' => 'Descrição Reduzida',
                        'descr' => 'Descrição',
                        'barra' => 'Código de Barras',
                        'apresentacao' => 'Apresentação',
                        'fatorconv' => 'Fator de Conversão',
                        'altura' => 'Altura',
                        'largura' => 'Largura',
                        'comprimento' => 'Comprimento',
                        'unidadevenda' => 'Unidade de Venda',
                        'unidadecompra' => 'Unidade de Compra',
                        'lastro' => 'Lastro',
                        'qtdecamada' => 'Quantidade por Camada',
                        'pesobruto' => 'Peso Bruto',
                        'pesoliquido' => 'Peso Líquido',
                        'empmax' => 'Empilhamento Máximo',
                        'seqemb' => 'Sequência Embalagem',
                        'tipoembalagem' => 'Tipo de Embalagem',
                        'descrreduzido2' => 'Descrição Reduzida 2',
                        'cnpjdepositante' => 'CNPJ Depositante',
                        'inscrestadualdep' => 'IE Depositante',
                    ]; @endphp

                    @foreach ($camposEmbalagem as $campo => $label)
                    <div class="col-md-4 mb-2">
                        <label class="form-label">{{ $label }}</label>
                        <input type="text" name="{{ $campo }}" class="form-control">
                    </div>
                    @endforeach

                    <div class="col-md-4 mb-2">
                        <label class="form-label">Caixa Fechada</label>
                        <select name="caixafechada" class="form-control">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Controle de Estoque</label>
                        <select name="controleestoque" class="form-control">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Salvar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </form>
  </div>
</div>
