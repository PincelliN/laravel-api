@extends('layouts.app')

@section('content')
    <div class="container-fluid overflow-auto">
        <table id="Dash" class="table ">
            <thead>
                <tr>
                    <th scope="col">#id
                    </th>

                    <th scope="col">
                        Titolo</th>
                    <th scope="col">
                        Argomento
                    </th>
                    <th scope="col">
                        Data di inizio
                    </th>
                    <th scope="col">
                        Data fine
                    </th>
                    <th scope="col">
                        Linguaggio
                    </th>
                    <th scope="col">
                        N_post
                    </th>
                    <th scope="col">
                        N_collaboratori
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
                            <form class="d-inline" action="{{ route('admin.work.restore', $work->id) }}" method="post"
                                onsubmit="return confirm('sei sicuro di voler ripristinare {{ $work['title'] }}')">
                                @csrf
                                @method('patch')
                                <button class="btn btn-success" type="submit" title='Ripristin'><i
                                        class="fa-solid fa-rotate-left"></i>
                                </button>
                            </form>
                            <form class="d-inline" action="{{ route('admin.work.delete', $work->id) }}" method="post"
                                onsubmit="return confirm('sei sicuro di voler eliminare definitivamente {{ $work['title'] }}')">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit" title='Cancella'><i
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
