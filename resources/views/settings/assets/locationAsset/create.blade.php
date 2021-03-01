@extends('layouts.main')

@section('page_title',$page_title)

@section('css')
<style>
    .select2-results__option[aria-selected=true] {
        display: none;
    }

</style>

@endsection

@section('content')
<div class="br-mainpanel">


    <div class="br-pagebody">
        <div class=" text-white rounded-20 pd-t-20 mg-t-50 mg-b-30">
            <div class="d-flex  bg-royal rounded-20 pd-10 text-white wd-300 animated fadeInLeft"
                style="margin-top: -40px;  width:fit-content;  box-shadow: -2px 13px 16px 0px rgba(0, 0, 0, 0.21);">
                <img src="{{asset('backend/images/icon/departement.png')}}" class="ht-50" alt="">
                <h4 class="mg-b-0 mg-t-10 mg-l-10 " style="   letter-spacing: 1px;">{{$page_title}}</h4>
            </div>
            <div class="row row-sm">
            </div>
        </div>
        <div class="row">

            <div class="col-lg-6 mg-b-20">
                <div class="br-section-wrapper rounded-20 animated fadeInUp" style="padding: 30px 20px">
                    <div style="align">
                        <span class="tx-bold tx-18">{{$page_title}}</span>
                        <hr>
                        <form method="POST" action="{{ route('location.store') }}">
                            @csrf
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif


                            <div class="form-group ">
                                <label for="">Country</label>
                                <input class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                                    type="text" name="country" placeholder="input Country" value="{{old('country')}}">
                                @if ($errors->has('country'))
                                <small class="text-danger">{{ $errors->first('country') }}</small>
                                @endif
                            </div>

                            <div class="form-group ">
                                <label for="">Province</label>
                                <input class="form-control{{ $errors->has('province') ? ' is-invalid' : '' }}"
                                    type="text" name="province" placeholder="input Province"
                                    value="{{old('province')}}">
                                @if ($errors->has('province'))
                                <small class="text-danger">{{ $errors->first('province') }}</small>
                                @endif
                            </div>

                            <div class="form-group ">
                                <label for="">City</label>
                                <input class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" type="text"
                                    name="city" placeholder="input City" value="{{old('city')}}">
                                @if ($errors->has('city'))
                                <small class="text-danger">{{ $errors->first('city') }}</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="">Address </label>
                                <textarea name="address" class="form-control" id="" cols="30"
                                    rows="3">{{old('address')}}</textarea>
                            </div>

                            <div class="form-group ">
                                <label for="">Postal Code</label>
                                <input class="form-control{{ $errors->has('postal_code') ? ' is-invalid' : '' }}"
                                    type="text" name="postal_code" placeholder="input Postal Code"
                                    value="{{old('postal_code')}}">
                                @if ($errors->has('postal_code'))
                                <small class="text-danger">{{ $errors->first('postal_code') }}</small>
                                @endif
                            </div>

                            <div class="form-group ">
                                <label for="">Longtitude</label>
                                <input class="form-control"
                                    type="text" name="longtitude" placeholder="input Longtitude"
                                    value="{{old('longtitude')}}">
                            </div>

                            <div class="form-group ">
                                <label for="">Latitude</label>
                                <input class="form-control"
                                    type="text" name="latitude" placeholder="input Latitude"
                                    value="{{old('latitude')}}">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit"><i class="far fa-save"></i>
                                    Save</button>
                                <a href="{{ url('settings/asset/location') }}"><button class="btn btn-danger"
                                        type="button"><i class="far fa-arrow-alt-circle-left"></i> Cancel</button></a>

                            </div>
                        </form>
                    </div>
                    <hr>

                </div>

            </div>

        </div>

    </div><!-- br-pagebody -->

    @include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection
