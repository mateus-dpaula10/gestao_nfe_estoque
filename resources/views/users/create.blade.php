<x-layout title="Criar usuário">
    @if (session('success'))
        <div class="alert alert-success">
            <ul class="m-0">
                <li>{{ session('success') }}</li>     
            </ul>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label class="form-label" for="name">Nome:</label>
                <input class="form-control" type="text" name="name" id="name" required>
            </div>

            <div class="form-group mt-3">
                <label class="form-label" for="email">Email:</label>
                <input class="form-control" type="email" name="email" id="email" required>
            </div>

            <div class="form-group mt-3">
                <label class="form-label" for="password">Senha:</label>
                <input class="form-control" type="password" name="password" id="password" required>
            </div>

            <div class="form-group mt-3">
                <label class="form-label" for="password_confirmation">Confirmar Senha:</label>
                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>                
            </div>

            <div class="form-group mt-3">
                <label class="form-label" for="role">Papel:</label>
                <select class="form-select" name="role" id="role" required>
                    <option value="usuario">Usuário</option>
                    <option value="administrador">Administrador</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-primary" type="submit">Criar Usuário</button>
            </div>
        </div>
    </form>

    <div class="cadastrados mt-5">
        <h2 class="mb-3">Usuários cadastrados no sistema</h2>

        <ul class="list-group">
            @foreach ($users as $user)
                <li class="list-group-item d-flex justify-content-between">
                    Nome: {{ $user->name }} - E-mail: {{ $user->email }} - Papel: {{ $user->role }}

                    <div class="d-flex align-items-center">
                        <a href="{{ route('users.edit', $user->id) }}">
                            <i class="fa-solid fa-pen-to-square" title="Editar usuário '{{ $user->name }}"></i>
                        </a>
                        
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
    
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa-solid fa-trash" title="Excluir usuário '{{ $user->name }}"></i>                                    
                            </button>
                        </form>
                    </div>
                </li>                
            @endforeach
        </ul>
    </div>
</x-layout>