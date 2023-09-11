@extends('layout.default')
@section('content')
    <div class="row">
        <a href="{{route('customer-create')}}" class="btn btn-primary col-md-2">Add</a>

        @include('partials.form-error')
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Bank Account NO</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{$customer['id']}}</td>
                        <td>{{$customer['firstname']}}</td>
                        <td>{{$customer['lastname']}}</td>
                        <td>{{$customer['email']}}</td>
                        <td>{{$customer['phone_number']}}</td>
                        <td>{{$customer['date_of_birth']}}</td>
                        <td>IR{{$customer['bank_account_number']}}</td>
                        <td>
                            <a href="{{route('customer-update', $customer['id'])}}">Edit</a> &nbsp;
                            <form action="{{route('customer-destroy', $customer['id'])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="javascript:void(0)" onclick="$(this).parent().submit()" type="submit">Delete</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
