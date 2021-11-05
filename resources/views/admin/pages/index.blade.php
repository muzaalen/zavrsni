@extends('layouts.app')

@section('content')
<div class="container">
@if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    @endif
    <br />
    <a href="{{ route('pages.create') }}" class="btn btn-large btn-primary openbutton" role="button">Create New</a>
    
    <div class="container">
        <div class="card-deck">

        @foreach($pages as $page)

            <div class="card">
                <img class="card-img-top" src="/storage/{{$page->file_path}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Title: {{$page->title}}</h5>
                    <p class="card-text">Content: {{$page->content}}</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">URL: {{$page->url}}</small>
                    <br>
                    <a href="{{ route('pages.edit' , ['page' => $page->id])}}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('pages.destroy', $page->id) }}" method="post">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}
                            <button class="btn btn-danger delete-link"  onclick="return confirm('Are you sure you want to delete this page?')" type="submit">Delete</button>
                        </form>
                </div>


            </div>

        @endforeach

        </div>


    

    </div>

    {{ $pages->links() }}

    

</div>
@endsection