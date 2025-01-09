@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Home</h1>
            
            <!-- Search Bar -->
            <form method="GET" action="{{ url('/') }}">
                <div class="form-row">
                    <div class="col-md-4">
                        <select name="gender" class="form-control">
                            <option value="" {{ old('gender', request('gender')) === null ? 'selected' : '' }}>All</option>
                            <option value="male" {{ old('gender', request('gender')) === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', request('gender')) === 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="hobby" class="form-control" placeholder="Hobby (e.g., reading)" value="{{ old('hobby', request('hobby')) }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
            
            <hr>

            <!-- User Cards -->
            <div class="row">
                @forelse ($users as $user)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p class="card-text">
                                    <strong>Gender:</strong> {{ $user->gender }} <br>
                                    <strong>Hobbies:</strong> {{ implode(', ', json_decode($user->hobby)) }} <br>
                                    <strong>Instagram:</strong> <a href="{{ $user->instagram }}" target="_blank">{{ $user->instagram }}</a> <br>
                                    <strong>Criteria:</strong> {{ $user->criteria }}
                                </p>
                                <form method="POST" action="{{ route('user.like', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="btn {{ in_array($user->id, $likedUsers) ? 'btn-primary' : 'btn-outline-primary' }} w-100">👍 Like</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No users found matching your criteria.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
