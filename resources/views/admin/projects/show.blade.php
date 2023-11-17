@extends('layouts.admin')

@section('content')

    <ul>
        
        <li>{{$project->title}}</li>
        <li><img src="{{$project->thumb}}" alt="{{$project->thumb}}"></li>
        <li>{{$project->decription}}</li>
        <li>{{$project->authors}}</li>
        <li>{{$project->link}}</li>
        <li>{{$project->github_link}}</li>
        <li>{{ $project->slug }}</li>
        <li>{{ $project->tech }}</li>
        
        
    </ul>
    
@endsection