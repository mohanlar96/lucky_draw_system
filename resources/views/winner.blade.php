@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><b><h2>Winner List</h2></b> </div>
                    <div class="card-body">
                        @if (session('status') )
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
                                <th>Prize</th>
                                <th>Wining Number</th>
                                <th>Winner Name</th>
                                <th>Winner Email</th>
                                @auth
                                    @if(auth()->user()->isAdmin())
                                        <th>Admin Name </th>
                                        <th>Draw Time</th>
                                    @endif
                                @endauth
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($prizes as $prize)
                                <tr>
                                    <td>{{$prize->name}}</td>

                                    <td class="@if(isset($prize->winning_number)) text-success font-weight-bold @else text-danger @endif ">{{(isset($prize->winning_number))? sprintf("%04d",$prize->winning_number) : 'Admin not Draw yet'}}</td>

                                    <td>{{(isset($prize->winning_number))? $prize->ticket->user->name  :'' }}</td>

                                    <td>{{(isset($prize->winning_number))? $prize->ticket->user->email  :'' }}</td>
                                   @auth
                                        @if(auth()->user()->isAdmin())
                                            <td>{{($prize->admin_id)? $prize->admin->name  :'' }}</td>
                                            <td>{{(isset($prize->winning_number))? $prize->updated_at  :'' }}</td>
                                        @endif
                                    @endauth
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        @auth
                            @if(auth()->user()->isAdmin())

                                <div class="row">
                                    <div class="col-sm-6">
                                        <form method="post"  action="{{url('/admin/lucky/reset')}}" >
                                            @csrf

                                            <button type="submit" class="btn-primary btn">Reset All </button>

                                        </form>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="{{url('/admin/lucky/draw')}}" class="btn btn-danger float-right">Lucky Draw</a>
                                    </div>
                                </div>


                            @endif
                         @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
