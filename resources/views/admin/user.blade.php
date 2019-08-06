@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Users And Their Winner Number   </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Lucky Draw Tickets' Number </th>
                            <th>Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}} </td>
                                <td>
                                    @foreach( $user->tickets as $i=> $ticket )

                                            <b>{{$ticket->number}} </b>

                                        {{($i+1  === count($user->tickets))? '' : '&'}}


                                    @endforeach
                                </td>
                                <td>{{$user->type}} </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <form method="post"  action="{{url('admin/user/reset')}}" >
                        @csrf

                        <button type="submit" class="btn-primary btn">Reset Lucky Draw Ticket  </button>

                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
