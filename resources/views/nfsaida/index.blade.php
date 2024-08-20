<x-layout title="Saída de produtos por nota">
    @isset($msgSucesso)
        <p class="alert alert-success">{{ $msgSucesso }}</p>
    @endisset

    @isset($msgErro)
        <p class="alert alert-danger">{{ $msgErro }}</p>
    @endisset

    <form action="{{ route('nfsaida.store') }}" method="POST">
        @csrf

        <div class="form-row">
            <input type="text" class="form-control" name="user_id" value="{{ Auth::user()->id }}" readonly hidden>

            <div class="form-group mt-3">
                <label for="nota_id" class="form-label">Nota fiscal:</label>
                <select name="nota_id" id="nota_id" required class="form-select" aria-label="Default select example">
                    <option value="">Selecione uma nota fiscal</option>

                    @foreach ($notas as $nota)
                        <option value="{{ $nota->id }}">{{ $nota->numero }}</option>    
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="produto_id" class="form-label">Produto:</label>
                <select name="produto_id" id="produto_id" required class="form-select" aria-label="Default select example">
                    <option value="">Selecione um produto</option>  
                </select>
            </div>

            <div class="form-group mt-3">
                <label class="form-label" for="quantidade">Quantidade:</label>
                <input class="form-control" type="number" name="quantidade" id="quantidade" min="1" required>
            </div>    

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Debitar</button>
            </div>
        </div>
    </form>

    <div class="cadastrados mt-5">
        <h2 class="mb-5">Notas fiscais de saída cadastradas no sistema</h2>

        <div class="table-responsive">
            <table class="table align-middle text-center">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Nota fiscal</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Data</th>
                    <th scope="col">Valor total</th>
                    <th scope="col">Responsável</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                    @if(count($outputs) > 0)
                        @foreach ($outputs as $output)
                            <tr>
                                <th scope="row">{{ $output->id }}</th>
                                <td>Sku: {{ $output->produto->sku }} - Nome: {{ $output->produto->nome }}</td>
                                <td>{{ $output->nota->numero }}</td>
                                <td>{{ $output->quantidade }}</td>
                                <td>{{ $output->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>{{ number_format($output->produto->preco_compra * $output->quantidade, 2, ',', '.') }}</td>
                                <td>{{ $output->user->name }}</td>
                            </tr>
                        @endforeach  
                    @else
                        <td colspan="7" class="alert-alert-warning">Nenhuma nota fiscal de saída cadastrada no sistema!</td>    
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let notas = @json($notas)

            document.querySelector('#nota_id').addEventListener('change', function() {
                let notaId = this.value
                let produtos = notas.find(nota => nota.id == notaId)?.produtos || []
                
                document.querySelector('#produto_id').innerHTML = ''
                document.querySelector('#produto_id').innerHTML += `
                    <option value="">Selecione um produto</option> 
                `
                produtos.forEach(produto => {
                    document.querySelector('#produto_id').innerHTML += `
                        <option value="${produto.id}">Sku: ${produto.sku} - Nome: ${produto.nome}</option> 
                    `
                })
            })
        })
    </script>
</x-layout>