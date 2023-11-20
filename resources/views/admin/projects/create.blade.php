@extends('layouts.admin')

@section('content')
    <h1>Create</h1>

    <div class="col-6 mx-auto">
        <form action="{{ route('project.store') }}" method="post" enctype="multipart/form-data">

            @csrf


            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                {{-- utilizziamo la funzione old per ridare all'utente i valori inseriti prima,in caso di errore --}}
                <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId"
                    placeholder="scrivi un titolo per il tuo progetto" value="{{ old('title' /* $project->title */) }}">
                <small id="titleHelper" class="form-text text-muted">Name Project</small>
                @error('title')
                    {{-- <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 px-0 my-3">
                            <div class="card text-center text-white bg-danger py-2">
                                {{$message}}
                            </div>
                        </div>
                    </div>
                </div> --}}
                    <div class="text-danger mb-2">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="thumb" class="form-label">Choose image</label>
                <input type="file" class="form-control" name="thumb" id="thumb" placeholder="image.."
                    aria-describedby="fileHelpThumb">
                <div id="fileHelpThumb" class="form-text">Your Image</div>
            </div>

            {{-- <div class="mb-3">
                <label for="thumb" class="form-label">Scegli una immagine</label>
                <input type="file" class="form-control" name="thumb" id="thumb" placeholder="Scegli una immagine per il tuo progetto" aria-describedby="thumb_helper" value="{{ old('thumb') }}">
                <div id="thumb_helper" class="form-text">Inserisci una immagine</div>
            </div> --}}

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                {{-- utilizziamo la funzione old per ridare all'utente i valori inseriti prima,in caso di errore --}}
                <input type="text" class="form-control" name="description" id="description" aria-describedby="helpId"
                    placeholder="Scrivi una descrizione per il tuo progetto"
                    value="{{ old('description' /* $project->description */) }}">
                <small id="descriptionHelper" class="form-text text-muted">Description Project</small>
            </div>

            <div class="mb-3">
                <label for="authors" class="form-label">Authors</label>
                {{-- utilizziamo la funzione old per ridare all'utente i valori inseriti prima,in caso di errore --}}
                <input type="text" class="form-control" name="authors" id="authors" aria-describedby="help"
                    placeholder="Scrivi gli autori del tuo progetto" value="{{ old('authors' /* $project->authors */) }}">
                <small id="authorsHelper" class="form-text text-muted">Authors of Project</small>
            </div>

            {{-- <div class="mb-3">
                <label for="type_id" class="form-label">Types</label>
                <select class="form-select @error('type_id') is-invalid  @enderror" name="type_id" id="type_id">

                    <option selected disabled>Select a type</option>
                    <option disable value="">Uncategorized</option>

                    @forelse ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                            {{ $type->type }}
                        </option>
                    @empty

                        N/A
                    @endforelse

                </select>

            </div> --}}





            <div class="dropdown my-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="multiSelectDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Types
                </button>
                <ul class="dropdown-menu" aria-labelledby="multiSelectDropdown">
                    @forelse ($types as $type)
                        <li>
                            <label>
                                <input type="checkbox" value="{{ $type->id }}">
                                {{ $type->type }}
                            </label>
                        </li>
                    @empty

                        N/A
                    @endforelse
                </ul>
            </div>


            {{-- <div class="mb-3">
                <label for="technologies" class="form-label">Technologies</label>
                <select multiple class="form-select" name="technologies" id="technologies">
                    <option selected disabled>Select one</option>
            </div>

            <!-- TODO: Improve validation outputs -->
            @foreach ($technologies as $technology)
                <option value="{{ $technology->id }}"
                    {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>
                    {{ $technology->technology }}
                </option>
            @endforeach
 --}}

            <div class="dropdown my-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="multiSelectDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Technologies
                </button>
                <ul class="dropdown-menu" aria-labelledby="multiSelectDropdown">
                    @forelse ($technologies as $technology)
                        <li>
                            <label>
                                <input type="checkbox" value="{{ $technology->id }} {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}">
                                {{ $technology->technology }}
                            </label>
                        </li>
                    @empty

                        N/A

                    @endforelse
                </ul>
            </div>


            @error('type_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            </select>
    </div>
    @error('technologies')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-primary my-5">Aggiungi Proj</button>

    </form>

    </div>
@endsection
