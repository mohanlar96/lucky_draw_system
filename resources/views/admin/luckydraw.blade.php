@extends('layouts.app')

@section('cdn')
    <script src="{{ asset('js/jquery.js') }}" defer></script>

@endsection
@section('content')

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Lucky Draw Pannel  </div>
                <div class="card-body">
                    <form action="/admin/lucky/draw" method="post" >
                        @csrf

                        <div class="form-group">
                            <label for="prize" >{{ __('Prize Type') }} <span style="color:red">*</span></label>
                                <select required name="prize" class="form-control @error('prize') is-invalid @enderror " id="prize">
                                    <option value=""> - -Please Select - -</option>
                                    @foreach($prizes as $prize)
                                        <option value="{{$prize->id}}"> {{$prize->name}}</option>
                                    @endforeach
                                </select>
                                @error('prize')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="generate" >{{ __('Generate Randomly') }} <span style="color:red">*</span></label>
                            <select name="generate" class="form-control @error('generate') is-invalid @enderror " id="generate">
                                <option value="0" selected> No</option>
                                <option value="1"> Yes</option>
                            </select>

                            @error('generate')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="number" >{{ __('Winning Number') }} </label>
                            <input type="number" name="number" placeholder="eg:1234" required="true" id="number" class="form-control @error('number') is-invalid @enderror ">
                            @error('number')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Draw</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{asset('js/jquery.js')}}" ></script>
    <script>
        $(function(){

            $("select#generate").on('change',function(){

                var prize= $(this).val();

                if(prize==1)
                  $("input#number").val('').prop('readonly','readonly');
                else
                    $("input#number").val('').removeAttr('readonly');


            });








        });
    </script>
@endsection
