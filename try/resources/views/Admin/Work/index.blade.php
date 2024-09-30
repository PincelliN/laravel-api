@extends('layouts.app')

@section('content')
    <div class="container-fluid overflow-auto">
        @if (session('delete'))
            <div class="alert alert-danger d-block">
                {{ session('delete') }}
            </div>
        @endif
        <table id="Dash" class="table ">

            <thead>
                <tr>
                    <th scope="col">
                        <div class="d-flex align-items-center text-nowrap">
                            <a href="{{ Route('admin.work.index', ['ordinatore' => 'id', 'verso' => $verso]) }}">#id
                                @if ($ordinatore == 'id')
                                    <i
                                        class="fa-solid  @if ($verso == 'asc') fa-arrow-up @else fa-arrow-down @endif"></i>
                                @endif
                            </a>

                        </div>

                    </th>

                    <th scope="col">
                        <div class="d-flex align-items-center text-nowrap">
                            <a class="d-flex align-items-center text-nowrap"
                                href="{{ Route('admin.work.index', ['ordinatore' => 'title', 'verso' => $verso]) }}">Titolo</a>
                            @if ($ordinatore == 'title')
                                <i
                                    class="fa-solid  @if ($verso == 'asc') fa-arrow-up @else fa-arrow-down @endif"></i>
                            @endif
                        </div>

                    </th>
                    <th scope="col">
                        <div class="d-flex align-items-center text-nowrap">
                            <a class="d-flex align-items-center text-nowrap"
                                href="{{ Route('admin.work.index', ['ordinatore' => 'subject', 'verso' => $verso]) }}">Argomento</a>
                            @if ($ordinatore == 'subject')
                                <i
                                    class="fa-solid  @if ($verso == 'asc') fa-arrow-up @else fa-arrow-down @endif"></i>
                            @endif
                        </div>
                    </th>
                    <th scope="col">
                        <div class="d-flex align-items-center text-nowrap">
                            <a class="d-flex align-items-center text-nowrap"
                                href="{{ Route('admin.work.index', ['ordinatore' => 'start_date', 'verso' => $verso]) }}">Data
                                di
                                inizio</a>
                            @if ($ordinatore == 'start_date')
                                <i
                                    class="fa-solid  @if ($verso == 'asc') fa-arrow-up @else fa-arrow-down @endif"></i>
                            @endif
                        </div>
                    </th>
                    <th scope="col">
                        <div class="d-flex align-items-center text-nowrap">
                            <a class="d-flex align-items-center text-nowrap"
                                href="{{ Route('admin.work.index', ['ordinatore' => 'end_date', 'verso' => $verso]) }}">Data
                                fine</a>
                            @if ($ordinatore == 'end_date')
                                <i
                                    class="fa-solid  @if ($verso == 'asc') fa-arrow-up @else fa-arrow-down @endif"></i>
                            @endif
                        </div>
                    </th>
                    <th scope="col">
                        <div class="d-flex align-items-center text-nowrap">
                            <a class="d-flex align-items-center text-nowrap"
                                href="{{ Route('admin.work.index', ['ordinatore' => 'type_id', 'verso' => $verso]) }}">Linguaggio</a>
                            @if ($ordinatore == 'type_id')
                                <i
                                    class="fa-solid  @if ($verso == 'asc') fa-arrow-up @else fa-arrow-down @endif"></i>
                            @endif
                        </div>
                    </th>
                    <th scope="col">
                        <div class="d-flex align-items-center text-nowrap">
                            <a class="d-flex align-items-center text-nowrap"
                                href="{{ Route('admin.work.index', ['ordinatore' => 'post', 'verso' => $verso]) }}">N_post</a>
                            @if ($ordinatore == 'post')
                                <i
                                    class="fa-solid  @if ($verso == 'asc') fa-arrow-up @else fa-arrow-down @endif"></i>
                            @endif
                        </div>
                    </th>
                    <th scope="col">
                        <div class="d-flex align-items-center text-nowrap">
                            <a class="d-flex align-items-center text-nowrap"
                                href="{{ Route('admin.work.index', ['ordinatore' => 'collaborators', 'verso' => $verso]) }}">N_collaboratori</a>
                            @if ($ordinatore == 'collaborators')
                                <i
                                    class="fa-solid  @if ($verso == 'asc') fa-arrow-up @else fa-arrow-down @endif"></i>
                            @endif
                        </div>
                    </th>
                    <th scope="col">Immagine</th>
                    <th scope="col">Tecnologie</th>
                    <th scope="col">Azione</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($works as $work)
                    <tr>

                        <td>{{ $work['id'] }}</td>
                        <td>{{ $work['title'] }}</td>
                        <td>{{ $work['subject'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($work['start_date'])->format('d/m/Y') }}</td>
                        <td>{{ $work['end_date'] ? \Carbon\Carbon::parse($work['end_date'])->format('d/m/Y') : '' }}</td>
                        <td><span class="badge bg-success text-dark">{{ $work->type?->name }}</span></td>
                        <td>{{ $work['post'] }}</td>
                        <td>{{ $work['collaborators'] }}</td>
                        <td> <img src="{{ asset('storage/' . $work->path_img) }}" alt="{{ $work->original_name_img }}"
                                class="img-thumbnail w-50" onerror="this.src='/img/default-image.jpg'"></td>
                        <td>
                            @forelse ($work->technologies as $tec)
                                <span class="badge bg-primary text-dark">{{ $tec->name }}</span>
                            @empty
                                <i class="fa-solid fa-xmark"></i>
                            @endforelse
                        </td>



                        <td>
                            <a href="{{ route('admin.work.show', $work) }}" class="btn btn-success" title="Dettaglio"><i
                                    class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.work.edit', $work) }}" class="btn btn-warning"title="Modifica"><i
                                    class="fa-solid fa-pen-to-square"></i></a>

                            <form class="d-inline" action="{{ route('admin.work.destroy', $work) }}" method="post"
                                onsubmit="return confirm('sei sicuro di voler cancellare {{ $work['title'] }}')">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit"title='Cancella'><i
                                        class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
