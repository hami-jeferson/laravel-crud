@extends('layout.default')
@section('scripts')
    <script src="{{ asset('assets/js/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ asset('assets/js/form.js') }}"></script>
@stop
@section('content')
    <div class="alert alert-danger error-section" role="alert" style="display: none"></div>
    <div class="alert alert-success success-section" role="alert" style="display: none"></div>
    <form id="customer-form" action="{{route('customer.update', $customer['id'])}}" method="put">
        <div class="row">
            <div class="col-md-6">
                <label>First Name</label>
                <input type="text" class="form-control" name="firstname" value="{{$customer['firstname']}}">
            </div>
            <div class="col-md-6">
                <label>Last Name</label>
                <input type="text" class="form-control" name="lastname" value="{{$customer['lastname']}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="{{$customer['email']}}">
            </div>
            <div class="col-md-3">
                <label>Mobile</label>
                <input type="text" class="form-control" name="phone_number" value="{{$customer['phone_number']}}">
            </div>
            <div class="col-md-3">
                <label>DOB</label>
                <input type="text" class="form-control date" name="date_of_birth" value="{{$customer['date_of_birth']}}" placeholder="1990-01-01">
            </div>
            <div class="col-md-3">
                <label>Bank Account Number</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">IR</span>
                    <input type="text" class="form-control" name="bank_account_number" value="{{$customer['bank_account_number']}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="{{route('home')}}" class="btn btn-warning" style="width: 100%;margin-top: 5px;">Back</a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success" style="width: 100%;margin-top: 5px;">Update</button>
            </div>
        </div>
    </form>
@stop
