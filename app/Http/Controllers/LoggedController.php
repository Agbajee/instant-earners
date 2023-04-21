<?php

namespace App\Http\Controllers;


use App\Models\Plan;
use App\Models\User;
use App\Models\Loans;
use App\Models\Bundle;
use App\Models\CouponCodes;
use App\Models\Subscription;
use App\Models\ActivityBonus;
use App\Mail\Withdraw;
use App\Models\payoutRequest;
use App\Models\EarningHistory;
use App\Models\MarketCategory;
use App\Models\GeneralSettings;
use App\Models\userPredictions;
use App\Models\Market;

use Carbon\Carbon;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\requestPayout;
use App\Mail\ResendActivation;
use App\Mail\AccountActivation;
use App\Models\siteNotifcation;
use App\Lib\GoogleAuthenticator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Notification;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class LoggedController extends Controller
{
    use SEOToolsTrait;

    public function __construct(){

    }

    public function dailyTask(Request $request){
        if (!$request->user()) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
        if (!$request->user()->daily_task) {
            $amount = 200;
            $user = $request->user();
            $user->allowi_balance += $amount;
            $user->daily_task = 1;
            $user->save();

            $earning = new EarningHistory();
            $earning->user_id = $user->id;
            $earning->amount = $amount;
            $earning->type = "Earned from daily task";
            $earning->save();
        }else{
            return response()->json(['message' => 'You have unlocked for today!', 'amount' => 0]);
        }

        return response()->json(['message' => 'Daily Task unlocked!', 'amount' => $amount]);
    }

    public function sendVerify($id){
        $verification_code =verificationCode(6);
        $user = User::where('id', $id)->firstOrFail();
        $user->verification_token = $verification_code;
        $user->save();

        $data = array(
            'code' => $verification_code,
            'fullname' => $user->fullname,
            'email' => $user->email,
            'username' => $user->username,
        );
        try {
            Mail::to($user)->send(new AccountActivation($data));
        } catch (\Exception $ex){
       
        }

        $notify[] = ['success', 'Verification Code has been sent to '. $user->email];
        return back()->withNotify($notify);
    }

    public function verifyAccount(){

        if(Auth::user()->is_verified){
            $notify[] = ['warning', 'Your Email Address has been verified'];
            return \redirect()->to(route('account'))->withNotify($notify);
        }

        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Verify Account - '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        $user = Auth::user();
        return view('users.verify',compact('user', 'gt')); 
    }

    public function changeEmail(Request $request){
        $this->validate($request, [
            'email' => 'required|email|unique:users'
        ]);
        $user =Auth::user();

        $update = User::where('id', $user->id)->firstOrFail();
        $update->email = $request->email;
        $update->save();

        $notify[] = ['success', 'Your Email Address have been Updated'];
        return back()->withNotify($notify);        
    }

    public function verifyAccountSubmit(Request $request){
        $this->validate($request, [
            'code' => 'required'
        ]);
        $user =Auth::user();
        if($request->code == $user->verification_token){
            $verify = User::where('id', $user->id)->firstOrFail();
            $verify->is_verified = true;
            $verify->save();

            $notify[] = ['success', 'Your Email Address has been verified'];
            return \redirect()->to(route('account'))->withNotify($notify);
        }else{
            $notify[] = ['error', 'Verification Code is invalid'];
            return back()->withNotify($notify);
        }
        
    }

    public function account(){
        // if(!Auth::user()->is_verified){
        //     $notify[] = ['warning', 'Your Email Address has not been verified'];
        //     return \redirect()->to(route('verifyAccount'))->withNotify($notify);
        // }
        $user = Auth::user();
        $data['history'] = EarningHistory::orderBy('created_at', 'DESC')->where('user_id', $user->id)->select(['type', 'amount', 'created_at'])->limit(5)->get(); 
        $data['title'] = 'dashboard';
        $data['gt'] = GeneralSettings::first();
        $this->seo()->setTitle('My Account');
        $this->seo()->opengraph()->setUrl(Url::current());

        return view('users.account', $data);  
        
    }

    public function predict(){

        $title = 'Quiz';
        $gt = GeneralSettings::first();
        $this->seo()->setTitle('Prediction');
        $this->seo()->opengraph()->setUrl(Url::current());

        return view('users.predict', compact('gt', 'title'));

    }

    public function predictPost(Request $request){
        $this->validate($request, [
            'answer' => 'required',
        ]);
        $cost = $request->cost;
        if(userPredictions::where('user_id', Auth::user()->id)->where('title', $request->title)->exists() == false){
            if( Auth::user()->allowi_balance >= $cost){
                $create = new userPredictions();
                $create->title = $request->title;
                $create->content = $request->content;
                $create->user_id = Auth::user()->id;
                $create->answer = $request->answer;
                $create->quiz_id = $request->id;
                $create->save();
    
                $update = User::findOrFail(Auth::user()->id);
                $update->allowi_balance -= $cost;
                $update->save();
    
                $notify[] = ['success', 'Prediction Submited, '.$cost. 'pt has been deducted from your MXP'];
                return back()->withNotify($notify);
            }else{
                $notify[] = ['error', 'You do not have suffucient balance.'];
                return back()->withNotify($notify); 
            }
        }else{
            $notify[] = ['warning', 'Sorry, You can only Predict once.'];
            return back()->withNotify($notify);
        }

    }

    public function luckyWheel(){
        $title = 'Lucky Wheel';
        $gt = GeneralSettings::first();
        return view('users.wheel', compact('gt', 'title'));
    }



    public function upgrade(){
        $title = 'Upgrade Account';
        $gt = GeneralSettings::first();
        $this->seo()->setTitle('Upgrade My Plan');
        $this->seo()->opengraph()->setUrl(Url::current());

        return view('users.upgrade',compact('gt', 'title'));
    }

    public function editAccount(){
        $title = "My Profile";
        $gt = GeneralSettings::first();
        $this->seo()->setTitle('Edit Account');
        $this->seo()->opengraph()->setUrl(Url::current());
        return view('users.edit', compact('gt', 'title'));
    }


    public function deletePayRequest($id){
        $d_req = payoutRequest::findOrFail($id);
        $d_req->delete();
        return redirect()->back()->with('info', 'Payout request deleted successfully');
    }

    public function editAccountPost(Request $request, $id){
        if($id == 1){
            $rules = [
                'fullname' => 'required|max:120|string',
                'number' => 'required|max:120|string',
                'file' => 'nullable|max:5000'
            ];

            $messages = [
                'fullname.required' => '* This field can not be empty',
                'fullname.max' => '* Field is too long',
                'fullname.string' => '* This field be a character',


                'number.required' => '* This field can not be empty',
                'number.max' => '* Field is too long',
                'number.string' => '* Phone number must be a character',

                'file.max' => '* File too large - Maximum File size is 5MB',
                'file.mimes' => '* Sorry only file with the Following Extensions are allowed (PNG, JPG, JPEG, GIF, BMP)',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }  else {
                if($request->file != ''){
                        $file = $request->file('file');
                        $name = sha1(date('YmdHis') . Str::random(20));
                        $resize_name = $name.'-'.Str::random(5).'.'.$file->getClientOriginalExtension();

                        Image::make($file)->save('images/users/'.$resize_name);

                    $updateUser2 = User::findOrFail(Auth::user()->id);
                    $updateUser2->avatar = $resize_name;
                    $updateUser2->save();
                }


                $updateUser = User::findOrFail(Auth::user()->id);
                $updateUser->fullname = $request->fullname;
                $updateUser->number = $request->number;
                $updateUser->country = $request->country;
                $updateUser->acc_name = $request->acc_name;
                $updateUser->acc_numb = $request->acc_numb;
                $updateUser->bank = $request->bank;
                $updateUser->save();

                $notify[] = ['success', 'Profile updated successfully.'];
                return back()->withNotify($notify);
            }
        }

    }

    public function userSettings(Request $request){
        $this->validate($request, [
            'withdrawal_limit' => 'required|numeric',
        ]);

        $plan = Plan::where('id', Auth::user()->plan)->first();
        $withdrawal_auto = $request->withdrawal_auto;

        if($request->withdrawal_limit < $plan->min_noref){
            $notify[] = ['warning', 'Minimum Payout cannot be less than'.' '. $plan->min_noref];
            return back()->withNotify($notify);
        }

        if(!$withdrawal_auto){
            $withdrawal_auto = 0;
        }


        $updateSettings = User::findOrFail(Auth::user()->id);
        $updateSettings->w_auto = $withdrawal_auto;
        $updateSettings->w_limit = $request->withdrawal_limit;
        $updateSettings->save();

        $notify[] = ['success', 'Settings updated successfully.'];
        return back()->withNotify($notify);

    }

    public function changePin(Request $request){
            $rules = [
                'pin' => 'required|numeric',
                'new_pin' => 'required|numeric|digits_between:4,6',
                'new_pin_confirm' => 'required|same:new_pin',
            ];

            $messages = [
                'pin.required' => '* Old Pin field can not be empty',
                'pin.numeric' => '* Old Pin can only consists of characters in (0-9)',

                'new_pin.required' => '* New Pin field can not be empty',
                'new_pin.max' => '* New Pin should not be greater than 6 digits',
                'new_pin.min' => '* New Pin should not be less than 4 digits',
                'new_pin.numeric' => '* New Pin can only consists of characters in (0-9)',

                'new_pin_confirm.same' => '* Pin Confirmation Does not match',


            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }  else {

                $updatePin = User::findOrFail(Auth::user()->id);
                if( $request->pin == $updatePin->w_pin){
                    $updatePin->w_pin = $request->new_pin;
                    $updatePin->save();

                    $notify[] = ['success', 'Pin Updated Successfully. New Pin = '.$updatePin->w_pin];
                    return back()->withNotify($notify);
                }else {
                    $notify[] = ['error', 'Sorry, Old Pin is Incorrect.'];
                    return back()->withNotify($notify);
                }

            }
    }


    public function subscribe(){
        $title = "Purchase Course";
        $gt = GeneralSettings::first();
        $this->seo()->setTitle('My subscription');
        $this->seo()->opengraph()->setUrl(Url::current());


        return view('users.subscribe',compact('gt','title'));
    }

    public function subscribePost(Request $request){

        $rules = [
            'bundle_id' => 'required',
        ];

        $messages = [
            'bundle_id.required' => '* You must select a skill',
         
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }else{
            if($request->bundle_id != 'null'){
                $bd = Bundle::find($request->bundle_id);
            } else{
                $notify[] = ['error', 'No Classes Selected.'];
                return redirect()->back()->withNotify($notify);
            }

            if($bd->points > Auth::user()->allowi_balance){
                $notify[] = ['error', 'Insufficient Points.'];
                return redirect()->back()->withNotify($notify);
            }else{

                if(Subscription::where('bundle_id', $request->bundle_id)->where('user_id', Auth::user()->id)->exists() == false){

                    $sub = new Subscription;
                    $sub->bundle_id = $request->bundle_id;
                    $sub->subscribed_on = Carbon::now();
                    $sub->expired_on = Carbon::now()->addDays($bd->days);
                    $sub->status = 1;
                    $sub->user_id = Auth::user()->id;
                    $sub->user_email = Auth::user()->email;
                    $sub->save();

                    $user = User::find(Auth::user()->id);
                    $user->allowi_balance -= $bd->points;
                    $user->save();

                    $notify[] = ['success', 'Congratulations, You have subscribed to this class successfully.'];
                    return redirect()->back()->withNotify($notify);

                } elseif(Subscription::where('bundle_id', $request->bundle_id)->where('user_id', Auth::user()->id)->exists() == true && Subscription::where('bundle_id', $request->bundle_id)->where('user_id', Auth::user()->id)->first()->status == 2){

                    $sub = Subscription::where('bundle_id', $request->bundle_id)->where('user_id', Auth::user()->id)->first();
                    $sub->bundle_id = $request->bundle_id;
                    $sub->subscribed_on = Carbon::now();
                    $sub->expired_on = Carbon::now()->addDays($bd->days);
                    $sub->status = 1;
                    $sub->user_id = Auth::user()->id;
                    $sub->save();

                    $user = User::find(Auth::user()->id);
                    $user->allowi_balance -= $bd->points;
                    $user->save();


                    $notify[] = ['success', 'Congratulations, Your subscription has been renewed successfully.'];
                    return redirect()->back()->withNotify($notify);
                } else {
                    $notify[] = ['info', 'Sorry, You have an active subscription, thanks.'];
                    return redirect()->back()->withNotify($notify);
                }
            }
        }

    }


    public function changePassword(){

        $title = "Update Password";
        $gt = GeneralSettings::first();
        $this->seo()->setTitle('Change account password');
        $this->seo()->opengraph()->setUrl(Url::current());
        return view('users.edit-password', compact('gt', 'title'));

    }

    public function changePasswordPost(Request $request){

            $rules = [
                'old_password' => 'required|max:120',
                'new_password' => 'required|max:120|min:6',
                'new_password_confirmation' => 'required|max:120|min:6|same:new_password',
            ];

            $messages = [
                'old_password.required' => '* Old password is required',
                'old_password.max' => '* Old password can not be this long',

                'new_password.required' => 'New Password is required',
                'new_password.max' => 'New Password is too long',
                'new_password.min' => 'New Password must be at least 6 characters long',


                'new_password_confirmation.required' => 'Pasword Confirmation is required',
                'new_password_confirmation.max' => 'New password can not be this long',
                'new_password_confirmation.min' => 'Password must be at least 6 characters long',
                'new_password_confirmation.confirmed' => 'Password Confirmation Does not match',

            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }  else {
                $the_user = User::findOrFail(Auth::user()->id);
                if( Hash::check($request->old_password, $the_user->password) == true){
                    $the_user->password = Hash::make($request->new_password);
                    $the_user->save();

                    $notify[] = ['success', 'Password Changed Successfully.'];
                    return back()->withNotify($notify);
                }else {
                    $notify[] = ['error', 'Sorry, Old Password is not correct.'];
                    return back()->withNotify($notify);
                }

            }
    }

    public function earningHistory(){
        $user = Auth::user();
        $data['title'] = "History";
        $data['user'] = Auth::user();
        $data['history'] = EarningHistory::orderBy('created_at', 'DESC')->where('user_id', $user->id)->select(['type', 'amount', 'created_at'])->paginate(10); 
        $data['gt'] = GeneralSettings::first();
        $this->seo()->setTitle('Earning History');
        $this->seo()->opengraph()->setUrl(Url::current());

        return view('users.earning_history', $data);
    }

    public function notifications(){
        $title = "Notifications";
        $user = Auth::user();
        $notification = siteNotifcation::orderBy('created_at', 'DESC')->limit(10)->get(); 
        $gt = GeneralSettings::first();
        return view('users.notifications', compact('gt', 'user', 'notification','title'));
    }

    public function becomeaproPost(Request $request){
            $this->validate( $request, [
                'coupon_code' => 'required',
            ]);

            if(CouponCodes::where('coupon_code', $request->coupon_code)->exists() == false){
                $notify[] = ['error', 'Coupon code does not exist please try a different one or contact your code vendor if issue persist.'];
                return back()->withNotify($notify);
            }

            if(CouponCodes::where('coupon_code', $request->coupon_code)->first()->is_used == 1){
                $notify[] = ['error', 'Coupon code has already been used, Please try a different one.'];
                return back()->withNotify($notify);
            } 

            if(CouponCodes::where('coupon_code', $request->coupon_code)->first()->plan == Auth::user()->plan){
                $notify[] = ['warning', 'Sorry! You are already on this plan, try another coupon code.'];
                return back()->withNotify($notify);
            }

            try{
                $the_code = CouponCodes::where('coupon_code', $request->coupon_code)->first();
                $the_code->is_used = 1;
                $the_code->user_id = Auth::user()->id;
                $the_code->save();

                $the_code2 = CouponCodes::where('coupon_code', $request->coupon_code)->first();

                $the_plan = Plan::where('id', $the_code2->plan)->first();

                //Lets Credit the referral
                // $the_user = User::where('id', Auth::user()->referred_by_id)->first();
                // $the_user->balance += (int)$the_plan->referral_bonus;
                // $the_user->save();

                // $earning_1 = new EarningHistory();
                // $earning_1->user_id = $the_user->id;
                // $earning_1->amount = $the_plan->referral_bonus;
                // $earning_1->type = "Downline Upgraded";
                // $earning_1->save();

                //Let's credit the user
                $user = User::where('id', Auth::user()->id)->first();
                $user->allowi_balance += (int)$the_plan->referral_bonus;
                $user->plan = $the_plan->id;
                $user->save();

                $earning = new EarningHistory();
                $earning->user_id = $user->id;
                $earning->amount = $the_plan->registeration_bonus;
                $earning->type = "Upgrade Bonus";
                $earning->save();


                $notify[] = ['success', 'Your plan has been upgraded successfully.'];
                return back()->withNotify($notify);

            }catch (\Exception $exception){
                $notify[] = ['error', 'An error has occurred. Please contact support'];
                return back()->withNotify($notify);
            }
    }

    public function requestPayout(){
        $data['title'] = "Payment";
        $data['gt'] = GeneralSettings::first();
        $data['user'] = Auth::user();
        $statusArray  = [
            0 => ['label' => 'pending', 'class' => 'text-warning'],
            1 => ['label' => 'approved', 'class' => 'text-success'],
            2 => ['label' => 'rejected', 'class' => 'text-danger'],
        ];
        $data['statusArray'] = $statusArray ;

        $data['payout'] = requestPayout::first();
        $data['myPlan'] = Plan::where('id', $data['user']->plan)->first();
        $data['history'] = payoutRequest::where('user_id', $data['user']->id)->select('id', 'amount', 'is_payed','created_at')->limit(10)->orderBy('created_at', 'desc')->get();
        $this->seo()->setTitle('Payment');
        $this->seo()->opengraph()->setUrl(Url::current());
        return view('users.request_payout', $data);
    }

    // public function requestPayoutPost(Request $request){
       
    //     $this->validate( $request, [
    //         'from' => 'required|integer',
    //         'amount' => 'required|integer',
    //         'code' => 'required',
    //     ]);

    //     $user = User::where('id', Auth::user()->id)->first();

    //     $userPlan = Plan::where('id', Auth::user()->plan)->first();
    //     if($request->from == 1){
    //         $minimum_amount = $userPlan->min_ref; 
    //     } elseif($request->from == 2){
    //         $minimum_amount = $userPlan->min_noref;
    //     }

        
    //     $balance = (int)Auth::user()->balance;

    //     if(!empty(Auth::user()->acc_numb) && !empty(Auth::user()->bank && !Auth::user()->is_block )){

    //         if($request->from == 1){
    //             if($minimum_amount <= $request->amount){
    //                 if(Auth::user()->balance >= $minimum_amount || (Auth::user()->balance + Auth::user()->indirect_ref) >= $minimum_amount  && (Auth::user()->balance + Auth::user()->indirect_ref) >= $request->amount){

    //                     if( $balance >= $request->amount || Auth::user()->balance >= $request->amount  ){ 

    //                         if(payoutRequest::where('name', Auth::user()->fullname)->where('amount', $request->amount)->where('from_account', $request->from)->where('is_payed', 0)->exists()  == false){
    //                             payoutRequest::updateOrCreate([
    //                                 'is_payed' => 0,
    //                                 'from_account' => $request->from,
    //                                 'name' => Auth::user()->fullname,
    //                                 'amount' => $request->amount,
    //                                 'account_number' =>  Auth::user()->acc_numb,
    //                                 'bank_name' =>  Auth::user()->bank,
    //                                 'user_id' => Auth::user()->id,
    //                             ]);

    //                             $user->balance -= $request->amount;
    //                             $user->save();

    //                             $notify[] = ['success', 'Withdrawal successfully submitted!.'];
    //                             return back()->withNotify($notify);
                                
    //                             try{
    //                                 $user = Auth::user(); 
    //                                 $amount = $request->amount;
    //                                 Mail::to($user)->send(new Withdraw($amount)); 
                    
    //                             } catch (\Exception $exception){
    //                                 $notify[] = ['error', 'Unable to send mail'];
    //                                 return back()->withNotify($notify);
    //                             }
    //                         }else{
    //                             $notify[] = ['warning', 'This Request exists Already!.'];
    //                             return back()->withNotify($notify);
    //                         }

    //                     } else {
    //                         $notify[] = ['warning', 'Insufficient Balance.'];
    //                         return back()->withNotify($notify);
    //                     }
                            

    //                 } else {
    //                     $notify[] = ['error', 'Low Balance.'];
    //                     return back()->withNotify($notify);
    //                 }
    //             }
    //             else{
    //                 $notify[] = ['error', 'Minimum withdrawal is'.' '.$minimum_amount];
    //                 return back()->withNotify($notify);
    //             }

    //         }elseif ($request->from == 2) {
    //             if($minimum_amount <= $request->amount){
    //                 if( (Auth::user()->allowi_balance + Auth::user()->mines) >= $minimum_amount && (Auth::user()->allowi_balance + Auth::user()->mines) >= $request->amount){
                        
    //                     if((Auth::user()->allowi_balance + Auth::user()->mines) >= $request->amount){

    //                         payoutRequest::create([
    //                             'is_payed' => 0,
    //                             'from_account' => $request->from,
    //                             'name' => Auth::user()->fullname,
    //                             'amount' => $request->amount,
    //                             'account_number' =>  Auth::user()->acc_numb,
    //                             'bank_name' =>  Auth::user()->bank,
    //                             'user_id' => Auth::user()->id,
    //                         ]);

    //                         $user->allowi_balance -= $request->amount;
    //                         $user->save();

    //                         $notify[] = ['success', 'Withdrawal successfully submitted!.'];
    //                         return back()->withNotify($notify);

    //                     } else {
    //                         $notify[] = ['warning', 'Insuffcient Points!.'];
    //                         return back()->withNotify($notify);
    //                     }
                            
    //                 } else {
    //                     $notify[] = ['error', 'Your Balance is not up to the requested amount!.'];
    //                     return back()->withNotify($notify);
    //                 }
    //             }else{
    //                 $notify[] = ['error', 'Minimum withdrawal is'.' '.$minimum_amount];
    //                 return back()->withNotify($notify);
    //             }
    //         }

    //     } else {
    //         $notify[] = ['warning', 'Please update your bank details!/ Check if your account might be suspended.'];
    //         return back()->withNotify($notify);
    //     }

    // }

    public function requestPayoutPost(Request $request)
    {
        $this->validate($request, [
            'from' => 'required|integer',
            'amount' => 'required|integer',
        ],[
            'from.required' => 'You must choose the withdrawal type .',
            'from.integer' => 'You must choose the withdrawal type .',
        ]);
        
        $user = User::where('id', Auth::user()->id)->first();

        $userPlan = Plan::where('id', $user->plan)->first();
        $minimum_amount = $request->from == 1 ? $userPlan->min_ref : $userPlan->min_noref;

        if (empty($user->acc_numb) || empty($user->bank) || $user->is_block) {
            $notify[] = ['warning', 'Please update your bank details! / Check if your account might be suspended.'];
            return back()->withNotify($notify);
        }

        if ($request->amount < $minimum_amount) {
            $notify[] = ['error', 'Minimum withdrawal is ' . $minimum_amount];
            return back()->withNotify($notify);
        }

        $balance = $request->from == 1 ? $user->balance : $user->allowi_balance;

        if ($balance < $request->amount) {
            $notify[] = ['error', 'Insuffucient Balance!'];
            return back()->withNotify($notify);
        }

        if (payoutRequest::where('name', $user->fullname)->where('amount', $request->amount)
            ->where('from_account', $request->from)->where('is_payed', 0)->exists()) {
            $notify[] = ['success', 'This Request exists Already!'];
            return back()->withNotify($notify);
        }

        payoutRequest::create([
            'is_payed' => 0,
            'from_account' => $request->from,
            'name' => $user->fullname,
            'amount' => $request->amount,
            'account_number' => $user->acc_numb,
            'bank_name' => $user->bank,
            'user_id' => $user->id,
        ]);

        if ($request->from == 1) {
            $user->balance -= $request->amount;
        } else {
            $user->allowi_balance -= $request->amount;
        }
    
        $user->save();
    
        try{
            Mail::to($user)->send(new Withdraw($request->amount));
        }catch (\Exception $exception) {
            // return $this->notifyError('Unable to send mail');
        }finally{
            $notify[] = ['success', 'withdrawal placed successfully'];
            return back()->withNotify($notify);
        }
    
    }
 
    public function userMarket(){
        $data['title'] = 'My Products';
        $data['gt'] = GeneralSettings::first();
        $data['products'] = Market::where('user_id', Auth::user()->id)->get();
        $data['market_category'] = MarketCategory::get();
        return view('users.market.index', $data);
    }

    public function submitMarket(Request $request){

        $rules = [
            'product_name' => 'required|max:120',
            'price' => 'nullable',
            'description' => 'required',
            'image' => 'required',
            'category' => 'required',
            'phone' => 'required',
        ];

        $messages = [
            'product_name.required' => 'Product Name is required',
            'product.max' => 'Product Name not be this long',

            'price.required' => 'Price is required',
            'price.max' => 'Price is too long',
            'price.integer' => 'Price can only be numbers',

            'description.required' =>'Product Description is required',
            'image.required' =>'Product image is required',
            'category.required' =>'Product category is required',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $gt = GeneralSettings::first();
        if( Auth::user()->allowi_balance >= $gt->market_point){

            if($request->image != ''){
                $file = $request->file('image');
                $name = sha1(date('YmdHis') . Str::random(20));
                $resize_name = $name.'-'.Str::random(5).'.'.$file->getClientOriginalExtension();
                Image::make($file)->save('images/users/product'.$resize_name);
            }

            Market::create([
                'product_name' => $request->product_name,
                'slug' => Str::slug($request->product_name),
                'price' => $request->price,
                'user_id' => Auth::user()->id,
                'cat_id' => $request->category,
                'contact' => [
                    'whatsapp'=>$request->whatsapp,
                    'telegram'=>$request->telegram,
                    'instagram'=>$request->instagram,
                    'phone'=>$request->phone,
                ],
                'description' => $request->description,
                'image' => $resize_name,
            ]);

            $update = User::findOrFail(Auth::user()->id);
            $update->allowi_balance -= $gt->market_point;
            $update->save();

            $notify[] = ['success', 'Product Uploaded, '.$gt->market_point. ' has been deducted from your MXP'];
            return back()->withNotify($notify);
        }else{
            $notify[] = ['error', 'You do not have suffucient balance.'];
            return back()->withNotify($notify); 
        }
    }

    public function createMarket(){

        $data['title'] = 'Upload Products';
        $data['gt'] = GeneralSettings::first();
        $data['products'] = GeneralSettings::first();
        $data['market_category'] = MarketCategory::get();
        return view('users.market.create', $data);
    }

    public function userEditProduct(Request $request){

        $rules = [
            'price' => 'nullable',
            'description' => 'required',
            'category' => 'required',
            'phone' => 'required',
        ];

        $messages = [
            'price.required' => 'Price is required',
            'price.max' => 'Price is too long',
            'price.integer' => 'Price can only be numbers',

            'description.required' =>'Product Description is required',
            'category.required' =>'Product category is required',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $updateProduct = Market::where('id', $request->id)->firstOrFail();
        $updateProduct->price = $request->price;
        $updateProduct->description = $request->description;
        $updateProduct->cat_id = $request->category;
        $updateProduct->contact = [
            'whatsapp'=>$request->whatsapp,
            'telegram'=>$request->telegram,
            'instagram'=>$request->instagram,
            'phone'=>$request->phone
        ];
        $updateProduct->save();

        $notify[] = ['info', $request->name.' Updated Successfully!'];
        return back()->withNotify($notify);

    }

    public function userDeleteProduct(Request $request, $id){
        $item = Market::where('id', $id)->firstOrFail();
        $item->delete();

        $notify[] = ['info', 'Product Removed Successfuly!'];
        return back()->withNotify($notify);
    }

    function balanceTransfer(Request $request){

        $this->validate($request, [
            'username' => 'required',
            'amount' => 'required|numeric|min:0',
        ]);

        $gt = GeneralSettings::first();
        $user = User::find(Auth::id());
        $trans_user = User::where('username', $request->username)->orWhere('email', $request->username)->first();

        if ($trans_user == '') {
            $notify[] = ['error', 'Username Not Found'];
            return back()->withNotify($notify);
        }
        if ($trans_user->username == $user->username) {
            $notify[] = ['error', 'Balance Transfer Not Possible In Your Own Account'];
            return back()->withNotify($notify);
        }
        if ($trans_user->email == $user->email) {
        $notify[] = ['error', 'Balance Transfer Not Possible In Your Own Account'];
        return back()->withNotify($notify);
        }

        $charge = $gt->transfer_fee + (($request->amount * $gt->transfer_fee) / 100);
        $amount = $request->amount + $charge;
        if ($amount >= 10000) {

        if ($user->balance >= $amount) {
            $user->balance -= $amount;
            $user->save();
            

            $trans_user->balance += $request->amount;
            $trans_user->save();


            $notify[] = ['success', 'Balance Transferred Successfully.'];
            return back()->withNotify($notify);

        } else {
                $notify[] = ['error', 'Insufficient Balance.'];
            return back()->withNotify($notify);
        }
        } else {
                $notify[] = ['warning', 'Minimun transferable amount is 10,000.'];
        return back()->withNotify($notify);
        }
    }

    public function changeMode($id)
    { 
        $changeMode = User::findOrFail(Auth::user()->id);
        if ($id == 1){
            $changeMode->mode = 0;
            $message = "You have switched to Dark Mode";
            $changeMode->save();
        }else{
            $changeMode->mode = 1;
            $message = "You have switched to Light Mode";
            $changeMode->save();
        } 

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
        
    }

    public function show2faForm()
    {
        $title = "Google 2FA";
        $gt = GeneralSettings::first();
        $ga = new GoogleAuthenticator();
        $user = Auth::user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $gt->sitename, $secret);
        $prevcode = $user->tsc;
        $prevqr = $ga->getQRCodeGoogleUrl($user->username . '@' . $gt->sitename, $prevcode);
        return view('users.2fa', compact('gt', 'secret', 'qrCodeUrl', 'prevcode', 'prevqr', 'user','title'));
    }
    public function create2fa(Request $request)
    {
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        $ga = new GoogleAuthenticator();
        $secret = $request->key;
        $oneCode = $ga->getCode($secret);

        if ($oneCode === $request->code) {

            $user->tsc = $request->key;
            $user->gfa = 1;
            $user->tv = 1;
            $user->save();

            $notify[] = ['success', 'Google Authenticator Enabled Successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong Verification Code'];
            return back()->withNotify($notify);
        }
    }


    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        $ga = new GoogleAuthenticator();

        $secret = $user->tsc;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;

        if ($oneCode === $userCode) {
            $user->tsc = null;
            $user->gfa = 0;
            $user->tv = 1;
            $user->save();

            $notify[] = ['success', 'Two Factor Authenticator Disable Successfully'];
            return back()->withNotify($notify);
            
        } else {
            $notify[] = ['error', 'Wrong Verification Code'];
            return back()->withNotify($notify);
        }
    }

    public function applyLoan(){
        $data['title']      = 'Get Loan';
        $data['gt']      = GeneralSettings::first();
        $data['loans']   = Loans::where('user_id', Auth::user()->id)->get();
        $data['user']    = Auth::user();
        return view('users.loans.apply', $data);  
    }
    public function myLoans(){
        $statusLabels = [
            2 => ['label' => 'pending', 'class' => 'text-warning'],
            1 => ['label' => 'approved', 'class' => 'text-success'],
            3 => ['label' => 'rejected', 'class' => 'text-danger'],
        ];
        $data['title'] = 'Loan History';
        $data['status'] = $statusLabels;
        $data['gt'] = GeneralSettings::first();
        $data['loans'] = Loans::where('user_id', Auth::user()->id)
                      ->select('id', 'loan_amount','created_at', 'status', 'paid')
                      ->orderBy('created_at', 'desc')
                      ->get();
        $data['loan_approved'] = Loans::where('user_id', Auth::user()->id)
                      ->where('status', Loans::STATUS_APPROVED)
                      ->where('paid', 0)
                      ->select('id', 'loan_amount', 'due_when','paid')
                      ->latest('created_at')
                      ->first();
        $data['loan_rejected'] = Loans::where('user_id', Auth::user()->id)
                      ->where('status', Loans::STATUS_REJECTED)
                      ->whereDate('due_when', '>', now()->toDateString())
                      ->select('id','due_when')
                      ->latest('created_at')
                      ->first();
        $data['level'] =  Loans::where('user_id', Auth::user()->id)->select('paid')->where('paid', Loans::STATUS_APPROVED)->count();
        $data['user'] =  Auth::user();
        return view('users.loans.index', $data);
    }

    public function submitLoan(Request $request){
        $validatedData = $request->validate([
            'employment' => 'required|integer',
            'fullname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'amount' => 'required|numeric',
            'dob' => 'required|date',
            'monthly_income' => 'required|numeric',
            'purpose' => 'required',
        ]);

        $user = Auth::user();
        
        if (Loans::where('user_id', $user->id)->whereIn('status', [Loans::STATUS_PENDING])->exists()) {
            $notify[] = ['error', 'You already have a pending or approved loan'];
            return back()->withNotify($notify);
        }
    
        $qualificationPercentage = 0;
    
        if ($validatedData['employment'] >= 4) {
            $qualificationPercentage += 30;
        }
    
        $age = Carbon::parse($validatedData['dob'])->age;
        if ($age >= 18 && $age <= 40) {
            $qualificationPercentage += 30;
        }
    
        if ($validatedData['monthly_income'] >= 20000 && $validatedData['monthly_income'] <= 40000) {
            $qualificationPercentage += 40;
        }
    
        $randomNumber = rand(1, 100);
    
        if ($randomNumber <= $qualificationPercentage) {
            $dateDue = Carbon::now()->addDays(10)->toDateString();
    
            $loan = new Loans();
            $loan->user_id = Auth::user()->id;
            $loan->loan_amount = $validatedData['amount'];
            $loan->user_info = [
                'fullname' => $validatedData['fullname'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'dob' => $validatedData['dob'],
                'job' => $validatedData['employment'],
                'income' => $validatedData['monthly_income'],
                'purpose' => $validatedData['purpose'],
            ];
            $loan->due_when = $dateDue;
            $loan->status = Loans::STATUS_PENDING;
            $loan->save();
    
            $notify[] = ['success', 'Evalution Score: '.$qualificationPercentage.' Loan Available for you is '. $request->amount];
            return \redirect()->to(route('myLoans'))->withNotify($notify);
        } else {
            $dateDue = Carbon::now()->addDays(10)->toDateString();
    
            $loan = new Loans();
            $loan->user_id = Auth::user()->id;
            $loan->loan_amount = $validatedData['amount'];
            $loan->user_info = [
                'fullname' => $validatedData['fullname'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'dob' => $validatedData['dob'],
                'job' => $validatedData['employment'],
                'income' => $validatedData['monthly_income'],
                'purpose' => $validatedData['purpose'],
            ];
            $loan->due_when = $dateDue;
            $loan->status = Loans::STATUS_REJECTED;
            $loan->save();
            
            $notify[] = ['warning', 'Evalution Score:'.$qualificationPercentage.' Loan Application Rejected'];
            return \redirect()->to(route('myLoans'))->withNotify($notify);
        }
    }
    
}


