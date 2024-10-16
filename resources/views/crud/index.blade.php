@extends('layout', ['title' => 'index'])
@section('body')
    <div class="content">
        <a href="{{ route('create') }}">Create</a>
        <div>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Profile</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($profiles as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td><img src="{{ asset('storage/' . $item->profile) }}" alt="profile pic" width="120px"></td>
                            <td>
                                <ul>
                                    <li>Show</li>
                                    <li><a href="{{ route('edit', $item->id) }}">Edit</a></li>
                                    <li>
                                        <form action="{{ route('destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
