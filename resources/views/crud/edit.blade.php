@extends('layout', ['title' => 'edit'])
@section('body')
    <div class="content">
        {{-- @dd($profile) --}}
        <form action="{{ route('update', $profile->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="name">name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $profile->name) }}">
            <label for="email">email</label>
            <input type="text" name="email" id="email" value="{{ old('email', $profile->email) }}">
            <label for="profile">profile</label>
            <input type="file" name="profile" id="profile">
            @if ($profile->profile)
                <img src="{{ ('storage/' . $profile->profile) }}" alt="profile pic" width="120px">
            @endif
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
