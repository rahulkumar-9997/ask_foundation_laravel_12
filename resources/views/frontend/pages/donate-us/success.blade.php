@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h2 class="text-success">🎉 Thank you for your donation!</h2>
    <p>Your payment was successful. We’ve received your donation details.</p>
    <a href="{{ route('donate-us') }}" class="btn btn-primary mt-3">Back to Donate Page</a>
</div>
@endsection
