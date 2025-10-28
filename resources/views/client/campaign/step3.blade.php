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
                        <h2 class="fs-lg fw-medium truncate me-5">Add Campaign - Step 3</h2>
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
                                <button class="w-10 h-10 rounded-circle btn text-gray-600 bg-gray-200 dark-bg-dark-1">4</button>
                                <div class="w-lg-32 fs-base mt-lg-3 ms-3 mx-lg-auto text-gray-700 dark-text-gray-600">Step 4</div>
                            </div>
                            <div class="wizard__line d-none d-lg-block w-2/3 bg-gray-200 dark-bg-dark-1 position-absolute mt-5"></div>
                        </div>

                        <form action="{{ route('campaign.store.step', 3) }}" method="POST" id="step3Form">
                            @csrf
                            <div class="row mt-12">
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">Advertisement Mode <span class="text-danger">*</span></label>
                                    <select name="ads_place_type" class="form-select @error('ads_place_type') is-invalid @enderror" required>
                                        <option value="">Select Advertisement Mode</option>
                                        <option value="Banner" {{ old('ads_place_type', $campaignData['step_3']['ads_place_type'] ?? '') == 'Banner' ? 'selected' : '' }}>Banner</option>
                                        <option value="Popup" {{ old('ads_place_type', $campaignData['step_3']['ads_place_type'] ?? '') == 'Popup' ? 'selected' : '' }}>Popup</option>
                                        <option value="Video" {{ old('ads_place_type', $campaignData['step_3']['ads_place_type'] ?? '') == 'Video' ? 'selected' : '' }}>Video</option>
                                        <option value="Text" {{ old('ads_place_type', $campaignData['step_3']['ads_place_type'] ?? '') == 'Text' ? 'selected' : '' }}>Text</option>
                                    </select>
                                    @error('ads_place_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">Ads Placement <span class="text-danger">*</span></label>
                                    <select name="ads_position" class="form-select @error('ads_position') is-invalid @enderror" required>
                                        <option value="">Select Ads Placement</option>
                                        <option value="Top" {{ old('ads_position', $campaignData['step_3']['ads_position'] ?? '') == 'Top' ? 'selected' : '' }}>Top</option>
                                        <option value="Right" {{ old('ads_position', $campaignData['step_3']['ads_position'] ?? '') == 'Right' ? 'selected' : '' }}>Right</option>
                                        <option value="Bottom" {{ old('ads_position', $campaignData['step_3']['ads_position'] ?? '') == 'Bottom' ? 'selected' : '' }}>Bottom</option>
                                        <option value="Left" {{ old('ads_position', $campaignData['step_3']['ads_position'] ?? '') == 'Left' ? 'selected' : '' }}>Left</option>
                                        <option value="Center" {{ old('ads_position', $campaignData['step_3']['ads_position'] ?? '') == 'Center' ? 'selected' : '' }}>Center</option>
                                    </select>
                                    @error('ads_position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">Budget <span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select name="budget_type" class="form-select @error('budget_type') is-invalid @enderror" required>
                                                <option value="">Select Budget Type</option>
                                                <option value="Daily" {{ old('budget_type', $campaignData['step_3']['budget_type'] ?? '') == 'Daily' ? 'selected' : '' }}>Daily</option>
                                                <option value="Weekly" {{ old('budget_type', $campaignData['step_3']['budget_type'] ?? '') == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                                                <option value="Monthly" {{ old('budget_type', $campaignData['step_3']['budget_type'] ?? '') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                                <option value="Halfyearly" {{ old('budget_type', $campaignData['step_3']['budget_type'] ?? '') == 'Halfyearly' ? 'selected' : '' }}>Halfyearly</option>
                                                <option value="Yearly" {{ old('budget_type', $campaignData['step_3']['budget_type'] ?? '') == 'Yearly' ? 'selected' : '' }}>Yearly</option>
                                            </select>
                                            @error('budget_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" 
                                                   placeholder="Amount in USD" step="0.01" min="0.01" 
                                                   value="{{ old('amount', $campaignData['step_3']['amount'] ?? '') }}" required>
                                            @error('amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-12">
                                <div class="col-lg-8 mb-4 offset-lg-2 d-flex justify-content-end">
                                    <a href="{{ route('campaign.step', 2) }}" class="btn btn-secondary w-24">Back</a>
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
    // Add validation for amount field
    const amountInput = document.querySelector('input[name="amount"]');
    const form = document.getElementById('step3Form');
    
    form.addEventListener('submit', function(e) {
        const amount = parseFloat(amountInput.value);
        if (amount <= 0) {
            amountInput.classList.add('is-invalid');
            e.preventDefault();
            alert('Please enter a valid amount greater than 0.');
        } else {
            amountInput.classList.remove('is-invalid');
        }
    });
});
</script>
@endsection