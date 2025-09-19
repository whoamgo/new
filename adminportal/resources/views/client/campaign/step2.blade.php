@extends('client.layouts.default')

@section('content')
@include('client.alert_message')

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Add Campaign - Step 2 of 4</h5>
        <div>
            <span class="badge bg-success">1</span>
            <span class="badge bg-primary">2</span>
            <span class="badge bg-secondary">3</span>
            <span class="badge bg-secondary">4</span>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('client.campaign.step2.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Target Age Group</label>
                <select name="age_group[]" class="form-select" multiple>
                    @php $ageOptions = ['15-25','25-35','35-45','45-65','65-100'];
                    $selectedAges = old('age_group', isset($campaign->age_group) ? explode(',', $campaign->age_group) : []);
                    @endphp
                    @foreach($ageOptions as $option)
                        <option value="{{ $option }}" {{ in_array($option, $selectedAges) ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                @php $genders = ['Male','Female','Other'];
                $selectedGenders = old('gender', isset($campaign->gender) ? explode(',', $campaign->gender) : []);
                @endphp
                <select name="gender[]" class="form-select" multiple>
                    @foreach($genders as $g)
                        <option value="{{ $g }}" {{ in_array($g, $selectedGenders) ? 'selected' : '' }}>{{ $g }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Region</label>
                    <input type="text" class="form-control" name="region" value="{{ old('region', $campaign->region ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Country</label>
                    <input type="text" class="form-control" name="country" value="{{ old('country', $campaign->country ?? '') }}">
                </div>
            </div>
            <div class="row g-3 mt-1">
                <div class="col-md-6">
                    <label class="form-label">State</label>
                    <input type="text" class="form-control" name="state" value="{{ old('state', $campaign->state ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">City</label>
                    <input type="text" class="form-control" name="city" value="{{ old('city', $campaign->city ?? '') }}">
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('client.campaign.step1.show') }}" class="btn btn-outline-secondary">Back</a>
                <button type="submit" class="btn btn-primary ms-2">Next</button>
            </div>
        </form>
    </div>
</div>
@endsection

