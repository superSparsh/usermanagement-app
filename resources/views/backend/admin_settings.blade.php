@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
    <h1>Profile Settings</h1>
@stop

@section('content')
    <div class="col-md-12">
        @if (session('update'))
            <div class="card-body">
                <div class="row-cols-1">
                    <div class="col-lg-12">
                        <div class="alert alert-success" role="alert">
                            {!! session('update') !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="card-body">
                <div class="row-cols-1">
                    <div class="col-lg-12">
                        <div class="alert alert-danger" role="alert">
                            {!! session('error') !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Profile Details</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
                @csrf
                <div class="card-body">
                    <input type="hidden" value="{{ auth()->user()->id }}" />
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" value="{{ auth()->user()->name }}" name="name" class="form-control"
                            id="exampleInputName1" placeholder="Enter name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" value="{{ auth()->user()->email }}" name="email" class="form-control"
                            id="exampleInputEmail1" placeholder="Enter email" readonly>
                    </div>
                    {{-- <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="text" value="{{auth()->user()->password}}" class="form-control" name="password" id="exampleInputPassword1"
                            placeholder="Password" readonly>
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Confirm Password</label>
                        <input type="password" class="form-control" id="exampleInputConfirmPassword1"
                            placeholder="Confirm Password">
                    </div> --}}
                </div>
                <!-- /.card-body -->

                {{-- <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div> --}}
            </form>
        </div>
        <!-- /.card -->
    </div>
@stop
