@extends('layouts.admin')

@section('content')
    <h1>
        Recycle
    </h1>

    @if (session('recycle_mess'))
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 px-0 my-3">
                    <div class="card text-center text-white bg-success py-2">
                        {{ session('recycle_mess') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>

                <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">DESCRIPTION</th>
                    <th scope="col">AUTHORS</th>
                    <th scope="col">LINK</th>
                    <th scope="col">GITHUB</th>
                    <th scope="col">TYPE_ID</th>
                    <th scope="col"></th>
                    <th scope="col">TECH</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($trashed as $project)
                    <tr class="text-center">
                        <td scope="row">{{ $project->id }}</td>
                        <td><b>{{ $project->title }}</b></td>
                        <td>
                            @if ($project->thumb)
                                <img class="w-100 p-3" src="{{ $project->thumb }}" alt="{{ $project->thumb }}">
                            @else
                                N/A
                            @endif
                        </td>

                        <td><em style="font-size: xx-small">{{ $project->description }}</em></td>
                        <td><b>{{ $project->authors }}</b></td>
                        <td>{{ $project->link }}</td>
                        <td>{{ $project->github_link }}</td>
                        <td>{{ $project->type ? $project->type->type : 'Nessuna tipologia' }}</td>
                        <td>
                            
                            <a href="{{ route('project.restore', $project->id) }}"
                                class="btn btn-success px-2 py-0 my-2 fs-6"><i class="fa-solid fa-recycle"></i></a>
                        </td>
                        <td>{{ $project->technology ? $project->technology->technology : 'Nessuna tecnologia' }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
