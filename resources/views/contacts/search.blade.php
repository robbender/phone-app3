@extends('layout')

@section('content')

    <h1>Search Results</h1>

    <p class="subtitle is-size-4 has-text-weight-semibold">
        Results:
    </p>


@foreach ($contacts as $contact)


        Name: <a href="/users/{{ $contact->id }}">{{ $contact->name }}</a>
        {{-- Name: {{ $user->name }} --}}
    </p>
    <p>
        Position: {{ $contact->position }}
    </p>
    <p>
        Phone: {{ $contact->phone }}
    </p>
    <br>
    <br>

@endforeach

<a href="/contacts">Back</a>

@endsection
