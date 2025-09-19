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
                        <h2 class="fs-lg fw-medium truncate me-5">Add Campaign - Step 4</h2>
                    </div>
                    <div class="intro-y box p-5 mb-5">
                        <div class="wizard d-flex flex-column flex-lg-row justify-content-center px-5 px-sm-20">
                            <div class="intro-x text-lg-center d-flex align-items-center d-lg-block flex-1 z-10">
                                <button class="w-10 h-10 rounded-circle btn btn-primary">1</button>
                                <div class="w-lg-32 fw-medium fs-base mt-lg-3 ms-3 mx-lg-auto">Step 1</div>
                            </div>
                            <div class="intro-x text-lg-center d-flex align-items-center mt-5 mt-lg-0 d-lg-block flex-1 z-10">
                                <button class="w-10 h-10 rounded-circle btn btn-primary">2</button>
                                <div class="w-lg-32 fs-base mt-lg-3 ms-3 mx-lg-auto text-gray-700 dark-text-gray-600">Step 2</div>
                            </div>
                            <div class="intro-x text-lg-center d-flex align-items-center mt-5 mt-lg-0 d-lg-block flex-1 z-10">
                                <button class="w-10 h-10 rounded-circle btn btn-primary">3</button>
                                <div class="w-lg-32 fs-base mt-lg-3 ms-3 mx-lg-auto text-gray-700 dark-text-gray-600">Step 3</div>
                            </div>
                            <div class="intro-x text-lg-center d-flex align-items-center mt-5 mt-lg-0 d-lg-block flex-1 z-10">
                                <button class="w-10 h-10 rounded-circle btn btn-primary">4</button>
                                <div class="w-lg-32 fs-base mt-lg-3 ms-3 mx-lg-auto text-gray-700 dark-text-gray-600">Step 4</div>
                            </div>
                            <div class="wizard__line d-none d-lg-block w-2/3 bg-gray-200 dark-bg-dark-1 position-absolute mt-5"></div>
                        </div>

                        <form action="{{ route('campaign.store.step', 4) }}" method="POST" enctype="multipart/form-data" id="step4Form">
                            @csrf
                            <div class="row mt-12">
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">Ad File Upload <span class="text-danger">*</span></label>
                                    <input type="file" name="ads_file" class="form-control @error('ads_file') is-invalid @enderror" 
                                           accept="image/*" required>
                                    <div class="form-help justify-content-end d-flex">The maximum file upload size is 5 MB.</div>
                                    @error('ads_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">Call-to-Action Link <span class="text-danger">*</span></label>
                                    <input type="url" name="action_url" class="form-control @error('action_url') is-invalid @enderror" 
                                           placeholder="https://example.com" 
                                           value="{{ old('action_url', $campaignData['step_4']['action_url'] ?? '') }}" required>
                                    @error('action_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Campaign Summary -->
                            <div class="row mt-12">
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <h4 class="mb-3">Campaign Summary</h4>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong>Title:</strong> {{ $campaignData['step_1']['title'] ?? 'N/A' }}<br>
                                                    <strong>Objective:</strong> {{ $campaignData['step_1']['objective'] ?? 'N/A' }}<br>
                                                    <strong>Start Date:</strong> {{ $campaignData['step_1']['start_date'] ?? 'N/A' }}<br>
                                                    <strong>End Date:</strong> {{ $campaignData['step_1']['end_date'] ?? 'N/A' }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Age Group:</strong> {{ implode(', ', $campaignData['step_2']['age_group'] ?? []) }}<br>
                                                    <strong>Gender:</strong> {{ implode(', ', $campaignData['step_2']['gender'] ?? []) }}<br>
                                                    <strong>Budget:</strong> ${{ $campaignData['step_3']['amount'] ?? '0' }} {{ $campaignData['step_3']['budget_type'] ?? '' }}<br>
                                                    <strong>Ad Type:</strong> {{ $campaignData['step_3']['ads_place_type'] ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-12">
                                <div class="col-lg-8 mb-4 offset-lg-2 d-flex justify-content-end">
                                    <a href="{{ route('campaign.step', 3) }}" class="btn btn-secondary w-24">Back</a>
                                    <button type="submit" class="btn btn-success w-24 ms-2">Submit Campaign</button>
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
    const fileInput = document.querySelector('input[name="ads_file"]');
    const form = document.getElementById('step4Form');
    
    // File size validation
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const fileSize = file.size / 1024 / 1024; // Convert to MB
            if (fileSize > 5) {
                this.classList.add('is-invalid');
                alert('File size must be less than 5 MB.');
                this.value = '';
            } else {
                this.classList.remove('is-invalid');
            }
        }
    });
    
    // Form validation
    form.addEventListener('submit', function(e) {
        const file = fileInput.files[0];
        if (!file) {
            fileInput.classList.add('is-invalid');
            e.preventDefault();
            alert('Please select a file to upload.');
        }
    });
});
</script>
@endsection