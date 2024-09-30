@extends('layouts.app')

@section('content')
    <form class="overflow-auto pe-5" action="{{ route('admin.work.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name='title' placeholder="Laravel"
                value="{{ old('title') }}">
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="path_img" class="form-label">Immagine</label>
            <input class="form-control" type="file" id="path_img" name="path_img" onchange="Preview(event)">
            <img src="/img/default-image.jpg" id="thumb" class="img-thumbnail w-25 mt-2">
            @error('path_img')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Linguaggio utilizzato</label>
            <select class="form-select" aria-label="Default select example" name="type_id" id="type">
                <option value="">Linguaggio utilizzato</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @if (old('type_id') == $type->id) selected @endif>
                        {{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Argomento</label>
            <input type="text" class="form-control" id="subject" name='subject' placeholder="php"
                value="{{ old('subject') }}">
            @error('subject')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="d-flex gap-3">
            <div class="mb-3">
                <label for="start_date" class="form-label">Data di Inizio</label>
                <input type="date" class="form-control" id="start_date" name='start_date'
                    value="{{ old('start_date') }}">
                @error('start_date')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">Data fine progetto</label>
                <input type="date" class="form-control" id="end_date" name='end_date' value="{{ old('end_date') }}">
                @error('end_date')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="d-flex gap-3">
            <div class="mb-3">
                <label for="post" class="form-label">Post</label>
                <input type="numbers" class="form-control" id="post" name='post' value="{{ old('post') }}">
                @error('post')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="collaborators" class="form-label">Collaboratori</label>
                <input type="numbers" class="form-control" id="collaborators" name='collaborators'
                    value="{{ old('collaborators') }}">
                @error('collaborators')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="btn-group mb-3" role="group" aria-label="Basic checkbox toggle button group">

            @foreach ($tecs as $tec)
                <input type="checkbox" class="btn-check" id="create-tec-{{ $tec->id }}" name="technologies[]"
                    autocomplete="off" value='{{ $tec->id }}' @if (in_array($tec->id, old('technologies', []))) checked @endif>
                <label class="btn btn-outline-light" for="create-tec-{{ $tec->id }}">{{ $tec->name }}</label>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descizione</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button class="btn btn-success" type="submit">Invia</button>
        <button class="btn btn-danger" type="reset">Reset</button>

    </form>

    <script>
        function Preview(event) {
            const thumb = document.getElementById('thumb');
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
