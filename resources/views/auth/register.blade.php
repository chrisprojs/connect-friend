@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                    <option value="" disabled selected>{{ __('Select Gender') }}</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Hobbies -->
                        <div class="row mb-3">
                            <label for="hobby" class="col-md-4 col-form-label text-md-end">{{ __('Hobby') }}</label>

                            <div class="col-md-6" id="hobbies-container">
                                <input id="hobby" type="text" class="form-control mb-2 @error('hobby') is-invalid @enderror" name="hobby[]" placeholder="Enter a hobby" value="{{ old('hobby.0') }}" required>
                                <input id="hobby" type="text" class="form-control mb-2 @error('hobby') is-invalid @enderror" name="hobby[]" value="{{ old('hobby.1') }}">
                                <input id="hobby" type="text" class="form-control mb-2 @error('hobby') is-invalid @enderror" name="hobby[]" value="{{ old('hobby.2') }}">

                                @error('hobby')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Add More Button -->
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-link" id="add-more-hobbies">{{ __('Add More Hobbies') }}</button>
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div class="row mb-3">
                            <label for="instagram" class="col-md-4 col-form-label text-md-end">{{ __('Instagram') }}</label>

                            <div class="col-md-6">
                                <input id="instagram" type="url" class="form-control @error('instagram') is-invalid @enderror" name="instagram" placeholder="http://www.instagram.com/username" value="{{ old('instagram') }}" required>

                                @error('instagram')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="row mb-3">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Criteria -->
                        <div class="row mb-3">
                            <label for="criteria" class="col-md-4 col-form-label text-md-end">{{ __('Criteria') }}</label>

                            <div class="col-md-6">
                                <input id="criteria" type="text" class="form-control @error('criteria') is-invalid @enderror" name="criteria" value="{{ old('criteria') }}" required>

                                @error('criteria')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Fee For Register -->
                        <div class="row mb-3">
                            <label for="fee_for_register" class="col-md-4 col-form-label text-md-end">{{ __('Fee For Register') }}</label>

                            <div class="col-md-6">
                                <div id="price-display" class="form-control-plaintext"></div>
                                <input type="hidden" id="fee_for_register" name="fee_for_register">

                                @error('fee_for_register')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- Register Button -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // JavaScript to dynamically add more hobby input fields
    document.getElementById('add-more-hobbies').addEventListener('click', function() {
        let hobbyContainer = document.getElementById('hobbies-container');
        let newInput = document.createElement('input');
        newInput.setAttribute('type', 'text');
        newInput.setAttribute('class', 'form-control mb-2');
        newInput.setAttribute('name', 'hobby[]');
        hobbyContainer.appendChild(newInput);
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Generate random price between 100000 and 125000
        const price = Math.floor(Math.random() * (125000 - 100000 + 1)) + 100000;

        // Display the price
        document.getElementById('price-display').textContent = `Rp ${price.toLocaleString()}`;

        // Set the hidden input value
        document.getElementById('fee_for_register').value = price;
    });
</script>
@endsection
