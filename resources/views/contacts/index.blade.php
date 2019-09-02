@extends('layout')

@section('content')

    <h1>Contacts</h1>

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
{{-- <div class="modal fade" id="search">
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
    </div> --}}

    {{-- Contact Views --}}
    @if (count($contacts))
    @foreach ($contacts as $contact)

    <div class="container">
    <div class="card">
        <div class="card-header-title is-size-1">
            <br>
            <div class="card-image">
                {{-- <img style="width:50%" src="/storage/images/{{ $contact->image }}">
               <img src="" alt="image"> --}}
           </div>
            <p>
                <a href="/contacts/{{ $contact->id }}">{{ $contact->name }}</a>
            </p>
            <p>
                {{ $contact->position }}
            </p>
            <p>
                {{ $contact->phone }}
            </p>
        <div class="field is-grouped is-grouped-right">
            <div class="row">
                <div class="col">
                     <button
                     type="button"
                     class="btn btn-primary"
                     data-toggle="modal"
                     data-target="#edit-{{ $contact->id }}">Edit
                    </button>

                </div>
            </div>
        </div>
        <div class="field is-grouped is-grouped-right">
            <div class="row">
                <div class="col">
                    <button
                    type="submit"
                    class="button is-danger is-medium"
                    data-toggle="modal"
                    data-target="#delete-{{ $contact->id }}">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
    <br>

    {{-- Edit Modal --}}
    <div class="modal fade" id="edit-{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="editLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="/contacts/{{ $contact->id }}">
                        @method('PATCH')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit">Edit {{ $contact->name }}</h5>
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
                                        name="phone" placeholder="Phone" value="{{ $contact->phone }}">
                                </div>
                            </div>

                            @if ($errors->any() && $errors->has($contact->id))

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
                                {{-- {{-- onclick="window.location.href = '/contacts'">Cancel</button> --}}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Delete Modal --}}
        <div class="modal modal-danger fade" id="delete-{{ $contact->id }}" tabindex="-1" role="dialog"
                aria-labelledby="deleteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="/contacts/{{ $contact->id }}">
                            @method('DELETE')
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteLabel">Delete entry</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you'd like to delete this entry?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    @endforeach
        @else
        <h3 style="text-align: center;">No entries found</h3>
        @endif

    <p class="control">

            {{-- <button
            type="submit"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#create-{{ $contact->id }}">Add Contact</button> --}}

        <button class="btn btn-primary"
                type="submit"
                data-toggle="modal"
                data-target="#create-{{ $contact->id }}">New Contact</button>
    </p>
    <br>
    <br>

    {{-- Create modal --}}
     <div class="modal fade" id="create-{{ $contact->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Create New Contact</h2>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <br>
                            <form method="POST" action="/contacts">
                                @csrf
                                <div class="field">
                                    <label class="label" for="name"></label>
                                    <div class="control">
                                    <input type="text" class="input is-large {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="field">
                                     <label class="label" type="text" name="position"></label>
                                    <div class="control">
                                        <input type="text" class="input is-large {{ $errors->has('position') ? 'is-danger' : '' }}" name="position" value="{{ old('position') }}" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label is-large" type="text" name="phone"></label>
                                    <div class="control">
                                        <input type="text" class="input is-large {{ $errors->has('phone') ? 'is-danger' : '' }}" name="phone" value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                                <div class="field"> --}}
                                        {{-- <label class="label is-large" type="text" name="image"></label> --}}
                                        <input type="file" class="input is-large {{ $errors->has('image') ? 'is-danger' : '' }}"
                                        name="image" enctype="multipart/form-data" accept="image/png, image/jpeg" placeholder="Image" required>
                                </div>
                                <br>
                                <div class="field">
                                    <div class="control">
                                        <button type="submit" class="button is-info is-medium">Add User</button>
                                    </div>
                                </div>
                                @if ($errors->any())
                                <div class="notification is-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Create</button>
                    </div>
                </div>
            </div>
        </div>
        <br>

     {{-- Demo modal --}}
     {{-- <div class="modal fade" id="demoModal">
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
        <br> --}}


    <footer class="footer">
            <div class="content has-text-centered">
              <p>
                <strong>Directory</strong> by <a href="">Web Services</a>.
                2019
              </p>
            </div>
          </footer>

    @endsection
