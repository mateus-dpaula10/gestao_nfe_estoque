<x-layout title="Editar nota fiscal '{{ $nota->numero}}'">
    <form action="{{ route('notas.update', $nota->id) }}" method="POST">
        @csrf

        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label for="numero" class="form-label">Número:</label>
                <input value="{{ $nota->numero }}" style="background-color: #cecece40" readonly required oninput="apenasNumeros(this)" type="text" class="form-control" name="numero" id="numero">
            </div>

            <div class="form-group mt-3">
                <label for="data" class="form-label">Data de emissão:</label>
                <input value="{{ $nota->data }}" required type="date" class="form-control" name="data" id="data">
            </div>

            <div class="form-group mt-3">
                <label for="chave_acesso" class="form-label">Chave de acesso:</label>
                <input value="{{ $nota->chave_acesso }}" oninput="apenasNumeros(this)" type="text" class="form-control" name="chave_acesso" id="chave_acesso">
            </div>

            <div class="form-group mt-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea name="descricao" id="descricao" class="form-control" rows="5">{{ $nota->descricao }}</textarea>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </div>
    </form>
</x-layout>