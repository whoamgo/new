@extends('client.layouts.default')

@section('content')
@include('client.alert_message')

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Add Campaign - Step 1 of 4</h5>
        <div>
            <span class="badge bg-primary">1</span>
            <span class="badge bg-secondary">2</span>
            <span class="badge bg-secondary">3</span>
            <span class="badge bg-secondary">4</span>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('client.campaign.step1.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Campaign Title</label>
                <input type="text" name="title" value="{{ old('title', $campaign->title ?? '') }}" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Campaign Objective</label>
                <input type="text" name="objective" value="{{ old('objective', $campaign->objective ?? '') }}" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Campaign Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $campaign->description ?? '') }}</textarea>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date', isset($campaign->start_date) ? $campaign->start_date : '') }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" value="{{ old('end_date', isset($campaign->end_date) ? $campaign->end_date : '') }}" class="form-control">
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary ms-2">Next</button>
            </div>
        </form>
    </div>
    <div class="card-footer text-muted">Fill required fields to proceed.</div>
    
</div>
@endsection

