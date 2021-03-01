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
                <img src="{{asset('backend/images/icon/departement.png')}}" class="ht-50 " alt="">
                <h4 class="mg-b-0 mg-t-10 mg-l-10 " style="   letter-spacing: 1px;">{{$page_title}}</h4>
            </div>
            <div class="row row-sm">
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12 mg-b-20">
                <div class="br-section-wrapper rounded-20 animated fadeInUp" style="padding: 30px 20px">
                    <div style="align">
                        <span class="tx-bold tx-18">{{$page_title}}</span>
                        {{-- <a href="{{url('departements/create')}}"> <button
                            class="btn btn-sm btn-danger float-right"><i class="icon ion ion-ios-plus-outline"></i>
                            New
                            Data</button>
                        </a> --}}
                        <hr>
                        <form method="POST" action="{{ route('asset.update',$assets->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="row row-sm">
                                <div class="col-lg-6">
                                    <div class="row row-sm">
                                        <div class="col-lg-5">
                                            <div class="form-group ">
                                                <label for="">Code</label>
                                                <input
                                                    class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                                    type="text" name="code" placeholder="input category code"
                                                    value="{{ $assets->code }}">
                                                @if ($errors->has('code'))
                                                <small class="text-danger">{{ $errors->first('code') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group ">
                                                <label for="">Name</label>
                                                <input
                                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                    type="text" name="name" placeholder="input category name"
                                                    value="{{ $assets->name }}">
                                                @if ($errors->has('name'))
                                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-sm">
                                        <div class="col-lg-5">
                                            <div class="form-group  " id="datepicker-date-area">
                                                <label>Purchase At</label>
                                                <input type="text" name="purchase_at" id="purchase_at"
                                                    value="{{date('d-m-Y', strtotime( $assets->purchase_at)) }}"
                                                    autocomplete="off" class="datepicker form-control time" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-7">
                                            <div class="form-group ">
                                                <label for="">Purchase Price</label>
                                                <input
                                                    class="form-control{{ $errors->has('purchase_price') ? ' is-invalid' : '' }}"
                                                    type="number" name="purchase_price"
                                                    placeholder="input category purchase_price"
                                                    value="{{ $assets->purchase_price }}">
                                                @if ($errors->has('purchase_price'))
                                                <small
                                                    class="text-danger">{{ $errors->first('purchase_price') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Description <small>(Optional)</small></label>
                                        <textarea name="description" class="form-control" id="" cols="30"
                                            rows="3">{{ $assets->description }}</textarea>
                                    </div>


                                    <div class="row row-sm">
                                        <div class="col-lg-6">
                                            <div class="form-group ">
                                                <label for="">Model</label>
                                                <input
                                                    class="form-control{{ $errors->has('model') ? ' is-invalid' : '' }}"
                                                    type="text" name="model" placeholder="input category model"
                                                    value="{{ $assets->model }}">
                                                @if ($errors->has('model'))
                                                <small class="text-danger">{{ $errors->first('model') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group ">
                                                <label for="">Brand</label>
                                                <input
                                                    class="form-control{{ $errors->has('brand') ? ' is-invalid' : '' }}"
                                                    type="text" name="brand" placeholder="input category brand"
                                                    value="{{ $assets->brand }}">
                                                @if ($errors->has('brand'))
                                                <small class="text-danger">{{ $errors->first('brand') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-sm">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Category</label>
                                                <select
                                                    class=" selectpicker form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                                                    name="category_id" id="">
                                                    <option value="" hidden>-Pilih Category-</option>
                                                    @foreach ($categorys as $category)
                                                    <option value="{{$category->id}}"
                                                        {{ (old('category_id') ?? $assets->category_id)== $category->id ? 'selected': '' }}>
                                                        {{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Asset Part Of</label>
                                                <select
                                                    class="selectpicker form-control{{ $errors->has('asset_part_of') ? ' is-invalid' : '' }}"
                                                    name="asset_part_of" id="">
                                                    <option disabled selected>-Pilih Asset-</option>
                                                    @foreach ($assetss as $asset)
                                                    @if ($assets->id != $asset->id && $assets->id !=
                                                    $asset->asset_part_of)
                                                    <option value="{{$asset->id}}"
                                                        {{ (old('asset_part_of') ?? $assets->asset_part_of)== $asset->id ? 'selected': '' }}>
                                                        {{$asset->name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-sm">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Location</label>
                                                <select
                                                    class="selectpicker form-control{{ $errors->has('location_id') ? ' is-invalid' : '' }}"
                                                    name="location_id" id="">
                                                    <option value="" hidden>-Pilih Location-</option>
                                                    @foreach ($locations as $location)
                                                    <option value="{{$location->id}}"
                                                        {{ (old('location_id') ?? $assets->location_id)== $location->id ? 'selected': '' }}>
                                                        {{$location->country}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Type</label>
                                                <select
                                                    class="selectpicker form-control{{ $errors->has('type_id') ? ' is-invalid' : '' }}"
                                                    name="type_id" id="">
                                                    <option value="" hidden>-Pilih Type-</option>
                                                    @foreach ($types as $type)
                                                    <option value="{{$type->id}}"
                                                        {{ (old('type_id') ?? $asset->type_id)== $type->id ? 'selected': '' }}>
                                                        {{$type->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="">Image</label>
                                        <br>
                                        <img height="100" class="mg-b-10"
                                            src="{{url('backend/images/asset/'.$assets->image)}}" alt="">
                                        <br>

                                        <input class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                            type="file" name="image" value="{{old('image')}}">
                                        @if ($errors->has('image'))
                                        <small class="text-danger">{{ $errors->first('image') }}</small>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select class="selectpicker form-control" name="status">
                                            <option>-- PILIH STATUS --</option>
                                            <option value="true"
                                                {{ (old('status') ?? $assets->status)== 1 ? 'selected': '' }}>ACTIVE
                                            </option>
                                            <option value="false"
                                                {{ (old('status') ?? $assets->status)== 0 ? 'selected': '' }}>INACTIVE
                                            </option>
                                        </select>
                                    </div>

                                    <p class="text-center">Bill Of Materials</p>
                                    <hr>
                                    <div class="form-group has-danger {{ $errors->has('boms') ? ' has-danger' : '' }}">
                                        <label for="">Bill Of boms</label>
                                        <br>
                                        <small>Select All</small>
                                        <input type="checkbox" id="checkbox">
                                        <select class="form-control select2 " name="boms[]" id="e1"
                                            data-placeholder="Choose one (with optgroup)" multiple>
                                            {{-- <option label="Choose one"></option> --}}
                                            @foreach ($boms as $bom)

                                                <option value="{{$bom->id}}">{{$bom->bom_name}}</option>

                                            @endforeach
                                        </select>
                                        @if ($errors->has('name'))
                                        <small class="text-danger">{{ $errors->first('boms') }}</small>
                                        @endif
                                    </div>

                                    <p class="text-center">Document</p>
                                    <hr>
                                    <div class="form-group increment">
                                        <div class="test">
                                            <div class="input-group">
                                                <input class="form-control mt-1{{ $errors->has('filename') ? ' is-invalid' : '' }}"  type="file" name="filename[]" value="{{old('filename')}}">
                                                <div class="input-group-append">
                                                    <button type="button"  class="btn btn-outline-primary btn-add">
                                                        <i class="fas fa-plus-square"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clone invisible">
                                        <div class="test">
                                            <div class="input-group mt-2">
                                                <input class="form-control mt-1{{ $errors->has('filename') ? ' is-invalid' : '' }}"  type="file" name="filename[]" value="{{old('filename')}}">
                                                <div class="input-group-append">
                                                    <button type="button"  class="btn btn-outline-danger btn-remove">
                                                        <i class="fas fa-minus-square"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit"><i class="far fa-save"></i> Save</button>
                                <a href="{{ url('settings/asset') }}"><button class="btn btn-danger" type="button"><i
                                            class="far fa-arrow-alt-circle-left"></i> Cancel</button></a>
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
            format: "dd-mm-yyyy",
            startView: 2,
            minViewMode: 0,
            language: "id",
            daysOfWeekHighlighted: "0",
            autoclose: true,
            todayHighlight: true,
            toggleActive: true,
            container: '#datepicker-date-area'
        });

        $(function () {
            bsCustomFileInput.init();
        });

        $(document).ready(function () {
            $(".btn-add").click(function () {
                let markup = $(".invisible").html();
                $(".increment").append(markup);
            });
            $("body").on("click", ".btn-remove", function () {
                $(this).parents(".test").remove();
            })
        });

        $("#e1").select2();
    $("#checkbox").click(function () {
        if ($("#checkbox").is(':checked')) {
            $("#e1 > option").prop("selected", "selected");
            $("#e1").trigger("change");
        } else {
            $("#e1 > option").removeAttr("selected");
            $("#e1").val("");
            $("#e1").trigger("change");
        }
    });

    $("#button").click(function () {
        alert($("#e1").val());
    });

    $("select").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);
        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });


    // SET VALUE SELECT 2
    $("#e1").val([
        @foreach ($assets->boms->all() as $privilege_selected)
            {{$privilege_selected->id.',' }}
        @endforeach
    ]);

    </script>
    @endpush

    @include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection

<
