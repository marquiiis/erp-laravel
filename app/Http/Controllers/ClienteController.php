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
        $data = $request->all();
        $data['empresa_id'] = auth()->user()->empresa_id;
        $data['user_id'] = auth()->id();
        $data['ativo'] = $request->has('ativo');
        $data['controleshelflife'] = $request->has('controleshelflife');

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
        $cliente = Cliente::where('empresa_id', auth()->user()->empresa_id)->findOrFail($id);

        $data = $request->all();
        $data['ativo'] = $request->has('ativo');
        $data['controleshelflife'] = $request->has('controleshelflife');

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
