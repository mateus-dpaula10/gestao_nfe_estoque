<x-layout title="Cadastrar produto">
    @isset($msgSucesso)
        <p class="alert alert-success">{{ $msgSucesso }}</p>
    @endisset
    @isset($msgErro)
        <p class="alert alert-danger">{{ $msgErro }}</p>
    @endisset

    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="nome" class="form-label">Nome:</label>
                <input required type="text" class="form-control" name="nome" id="nome">
            </div>

            <div class="form-group mt-3">
                <label for="sku" class="form-label">Sku:</label>
                <input oninput="apenasNumeros(this)" required type="text" class="form-control" name="sku" id="sku">
            </div>

            <div class="form-group mt-3">
                <label for="preco_compra" class="form-label">Preço de compra:</label>
                <input oninput="formatCurrency(this)" onblur="formatCurrencyBlur(this)" required type="text" class="form-control" name="preco_compra" id="preco_compra">
            </div>

            <div class="form-group mt-3">
                <label for="preco_venda" class="form-label">Preço de venda:</label>
                <input oninput="formatCurrency(this)" onblur="formatCurrencyBlur(this)" required type="text" class="form-control" name="preco_venda" id="preco_venda">
            </div>

            <div class="form-group mt-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea name="descricao" id="descricao" class="form-control" rows="5"></textarea>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </form>

    <div class="cadastrados mt-5">
        <h2 class="mb-5">Produtos cadastrados no sistema</h2>

        <div class="table-responsive">
            <table class="table align-middle text-center">
                <thead>
                  <tr>
                    <th scope="col">Sku</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço de compra</th>
                    <th scope="col">Preço de venda</th>
                    <th scope="col"></th>
                  </tr>
                </thead>

                <tbody>
                    @if(count($produtos) > 0)
                        @foreach ($produtos as $produto)
                            <tr>
                                <th scope="row">{{ $produto->sku }}</th>
                                <td>{{ $produto->nome }}</td>
                                <td>R$ {{ number_format($produto->preco_compra, 2, ',', '.') }}</td>
                                <td>R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                                <td class="d-flex align-items-center">
                                    <a href="{{ route('produtos.edit', $produto->id) }}">
                                        <i class="fa-solid fa-pen-to-square" title="Editar produto '{{ $produto->sku }} - {{ $produto->nome }}'"></i>
                                    </a>

                                    <form action="{{ route('produtos.destroy', $produto->id )}}" method="POST">
                                        @csrf

                                        @method('DELETE')
                                        <button type="submit">
                                            <i class="fa-solid fa-trash" title="Excluir produto '{{ $produto->sku }} - {{ $produto->nome }}'"></i>                                    
                                        </button>
                                    </form>                                
                                </td>
                            </tr>
                        @endforeach  
                    @else
                        <td colspan="5" class="alert-alert-warning">Nenhum produto cadastrado no sistema!</td>    
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-layout>