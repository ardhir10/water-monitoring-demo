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
                        <form method="POST" action="{{ route('bom.store') }}">
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
                                <label for="">Bom Name</label>
                                <input class="form-control{{ $errors->has('bom_name') ? ' is-invalid' : '' }}" type="text" name="bom_name"
                            placeholder="input Bom Name" value="{{old('bom_name')}}">
                                @if ($errors->has('bom_name'))
                                    <small class="text-danger">{{ $errors->first('bom_name') }}</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control"  cols="30" rows="3">{{old('description')}}</textarea>
                            </div>

                            <div class="form-group has-danger {{ $errors->has('materials') ? ' has-danger' : '' }}">
                                <label for="">Materials</label>
                                <br>
                                <small>Select All</small>
                                <input type="checkbox" id="checkbox">
                                <select class="form-control select2 " name="materials[]" id="e1"
                                    data-placeholder="Choose one (with optgroup)" multiple>
                                    {{-- <option label="Choose one"></option> --}}
                                    @foreach ($materials as $material)
                                    <option value="{{$material->id}}"
                                    @if (old('materials') == $material->id)
                                        {{ 'selected:selected' }}
                                    @endif
                                    >

                                    {{$material->name}}</option>

                                    @endforeach
                                </select>
                                @if ($errors->has('name'))
                                    <small class="text-danger">{{ $errors->first('materials') }}</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit"><i class="far fa-save"></i>
                                    Save</button>
                                <a href="{{ url('settings/asset/bom') }}"><button class="btn btn-danger" type="button">
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
    </script>

@endpush

    @include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection

