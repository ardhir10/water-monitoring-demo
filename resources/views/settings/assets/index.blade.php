@extends('layouts.main')

@section('page_title',$page_title)


@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

<style>
    .card-body-min {

    padding: 0.2rem;
}
.jstree-themeicon-custom{
    background-size: contain !important;
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
                        <a href="{{url('settings/asset/create') }}">
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
                   <div class="col-lg-12">

                       <div class="card">
                           <div class="card-body">
                            @if(!($assets->count() != 0))
                            <img src="{{asset('backend/not-found.jpg')}}" class="mx-auto d-block" alt="" width="55%">
                            @endif
                               <div id="treeview">

                               </div>
                           </div>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>

    <!-- br-pagebody -->




    @include('layouts.partials.footer')
</div><!-- br-mainpanel -->

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script>
         var route_url = 'asset';
        $(document).ready(function () {
            var dataTree = [];
        $.ajax({
            type: 'GET',
            url: '{{ route('asset.gettree') }}',
            dataType: 'json',
            async: false,
            success: function (data) {
                dataTree = data
            },
            error: function (data) {
                $.alert('Failed Get Data!');
                console.log(data);
            }
        });
            $('#treeview').jstree({
                'core': {
                    "animation": 0,
                    "check_callback": true,
                    "themes": {
                        "stripes": true
                    },
                    'data' : dataTree
                },
                plugins: ["wholerow", "contextmenu"],
                contextmenu: {
                    items: customMenu,
                }
            }).bind("select_node.jstree", function (e, data) {
                // var href = data.node.a_attr.href;
                // document.location.href = href;
            });

            function customMenu(node) {
            // The default set of all items
            var items = {
                create: { // The "create" menu item
                    label: "Create Children",
                    action: function () {
                        var href = node.a_attr.create;
                        document.location.href = href;
                    }
                },
                detail: { // The "detail" menu item
                    label: "Detail",
                    action: function () {
                        var href = node.a_attr.show;
                        document.location.href = href;
                    }
                },
                edit: { // The "edit" menu item
                    label: "Edit",
                    action: function () {
                        var href = node.a_attr.edit;
                        document.location.href = href;
                    }
                },
                delete: { // The "delete" menu item
                    label: "Delete",
                    action: function () {
                        var id = node.id;
                        deleteData(id);
                    }
                },
            };

            if ($(node).hasClass("folder")) {
                // Delete the "delete" menu item
                delete items.deleteItem;
            }

            return items;
        }
        });
    </script>

@endpush
