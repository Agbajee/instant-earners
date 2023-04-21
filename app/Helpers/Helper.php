<?php
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Influencer;
use App\Models\EarningHistory;
function verifyBankDetails($account_number, $bank_code){
    $curl = curl_init();
  
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number={{$account_number}}&bank_code={{$bank_code}}",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Authorization: sk_test_98c5aa98dcb426d923b60973abe09ff3f31ffb21",
        "Cache-Control: no-cache",
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
}
function date_to_word($date_string)
{
    $date = new DateTime($date_string);
    return $date->format('d F, Y \- g:i A');
}

function influencerBonus($user){
    $influencer = Influencer::where('user_id', $user->id)->first();
    $influencer->salary += 250;
    $influencer->save();
}

function updateCodeStatus($the_code, $user_id){
    $the_code->is_used = 1;
    $the_code->user_id = $user_id;
    $the_code->save();
}


function verificationCode($length)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = 0;
    while ($length > 0 && $length--) {
        $max = ($max * 10) + 9;
    }
    return random_int($min, $max);
}

if (! function_exists('activityBalance')) {

    function activityBalance( $id )
    {
        $sum = User::where('id', $id)->select(['allowi_balance', 'mines'])->get();
        $activityBalance = ($sum->allowi_balance + $sum->mines);
        return $activityBalance;
    }
}

if (! function_exists('get_vendor_name')) {

    function get_vendor_name( $id )
    {
        $name = User::find($id);
        $vendor = User::find($name->id);

        if(isset($vendor->username))
            return $vendor->username;
        else{
            return 'Vendor not found!';
        }
    }
}

if (! function_exists('get_referral_by_bonus_by_name')) {

    function get_referral_by_bonus_by_name( $id )
    {
        $referral = User::find($id);
        $user = User::find($referral->referred_by_id);

        if(isset($user->username))
            return $user->username;
        else{
            return 'Referral not found!';
        }
    }
}

if (! function_exists('get_referral_by_bonus_by_id')) {

    function get_referral_by_bonus_by_id( $id )
    {
        $referral = User::find($id);

        $user = User::find($referral->referred_by_id);

        if(isset($user->id)){
            return $user->id;
        }else{
            return 'Referral not found!';
        }
    }
}

if (! function_exists('total_cashout')) {

    function total_cashout( $id )
    {
        $total = User::where('id', $id)->sum('balance');
        return $total;
    }
}

if (! function_exists('get_referral')) {

    function get_referral( $id )
    {
        $input  = '2021/07/29';
        $format = 'Y/m/d';

        $now = Carbon\Carbon::parse($input)->format($format);

        $ref = User::where('referred_by_id', $id)->whereDate('created_at', $now)->get()->count();

        return $ref;
    }
}

