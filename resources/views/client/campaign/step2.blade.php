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
                        <h2 class="fs-lg fw-medium truncate me-5">Add Campaign - Step 2</h2>
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
                                <button class="w-10 h-10 rounded-circle btn text-gray-600 bg-gray-200 dark-bg-dark-1">3</button>
                                <div class="w-lg-32 fs-base mt-lg-3 ms-3 mx-lg-auto text-gray-700 dark-text-gray-600">Step 3</div>
                            </div>
                            <div class="intro-x text-lg-center d-flex align-items-center mt-5 mt-lg-0 d-lg-block flex-1 z-10">
                                <button class="w-10 h-10 rounded-circle btn text-gray-600 bg-gray-200 dark-bg-dark-1">4</button>
                                <div class="w-lg-32 fs-base mt-lg-3 ms-3 mx-lg-auto text-gray-700 dark-text-gray-600">Step 4</div>
                            </div>
                            <div class="wizard__line d-none d-lg-block w-2/3 bg-gray-200 dark-bg-dark-1 position-absolute mt-5"></div>
                        </div>

                        <form action="{{ route('campaign.store.step', 2) }}" method="POST" id="step2Form">
                            @csrf
                            <div class="row mt-12">
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">Target Age Group <span class="text-danger">*</span></label>
                                    <select name="age_group[]" class="form-select @error('age_group') is-invalid @enderror" multiple required>
                                        <option value="15-25" {{ in_array('15-25', old('age_group', $campaignData['step_2']['age_group'] ?? [])) ? 'selected' : '' }}>15 to 25</option>
                                        <option value="25-35" {{ in_array('25-35', old('age_group', $campaignData['step_2']['age_group'] ?? [])) ? 'selected' : '' }}>25 to 35</option>
                                        <option value="35-45" {{ in_array('35-45', old('age_group', $campaignData['step_2']['age_group'] ?? [])) ? 'selected' : '' }}>35 to 45</option>
                                        <option value="45-65" {{ in_array('45-65', old('age_group', $campaignData['step_2']['age_group'] ?? [])) ? 'selected' : '' }}>45 to 65</option>
                                        <option value="65-100" {{ in_array('65-100', old('age_group', $campaignData['step_2']['age_group'] ?? [])) ? 'selected' : '' }}>65 to 100</option>
                                    </select>
                                    @error('age_group')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                                    <select name="gender[]" class="form-select @error('gender') is-invalid @enderror" multiple required>
                                        <option value="Male" {{ in_array('Male', old('gender', $campaignData['step_2']['gender'] ?? [])) ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ in_array('Female', old('gender', $campaignData['step_2']['gender'] ?? [])) ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ in_array('Other', old('gender', $campaignData['step_2']['gender'] ?? [])) ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">Region <span class="text-danger">*</span></label>
                                    <select name="region[]" class="form-select @error('region') is-invalid @enderror" multiple required>
                                        <option value="Asia" {{ in_array('Asia', old('region', $campaignData['step_2']['region'] ?? [])) ? 'selected' : '' }}>Asia</option>
                                        <option value="Europe" {{ in_array('Europe', old('region', $campaignData['step_2']['region'] ?? [])) ? 'selected' : '' }}>Europe</option>
                                        <option value="North America" {{ in_array('North America', old('region', $campaignData['step_2']['region'] ?? [])) ? 'selected' : '' }}>North America</option>
                                        <option value="South America" {{ in_array('South America', old('region', $campaignData['step_2']['region'] ?? [])) ? 'selected' : '' }}>South America</option>
                                        <option value="Africa" {{ in_array('Africa', old('region', $campaignData['step_2']['region'] ?? [])) ? 'selected' : '' }}>Africa</option>
                                        <option value="Oceania" {{ in_array('Oceania', old('region', $campaignData['step_2']['region'] ?? [])) ? 'selected' : '' }}>Oceania</option>
                                    </select>
                                    @error('region')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">Country <span class="text-danger">*</span></label>
                                    <select name="country[]" class="form-select @error('country') is-invalid @enderror" multiple required>
                                        <option value="India" {{ in_array('India', old('country', $campaignData['step_2']['country'] ?? [])) ? 'selected' : '' }}>India</option>
                                        <option value="Sri Lanka" {{ in_array('Sri Lanka', old('country', $campaignData['step_2']['country'] ?? [])) ? 'selected' : '' }}>Sri Lanka</option>
                                        <option value="Australia" {{ in_array('Australia', old('country', $campaignData['step_2']['country'] ?? [])) ? 'selected' : '' }}>Australia</option>
                                        <option value="United States" {{ in_array('United States', old('country', $campaignData['step_2']['country'] ?? [])) ? 'selected' : '' }}>United States</option>
                                        <option value="United Kingdom" {{ in_array('United Kingdom', old('country', $campaignData['step_2']['country'] ?? [])) ? 'selected' : '' }}>United Kingdom</option>
                                    </select>
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">State <span class="text-danger">*</span></label>
                                    <select name="state[]" class="form-select @error('state') is-invalid @enderror" multiple required>
                                        <option value="Rajasthan" {{ in_array('Rajasthan', old('state', $campaignData['step_2']['state'] ?? [])) ? 'selected' : '' }}>Rajasthan</option>
                                        <option value="Andhra Pradesh" {{ in_array('Andhra Pradesh', old('state', $campaignData['step_2']['state'] ?? [])) ? 'selected' : '' }}>Andhra Pradesh</option>
                                        <option value="Arunachal Pradesh" {{ in_array('Arunachal Pradesh', old('state', $campaignData['step_2']['state'] ?? [])) ? 'selected' : '' }}>Arunachal Pradesh</option>
                                        <option value="Maharashtra" {{ in_array('Maharashtra', old('state', $campaignData['step_2']['state'] ?? [])) ? 'selected' : '' }}>Maharashtra</option>
                                        <option value="Karnataka" {{ in_array('Karnataka', old('state', $campaignData['step_2']['state'] ?? [])) ? 'selected' : '' }}>Karnataka</option>
                                    </select>
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-8 mb-4 offset-lg-2">
                                    <label class="form-label">City <span class="text-danger">*</span></label>
                                    <select name="city[]" class="form-select @error('city') is-invalid @enderror" multiple required>
                                        <option value="Jaipur" {{ in_array('Jaipur', old('city', $campaignData['step_2']['city'] ?? [])) ? 'selected' : '' }}>Jaipur</option>
                                        <option value="Jodhpur" {{ in_array('Jodhpur', old('city', $campaignData['step_2']['city'] ?? [])) ? 'selected' : '' }}>Jodhpur</option>
                                        <option value="Udaipur" {{ in_array('Udaipur', old('city', $campaignData['step_2']['city'] ?? [])) ? 'selected' : '' }}>Udaipur</option>
                                        <option value="Mumbai" {{ in_array('Mumbai', old('city', $campaignData['step_2']['city'] ?? [])) ? 'selected' : '' }}>Mumbai</option>
                                        <option value="Delhi" {{ in_array('Delhi', old('city', $campaignData['step_2']['city'] ?? [])) ? 'selected' : '' }}>Delhi</option>
                                    </select>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-12">
                                <div class="col-lg-8 mb-4 offset-lg-2 d-flex justify-content-end">
                                    <a href="{{ route('campaign.step', 1) }}" class="btn btn-secondary w-24">Back</a>
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
    // Add validation for multi-select fields
    const form = document.getElementById('step2Form');
    const requiredSelects = form.querySelectorAll('select[required]');
    
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        requiredSelects.forEach(function(select) {
            if (select.selectedOptions.length === 0) {
                select.classList.add('is-invalid');
                isValid = false;
            } else {
                select.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Please select at least one option for each required field.');
        }
    });
});
</script>
@endsection