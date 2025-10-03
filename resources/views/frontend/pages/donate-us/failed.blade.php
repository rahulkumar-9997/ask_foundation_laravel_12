@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h2 class="text-danger">❌ Payment Failed</h2>
    <p>Something went wrong. Please try again or contact support.</p>
    <a href="{{ route('donate-us') }}" class="btn btn-warning mt-3">Try Again</a>
</div>
@endsection
