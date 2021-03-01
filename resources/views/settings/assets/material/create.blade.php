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
                        {{-- <a href="{{url('departements/create')}}"> <button
                            class="btn btn-sm btn-danger float-right"><i class="icon ion ion-ios-plus-outline"></i>
                            New
                            Data</button>
                        </a> --}}
                        <hr>
                        <form method="POST" action="{{ route('material.store') }}">
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
                                <label for="">Name</label>
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name"
                            placeholder="input material Name" value="{{old('name')}}">
                                @if ($errors->has('name'))
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @endif
                            </div>

                            <div class="row row-sm">
                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="">Model</label>
                                        <input class="form-control{{ $errors->has('model') ? ' is-invalid' : '' }}" type="text" name="model" placeholder="input category model" value="{{old('model')}}">
                                        @if ($errors->has('model'))
                                            <small class="text-danger">{{ $errors->first('model') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="">Brand</label>
                                        <input class="form-control{{ $errors->has('brand') ? ' is-invalid' : '' }}" type="text" name="brand" placeholder="input category brand" value="{{old('brand')}}">
                                        @if ($errors->has('brand'))
                                            <small class="text-danger">{{ $errors->first('brand') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row row-sm">
                                <div class="col-lg-6">
                                    <div class="form-group  " id="datepicker-date-area">
                                        <label>Purchase At</label>
                                        <input type="text" name="purchase_at" id="purchase_at" value="{{old('purchase_at')}}"
                                            autocomplete="off" class="datepicker form-control time" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="">Purchase Price</label>
                                        <input class="form-control{{ $errors->has('purchase_price') ? ' is-invalid' : '' }}" type="number" name="purchase_price" placeholder="input category purchase_price" value="{{old('purchase_price')}}">
                                        @if ($errors->has('purchase_price'))
                                            <small class="text-danger">{{ $errors->first('purchase_price') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Type</label>
                                <select class=" form-control{{ $errors->has('type_id') ? ' is-invalid' : '' }}"
                                    name="type_id" id="">
                                    <option value="" hidden>-Pilih Type-</option>
                                    @foreach ($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control"  cols="30" rows="3">{{old('description')}}</textarea>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit"><i class="far fa-save"></i>
                                    Save</button>
                                <a href="{{ url('settings/asset/material') }}"><button class="btn btn-danger" type="button">
                                    <i class="far fa-arrow-alt-circle-left"></i> Cancel</button>
                                </a>
                            </div>
                        </form>
                    </div>
                    <hr>
                </div>
            </div>
        </div>

    </div><!-- br-pagebody -->

 @push('js')
    <script>

        var table = $('.datatable').DataTable();
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            startView: 2,
            minViewMode: 0,
            language: "id",
            daysOfWeekHighlighted: "0",
            autoclose: true,
            todayHighlight: true,
            toggleActive: true,
            container: '#datepicker-date-area'
        });

    </script>
@endpush

    @include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection

