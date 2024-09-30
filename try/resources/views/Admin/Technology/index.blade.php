@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column align-items-center ">
        <h1>Technology</h1>
        @if (session('delete'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ session('delete') }}</li>
                </ul>
            </div>
        @endif
        @if (session('update'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ session('update') }}</li>
                </ul>
            </div>
        @endif
        @if (session('create'))
            <div class="alert alert-primary">
                <ul>
                    <li>{{ session('create') }}</li>
                </ul>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    <li>{{ $errors->first() }}</li>
                </ul>
            </div>
        @endif
        <form class="my-3 d-flex align-items-center" action="{{ route('admin.technology.store') }}" method="post">
            @csrf
            <input type="text" name="name" value="{{ $errors->any() && ' ' ? ' ' : old('name') }}">
            <button class="ms-3 btn btn-success" type="submit">Invia</button>
        </form>
        @dump(old())
        <ul>
            @foreach ($techs as $tech)
                <li class="d-flex align-items-center gap-3 ">
                    <form action="{{ route('admin.technology.update', $tech) }}" method="post"
                        id='Tech-edit-{{ $tech->id }}'>
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="techid" value="{{ $tech['id'] }}">
                        <input class="my-3 " type="text" name="name"
                            value="{{ old('techid') == $tech['id'] ? old('name', $tech['name']) : $tech['name'] }}">

                    </form>
                    {{-- se ci sono errori  e l'id attuale è uguale al id modificato allora conserva la modifica segnando la presenza del errore --}}
                    <button class="btn btn-warning" type="submit" onclick="GetTechid({{ $tech->id }})">
                        <i class="fa-solid fa-pen-to-square"></i></button>
                    <form action="{{ route('admin.technology.destroy', $tech) }}" method="post"
                        onsubmit="return confirm(sei sicuro di voler eliminare {{ $tech['name'] }})">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button>
                    </form>

                </li>
            @endforeach

        </ul>
    </div>

    <script>
        function GetTechid(id) {
            const form = document.getElementById(`Tech-edit-${id}`)
            form.submit();
        }
    </script>
@endsection
