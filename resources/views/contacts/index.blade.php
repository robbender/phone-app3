@extends('layout')

@section('content')

<div class="container">

    <h1>Phonebook Application</h1>

    {{-- Search form --}}

    <div class="form-group row">
    {{-- <div class="form-group col-md-6"> --}}
    <form action="/search" method="POST" role="search" class="">
        {{-- class="fa fa-search form-control-feedback" --}}
        @csrf

    <div class="">
    <div class="field has-addons">
        <div class="control is-horizontal">
          <input type="search" class="form-control" name="query" placeholder="Search" required>
        </div>
        <div class="control">
          {{-- <button class="btn btn-success" type="submit" data-toggle="modal" data-target="#search"> --}}
                <button
                    class="btn btn-success"
                    type="submit"
                    data-toggle="modal"
                    data-target="#search">
                <span class="text"></span>
                {{-- <span class="icon"><i class="fas fa-plus"></i></span> --}}
                Search
          </button>
        </div>
    </div>
    </div>
</form>
</div>
</div>
{{-- </div> --}}


{{-- Search Alert Window --}}
{{-- <div class="container">
        <div class="row">
            <div class="col">
                <h1></h1>
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
        </div> --}}
        {{-- <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demoModal">Show Modal</button>
            </div>
        </div> --}}
    {{-- </div> --}}

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
    {{-- @if (count($contacts)) --}}
    @foreach ($contacts as $contact)

    <div class="container">
    <div class="card">
        <div class="card-header-title is-size-1">
            <br>
            <div class="card-image">
                    <img style="width:10%" src="/storage/images/{{$contact->image}}">
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
                    class="btn btn-danger"
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
                            <h3 class="modal-title" id="edit">Edit: {{ $contact->name }}</h3>
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

                            {{-- <h6>Image upload</h6>
                                {!! Form::open(['action' => 'ContactController@store', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
                                    @method('PATCH')
                                    @csrf
                                    <div class="form-group">
                                        {{Form::file('cover_image')}}
                                    </div>
                                {!! Form::close() !!} --}}
                            {{-- <div class="">
                                    <br>
                                    <label>Image</label>
                                    <input type="file"
                                        class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }} required"
                                        name="image" enctype="multipart/form-data" accept=".jpg, .jpeg, .png" placeholder="Image">
                                </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
                                <h3 class="modal-title" id="deleteLabel">Delete Contact</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure? This action cannot be undone.
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
        {{-- @else
            <h3 style="text-align: center;">Please Add Contacts</h3>
        @endif --}}

   <div>
            <button
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#create">Add Contact
           </button>
    </div>
    <br>
    <br>

    {{-- Create modal --}}
<div class="modal fade" id="create">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Create New Contact</h3>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <br>
                            <form method="POST" action="/contacts">
                                @csrf
                                <div class="field">
                                    <label class="label" for="name">Name</label>
                                    <div class="control">
                                    <input type="text" class="input is-large {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" required>
                                    </div>
                                </div>
                                <div class="field">
                                     <label class="label" type="text" name="position">Position</label>
                                    <div class="control">
                                        <input type="text" class="input is-large {{ $errors->has('position') ? 'is-danger' : '' }}" name="position" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label is-large" type="text" name="phone">Phone</label>
                                    <div class="control">
                                        <input type="text" class="input is-large {{ $errors->has('phone') ? 'is-danger' : '' }}" name="phone" required>
                                    </div>
                                </div>
                                <div class="">
                                        <br>
                                        <label>Image</label>
                                        <input type="file"
                                            class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }} required"
                                            name="image" enctype="multipart/form-data" accept=".jpg, .jpeg, .png" placeholder="Image" required>
                                    </div>
                                <br>

                                <div class="field">
                                    <div class="control">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Add User</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                    <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add User</button> --}}
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
