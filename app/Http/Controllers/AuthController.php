<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;

use App\Testimonial;
use App\Mail\Referral;
use App\Models\Advert;
use App\Models\Market;
use App\Models\Vendor;
use App\Models\Influencer;
use App\Mail\ResetPassword;
use App\Models\CouponCodes;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\ActivityBonus;
use App\Models\payoutRequest;
use App\Models\EarningHistory;
use App\Models\MarketCategory;
use App\Models\PasswordResetM;
use App\Mail\AccountActivation;
use App\Models\GeneralSettings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Artesaos\SEOTools\Facades\SEOMeta;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class AuthController extends Controller
{
    use SEOToolsTrait;

    public function home(){
        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle($gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        // $this->seo()->setKeywords();
        $this->seo()->opengraph()->setUrl(Url::current());
        $this->seo()->opengraph()->addProperty('type', 'articles');
        $this->seo()->opengraph()->addImage(asset('images/general/'.$gt->socialIcon), ['height' => 300, 'width' => 300]);

        return view('index', compact('gt'));
    }


    public function newlook(){
        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle($gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        //$this->seo()->setKeywords();
        $this->seo()->opengraph()->setUrl(Url::current());
        $this->seo()->opengraph()->addProperty('type', 'articles');
        $this->seo()->opengraph()->addImage(asset('images/general/'.$gt->socialIcon), ['height' => 300, 'width' => 300]);

        return view('index', compact('gt'));
    }

    public function newlook2(){
        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle($gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        //$this->seo()->setKeywords();
        $this->seo()->opengraph()->setUrl(Url::current());
        $this->seo()->opengraph()->addProperty('type', 'articles');
        $this->seo()->opengraph()->addImage(asset('images/general/'.$gt->socialIcon), ['height' => 300, 'width' => 300]);

        return view('newlook2.main', compact('gt'));
    }

    public function newlook3(){
        $user = Auth::user();
        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle($gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        //$this->seo()->setKeywords();
        $this->seo()->opengraph()->setUrl(Url::current());
        $this->seo()->opengraph()->addProperty('type', 'articles');
        $this->seo()->opengraph()->addImage(asset('images/general/'.$gt->socialIcon), ['height' => 300, 'width' => 300]);
        return view('newlook3.main', compact('gt', 'user'));
    }
    
    public function news(){
        $pageTitle = 'All News';
        $pageSubtitle ='Sponsored Post';
        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle($gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        //$this->seo()->setKeywords();
        $this->seo()->opengraph()->setUrl(Url::current());
        $this->seo()->opengraph()->addProperty('type', 'articles');
        $this->seo()->opengraph()->addImage(asset('images/general/'.$gt->socialIcon), ['height' => 300, 'width' => 300]);
        

        return view('news', compact('gt', 'pageTitle', 'pageSubtitle'));
    }

    public function Ads(){
        $data['pageTitle'] = 'All Adverts';
        $data['pageSubtitle'] ='Advert Post';
        $data['gists'] = Advert::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(4);
        $data['gt'] = GeneralSettings::first();
        SEOMeta::addKeyword( $data['gt']->keywords ? $data['gt']->keywords : '' );
        $this->seo()->setTitle($data['gt']->title);
        $this->seo()->setDescription( $data['gt']->description ? $data['gt']->description : '' );
        $this->seo()->opengraph()->setUrl(Url::current());
        $this->seo()->opengraph()->addProperty('type', 'articles');
        $this->seo()->opengraph()->addImage(asset('images/general/'.$data['gt']->socialIcon), ['height' => 300, 'width' => 300]);

        return view('ads', $data);
    }


    public function activationCode(){
        $pageTitle = 'Get Code';
        $pageSubtitle ='Click on any Vendor to get Code';
        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Activation Code- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('activation', compact('gt', 'pageTitle', 'pageSubtitle'));
    }




    public function siteStatistics(){

        $pageTitle = 'Top Earners';
        $pageSubtitle ='List of all time Top Earners';
        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Top earners and site statistic- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        // $earners =  User::select('id','avatar', 'username', 'balance', 'total_balance',  DB::raw('balance + total_balance as total'))
        //     ->where('id', '!=', 1)->orderBy('total', 'DESC')
        //     ->take(10)
        //     ->get();

        $earners = DB::table('users')
            ->leftJoin('payout_requests', function($join) {
                $join->on('users.id', '=', 'payout_requests.user_id')
                     ->where('payout_requests.is_payed', '!=', payoutRequest::REJECTED);
            })
            ->select('users.id', 'users.username', 'users.balance','users.avatar', DB::raw('SUM(payout_requests.amount) as total_payouts'))
            ->groupBy('users.id', 'users.username', 'users.balance','users.avatar')
            ->orderByRaw('(users.balance + IFNULL(SUM(payout_requests.amount), 0)) desc')
            ->take(20)
            ->get();
        return view('statistic', compact('gt', 'pageTitle', 'pageSubtitle', 'earners'));
    }

    public function howItWorks(){

        $pageTitle = 'How It Works';
        $pageSubtitle ='Read Through How The Site Works';
        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('How it works- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('how_it_works', compact('gt', 'pageTitle', 'pageSubtitle'));
    }

    public function todaysPayout(){


        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Todays Payout- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('today', compact('gt'));
    }

    public function checkCoupon(){
        $pageTitle = 'Verify Coupon Code';
        $pageSubtitle ='Paste In Your Code to Confirm Your Code Status';
        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Coupon Checker- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('coupon', compact('gt', 'pageTitle', 'pageSubtitle'));

    }

    public function applyVendor(){

        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Apply for vendor - '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('Auth.vendor', compact('gt'));

    }
    
    public function freebies(){


        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Win Random prices- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('freebies', compact('gt'));
    }
    
    public function leaderboard(){


        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Contest Leaderboard- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('leaderboard', compact('gt'));
    }

    public function marketplace(){

        $pageTitle = 'Marketplace';
        $pageSubtitle ='Marketplace';
        $gt = GeneralSettings::first();
        $products = Market::orderBy('created_at', 'DESC')->where('status', 1)->paginate(10);
        $category = MarketCategory::get();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Job marketplace to find amazing talents for your next big project- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('marketplace', compact('gt', 'pageTitle', 'pageSubtitle', 'products', 'category'));
    }

    public function marketplaceCategory($id){
        $category_request = MarketCategory::where('slug', $id)->first();
        $gt = GeneralSettings::first();
        $data['pageTitle'] = $category_request->category_name;
        $data['pageSubtitle'] = $category_request->category_name;
        $data['gt'] = GeneralSettings::first();
        $data['products'] = Market::orderBy('created_at', 'DESC')->where('status', 1)->where('cat_id', $category_request->id )->paginate(10);
        $data['category'] = MarketCategory::get();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle($category_request->description.' '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );

        return view('marketplace-category', $data);
    }

    public function marketplaceCatID($id) {
        $cat = MarketCategory::findOrFail($id);
        return \redirect()->to(route('marketplaceCategory', $cat->slug));
    }

    public function productSearch(Request $request){

        $id = $request['term'];
        $products = Market::where('product_name','LIKE','%'.$id.'%')->where('status', 1)->orderBy('created_at', 'DESC')->get();
        $category = MarketCategory::get();
        $gt = GeneralSettings::first();

        $pageTitle = $id.' Searched';
        $pageSubtitle = $products->count().' Search result';

        $this->seo()->setTitle($products->count().' Search result found');
        $this->seo()->setDescription('Showing over '. $products->count(). ' search result found');
        $this->seo()->opengraph()->setUrl(Url::current());
        $this->seo()->opengraph()->addProperty('type', 'articles');
        $this->seo()->opengraph()->addImage(asset('images/general/'.$gt->socialIcon), ['height' => 300, 'width' => 300]);

        Session::flash('search', $id);

        return view('product-search', compact('products', 'id', 'gt', 'category', 'pageTitle', 'pageSubtitle' ));
    }
    
    public function productLike(Request $request){
        if(!Auth::check()){
           return response()->json(['error' => 'You need to be logged in to perform this action']);
        }
        if(Auth::user()->id == $request->user_id){
           return response()->json(['error' => 'You cannot like your own product']);
        }
        $likeProduct = Market::where('id', $request->id)->findOrFail($request->id);
        $likeProduct->likes += 1;
        $likeProduct->save();
        return response()->json(['success' => 'You like this product']);
    }
    public function productDetails($id){
        $gt = GeneralSettings::first();
        $product = Market::where('slug', $id)->firstOrFail();

        $pageTitle = 'Product Details';
        $pageSubtitle = $product->name;
        $this->seo()->setTitle($product->slug);
        $this->seo()->setTitle($product->title);
        $this->seo()->setDescription( $product->description ? Str::limit(strip_tags(preg_replace('#^data:image/[^;]+;base64,#', '', $product->description), 200)) : '---' );
        $this->seo()->opengraph()->setUrl(Url::current());
        $this->seo()->opengraph()->addProperty('type', 'articles');
        
        function catch_that_image($product,  $gts) {
            $first_img = '';
            $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $product->description, $matches);
            if($output ==  1){
                return $first_img = asset($matches[1][0]);
            } else {
                return $first_img = asset('images/general/'.$gts->socialIcon);
            }
        }
        
        $this->seo()->opengraph()->addImage(catch_that_image($product, $gt), ['height' => 300, 'width' => 300]);

        return view('product-single', compact('product', 'gt','pageSubtitle', 'pageTitle'));
 
    }

    public function testimonial(){


        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Read the Testimony of People That Have Completed The Bismart You Learn Program- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('testimonial', compact('gt'));
    }

    public function createTestimony(){


        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Share to others what you have gained with Bismart- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('createTestimony', compact('gt'));
    }

    public function terms(){

        $pageTitle = 'Terms and Condition';
        $pageSubtitle ='Go through our terms and conditions';
        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Terms and Condition- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('terms', compact('gt','pageTitle','pageSubtitle'));
    }
    
    public function howRegister(){
        $pageTitle = 'How to Register';
        $pageSubtitle ='Instruction on how to Get Started';

        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : 'Bismart how to register' );
        $this->seo()->setTitle('How to register- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('howRegister', compact('gt', 'pageTitle', 'pageSubtitle'));
    }
    
    public function privacy(){
        
        $pageTitle = 'Privacy Policy';
        $pageSubtitle ='INSTANTNAIRE Privacy Policies';

        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Privacy Policies- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('privacy', compact('gt', 'pageTitle', 'pageSubtitle'));
    }

    public function aboutUs(){
        
        $pageTitle = 'About Us';
        $pageSubtitle ='Everything you need to know about us';

        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('About Us- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('about', compact('gt', 'pageTitle', 'pageSubtitle'));
    }
    
    public function contact(){
        
        $pageTitle = 'Contact Us';
        $pageSubtitle ='Send us a direct message';

        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Privacy Policies- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('contact', compact('gt', 'pageTitle', 'pageSubtitle'));
    }

    public function contactPost(Request $request){
        $rules = [
            'fullname' => 'required|max:120|string',
            'subject' => 'required|max:120|min:6',
            'email' => 'required|max:120|email',
            'message' => 'nullable'
        ];

        $messages = [

            'fullname.required' => 'Fullnameis required',
            'fullname.max' => 'Fullname is too long',
            'fullname.string' => 'Fullname is invalid',

            'subject.required' => 'Subject is required',
            'subject.max' => 'Subject is too long',
            'subject.string' => 'Subject  is invalid',

            'email.required' => 'Email is required',
            'email.max' => 'Email is too long',
            'email.string' => 'Email is invalid',
            'email.email' => '* Please enter a valid email, specifically with the "@ symbol"',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }  else {
                $the_user = new Vendor();
                $the_user->fullname = $request->fullname;
                $the_user->email = $request->email;
                $the_user->subject = $request->subject;
                $the_user->message = $request->message;
                $the_user->save();

                $notify[] = ['success', 'Your Message have been recieved!'];
                return back()->withNotify($notify);
        }
    }

    public function couponCheckerPost(Request $request){
        $rules = [
            'coupon' => 'required',
        ];

        $messages = [
            'coupon.required' => '* This field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {

            if(CouponCodes::where('coupon_code', $request->coupon)->exists() == true){

                if(CouponCodes::where('coupon_code', $request->coupon)->first()->is_used == 1){

                    $user_id = CouponCodes::where('coupon_code', $request->coupon)->first()->user_id;
                    $date = CouponCodes::where('coupon_code', $request->coupon)->first()->updated_at;
                    $user = User::where('id', $user_id)->first();
                    $plan = Plan::where('id', CouponCodes::where('coupon_code', $request->coupon)->first()->plan)->first()->name;
                    $message = "Coupon code belong to ".$plan.". It has already been used by".$user->username." on ".$date." referral bonus awarded to ".get_referral_by_bonus_by_name($user->id); 

                    $notify[] = ['warning', $message];
                    return back()->withNotify($notify);
                } 
                else {
                    $notify[] = ['success', 'Coupon code has not been used!'];
                    return back()->withNotify($notify);
                }

            }  else {

                    $notify[] = ['error', 'Coupon code does not exist please try a different one or contact your coupon agent if issue persist.'];
                    return back()->withNotify($notify);
            }
        }

    }

    public function signup(Request $request){
        if ($request->ref) {
            $ref = User::where('referral_id', $request->ref)->first();
            if(!$ref){
                $notify[] = ['error', 'Referral Link Does Not Exist'];
                return \redirect()->to(url('/'))->withNotify($notify);
            }
            $ref_id = $ref->referral_id;
        }else{
            $ref_id = User::find(1)->referral_id;
        }
        
        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Create a Free Account- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('register', compact('gt', 'ref_id'));
    }

    public function signupPost(Request $request){

        $this->validate($request, [
            'referral_id' => 'required|max:120|string',
            'username' => 'required|alpha_num|max:120|string|unique:users',
            'fullname' => 'required|max:120|string',
            'password' => 'required|max:120|min:6',
            'number' => 'required|max:120|min:6',
            'country' => 'required',
            'email' => 'required|max:120|email|unique:users',
            'coupon' => 'required'
        ]);
                              
        $the_coupon_code = CouponCodes::where('coupon_code', $request->coupon);

        if ($the_coupon_code->exists() == false) {
            $notify[] = ['error', 'Coupon code does not exist please try a different one or contact your coupon agent if issue persist.'];
            return back()->withNotify($notify);
        }

        if ($the_coupon_code->first()->is_used == 1) {
            $notify[] = ['error', 'Coupon code has already been used, Please try a different one.'];
            return back()->withNotify($notify);
        }

        if (User::where('referral_id', $request->referral_id)->exists() == true) {
            $the_referral = User::where('referral_id', $request->referral_id)->first();
        } else {
            $notify[] = ['error', 'Referral not found!'];
        }

        $the_code = CouponCodes::where('coupon_code', $request->coupon)->first();
        $the_plan = Plan::where('id', $the_code->plan)->first();

        $verification_code =verificationCode(6);

        $user = User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'number' => $request->number,
            'country' => $request->country,
            'password' => Hash::make($request->password),
            'referred_by_id' => $the_referral->id,
            'referral_id' => $request->username . '-' . Str::upper(Str::random('5')),
            'verification_token' => $verification_code,
            'plan' => $the_code->plan,
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'w_limit' => $the_plan->min_noref,
            'allowi_balance' => $the_plan->registeration_bonus,
        ]);

        updateCodeStatus($the_code, $user->id);
        
        // Lets Credit the referral
        $ref_id = User::where('referral_id', $request->referral_id)->first();
        $parent = User::where('id', $ref_id->id)->first();

        $registered_user_plan = Plan::find($user->plan)->amount;
        $referral_user_plan = Plan::find($the_referral->plan)->amount;

        // Update the referral and Indirect Referral
        if ($registered_user_plan <= $referral_user_plan) {
            if ($parent) {
                // $parent->indirect_ref += $the_plan->referral_bonus;
                $parent->balance += $the_plan->referral_bonus;
                $parent->save();

                if($parent->influencer){
                    $influencer = Influencer::where('user_id', $parent->id)->first();
                    $influencer->salary += 300;
                    $influencer->save();

                    $earning = new EarningHistory();
                    $earning->user_id = $parent->id;
                    $earning->amount = 300;
                    $earning->type = 'Salary earned';
                    $earning->save();
                }

                //Earning History
                $earning = new EarningHistory();
                $earning->user_id = $parent->id;
                $earning->amount = $the_plan->referral_bonus;
                $earning->type = 'Referral Bonus on ' . $user->username;
                $earning->save();

                $subject = $parent;

                $data = array(
                    'fullname' => $parent->fullname,
                    'downline' => $user->username,
                    'type' => 'Referral Bonus',
                    'amount' => $the_plan->referral_bonus,
                );
                try {
                    Mail::to($subject)->send(new Referral($data));
                } catch (\Exception $e) {
                }
            }

            //update Grandparent Cycle
            $grand_parent = User::where('id', $parent->referred_by_id)->first();
            if ($grand_parent) {

                $grand_parent->balance += $the_plan->indirect_ref;
                $grand_parent->indirect_ref += $the_plan->indirect_ref;
                $grand_parent->save();

                //EarningHistory
                $earning = new EarningHistory();
                $earning->user_id = $grand_parent->id;
                $earning->amount = $the_plan->indirect_ref;
                $earning->type = 'Indirect Bonus from ' . $parent->username;
                $earning->save();

                $subject_a = $grand_parent;

                $data = array(
                    'fullname' => $grand_parent->fullname,
                    'downline' => $parent->username,
                    'type' => 'Indirect Bonus',
                    'amount' => $the_plan->indirect_ref
                );

                try {
                    Mail::to($subject_a)->send(new Referral($data));
                } catch (\Exception $e) {
                }
            }
        }

        // Create Earning History For User
        $earning = new EarningHistory();
        $earning->user_id = $user->id;
        $earning->amount = $the_plan->registeration_bonus;
        $earning->type = "Registration Bonus";
        $earning->save();

        // Send Email to user
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

        Auth::login($user, true);

        $notify[] = ['success', 'Successfully Registered. Kindly Setup Your Profile'];
        return \redirect()->to(route('account'))->withNotify($notify);

    }


    public function signin(){

        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Login Account - '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('users.login', compact('gt'));
    }


    public function signinpost(Request $request){
        $rules = [
            'id' => 'required|max:100|string',
            'password' => 'required|max:120',
        ];

        $messages = [
            'id.required' => '* Please enter either your accounts username or email',
            'id.max' => '* Field is too long',
            'id.string' => '* Login Id must be a character',

            'password.required' => '* Please enter your accounts password',
            'password.max' => '* Password is too long, please pick something you would remember.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }  else {
           if(User::where('username', $request->id)->orWhere('email', $request->id)->exists() == true){

               $field = filter_var($request->id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
               $credentials = [$field =>$request->id, 'password' => $request->password];
               if(Auth::validate($credentials) == true) {

                   $userlogin = User::where('username', $request->id)->orWhere('email', $request->id)->first();
                   if ($userlogin->is_block == 0 ) {
                       try {
                           if ($userlogin->last_login_at) {
                               $last_login = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $userlogin->last_login_at);
                               $now = \Carbon\Carbon::now();

                               $the_last_login = $last_login->diffInHours($now);
                               if ($the_last_login <= 24 && $userlogin->no_of_login == 0) {
                                   //Credit the user and create a login stamp
                                   $userlogin->allowi_balance = $userlogin->allowi_balance + ActivityBonus::first()->login;
                                   $userlogin->no_of_login = 1;
                                   $userlogin->save();

                                    $earning = new EarningHistory();
                                    $earning->user_id = $userlogin->id;
                                    $earning->amount = ActivityBonus::first()->login;
                                    $earning->type = "Login Bonus";
                                    $earning->save();
                               }

                           }
                       } catch (\Exception $exception) {

                       }

                       $user = Auth::getLastAttempted();
                       Auth::login($user, true);
                       return redirect()->intended();
                   } else {
                       $notify[] = ['error', 'Blocked!, Please contact our support team to resolve any issue you might have with your account right away'];
                       return back()->withNotify($notify)->withInput($request->only('id'));
                   }
               } else {
                   $notify[] = ['error', 'invalid Password, please check and try again.'];
                   return back()->withNotify($notify)->withInput($request->only('id'));
               }

           } else{
               $notify[] = ['error', 'This username does not exist. please check and try again.'];
               return back()->withNotify($notify)->withInput($request->only('id'));
           }
        }
    }


    public function refFallback(Request $request){

        if($request->id !==  null){

            if(User::where('referral_id', $request->id )->exists() == true){
                Session::flash('d_ref', $request->id );
                return \redirect()->to(route('signup'));
            } else {
                Session::flash('ref_not_found', 'Sorry, we could not validate the referral id with any registered users, please check the link and try again, or better still user Bismart if you do not have any referral id.');
                return \redirect()->to(route('signup'));
            }
        } else {

        }
    }


   public function getRef(Request $request, $id){
        return dd($request->$id);
    }

    public function acctPassword(){

        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Reset account\'s password- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );
        return view('Auth.reset_password', compact('gt'));
    }

    public function acctPasswordPost(Request $request){
        $rules = [
            'email' => 'required|max:120|email',
        ];

        $messages = [

            'email.required' => '* This field is required',
            'email.max' => '* This Field is too long',
            'email.string' => '* This field is invalid',
            'email.email' => '* Please enter a valid email, specifically with the "@ symbol"',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }  else {
            if(User::where('email', $request->email)->exists() == true){
                $user = User::where('email', $request->email)->first();

                    $user = PasswordResetM::updateOrCreate([
                    'email' => $request->email,
                    'token' => Str::random(64),
                ]);
                
                Mail::to($user)->send(new ResetPassword($user));

                $notify[] = ['success', 'Please check your email for a reset link.'];
                return \redirect()->to(route('acctPassword'))->withNotify($notify);

            } else {
                $notify[] = ['error', 'This Email Does Nor Exist!.'];
                return back()->withNotify($notify);
            }
        }
    }

    public function acctPasswordStaged($id){

        $gt = GeneralSettings::first();
        SEOMeta::addKeyword( $gt->keywords ? $gt->keywords : '' );
        $this->seo()->setTitle('Reset account\'s password- '.$gt->title);
        $this->seo()->setDescription( $gt->description ? $gt->description : '' );

        $ddd = PasswordResetM::where('token', $id)->firstOrFail();

        return view('Auth.reset_password_staged', compact('id', 'gt'));
    }


    public function acctPasswordStagedPost(Request $request, $token){
        $input = $request->all();

        $rules = [
            'new_password' => 'required|string|min:6|same:new_password_confirmation',
            'new_password_confirmation' => 'required|string',
        ];

        $messages = [

            'new_password.required' => '* This field is required',
            'new_password.string' => '* Invalid password',
            'new_password.min' => '* Password Must be longer than 6 characters',


            'new_password_confirmation.required' => '* This field is required',
            'new_password_confirmation.string' => '* Invalid password',
            'new_password_confirmation.min' => '* Password Must be longer than 6 characters',
            'new_password_confirmation.same' => '* Password confirmation does not match',

        ];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $pword = PasswordResetM::where('token', $token)->OrderBy('created_at', 'DESC')->first();
            $new_user = User::where('email', $pword->email)->first();
            $new_user->update([
                'password' => Hash::make($request->new_password)
            ]);
            PasswordResetM::where('email', $new_user->email)->delete();

            $notify[] = ['success', 'Password changed successfully, you may now login..'];
            return \redirect()->to(route('users.editAccount'))->withNotify($notify);
        }
    }
    
}
