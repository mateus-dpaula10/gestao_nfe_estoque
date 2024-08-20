<x-layout title="Nota fiscal '{{ $nota->numero }}'">
    <style>
        .produto-zerado th {
            background-color: #f8d7da
        }
        .produto-zerado td {
            background-color: #f8d7da
        }
    </style>

    <h3>Produtos da nota fiscal</h3>

    <div class="table-responsive mt-3">
        <table class="table align-middle text-center">
            <thead>
                <tr>
                    <th scope="col">Sku</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço compra</th>
                    <th scope="col">Preço venda</th>
                    <th scope="col">Quantidade</th>
                </tr>
                </thead>

                <tbody>
                    @foreach ($produtos as $produto)
                        <tr class="{{ $produto->pivot->quantidade === 0 ? 'produto-zerado' : '' }}">
                            <th scope="row">{{ $produto->sku }}</th>
                            <td>{{ $produto->nome }}</td>
                            <td>R$ {{ number_format($produto->preco_compra, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                            <td>{{ $produto->pivot->quantidade }}</td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
    </div>    
</x-layout>