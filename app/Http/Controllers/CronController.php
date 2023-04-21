<?php

namespace App\Http\Controllers;
// email
use App\Mail\Activation;
use App\Models\Subscriber;
use Illuminate\Http\JsonResponse;
// email
use Carbon\Carbon;

use App\Models\payoutRequest;
use App\Models\User;
use App\Models\Plan;
use App\Models\GeneralSettings;
use App\Models\requestPayout;

class CronController extends Controller
{
    public function cron()
    {
        // daily reset
        $today = Carbon::today();
        $user = User::where('last_login_at', '<=', $today );
        $user->update([
             'no_of_login' => 0,
             'daily_task' => 0,
        ]);

        // Auto Withdrawal
        $gnl = GeneralSettings::first();
        $gnl->last_cron = Carbon::now()->toDateTimeString();
		$gnl->save();

        $check_if_activity_is_on = requestPayout::first();

        if ($check_if_activity_is_on->allowi == 1) {

            // Let's process the payment
            $gnl->last_payment = Carbon::now()->toDateString();
            $gnl->save();

            $eligibleUsers = User::where('allowi_balance', '>=', 20000)
            ->where('acc_numb', '!=', '')
            ->where('bank', '!=', '')
            ->where('w_auto', '1')
            ->get();

            foreach ($eligibleUsers as $uex) {
                
                $user = User::find($uex->id);
                $plan = Plan::where('id', $user->plan)->first();

                $point = $user->w_limit;

                // deduct balance from User
                $uex->allowi_balance -= $point;
                $uex->save();

                payoutRequest::updateOrCreate([
                    'is_payed' => 0,
                    'from_account' => 2,
                    'name' => $user->fullname,
                    'amount' => $point,
                    'account_number' => $user->acc_numb,
                    'bank_name' => $user->bank,
                    'user_id' => $user->id,
                ]);

            }
            return count($eligibleUsers);
        }else{
            return "Activity is not available";
            // return Carbon::parse($gnl->last_payment)->toDateString();
        }
    }
}
