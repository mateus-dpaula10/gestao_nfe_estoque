<x-layout title="Editar produto '{{ $produto->sku}} - {{ $produto->nome }}'">
    <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
        @csrf

        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label for="nome" class="form-label">Nome:</label>
                <input value="{{ $produto->nome }}" required type="text" class="form-control" name="nome" id="nome">
            </div>

            <div class="form-group mt-3">
                <label for="sku" class="form-label">Sku:</label>
                <input style="background-color: #cecece40" readonly value="{{ $produto->sku }}" required type="text" class="form-control" name="sku" id="sku">
            </div>

            <div class="form-group mt-3">
                <label for="preco_compra" class="form-label">Preço de compra:</label>
                <input value="{{ $produto->preco_compra }}" oninput="formatCurrency(this)" onblur="formatCurrencyBlur(this)" required type="text" class="form-control" name="preco_compra" id="preco_compra">
            </div>

            <div class="form-group mt-3">
                <label for="preco_venda" class="form-label">Preço de venda:</label>
                <input value="{{ $produto->preco_venda }}" oninput="formatCurrency(this)" onblur="formatCurrencyBlur(this)" required type="text" class="form-control" name="preco_venda" id="preco_venda">
            </div>

            <div class="form-group mt-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea name="descricao" id="descricao" class="form-control" rows="5">{{ $produto->descricao }}</textarea>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </div>
    </form>
</x-layout>