@extends("adminlte::page")

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop

@section('footer')
    <h6>Copyright@2021</h6>
@stop

@section('content')
    <div class="col-md-12">
        @if (session('error'))
            <div class="card-body">
                <div class="row-cols-1">
                    <div class="col-lg-12">
                        <div class="alert alert-danger" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="xclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                                aria-label="Warning:">
                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <strong>{!! session('error') !!}</strong>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (session('block'))
            <div class="card-body">
                <div class="row-cols-1">
                    <div class="col-lg-12">
                        <div class="alert alert-success" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                                aria-label="Warning:">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                            <strong> {!! session('block') !!}</strong>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (session('delete'))
            <div class="card-body">
                <div class="row-cols-1">
                    <div class="col-lg-12">
                        <div class="alert alert-success" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                                aria-label="Warning:">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                            <strong> {!! session('delete') !!}</strong>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="col-md-12">
        <a href="{{ route('admin.create') }}"
            class="btn btn-md btn-success float-end mb-3 fw-bold text-decoration-none border-0 btn-outline-0">+ Add User</a>
    </div>
    <div class="unit w-2-3">
        <div class="hero-callout">
            <div id="example_wrapper" class="dataTables_wrapper">
                <table id="user_table" class="display nowrap dataTable dtr-inline collapsed table table-bordered"
                    style="width: 100%;" role="grid" aria-describedby="example_info">
                    <thead class="table-dark">
                        <tr role="row">
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                style="width: 1px;" aria-sort="ascending"
                                aria-label="Name: activate to sort column descending">#</th>
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                style="width: 192px;" aria-label="Position: activate to sort column ascending">Name</th>
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                style="width: 89px;" aria-label="Office: activate to sort column ascending">Email</th>
                            <th class="dt-body-right sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                style="width: 35px;" aria-label="Age: activate to sort column ascending">Role</th>
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                style="width: 78px;" aria-label="Start date: activate to sort column ascending">Status </th>
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                style="width: 78px;" aria-label="Start date: activate to sort column ascending">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="dtr-control sorting_1" tabindex="0" class="id">{{ $user->id }}
                                </td>
                                <td>{{ $user->name }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">
                                    @if ($user->role_id == 0)
                                        <span type="button" class="badge badge-success">Admin</span>
                                    @else
                                        <span type="button" class="badge"
                                            style="background: burlywood;">User</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($user->is_blocked == 0)
                                        <a class="text-success text-decoration-none" href="#" data-toggle="modal"
                                            data-target="#ModalBlock{{ $user->id }}"> <i class="fas fa-user"></i></a>
                                    @else
                                        <a class="text-danger text-decoration-none" href="#" data-toggle="modal"
                                            data-target="#ModalBlock{{ $user->id }}"><i
                                                class="fas fa-user-slash "></i></a>
                                    @endif
            </div>
            </td>
            <td class="text-center"> <a class="edit-btn" href="{{ route('admin.edit', $user->id) }}">Edit
                </a>|<a class="text-danger text-decoration-none ml-1" href="#" data-toggle="modal"
                    data-target="#ModalDelete{{ $user->id }}">Delete</a>


                {{-- <form action="{{ route('admin.destroy', $user->id) }}" method="GET" class="form-delete">
                    <button class="text-danger delete-btn"
                        onclick="return confirm('Are you sure you want to Delete?');">Delete</button>
                    @csrf
                </form> --}}
            </td>
            </tr>
            @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th rowspan="1" colspan="1">#</th>
                    <th rowspan="1" colspan="1">Name</th>
                    <th rowspan="1" colspan="1">Email</th>
                    <th class="dt-body-right" rowspan="1" colspan="1">Role</th>
                    <th rospan="1" colspan="1">Status</th>
                    <th rowspan="1" colspan="1">Action</th>
                </tr>
            </tfoot>
            </table>

        </div>
    </div>

    </div>

    {{-- !-- Block Warning Modal --> --}}
    <form action="{{ route('admin.block', $user->id) }}" method="POST">
        @csrf

        <!-- Modal -->
        <div class="modal fade" id="ModalBlock{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('User Block') }}</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        You sure you want to block <b>{{ $user->name }}</b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                        @if ($user->is_blocked == 0)
                            <div class="form-group text-center">
                                <button type='submit' class="btn btn-danger active_deactive_user" value="1"
                                    name="is_blocked">Block</button>
                            </div>
                        @else
                            <div class="form-group text-center">
                                <button type='submit' class="btn btn-success  active_deactive_user" value="0"
                                    name="is_blocked">Unblock</i></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- !-- Delete Warning Modal --> --}}
    <form action="{{ route('admin.destroy', $user->id) }}" method="POST">
        @csrf

        <!-- Modal -->
        <div class="modal fade" id="ModalDelete{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('User Delete') }}</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        You sure you want to delete <b>{{ $user->name }}</b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Delete') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.7/css/autoFill.dataTables.min.css">
    <style>
        .edit-btn {
            text-decoration: none;
            color: gray;
        }

        .edit-btn:hover {
            color: black;
        }

        .delete-btn {
            border: none;
            background: none;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
        }

        .form-delete {
            margin-top: -25px;
            margin-left: 36px;
        }

        .main-footer {
            margin-top: 13px;
            background: #141414;
            color: white;
            text-align: center;
            height: 50px;
        }

    </style>
@stop

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#user_table').DataTable();
        });
    </script>

@stop
