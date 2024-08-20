<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $msgSucesso = session('msg.success');
        $msgErro = session('msg.error');
        $produtos = Produto::orderBy('sku', 'asc')->get();
        return view ('produtos.index')
            ->with('msgSucesso', $msgSucesso)
            ->with('msgErro', $msgErro)
            ->with('produtos', $produtos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $exist = Produto::where('sku', $request->sku)->first();
        
        if (!$exist) {
            $produtos = Produto::create($request->all());      
            return to_route('produtos.index')
                ->with('msg.success', "Produto '{$produtos->nome}' cadastrado com sucesso no sistema!");
        }

        return to_route('produtos.index')
            ->with('msg.error', "Produto com Sku '{$request->sku}' já cadastrado no sistema!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        return view ('produtos.edit')
            ->with('produto', $produto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $produto->fill($request->all());
        $produto->save();

        return to_route('produtos.index')
            ->with('msg.success', "Produto '{$produto->nome}' atualizado com sucesso no sistema!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {        
        $produto->delete();

        return to_route('produtos.index')
            ->with('msg.success', "Produto '{$produto->nome}' excluído com sucesso no sistema!");
    }
}
