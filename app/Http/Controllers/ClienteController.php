<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::where('empresa_id', auth()->user()->empresa_id)->get();
        return view('clientes.index', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigointerno' => 'required|string|max:255',
            'razaosocial' => 'required|string|max:255',
            'fantasia' => 'nullable|string|max:255',
            'pessoa' => 'required|in:F,J',
            'cpf' => 'required_if:pessoa,F|nullable|string|max:20',
            'cnpj' => 'required_if:pessoa,J|nullable|string|max:20',
            'rg' => 'nullable|string|max:20',
            'cep' => 'required|string|max:10',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'pais' => 'required|string|max:100',
            'complemento' => 'nullable|string|max:255',
            'telefone' => 'required|string|max:20',
            'ativo' => 'required|in:Sim,Não',
        ]);

        $data = $request->all();
        $data['empresa_id'] = auth()->user()->empresa_id;
        $data['user_id'] = auth()->id();
        $data['controleshelflife'] = $request->has('controleshelflife');
        $data['ativo'] = $request->ativo === 'Sim' ? 1 : 0;

        Cliente::create($data);

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $cliente = Cliente::where('empresa_id', auth()->user()->empresa_id)->findOrFail($id);
        return response()->json($cliente);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigointerno' => 'required|string|max:255',
            'razaosocial' => 'required|string|max:255',
            'fantasia' => 'nullable|string|max:255',
            'pessoa' => 'required|in:F,J',
            'cpf' => 'required_if:pessoa,F|nullable|string|max:20',
            'cnpj' => 'required_if:pessoa,J|nullable|string|max:20',
            'rg' => 'nullable|string|max:20',
            'cep' => 'required|string|max:10',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'pais' => 'required|string|max:100',
            'complemento' => 'nullable|string|max:255',
            'telefone' => 'required|string|max:20',
            'ativo' => 'required|in:Sim,Não',
        ]);

        $cliente = Cliente::where('empresa_id', auth()->user()->empresa_id)->findOrFail($id);

        $data = $request->all();
        $data['controleshelflife'] = $request->has('controleshelflife');
        $data['ativo'] = $request->ativo === 'Sim' ? 1 : 0;

        $cliente->update($data);

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $cliente = Cliente::where('empresa_id', auth()->user()->empresa_id)->findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
