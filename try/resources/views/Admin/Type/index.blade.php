@extends('layouts.app')

@section('content')
    <div>
        <h2>Linguaggi</h2>
        @if (session('delete'))
            <div class="alert alert-danger d-block">
                {{ session('delete') }}
            </div>
        @endif
        <form class='d-flex justify-content-between mb-5' action="{{ route('admin.type.store') }}" method="post">
            @csrf
            <input type="text" name='name' class="form-control">
            <button class="btn btn-success ms-3" type="submit"> Invia</button>
        </form>
        <ul>
            @foreach ($types as $type)
                <li class='d-flex justify-content-between align-items-center m-2'>
                    <form action="{{ route('admin.type.update', $type) }}" method="POST" id="Edit-{{ $type->id }}">
                        @csrf
                        @method('PUT')
                        <input class="border border-0  p-0" type="text" name="name" value="{{ $type->name }}">
                    </form>

                    <button class="btn btn-warning mx-2 " type="submit" onclick="Getid({{ $type->id }})"><i
                            class="fa-solid fa-pen-to-square"></i></button>

                    <form class="d-inline" action="{{ route('admin.type.destroy', $type) }}" method="post"
                        onsubmit="return confirm('sei sicuro di voler cancellare {{ $type['name'] }}')">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger mx-2"><i class="fa-solid fa-trash"></i></button>
                    </form>

                </li>
            @endforeach
        </ul>
    </div>

    <script>
        function Getid(id) {
            const form = document.getElementById(`Edit-${id}`)
            form.submit();
        }
    </script>
@endsection
