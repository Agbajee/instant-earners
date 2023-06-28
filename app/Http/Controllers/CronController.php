<?php

namespace App\Http\Controllers;
// email
use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;
// email
use App\Mail\Activation;

use App\Models\Subscriber;
use App\Models\payoutRequest;
use App\Models\requestPayout;
use App\Models\GeneralSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CronController extends Controller
{
    public function cron()
    {
        // daily reset
        // $today = Carbon::today();
        // $user = User::where('last_login_at', '<=', $today );
        $user = User::query();
        $user->update([
            'no_of_login' => 0,
            'daily_task' => 0,
            'no_of_sponsored' => 0,
        ]);

        // return dd($user->count());

        // Auto Withdrawal
        $gnl = GeneralSettings::first();
        $gnl->last_cron = Carbon::now()->toDateTimeString();
		$gnl->save();

        $check_if_activity_is_on = requestPayout::first();

        if ($check_if_activity_is_on->allowi == 1) {

            // Let's process the payment
            $gnl->last_payment = Carbon::now()->toDateString();
            $gnl->save();
    
            $eligibleUsers = User::where('allowi_balance', '>=', 25000)
            ->where('acc_numb', '!=', '')
            ->where('bank', '!=', '')
            ->where('w_auto', '1')
            ->get();
    
            foreach ($eligibleUsers as $uex) {
                // Start the transaction
                DB::transaction(function () use ($uex) {
                    $user = User::find($uex->id);
            
                    // Check for an existing unpaid payoutRequest for this user
                    $existingRequest = payoutRequest::where('user_id', $user->id)->where('is_payed', 0)->first();
                    if ($existingRequest) {
                        // An unpaid request exists, so skip this iteration
                        return;
                    }
            
                    $point = $user->w_limit;
            
                    // deduct balance from User
                    $uex->allowi_balance -= $point;
                    $uex->save();
            
                    payoutRequest::create([
                        'from_account' => 2,
                        'name' => $user->fullname,
                        'amount' => $point,
                        'account_number' => $user->acc_numb,
                        'bank_name' => $user->bank,
                        'user_id' => $user->id,
                        'is_payed' => 0
                    ]);
                });
            }
            
            return count($eligibleUsers);
        }else{
            return "Activity is not available";
        }
    }
}