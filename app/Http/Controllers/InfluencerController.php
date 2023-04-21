<?php

namespace App\Http\Controllers;

use App\Models\Influencer;
use App\Models\GeneralSettings;
use App\Models\InfluencerSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response as FacadeResponse;

class InfluencerController extends Controller
{
    public function stat(){
        $user = Auth::user();
        $statusLabels = [
            0 => ['label' => 'pending', 'class' => 'text-warning'],
            1 => ['label' => 'approved', 'class' => 'text-success'],
            2 => ['label' => 'rejected', 'class' => 'text-danger'],
        ];
        $data['gt'] = GeneralSettings::firstOrFail();
        $data['users'] = $user;
        $data['status'] = $statusLabels;
        $data['influencer'] = Influencer::where('user_id', $user->id)->first();
        $data['salary_history'] = InfluencerSalary::where('user_id', $user->id)->get();

        return view('influencer.index', $data);
    }

    public function requestSalary(Request $request){
       
        $this->validate( $request, [
            'amount' => 'required|integer',
        ]);
    
        $user = Auth::user();
        $influencer = Influencer::where('user_id', $user->id)->first();
    
        if ($request->amount > $influencer->salary) {
            $notify[] = ['error', 'Insufficient funds'];
            return back()->withNotify($notify);
        }
    
        if (InfluencerSalary::where('user_id', $user->id)->whereIn('status', [InfluencerSalary::PENDING])->exists()) {
            $notify[] = ['warning', 'You still have a pending Request'];
            return back()->withNotify($notify);
        }
    
        $influencerSalary = new InfluencerSalary();
        $influencerSalary->user_id = $user->id;
        $influencerSalary->amount = $request->amount;
        $influencerSalary->status = InfluencerSalary::PENDING;
        $influencerSalary->bank = $user->bank;
        $influencerSalary->account_num = $user->acc_numb;
        $influencerSalary->save();
    
        $influencer->salary -= $request->amount;
        $influencer->save();
    
        $notify[] = ['success', 'Payment request sent successfully'];
        return back()->withNotify($notify);
    }
}