@extends('master')

@section('content')
<div class="container">
    <div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
    
                <h4>Contact Us</h4>
                <a href="{{ url('/admin/contact-us') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                <br />
                <br />

               

                <form method="POST" action="{{ url('/admin/contact-us/' . $contactus->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate>
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}

                    @include ('admin.contact-us.form', ['formMode' => 'edit'])

                </form>
    </div>
    </div>
</div>
    
@endsection
