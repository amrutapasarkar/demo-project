
@extends('master')

@section('title', 'Edit user page')

@section('content')
<div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit User</h2>
                </div>
                <div class="pull-right"><br>
                    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                </div>
            </div>
        </div>
        {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>First name:</strong>
                    {!! Form::text('first_name', null, array('placeholder' => 'First Name','class' => 'form-control')) !!}
                </div>
                @if ($errors->has('first_name'))
            <span class="error" style="color:red;">{{ $errors->first('first_name'),"" }}</span>
            @endif
            </div>
            
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Last name:</strong>
                {!! Form::text('last_name', null, array('placeholder' => 'last Name','class' => 'form-control')) !!}
            </div>
            @if ($errors->has('last_name'))
            <span class="error" style="color:red;">{{ $errors->first('last_name'),"" }}</span>
        @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            </div>
            @if ($errors->has('email'))
            <span class="error" style="color:red;">{{ $errors->first('email'),"" }}</span>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
            </div>
            @if ($errors->has('password'))
            <span class="error" style="color:red;">{{ $errors->first('password'),"" }}</span>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
            </div>
            @if ($errors->has('confirm-password'))
            <span class="error" style="color:red;">{{ $errors->first('confirm-password'),"" }}</span>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
            </div>
            @if ($errors->has('roles'))
            <span class="error" style="color:red;">{{ $errors->first('roles'),"" }}</span>
            @endif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>
@endsection