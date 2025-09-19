@extends('client.layouts.default')

@section('content')
@include('client.alert_message')

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Add Campaign - Step 3 of 4</h5>
        <div>
            <span class="badge bg-success">1</span>
            <span class="badge bg-success">2</span>
            <span class="badge bg-primary">3</span>
            <span class="badge bg-secondary">4</span>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('client.campaign.step3.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Advertisement Mode</label>
                @php $modes = ['Banner','Video','Interstitial']; @endphp
                <select class="form-select" name="ads_place_type">
                    @foreach($modes as $mode)
                        <option value="{{ $mode }}" {{ old('ads_place_type', $campaign->ads_place_type ?? '') === $mode ? 'selected' : '' }}>{{ $mode }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Ads Placement</label>
                @php $positions = ['Top','Right','Bottom','Left','Center']; @endphp
                <select class="form-select" name="ads_position">
                    @foreach($positions as $pos)
                        <option value="{{ $pos }}" {{ old('ads_position', $campaign->ads_position ?? '') === $pos ? 'selected' : '' }}>{{ $pos }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Budget</label>
                <div class="d-flex gap-2">
                    @php $budgetTypes = ['Daily','Weekly','Monthly','Halfyearly','Yearly']; @endphp
                    <select class="form-select" style="max-width: 200px" name="budget_type">
                        @foreach($budgetTypes as $bt)
                            <option value="{{ $bt }}" {{ old('budget_type', $campaign->budget_type ?? '') === $bt ? 'selected' : '' }}>{{ $bt }}</option>
                        @endforeach
                    </select>
                    <input type="number" step="0.01" min="0" class="form-control" name="amount" placeholder="Amount in USD" value="{{ old('amount', $campaign->amount ?? '') }}">
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('client.campaign.step2.show') }}" class="btn btn-outline-secondary">Back</a>
                <button type="submit" class="btn btn-primary ms-2">Next</button>
            </div>
        </form>
    </div>
</div>
@endsection

