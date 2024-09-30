@extends('layouts.app')

@section('content')
    <form class="overflow-auto" action="{{ route('admin.work.update', $work) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
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
                value="{{ old('title', $work['title']) }}">
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="path_img" class="form-label">Immagine</label>
            <input class="form-control" type="file" id="path_img" name="path_img" onchange="Preview(event)">

            <img src="{{ asset('storage/' . $work->path_img) }}" alt="{{ $work->original_name_img }}" id="thumb"
                class="img-thumbnail w-25 mt-2" onerror="this.src='/img/default-image.jpg'"></td>
            @error('path_img')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Titolo</label>
            <select class="form-select" aria-label="Default select example" name="type_id" id="type">
                <option value="">Linguaggio utilizzato</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @if (old('type_id', $work->type?->id) == $type->id) selected @endif>
                        {{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Argomento</label>
            <input type="text" class="form-control" id="subject" name='subject' placeholder="php"
                value="{{ old('subject', $work['subject']) }}">
            @error('subject')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="d-flex gap-3">
            <div class="mb-3">
                <label for="start_date" class="form-label">Data di Inizio</label>
                <input type="date" class="form-control" id="start_date" name='start_date'
                    value="{{ old('start_date', $work['start_date']) }}">
                @error('start_date')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">Data fine progetto</label>
                <input type="date" class="form-control" id="end_date" name='end_date'
                    value="{{ old('end_date', $work['end_date']) }}">
                @error('end_date')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="d-flex gap-3">
            <div class="mb-3">
                <label for="post" class="form-label">Post</label>
                <input type="numbers" class="form-control" id="post" name='post'
                    value="{{ old('post', $work['post']) }}">
                @error('post')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="collaborators" class="form-label">Collaboratori</label>
                <input type="numbers" class="form-control" id="collaborators" name='collaborators'
                    value="{{ old('collaborators', $work['collaborators']) }}">
                @error('collaborators')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="btn-group mb-3" role="group" aria-label="Basic checkbox toggle button group">
            {{--    Caso 1: se non ci sono errori di validazione, verifica se la tecnologia è già associata al work
            Caso 2: se ci sono errori di validazione, recupera le tecnologie selezionate tramite old()  --}}
            @foreach ($tecs as $tec)
                <input type="checkbox" class="btn-check" id="create-tec-{{ $tec->id }}" name="technologies[]"
                    autocomplete="off" value='{{ $tec->id }}' @if (
                        (!$errors->any() && $work->technologies->contains($tec)) ||
                            ($errors->any() && in_array($tec->id, old('technologies', [])))) checked @endif>
                <label class="btn btn-outline-light" for="create-tec-{{ $tec->id }}">{{ $tec->name }}</label>
            @endforeach
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Example textarea</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $work['description']) }}</textarea>
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
