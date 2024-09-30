@extends('layouts.app')

@section('content')
    <div class="container-fluid  ">
        @if (session('update'))
            <div class="alert alert-success mx-auto">
                {{ session('update') }}
            </div>
        @endif
        <div class="card mx-auto " style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $work->title }}</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">{{ $work->subject }}</h6>
                @if ($work->description != null)
                    <p class="card-text">{{ $work->description }}</p>
                @else
                    <p class="card-text"><strong>Nussuna descrizione per questo progetto</strong></p>
                @endif
                <img src="{{ asset('storage/' . $work->path_img) }}" alt="{{ $work->original_name_img }}"
                    class="img-thumbnail" onerror="this.src='/img/default-image.jpg'">
                <ul>
                    <li>Linguaggio:{{ $work->type ? $work->type->name : '' }}</li>
                    <li>Data inizio:{{ $work->start_date }}</li>
                    @if ($work->end_date != null)
                        <li>Data Fine:{{ $work->end_date }}</li>
                    @else
                        <li><strong>Progetto ancora in sviluppo</strong></li>
                    @endif
                    <li>Numero Post: {{ $work->post }}</li>
                    @if ($work->collaborators > 0)
                        <li>Numero collaboratori: {{ $work->collaborators }}</li>
                    @else
                        <li><Strong>Progetto individuale</Strong></li>
                    @endif

                    @forelse ($work->technologies as $tec)
                        <li> <span class="badge bg-primary text-dark">{{ $tec->name }}</span></li>
                    @empty
                    @endforelse

                </ul>
                <a href="{{ route('admin.work.index') }}" class="card-link btn btn-secondary" title="Indietro"><i
                        class="fa-solid fa-table-cells"></i></a>
                <a href="{{ route('admin.work.edit', $work) }}" class="btn btn-warning"><i
                        class="fa-solid fa-pen-to-square"></i></a>
                <form class="d-inline" action="{{ route('admin.work.destroy', $work) }}" method="post"
                    onsubmit="return confirm('sei sicuro di voler cancellare {{ $work['title'] }}')">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" type="submit"title='Cancella'><i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
