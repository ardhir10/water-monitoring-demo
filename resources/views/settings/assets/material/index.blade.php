@extends('layouts.main')

@section('page_title',$page_title)


@section('content')
<style>
    .card-body-min {

    padding: 0.2rem;
}
</style>
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

        <div class="row row-sm mg-b-30 ">
            <div class="col-lg-6 " style="z-index:99">
                <div class="card mg-b-20 tx-white shadow animated fadeInUp"style="border-radius:40px 40px 5px 5px ;">
                    <div class="card-header bg-grandeur -white tx-medium bd-0 stx-20" style="border-radius:40px 40px 0px 0px ;">
                        <span class="pl-3 tx-24 d-block  tx-center ">Asset</span>
                    </div>
                    <div class="card-body ">
                        <div class="row row-sm">
                            <div class="col-lg-4 " style="z-index:999 ">
                                <a href="{{url('settings/asset')}}">
                                    <div class="card shadow-base card__one bd-0 ht-100p rounded-10 animated fadeInUp">
                                        <div class="card-body-min d-flex">
                                            <img src="{{asset('backend/images/icon/gateway.png')}}" class="img-fluid mg-l-10 ht-30"
                                                alt="">
                                            <div class="mg-l-10">
                                                <span class="tx-bold tx-18 d-block  tx-inverse ">All Asset</span>
                                            </div>
                                        </div><!-- card-body -->
                                    </div><!-- card -->
                                </a>
                            </div>

                            <div class="col-lg-4  " style="z-index:999 ">
                                <a href="{{url('settings/asset/category')}}">
                                    <div class="card shadow-base card__one bd-0 ht-100p rounded-10 animated fadeInUp">
                                        <div class="card-body-min d-flex">
                                            <img src="{{asset('backend/images/icon/gateway.png')}}" class="img-fluid mg-l-10 ht-30"
                                                alt="">
                                            <div class="mg-l-10">
                                                <span class="tx-bold tx-18 d-block  tx-inverse ">Category</span>
                                            </div>
                                        </div><!-- card-body -->
                                    </div><!-- card -->
                                </a>
                            </div>



                            <div class="col-lg-4  " style="z-index:999">
                                <a href="{{url('settings/asset/location')}}">
                                    <div class="card shadow-base card__one bd-0 ht-100p rounded-10 animated fadeInUp">
                                        <div class="card-body-min d-flex">
                                            <img src="{{asset('backend/images/icon/gateway.png')}}" class="img-fluid mg-l-10 ht-30"
                                                alt="">
                                            <div class="mg-l-10">
                                                <span class="tx-bold tx-18 d-block tx-inverse ">Location</span>
                                            </div>
                                        </div><!-- card-body -->
                                    </div><!-- card -->
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 " style="z-index:99">
                <div class="card mg-b-20 tx-white shadow animated fadeInUp"style="border-radius:40px 40px 5px 5px ;">
                    <div class="card-header bg-grandeur -white tx-medium bd-0 stx-20" style="border-radius:40px 40px 0px 0px ;">
                        <span class="pl-3 tx-24 d-block  tx-center ">Master Data</span>
                    </div>
                    <div class="card-body ">
                        <div class="row row-sm">
                            <div class="col-lg-4  " style="z-index:999">
                                <a href="{{url('settings/asset/type')}}">
                                    <div class="card shadow-base card__one bd-0 ht-100p rounded-10 animated fadeInUp">
                                        <div class="card-body-min d-flex">
                                            <img src="{{asset('backend/images/icon/gateway.png')}}" class="img-fluid mg-l-10 ht-30"
                                                alt="">
                                            <div class="mg-l-10">
                                                <span class="tx-bold tx-18 d-block tx-inverse ">Type</span>
                                            </div>
                                        </div><!-- card-body -->
                                    </div><!-- card -->
                                </a>
                            </div>

                            <div class="col-lg-4  " style="z-index:999">
                                <a href="{{url('settings/asset/bom')}}">
                                    <div class="card shadow-base card__one bd-0 ht-100p rounded-10 animated fadeInUp">
                                        <div class="card-body-min d-flex">
                                            <img src="{{asset('backend/images/icon/gateway.png')}}" class="img-fluid mg-l-10 ht-30"
                                                alt="">
                                            <div class="mg-l-10">
                                                <span class="tx-bold tx-18 d-block tx-inverse ">Bom</span>
                                            </div>
                                        </div><!-- card-body -->
                                    </div><!-- card -->
                                </a>
                            </div>

                            <div class="col-lg-4 " style="z-index:999">
                                <a href="{{url('settings/asset/material')}}">
                                    <div class="card shadow-base card__one bd-0 ht-100p rounded-10 animated fadeInUp">
                                        <div class="card-body-min d-flex">
                                            <img src="{{asset('backend/images/icon/gateway.png')}}" class="img-fluid mg-l-10 ht-30"
                                                alt="">
                                            <div class="mg-l-10">
                                                <span class="tx-bold tx-18 d-block tx-inverse ">Material</span>
                                            </div>
                                        </div><!-- card-body -->
                                    </div><!-- card -->
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12 mg-b-20">
                <div class="br-section-wrapper rounded-20 animated fadeInUp" style="padding: 30px 20px">
                    <div style="align">
                        <span class="tx-bold tx-18"><i class="icon ion ion-ios-people tx-22"></i> {{$page_title}}</span>
                        <a href="{{url('settings/asset/material/create') }}">
                            <button class="btn btn-sm btn-info float-right"><i
                                    class="icon ion ion-ios-plus-outline"></i>
                                New
                                Data</button>
                        </a>
                    </div>
                    <hr>
                    @if(session()->has('create'))
                    <div class="alert alert-success wd-100p">
                        {{ session()->get('create') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session()->has('update'))
                    <div class="alert alert-warning wd-100p">
                        {{ session()->get('update') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    @endif


                    @if(session()->has('delete'))
                    <div class="alert alert-danger wd-100p">
                        {{ session()->get('delete') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    @endif
                    <div class="table-wrapper ">
                        <table class="table display responsive nowrap" id="datatable1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="70%">Name</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                @endphp
                                @foreach ($materials as $material)

                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $material->name }}</td>

                                    <td>
                                        <a href="{{url('settings/asset/material/'.$material->id.'/edit/') }}">
                                            <button class="btn btn-warning btn-sm text-white">
                                                <i class="icon icon ion ion-edit"></i> Edit

                                            </button>
                                        </a>
                                        <button class="btn btn-danger btn-sm text-white"
                                            onclick="deleteData({{$material->id}})">
                                            <i class="icon icon ion ion-ios-trash-outline"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- br-pagebody -->

    @include('layouts.partials.footer')
</div><!-- br-mainpanel -->\

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection

@push('js')
<script>

    var route_url= 'material';
    var table = $('#datatable1').DataTable();
    function detailPrivileges(id) {
        $.confirm({
            title: 'Detail Privilege',
            theme : 'material',
            backgroundDismiss: true, // this will just close the modal
            content: 'url:departements/'+id,
            onContentReady: function () {
                var self = this;
                // this.setContentPrepend('<div>Prepended text</div>');
                // setTimeout(function () {
                //     self.setContentAppend('<div>Appended text after 2 seconds</div>');
                // }, 2000);
            },
            columnClass: 'medium',
        });
    }

</script>
@endpush
