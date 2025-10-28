@extends('client.layouts.default')

@section('content')

@include('client.alert_message')

<!-- BEGIN: Content -->
<div class="content">
    <div class="grid columns-12 gap-6">
        <div class="g-col-12 g-col-xxl-10">
            <div class="grid columns-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="g-col-12 mt-8">
                    <div class="intro-y d-flex align-items-center h-10">
                        <h2 class="fs-lg fw-medium truncate me-5">Add Campaign</h2>
                    </div>
                    <div class="intro-y box p-5 mb-5">
                        <div class="wizard d-flex flex-column flex-lg-row justify-content-center px-5 px-sm-20">
                            <div class="intro-x text-lg-center d-flex align-items-center d-lg-block flex-1 z-10">
                                <button class="w-10 h-10 rounded-circle btn btn-primary">1</button>
                                <div class="w-lg-32 fw-medium fs-base mt-lg-3 ms-3 mx-lg-auto">Step 1</div>
                            </div>
                            <div class="intro-x text-lg-center d-flex align-items-center mt-5 mt-lg-0 d-lg-block flex-1 z-10">
                                <button class="w-10 h-10 rounded-circle btn text-gray-600 bg-gray-200 dark-bg-dark-1">2</button>
                                <div class="w-lg-32 fs-base mt-lg-3 ms-3 mx-lg-auto text-gray-700 dark-text-gray-600">Step 2</div>
                            </div>
                            <div class="intro-x text-lg-center d-flex align-items-center mt-5 mt-lg-0 d-lg-block flex-1 z-10">
                                <button class="w-10 h-10 rounded-circle btn text-gray-600 bg-gray-200 dark-bg-dark-1">3</button>
                                <div class="w-lg-32 fs-base mt-lg-3 ms-3 mx-lg-auto text-gray-700 dark-text-gray-600">Step 3</div>
                            </div>
                            <div class="intro-x text-lg-center d-flex align-items-center mt-5 mt-lg-0 d-lg-block flex-1 z-10">
                                <button class="w-10 h-10 rounded-circle btn text-gray-600 bg-gray-200 dark-bg-dark-1">4</button>
                                <div class="w-lg-32 fs-base mt-lg-3 ms-3 mx-lg-auto text-gray-700 dark-text-gray-600">Step 4</div>
                            </div>
                            <div class="wizard__line d-none d-lg-block w-2/3 bg-gray-200 dark-bg-dark-1 position-absolute mt-5"></div>
                        </div>

                        <div class="row mt-12">
                            <div class="col-lg-8 mb-4 offset-lg-2 text-center">
                                <h3>Welcome to Campaign Creation</h3>
                                <p class="text-muted">Create your advertising campaign in 4 simple steps. Click "Start" to begin.</p>
                                
                                <div class="row mt-5">
                                    <div class="col-md-3 mb-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <i class="fas fa-info-circle fa-2x text-primary mb-2"></i>
                                                <h5>Step 1</h5>
                                                <p class="text-muted">Basic Information</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                                <h5>Step 2</h5>
                                                <p class="text-muted">Target Audience</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <i class="fas fa-ad fa-2x text-primary mb-2"></i>
                                                <h5>Step 3</h5>
                                                <p class="text-muted">Ad Settings</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <i class="fas fa-upload fa-2x text-primary mb-2"></i>
                                                <h5>Step 4</h5>
                                                <p class="text-muted">Upload & Submit</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-12">
                            <div class="col-lg-8 mb-4 offset-lg-2 d-flex justify-content-center">
                                <a href="{{ route('campaign.step', 1) }}" class="btn btn-primary btn-lg">Start Campaign Creation</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: General Report -->
            </div>
        </div>
    </div>
</div>
<!-- END: Content -->

@endsection

@section('footer_js')
@endsection