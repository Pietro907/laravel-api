@extends('layouts.admin')
@section('content')


    

    <div class="table-responsive">

        <div class="d-flex justify-content-center">

            <a href="{{ route('project.create') }}" class="bg-warning text-decoration-none text-white rounded-3 shadow p-1 my-5">Create New Project</a>
        </div>
    


        @if (session('messaggio'))
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 px-0 my-3">
                        <div class="card text-center text-white bg-danger py-2">
                            {{ session('messaggio') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    
        @if (session('create_mess'))
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 px-0 my-3">
                        <div class="card text-center text-white bg-success py-2">
                            {{ session('create_mess') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

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
                    <th scope="col">TECH</th>
                    <th scope="col"></th>
                    <th scope="col">SLUG</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($projects as $project)
                    <tr class="text-center">
                        <td scope="row">{{ $project->id }}</td>
                        <td><b>{{ $project->title }}</b></td>
                        <td>
                            @if ($project->thumb)
                                <img class="w-100 p-3" src="{{ asset('storage/' . $project->thumb) }}" alt="{{ $project->thumb }}">
                            @else
                                N/A
                            @endif
                        </td>

                        <td><em style="font-size: xx-small">{{ $project->description }}</em></td>
                        <td><b>{{ $project->authors }}</b></td>
                        <td><a href="{{ $project->link }}"><i class="fa-solid fa-link text"></i></a></td>
                        <td><a href="{{ $project->github_link }}"><i class="fa-brands fa-github"></i></a></td>
                        <td>{{ $project->type ? $project->type->type : 'Nessuna tipologia' }}</td>
                        <td>{{ $project->technology ? $project->technology->technology : 'Nessuna tecnologia' }}</td>
                        <td>
                            {{-- <a href="project/{project}">{{ $project->slug }}</a> --}}

                            <form action="{{ route('project.show', [$project->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary text-white  my-2 fs-6">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </form>

                            <form action="{{ route('project.edit', [$project->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-secondary text-white  my-2 fs-6">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </form>

                            {{-- <form action="{{ route('project.destroy', [$project->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger text-white px2- py-0 my-2 fs-6">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button> --}}

                            <button type="button" class="btn btn-danger text-white  my-2 fs-6" data-bs-toggle="modal"
                                data-bs-target="#deleteProject-{{ $project->id }}">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>


                            <div class="modal fade" id="deleteProject-{{ $project->id }}" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="modalTitle-{{ $project->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitle-{{ $project->id }}">
                                                {{ $project->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ⚠ Attention! This is a destructive operation. You cannot undo this!
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <form action="{{ route('project.destroy', $project) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">⚡ Confirm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- </form> --}}

                        </td>
                        <td>{{ $project->tech }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    
        <div class="d-flex justify-content-center">

            <a href="{{ route('project.create') }}" class="bg-warning text-decoration-none text-white rounded-3 shadow p-1 my-5">Create New Project</a>
        </div>
    

    </div>
@endsection
