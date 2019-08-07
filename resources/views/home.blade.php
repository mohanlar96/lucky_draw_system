@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>{{Auth::user()->name}}</b>, Your Lucky Draw Tickets List </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <ol type="1">
                        @foreach($tickets as $ticket)
                            <li>{{sprintf("%04d",$ticket->number)}}</li>
                        @endforeach

                    </ol>

                        <form method="POST" action="{{ url('/user/draw') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Take One Ticket') }}</label>

                                <div class="col-md-6">
                                    <input id="number" type="number"  maxlength="4" placeholder="eg:2343" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" required autocomplete="email" autofocus>

                                    @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

                            <div class="row form-group">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Take') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
