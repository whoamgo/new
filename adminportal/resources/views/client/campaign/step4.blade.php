@extends('client.layouts.default')

@section('content')
@include('client.alert_message')

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Add Campaign - Step 4 of 4</h5>
        <div>
            <span class="badge bg-success">1</span>
            <span class="badge bg-success">2</span>
            <span class="badge bg-success">3</span>
            <span class="badge bg-primary">4</span>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('client.campaign.step4.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Ad File Upload</label>
                <input type="file" name="ads_file" class="form-control">
                <div class="form-text">The maximum file upload size is 5 MB.</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Call-to-Action Link</label>
                <input type="url" name="action_url" value="{{ old('action_url', $campaign->action_url ?? '') }}" class="form-control">
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('client.campaign.step3.show') }}" class="btn btn-outline-secondary">Back</a>
                <button type="submit" class="btn btn-primary ms-2">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

