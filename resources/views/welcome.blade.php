@extends('layout')

@section('content')


    <h1>Welcome To The Phonebook Application</h1>
    <br>
    <br>
    <div class="jumbotron text-center">
        <h1>Robert's Contacts</h1>
        <br>
        <p></p>
        {{-- <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> --}}
        <p><a class="btn btn-primary btn-lg" href="/contacts" role="button">Enter</a>
            {{-- <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p> --}}
    </div>


@endsection
