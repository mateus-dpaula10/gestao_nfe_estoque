<x-layout title="Cadastrar nota fiscal">
    @isset($msgSucesso)
        <p class="alert alert-success">{{ $msgSucesso }}</p>
    @endisset
    @isset($msgErro)
        <p class="alert alert-danger">{{ $msgErro }}</p>
    @endisset

    <form action="{{ route('notas.store') }}" method="POST">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="numero" class="form-label">Número:</label>
                <input required oninput="apenasNumeros(this)" type="text" class="form-control" name="numero" id="numero">
            </div>

            <div class="form-group mt-3">
                <label for="data" class="form-label">Data de emissão:</label>
                <input required type="date" class="form-control" name="data" id="data">
            </div>

            <div class="form-group mt-3">
                <label for="chave_acesso" class="form-label">Chave de acesso:</label>
                <input oninput="apenasNumeros(this)" type="text" class="form-control" name="chave_acesso" id="chave_acesso">
            </div>

            <div class="form-group mt-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea name="descricao" id="descricao" class="form-control" rows="5"></textarea>
            </div>

            <h2 class="mt-5 mb-3">Produtos</h2>
            @foreach ($produtos as $produto)
                <div class="form-check mt-3">
                    <input id="input-{{ $loop->index }}" class="form-check-input" type="checkbox" name="produtos[{{ $loop->index }}][id]" value="{{ $produto->id }}">
                    <label for="input-{{ $loop->index }}" class="form-check-label">Sku: {{ $produto->sku }} - Nome: {{ $produto->nome }}</label>
                    <input class="form-control" type="number" name="produtos[{{ $loop->index }}][quantidade]" min="1" step="1" placeholder="Quantidade">
                    <input hidden class="form-control" type="text" value="{{ $produto->preco_compra }}" name="produtos[{{ $loop->index }}][preco_compra]">
                </div>
            @endforeach

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </form>

    <div class="cadastrados mt-5">
        <h2 class="mb-3">Notas fiscais cadastradas no sistema</h2>

        <div class="table-responsive">
            <table class="table align-middle text-center">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Número</th>
                    <th scope="col">Data</th>
                    <th scope="col">Chave de acesso</th>
                    <th scope="col">Valor total</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                    @if(count($notas) > 0)
                        @foreach ($notas as $nota)
                            <tr>
                                <th scope="row">{{ $nota->id }}</th>
                                <td>{{ $nota->numero }}</td>
                                <td>{{ \Carbon\Carbon::parse($nota->data)->format('d/m/Y') }}</td>
                                <td id="chave_acesso">{{ $nota->chave_acesso }}</td>
                                <td>R$ {{ number_format($nota->valor_total, 2, ',', '.') }}</td>
                                <td class="d-flex align-items-center">
                                    <a href="{{ route('notas.show', $nota->id) }}">
                                        <i class="fa-solid fa-eye me-2" title="Visualizar nota fiscal '{{ $nota->numero }}"></i>
                                    </a>

                                    <a href="{{ route('notas.edit', $nota->id) }}">
                                        <i class="fa-solid fa-pen-to-square" title="Editar nota fiscal '{{ $nota->numero }}"></i>
                                    </a>

                                    <form action="{{ route('notas.destroy', $nota->id )}}" method="POST">
                                        @csrf

                                        @method('DELETE')
                                        <button type="submit">
                                            <i class="fa-solid fa-trash" title="Excluir nota fiscal '{{ $nota->numero }}"></i>                                    
                                        </button>
                                    </form>                                
                                </td>
                            </tr>
                        @endforeach  
                    @else
                        <td colspan="5" class="alert-alert-warning">Nenhuma nota fiscal cadastrada no sistema!</td>    
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-layout>