@extends('layout')

@section('content')

    <h1>Contacts</h1>

    {{-- <span class="fa fa-search form-control-feedback"></span>
                <input type="search" class="form-control" name="query" placeholder="Search" required>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demoModal">Show Modal</button>
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#search"></button>
                        <span class="text"></span>
                        <span class="icon"><i class="fas fa-plus"></i></span>
                    </button>
                </span> --}}

    {{-- Search form --}}
    <form action="/search" method="POST" role="search" class="fa fa-search form-control-feedback">
        @csrf

    <div class="is-grouped is-pulled-right">
    <div class="field has-addons">
        <div class="control is-horizontal">
          {{-- <input class="input is-large" type="search" placeholder="Find a contact" name="query"> --}}
          <input type="search" class="form-control" name="query" placeholder="Search" required>
        </div>
        <div class="control">
          <button class="btn btn-success" type="submit" data-toggle="modal" data-target="#search">
                <button class="btn btn-success" type="submit">
                <span class="text"></span>
                <span class="icon"><i class="fas fa-plus"></i></span>
          </button>
        </div>
    </div>
    </div>
</form>


{{-- Search Alert Window --}}
{{-- <div class="container">
        <div class="row">
            <div class="col">
                <h1>Alerts &amp; Modal</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="alert-heading">This is an alert!</h2>
                    <p>I'm an alert!
                        <a href="#" class="alert-link">Click me!</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demoModal">Show Modal</button>
            </div>
        </div>
    </div> --}}

{{-- Search Modal --}}
<div class="modal fade" id="search">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Search Results</h2>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                            <p class="subtitle is-size-4 has-text-weight-semibold">
                                Results:
                            </p>
                        @foreach ($contacts as $contact)
                            <h3>
                                Name: <a href="/contacts/{{ $contact->id }}">{{ $contact->name }}</a>
                            </h3>
                            <p>
                                Position: {{ $contact->position }}
                            </p>
                            <p>
                                Phone: {{ $contact->phone }}
                            </p>
                            <br>
                            <br>

                        @endforeach

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Contact Views --}}

    @foreach ($contacts as $contact)

    <div class="container">

    <div class="card">
        <div class="card-header-title is-size-1">
            <br>

            <p>
                <a href="/contacts/{{ $contact->id }}">{{ $contact->name }}</a>
            </p>
        </div>

        <div class="card-image">
             {{-- <img style="width:50%" src="/storage/images/{{ $contact->image }}"> --}}
            <img src="" alt="">

        </div>

        <div class="card-content">

        <p class="subtitle is-size-4 has-text-weight-semibold">
            Position:
            {{ $contact->position }}
        </p>

        <p class="subtitle is-size-4 has-text-weight-semibold">
            Phone:
            {{ $contact->phone }}
        </p>
        <div class="field is-grouped is-grouped-right">
            <div class="row">
                <div class="col">
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">Edit</button>
                </div>
            </div>
        </div>
            <form method="POST" action="/contacts/{{ $contact->id }}">
                @method('DELETE')
                @csrf
                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-danger is-medium">Delete</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    </div>
    <br>

    @endforeach

    {{-- Edit Modal --}}

    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="/contacts/{{ $contact->id }}">
                        @method('PATCH')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit">Edit Contact</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="field">
                                <label for="name" class="label">Name</label>

                                <div>
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        name="name" placeholder="Name" value="{{ $contact->name }}" required>
                                </div>
                            </div>

                            <div class="field">
                                <label for="title" class="label">Position</label>

                                <div>
                                    <input type="text"
                                        class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}"
                                        name="position" placeholder="Position" value="{{ $contact->position }}" required>
                                </div>
                            </div>

                            <div class="field">
                                <label for="phone" class="label">Phone</label>

                                <div>
                                    <input type="text"
                                        class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                        name="phone" placeholder="Phone" value="{{ $contact->phoneNumber }}">
                                </div>
                            </div>

                            @if ($errors->any() && $errors->has($contact->id))
                            {{-- <script>
                            $(document).ready(function() {
                                $('#edit-{{ $entry->id }}').modal('show');
                            });
                            </script> --}}

                            <div class="notification is-invalid">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"
                                onclick="window.location.href = '/entries'">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    {{-- Edit Modal --}}
    {{-- <div class="modal fade" id="edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Please confirm!</h2>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <h1 class="title is-size-1">Edit Contact</h1>
                            <form method="POST" action="/contacts/{{ $contact->id }}">
                                @method('PATCH')
                                @csrf
                                    <div class="field">
                                        <label class="label" for="name">Name</label>
                                    <div class="control">
                                    <input type="text" class="input is-large" name="name" placeholder="Name" value="{{ $contact->name }}">
                                    </div>
                                    <div class="field">
                                        <label class="label" for="position">Position</label>
                                    <div class="control">
                                        <input type="text" class="input is-large" name="position" placeholder="Position" value="{{ $contact->position }}" required>
                                     </div>
                                     <div class="field">
                                        <label class="label" for="phone">Phone</label>
                                    <div class="control">
                                    <input type="text" class="input is-large" name="phone" placeholder="Phone" value="{{ $contact->phone }}" required>
                                    </div>
                                    <br>
                                    <div class="control">

                                        <input type="file" class="input is-large" name="image" accept="image/png, image/jpeg" placeholder="Image" value="{{ old('position') }}" required> --}}
                                        {{-- value="{{ $user->image }}" --}}
                                    {{-- </div>
                                    <br>
                                    <div class="field">
                                        <div class="control">
                                            <button type="submit" class="button is-info is-large">Update</button>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Confirm</button>
                    </div>
                </div>
            </div>
        </div> --}}

    {{-- Demo modal --}}
    <div class="modal fade" id="demoModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Please confirm!</h2>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>This is the modal body, do you like it?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <br>

    <p class="control">
        <a href="/users/create" class="button is-info is-pulled-right is-large">New Contact</a>
    </p>
    <br>
    <br>
    <footer class="footer">
            <div class="content has-text-centered">
              <p>
                <strong>Directory</strong> by <a href="">Web Services</a>.
                2019
              </p>
            </div>
          </footer>

    @endsection
