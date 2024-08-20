<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Produto;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    public function index()
    {
        $msgSucesso = session('msg.success');
        $msgErro = session('msg.error');

        $notas = Nota::with('produtos')->orderBy('numero', 'asc')->get();
        $produtos = Produto::all();

        return view ('notas-fiscais.index')
            ->with('msgSucesso', $msgSucesso)
            ->with('msgErro', $msgErro)
            ->with('produtos', $produtos)
            ->with('notas', $notas);
    }
    
    public function store(Request $request)
    {   
        $notas = Nota::create($request->only('numero', 'data', 'chave_acesso', 'descricao'));

        $totalAmount = 0;

        if ($request->has('produtos')) {
            foreach ($request->input('produtos') as $produto) {
                if (isset($produto['id']) && isset($produto['quantidade'])) { 
                    $notas->produtos()->attach($produto['id'], ['quantidade' => $produto['quantidade']]);
                    $totalAmount += $produto['quantidade'] * $produto['preco_compra'];
                }   
            }
        }

        $notas->update(['valor_total' => $totalAmount]);

        return to_route('notas.index')
            ->with('msg.success', "Nota fiscal '{$notas->numero}' cadastrada com sucesso no sistema!");
    }

    public function show($id)
    {
        $nota = Nota::findOrFail($id);
        $produtos = $nota->produtos()->orderBy('quantidade', 'desc')->get();

        return view ('notas-fiscais.show')
            ->with('produtos', $produtos)
            ->with('nota', $nota);
    }

    public function edit(Nota $nota)
    {
        return view ('notas-fiscais.edit')
            ->with('nota', $nota);
    }
    
    public function update(Request $request, Nota $nota)
    {
        $nota->fill($request->all());
        $nota->save();

        return to_route('notas.index')
            ->with('msg.success', "Nota fiscal '{$nota->numero}' atualizada com sucesso no sistema!");
    }
    
    public function destroy(Nota $nota)
    {        
        $nota->delete();

        return to_route('notas.index')
            ->with('msg.success', "Nota fiscal '{$nota->numero}' excluída com sucesso no sistema!");
    }
}
