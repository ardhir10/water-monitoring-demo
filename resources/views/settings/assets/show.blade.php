@extends('layouts.main')

@section('page_title',$page_title)


@section('content')
<style>
    .card-body-min {

    padding: 0.2rem;
}
.image-detail{
    padding: 10px 15px 10px 20px;
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
                        <span class="pl-3 tx-24 d-block  tx-center ">Asset</span>
                    </div>
                    <div class="card-body ">
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                         <p class="tx-16 tx-medium  pl-3 tx-inverse">Code &nbsp; :<span class=" float-right pr-2 tx-17 tx-medium tx-black">{{ $assets->code }}</span></p>
                                        <hr>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse ">Name &nbsp; :<span class=" float-right pr-2  tx-17  tx-medium  tx-black">{{ $assets->name }}</span></p>
                                        <hr>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse ">Purchase At &nbsp; :<span class=" float-right pr-2  tx-17  tx-medium tx-black">{{ date('d-m-Y',strtotime($assets->purchase_at)) }}</span></p>
                                        <hr>
                                    </div>
                                    <hr>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse ">Purchase Price &nbsp; :<span class=" float-right pr-2  tx-17 tx-medium  tx-black">Rp.{{ $assets->purchase_price }}</span></p>
                                        <hr>
                                    </div>
                                    <hr>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse ">Status &nbsp; :<span class=" float-right pr-2  tx-17 tx-medium  tx-black"> @if ($assets->status == 1)
                                            <span class="tx-12 tx-medium badge badge-success tx-black tx-bold">ACTIVE</span>
                                            @else
                                            <span class="tx-12 tx-medium badge badge-danger tx-black tx-bold ">INACTIVE</span>
                                            @endif</span>
                                        </p>
                                        <hr>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse ">Description &nbsp; :</p>
                                    </div>
                                    <hr>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                        <p class="tx-16 tx-medium  pl-3 tx-black ">{{$assets->description}}</p>
                                        <hr>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 pd-t-60" style="z-index:99">
                <div class="card mg-b-20 rounded-40 tx-white shadow animated fadeInUp">
                    <div class="card-body ">
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="row row-sm">
                                    <div class="col-lg-6">
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse">Model &nbsp; :<span class=" float-right pr-2 tx-17 tx-medium tx-black">{{ $assets->model }}</span></p>
                                        <hr>
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse">Brand &nbsp; :<span class=" float-right pr-2 tx-17 tx-medium tx-black">{{ $assets->brand }}</span></p>
                                        <hr>
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse">Type &nbsp; :<span class=" float-right pr-2 tx-17 tx-medium tx-black">{{ $assets->type->name ?? 'N/A' }}</span></p>
                                        <hr>
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse">Category &nbsp; :<span class=" float-right pr-2 tx-17 tx-medium tx-black">{{ $assets->category->name ?? 'N/A'}}</span></p>
                                        <hr>
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse">Location &nbsp; :<span class=" float-right pr-2 tx-17 tx-medium tx-black">{{ $assets->location->country }}</span></p>
                                        <hr>
                                        <p class="tx-16 tx-medium  pl-3 tx-inverse">Asset Part Of &nbsp; :<span class=" float-right pr-2 tx-17 tx-medium tx-black">{{ $assets->parent->name ?? 'N/A'}}</span></p>
                                        <hr>
                                    </div>
                                    <div class="col-lg-6 pt-3">
                                        <p class="tx-18 tx-medium tx-center tx-inverse">Image </p>
                                        <div class="image-detail">
                                            <img  class="wd-100p  rounded-20" style=" box-shadow: -2px 13px 16px 0px rgba(0, 0, 0, 0.21);" src="{{url('backend/images/asset/'.$assets->image)}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-lg-6 " style="z-index:99">
                <div class="card mg-b-20 rounded-40 tx-white shadow animated fadeInUp">
                    <div class="card-header bg-grandeur tx-white tx-medium bd-0 stx-20" style="border-radius: 40px 40px 0px 0px ;">
                        <span class="pl-3 tx-24 d-block  tx-center ">Document Support</span>
                    </div>
                    <div class="card-body ">
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                        @if(!($assets->calibration->count() != 0))
                                        <style>
                                            .table-responsive{
                                                display: none;
                                            }
                                        </style>
                                             <img src="{{asset('backend/not-found.jpg')}}" class="mx-auto d-block" alt="" width="55%">
                                        @endif
                                        <div class="table-responsive tx-center ">
                                            <table class="table table-striped " id="">
                                                <thead class="thead-colored thead-dark ">
                                                    <th>No</th>
                                                    <th width="55%">Upload</th>
                                                    <th width="40%">Size</th>

                                                </thead>
                                                <tbody class="tx-black">
                                                    @foreach ($assets->calibration as $asset)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td> <a href="{{url('backend/images/Calibrations/'.$asset->filename)}}">{{  Illuminate\Support\Str::limit($asset->filename, 76, '...') }}</a></td>
                                                        <td>{{File::size(public_path('backend/images/Calibrations/'.$asset->filename))}} Kb</td>


                                                    </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 " style="z-index:99">
                <div class="card mg-b-20 rounded-40 tx-white shadow animated fadeInUp">
                    <div class="card-header bg-grandeur tx-white tx-medium bd-0 stx-20" style="border-radius: 40px 40px 0px 0px ;">
                        <span class="pl-3 tx-24 d-block  tx-center ">Bill Of Materials</span>
                    </div>
                    <div class="card-body ">
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="row row-sm">
                                    <div class="col-lg-12">
                                        @if(!($assets->calibration->count() != 0))
                                        <style>
                                            .table-responsive{
                                                display: none;
                                            }
                                        </style>
                                             <img src="{{asset('backend/not-found.jpg')}}" class="mx-auto d-block" alt="" width="55%">
                                        @endif
                                        <div class="table-responsive ">
                                            <table class="table table-striped " id="">
                                                <thead class="thead-colored thead-dark tx-center">
                                                    <th>No</th>
                                                    <th width="30%">Name</th>
                                                    <th width="20%">Materials</th>
                                                    <th width="30%">Description</th>
                                                </thead>
                                                <tbody class="tx-black">
                                                    @foreach ($assets->boms->all() as $bom)
                                                        <tr>
                                                            <td class="tx-center">{{ $loop->iteration}}</td>
                                                            <td>{{ $bom->bom_name }}</td>
                                                            <td class="tx-center">
                                                                <button onclick="detailMaterials({{$bom->id}})" class="btn btn-info btn-sm"><i class="ion ion-eye"></i>
                                                                    View Materials</button>
                                                            </td>
                                                            <td>{{ Illuminate\Support\Str::limit($bom->description, 20, '...') }}</td>

                                                        </tr>
                                                     @endforeach
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- br-pagebody -->
<script>
     function detailMaterials(id) {
        $.confirm({
            title: 'Detail Material',
            theme : 'material',
            backgroundDismiss: true, // this will just close the modal
            content: 'url:/' + 'settings/asset/bom/detail/' + id,
            onContentReady: function () {
                var self = this;
                // this.setContentPrepend('<div>Prepended text</div>');
                // setTimeout(function () {
                //     self.setContentAppend('<div>Appended text after 2 seconds</div>');
                // }, 2000);
            },
            columnClass: 'large',
        });
    }
</script>
    @include('layouts.partials.footer')
</div><!-- br-mainpanel -->\

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection

