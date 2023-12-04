@extends('admin.layouts')

@section('titlePage')
    Dashboard
@endsection


@section('content')
    <div class="col-sm-6 col-md stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">{{ $userCount }}</h3>
                            <p class="text-danger ml-2 mb-0 font-weight-medium">-2.4%</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-danger">
                            <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Users</h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">{{ $categoryCount }}</h3>
                            <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Categories</h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">{{ $productCount }}</h3>
                            <p class="text-success ml-2 mb-0 font-weight-medium">+11%</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Products</h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">{{ $contactCount }}</h3>
                            <p class="text-danger ml-2 mb-0 font-weight-medium">-2.4%</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-danger">
                            <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Message Clients</h6>
            </div>
        </div>
    </div>
@endsection
