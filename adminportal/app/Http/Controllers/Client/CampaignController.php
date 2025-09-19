<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Step1Request;
use App\Http\Requests\Client\Step2Request;
use App\Http\Requests\Client\Step3Request;
use App\Http\Requests\Client\Step4Request;
use App\Models\ClientCampaign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function step1Show(Request $request)
    {
        $campaign = $this->getCampaignFromSession(optional: true);
        return view('client.campaign.step1', compact('campaign'));
    }

    public function step1Store(Step1Request $request): RedirectResponse
    {
        $campaign = $this->getCampaignFromSession(optional: true);

        $data = $request->validated();

        if (!$campaign) {
            $campaign = new ClientCampaign();
            $campaign->client_id = Auth::id();
            $campaign->camp_code = $this->generateUniqueCampCode();
        }

        $campaign->fill([
            'title' => $data['title'],
            'objective' => $data['objective'] ?? null,
            'description' => $data['description'] ?? null,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'step' => '1',
        ]);
        $campaign->save();

        session(['campaign_id' => $campaign->id]);

        return redirect()->route('client.campaign.step2.show')->with('success', 'Step 1 saved. Continue to Step 2.');
    }

    public function step2Show(Request $request)
    {
        $campaign = $this->getCampaignFromSession();
        if ($campaign->step < '1') {
            return redirect()->route('client.campaign.step1.show')->with('error', 'Complete Step 1 first.');
        }
        return view('client.campaign.step2', compact('campaign'));
    }

    public function step2Store(Step2Request $request): RedirectResponse
    {
        $campaign = $this->getCampaignFromSession();
        $data = $request->validated();

        $campaign->fill([
            'age_group' => isset($data['age_group']) ? implode(',', $data['age_group']) : null,
            'gender' => isset($data['gender']) ? implode(',', $data['gender']) : null,
            'region' => $data['region'] ?? null,
            'country' => $data['country'] ?? null,
            'state' => $data['state'] ?? null,
            'city' => $data['city'] ?? null,
            'step' => '2',
        ])->save();

        return redirect()->route('client.campaign.step3.show')->with('success', 'Step 2 saved. Continue to Step 3.');
    }

    public function step3Show(Request $request)
    {
        $campaign = $this->getCampaignFromSession();
        if ($campaign->step < '2') {
            return redirect()->route('client.campaign.step2.show')->with('error', 'Complete Step 2 first.');
        }
        return view('client.campaign.step3', compact('campaign'));
    }

    public function step3Store(Step3Request $request): RedirectResponse
    {
        $campaign = $this->getCampaignFromSession();
        $data = $request->validated();

        $campaign->fill([
            'ads_place_type' => $data['ads_place_type'],
            'ads_position' => $data['ads_position'],
            'budget_type' => $data['budget_type'],
            'amount' => $data['amount'],
            'step' => '3',
        ])->save();

        return redirect()->route('client.campaign.step4.show')->with('success', 'Step 3 saved. Continue to Step 4.');
    }

    public function step4Show(Request $request)
    {
        $campaign = $this->getCampaignFromSession();
        if ($campaign->step < '3') {
            return redirect()->route('client.campaign.step3.show')->with('error', 'Complete Step 3 first.');
        }
        return view('client.campaign.step4', compact('campaign'));
    }

    public function step4Store(Step4Request $request): RedirectResponse
    {
        $campaign = $this->getCampaignFromSession();
        $data = $request->validated();

        if ($request->hasFile('ads_file')) {
            $path = $request->file('ads_file')->store('campaigns', 'public');
            $campaign->ads_file = $path;
        }

        $campaign->action_url = $data['action_url'];
        $campaign->step = '4';
        $campaign->camp_status = '0';
        $campaign->status = '0';
        $campaign->save();

        // Optionally clear session to prevent duplicate submits
        // session()->forget('campaign_id');

        return redirect()->route('client.campaign.step4.show')->with('success', 'Campaign submitted. Awaiting review.');
    }

    private function getCampaignFromSession(bool $optional = false): ?ClientCampaign
    {
        $campaignId = session('campaign_id');
        if (!$campaignId) {
            if ($optional) {
                return null;
            }
            abort(302, '', ['Location' => route('client.campaign.step1.show')]);
        }
        $campaign = ClientCampaign::find($campaignId);
        if (!$campaign) {
            session()->forget('campaign_id');
            if ($optional) {
                return null;
            }
            abort(302, '', ['Location' => route('client.campaign.step1.show')]);
        }
        return $campaign;
    }

    private function generateUniqueCampCode(): string
    {
        do {
            $code = 'CAMP-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(6));
        } while (ClientCampaign::where('camp_code', $code)->exists());
        return $code;
    }
}

