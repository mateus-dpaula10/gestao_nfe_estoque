<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Produto;
use App\Models\ProdutoSaida;
use Illuminate\Http\Request;

class ProdutoOutputController extends Controller
{
    public function index() 
    {
        $produtos = Produto::all();
        $notas = Nota::with('produtos')->get();
        $outputs = ProdutoSaida::with(['produto', 'nota'])->get();

        $msgSucesso = session('msg.success');
        $msgErro = session('msg.error');

        return view ('nfsaida.index', compact(['produtos', 'notas', 'outputs']))
            ->with('msgSucesso', $msgSucesso)
            ->with('msgErro', $msgErro);
    }

    public function store(Request $request)
    {
        $produto = Produto::find($request->produto_id);
        $nota = Nota::find($request->nota_id);

        $existQtd = $nota->produtos()->where('produto_id', $produto->id)->first()->pivot->quantidade;

        if ($existQtd < $request->quantidade) {
            return redirect()->back()->with('msg.error', "Quantidade do poduto '{$produto->sku} - {$produto->nome}' insuficiente na nota '{$nota->numero}'.");
        }

        ProdutoSaida::create($request->all());

        $nota->produtos()->updateExistingPivot($produto->id, ['quantidade' => $existQtd - $request->quantidade]);

        return redirect()->back()->with('msg.success', "Produto '{$produto->sku} - {$produto->nome}' debitado da nota fiscal '{$nota->numero}' com sucesso.");
    }
}
