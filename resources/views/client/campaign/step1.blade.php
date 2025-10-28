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
                        <h2 class="fs-lg fw-medium truncate me-5">Add Campaign - Step 1</h2>
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

                        <form action="{{ route('campaign.store.step', 1) }}" method="POST" id="step1Form">
                            @csrf
                            <div class="row mt-12">
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">Campaign Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                           value="{{ old('title', $campaignData['step_1']['title'] ?? '') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">Campaign Objective <span class="text-danger">*</span></label>
                                    <input type="text" name="objective" class="form-control @error('objective') is-invalid @enderror" 
                                           value="{{ old('objective', $campaignData['step_1']['objective'] ?? '') }}" required>
                                    @error('objective')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">Campaign Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                              rows="3" required>{{ old('description', $campaignData['step_1']['description'] ?? '') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">Start Date <span class="text-danger">*</span></label>
                                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" 
                                           value="{{ old('start_date', $campaignData['step_1']['start_date'] ?? '') }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">End Date <span class="text-danger">*</span></label>
                                    <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" 
                                           value="{{ old('end_date', $campaignData['step_1']['end_date'] ?? '') }}" required>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-12">
                                <div class="col-lg-8 mb-4 offset-lg-2 d-flex justify-content-end">
                                    <a href="{{ route('campaign.create') }}" class="btn btn-secondary w-24">Cancel</a>
                                    <button type="submit" class="btn btn-primary w-24 ms-2">Next</button>
                                </div>
                            </div>
                        </form>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.querySelector('input[name="start_date"]').setAttribute('min', today);
    
    // Update end date minimum when start date changes
    document.querySelector('input[name="start_date"]').addEventListener('change', function() {
        const startDate = this.value;
        const endDateInput = document.querySelector('input[name="end_date"]');
        if (startDate) {
            endDateInput.setAttribute('min', startDate);
        }
    });
});
</script>
@endsection