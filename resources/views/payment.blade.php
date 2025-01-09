@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form id="fee_for_register_form" method="POST" action="{{ route('payment') }}" class="col-md-12 d-flex flex-column align-items-center justify-content-center">
            @csrf
            <h1>Pay Fee For Register</h1>
            <h2>{{ Auth::user()->fee_for_register }} coin</h2>
            <input id="pay_price" type="number" class="form-control @error('pay_price') is-invalid @enderror" name="pay_price" value="{{ old('pay_price') }}" required>
            @error('pay_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @if (session('overpaid'))
                <div class="alert alert-warning">
                    Sorry, you overpaid {{ session('overpaid') }} coins.
                    Would you like to enter the balance?
                    <div>
                        <button type="button" class="btn btn-success" onclick="handleOverpay(true)">Yes</button>
                        <button type="button" class="btn btn-danger" onclick="handleOverpay(false)">No</button>
                    </div>   
                </div>
            @endif
            <input id="is_overpaid" type="hidden" name="is_overpaid" value=false>
            <button class="btn btn-primary">Pay</button>
        </form>
    </div>
    <script>
        function handleOverpay(accept) {
            if (accept) {
              document.getElementById('is_overpaid').value = true;
              event.preventDefault();
              document.getElementById('fee_for_register_form').submit();
            } else {
              document.querySelector('.alert-warning').style.display = 'none';
            }
        }
    </script>
</div>
@endsection
