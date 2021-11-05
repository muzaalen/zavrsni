@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New</h1>
    <form action="{{ route('pages.store') }}" method="post" enctype="multipart/form-data">
        @include('admin.pages.partials.fields')
        


    </form>
</div>
@endsection