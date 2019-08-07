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
                    <?php
                    function render_alert($type='status',$msg){
                        $alert_class=($type=='status')?'alert-danger':'alert-success';
                      echo "
                         <div class='alert $alert_class ' role='alert'>
                                $msg
                           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                           </button>
                         </div>
                          ";

                    }

                    ?>
                    @if (session('status') )
                       {{render_alert('status',session('status'))}}
                    @endif
                    @if (session('suggest') )
                         {{render_alert('suggest',session('suggest') )}}
                    @endif
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
                            <label for="winning_number" >{{ __('Winning Number') }} </label>
                            <input type="winning_number" name="winning_number" placeholder="eg:1234" required="true" id="winning_number" class="form-control @error('winning_number') is-invalid @enderror ">
                            @error('winning_number')
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
                  $("input#winning_number").val('').prop('readonly','readonly');
                else
                    $("input#winning_number").val('').removeAttr('readonly');
            });
        });
    </script>
@endsection
