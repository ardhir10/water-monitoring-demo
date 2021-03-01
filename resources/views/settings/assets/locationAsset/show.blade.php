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
            <div class="col-lg-4 " style="z-index:99">
                <div class="card mg-b-20 rounded-40 tx-white shadow animated fadeInUp">
                    <div class="card-header bg-grandeur tx-white tx-medium bd-0 stx-20" style="border-radius:40px 40px 0px 0px ;">
                        <span class="pl-3 tx-24 d-block  tx-center ">Location</span>
                    </div>
                    <div class="card-body ">
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                         <p class="tx-16 tx-medium  pl-3 tx-inverse"> Country &nbsp; :<span class=" float-right pr-2 tx-17 tx-medium tx-black">{{ $location->country }}</span></p>
                                        <hr>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse ">Province &nbsp; :<span class=" float-right pr-2  tx-17  tx-medium  tx-black">{{ $location->province }}</span></p>
                                        <hr>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse ">City &nbsp; :<span class=" float-right pr-2  tx-17  tx-medium tx-black">{{ $location->city }}</span></p>
                                        <hr>
                                    </div>
                                    <hr>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse ">Postal Code &nbsp; :<span class=" float-right pr-2  tx-17 tx-medium  tx-black">{{ $location->postal_code }}</span></p>
                                        <hr>
                                    </div>
                                    <hr>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse ">Address &nbsp; :</p>
                                    </div>
                                    <hr>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                        <p class="tx-16 tx-medium  pl-3 tx-black ">{{$location->address}}</p>
                                        <hr>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 " style="z-index:99">
                <div class="card mg-b-20 rounded-40 tx-white shadow animated fadeInUp">
                    <div class="card-header bg-grandeur tx-white tx-medium bd-0 stx-20" style="border-radius: 40px 40px 0px 0px ;">
                        <span class="pl-3 tx-24 d-block  tx-center ">Maps</span>
                    </div>
                    <div class="card-body ">
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                         <p class="tx-16 tx-medium pd-l-110 tx-inverse"> Longtitude &nbsp; :<span class=" float-right pd-r-110 tx-16 tx-medium tx-inverse">Latitude &nbsp; :</span></p>
                                        <hr>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                        <p class="tx-16 tx-medium  pd-l-110 tx-black">{{$location->longtitude}}<span class=" float-right pd-r-110 tx-16 tx-medium tx-black">{{ $location->latitude }}</span></p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div><!-- br-pagebody -->

    @include('layouts.partials.footer')
</div><!-- br-mainpanel -->\

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection

