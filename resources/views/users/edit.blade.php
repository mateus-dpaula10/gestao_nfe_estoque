<x-layout title="Editar usuário '{{ $user->name }}'">
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

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf

        @method('PUT')
        <div class="form-row">
            <div class="form-group">
                <label class="form-label" for="name">Nome:</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group mt-3">
                <label class="form-label" for="email">Email:</label>
                <input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group mt-3">
                <label class="form-label" for="role">Papel:</label>
                <select class="form-select" name="role" id="role" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role }}"{{ $role == $user->role ? 'selected' : ''}}>
                            {{ $role }}
                        </option>                        
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-primary" type="submit">Editar Usuário</button>
            </div>
        </div>
    </form>
</x-layout>