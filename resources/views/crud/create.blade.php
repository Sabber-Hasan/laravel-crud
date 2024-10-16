@extends('layout', ['title' => 'create'])
@section('body')
    <div class="content">
        <form action="{{ route('create.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="name">name</label>
            <input type="text" name="name" id="name">
            <label for="email">email</label>
            <input type="text" name="email" id="email">
            <label for="profile">profile</label>
            <input type="file" name="profile" id="profile">
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
