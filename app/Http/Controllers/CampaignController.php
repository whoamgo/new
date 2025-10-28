<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientCampaign;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    public function create(Request $request)
    {
        // Clear any existing campaign data in session
        $request->session()->forget('campaign_data');
        $request->session()->forget('current_step');
        
        return view("client.campaign.add");
    }

    public function step(Request $request, $step)
    {
        $currentStep = (int) $step;
        $campaignData = $request->session()->get('campaign_data', []);
        
        // Validate step access
        if ($currentStep > 1) {
            $previousStepData = $this->getStepData($campaignData, $currentStep - 1);
            if (empty($previousStepData)) {
                return redirect()->route('campaign.create')->with('error', 'Please complete the previous steps first.');
            }
        }

        return view("client.campaign.step{$currentStep}", compact('currentStep', 'campaignData'));
    }

    public function storeStep(Request $request, $step)
    {
        $currentStep = (int) $step;
        $campaignData = $request->session()->get('campaign_data', []);
        
        // Validate step access
        if ($currentStep > 1) {
            $previousStepData = $this->getStepData($campaignData, $currentStep - 1);
            if (empty($previousStepData)) {
                return redirect()->route('campaign.create')->with('error', 'Please complete the previous steps first.');
            }
        }

        // Get validation rules for current step
        $rules = ClientCampaign::getStepValidationRules($currentStep);
        
        // Validate the request
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('current_step', $currentStep);
        }

        // Handle file upload for step 4
        if ($currentStep == 4 && $request->hasFile('ads_file')) {
            $file = $request->file('ads_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('campaigns/ads', $filename, 'public');
            $request->merge(['ads_file' => $path]);
        }

        // Store step data in session
        $stepData = $request->except(['_token', '_method']);
        $campaignData["step_{$currentStep}"] = $stepData;
        
        $request->session()->put('campaign_data', $campaignData);
        $request->session()->put('current_step', $currentStep);

        // If this is the last step, save to database
        if ($currentStep == 4) {
            return $this->saveCampaign($request);
        }

        // Redirect to next step
        $nextStep = $currentStep + 1;
        return redirect()->route('campaign.step', $nextStep)
            ->with('success', "Step {$currentStep} completed successfully!");
    }

    private function saveCampaign(Request $request)
    {
        $campaignData = $request->session()->get('campaign_data', []);
        
        // Combine all step data
        $allData = [];
        for ($i = 1; $i <= 4; $i++) {
            if (isset($campaignData["step_{$i}"])) {
                $allData = array_merge($allData, $campaignData["step_{$i}"]);
            }
        }

        // Convert arrays to comma-separated strings for database storage
        $arrayFields = ['age_group', 'gender', 'region', 'country', 'state', 'city'];
        foreach ($arrayFields as $field) {
            if (isset($allData[$field]) && is_array($allData[$field])) {
                $allData[$field] = implode(',', $allData[$field]);
            }
        }

        // Add additional required fields
        $allData['client_id'] = auth()->id(); // Assuming user is authenticated
        $allData['camp_code'] = ClientCampaign::generateCampaignCode();
        $allData['status'] = '0';
        $allData['camp_status'] = '0';
        $allData['step'] = '4';

        // Create campaign
        $campaign = ClientCampaign::create($allData);

        // Clear session data
        $request->session()->forget('campaign_data');
        $request->session()->forget('current_step');

        return redirect()->route('campaign.create')
            ->with('success', 'Campaign created successfully! Your campaign code is: ' . $campaign->camp_code);
    }

    private function getStepData($campaignData, $step)
    {
        return $campaignData["step_{$step}"] ?? [];
    }

    public function back(Request $request, $step)
    {
        $currentStep = (int) $step;
        
        if ($currentStep > 1) {
            $previousStep = $currentStep - 1;
            return redirect()->route('campaign.step', $previousStep);
        }
        
        return redirect()->route('campaign.create');
    }
}