<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;
use App\Models\Advert;
use App\Models\Treads;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\ActivityBonus;
use App\Models\CategoryTread;
use App\Models\EarningHistory;
use App\Models\ReadingHistory;
use App\Models\GeneralSettings;
use App\Models\AdvertPostHistory;
use Illuminate\Support\Facades\URL;
use App\Models\SponsoredPostHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class TreadController extends Controller
{
    use SEOToolsTrait;

    private function catch_that_image($tread, $gts)
    {
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $tread->content, $matches);
        if ($output == 1) {
            return asset($matches[1][0]);
        } else {
            return asset('images/general/' . $gts->socialIcon);
        }
    }

    public function tread($id){
        try{
            $gt = GeneralSettings::first();
            $tread = Treads::where('slug', $id)->firstOrFail();
            $sponsored_post = \App\Models\CategoryTread::where('tread_id', $tread->id)->get();
            $gists = \App\Models\Treads::where('status', 1)->orderBy('created_at', 'DESC')->where('is_tread', 1)->limit(5)->get();

            $pageTitle = 'Post Details';
            $pageSubtitle = $tread->slug;
            $this->seo()->setTitle($tread->slug);
            $this->seo()->setTitle($tread->title);
            $this->seo()->setDescription( $tread->content ? Str::limit(strip_tags(preg_replace('#^data:image/[^;]+;base64,#', '', $tread->content), 200)) : '---' );
            $this->seo()->opengraph()->setUrl(Url::current());
            $this->seo()->opengraph()->addProperty('type', 'articles');
            $this->seo()->opengraph()->addImage($this->catch_that_image($tread, $gt), ['height' => 300, 'width' => 300]);

            if (Auth::check()== true) {
                $user = Auth::user();
                // dd('hey');
                
                // if ($this->isEligibleForReadingBonus($user, $tread)) {
                //     $this->creditUserForReadingPost($user, $tread);
                // }
                if ($tread->status) {
                    return view('single', compact('tread', 'gt','sponsored_post','gists', 'pageTitle', 'pageSubtitle'));
                } else {
                    return abort('404');
                }
            } else {
                if ($tread->status) {
                    return view('single', compact('tread', 'gt','sponsored_post','gists', 'pageSubtitle', 'pageTitle'));
                } else {
                    return abort('404');
                }
            }
        } catch (\Exception $e) {
            // Handle exceptions here
        }
    }

    private function isEligibleForReadingBonus($user, $tread)
    {
        if (!$user->readingHistories()->where('tread_id', $tread->id)->exists() && $user->last_login_at) {
            $last_login = Carbon::createFromFormat('Y-m-d H:s:i', $user->last_login_at);
            $tread_created = Carbon::createFromFormat('Y-m-d H:s:i', $tread->created_at);
            $now = Carbon::now();

            $the_last_login = $last_login->diffInHours($now);
            $tread_posted_at = $tread_created->diffInHours($now);
            $activityBonus = ActivityBonus::first();

            return $the_last_login <= 24 && $tread_posted_at <= 24 && $user->no_of_post_view <= $activityBonus->no_of_post_view && $user->is_block == 0;
        }

        return false;
    }

    private function creditUserForReadingPost($user, $tread)
    {
        $plan = Plan::where('id', $user->plan)->first();
        $user->no_of_post_view += 1;
        $user->allowi_balance += $plan->reading;
        $user->save();

        $earning = new EarningHistory();
        $earning->user_id = $user->id;
        $earning->amount = $plan->reading;
        $earning->type = "Reading Bonus";
        $earning->save();

        $reading = new ReadingHistory();
        $reading->user_id = $user->id;
        $reading->tread_id = $tread->id;
        $reading->save();
    }

 
    public function treadID($id) {
        $tread = Treads::findOrFail($id);
        return \redirect()->to(route('tread', $tread->slug));
    }

    public function search(Request $request){

        $id = $request['term'];
        $get_tread = Treads::where('title','LIKE','%'.$id.'%')->where('status', 1)->where('is_tread', 1)->orderBy('created_at', 'DESC')->get();
        $get_pd_1 = Treads::where('title','LIKE','%'.$id.'%')->first();

        $gt = GeneralSettings::first();

        $this->seo()->setTitle(count($get_tread).' Search result found');
        $this->seo()->setDescription('Showing over '. count($get_tread). ' search result found');
        $this->seo()->opengraph()->setUrl(Url::current());
        $this->seo()->opengraph()->addProperty('type', 'articles');
        $this->seo()->opengraph()->addImage(asset('images/general/'.$gt->socialIcon), ['height' => 300, 'width' => 300]);


        Session::flash('search', $id);


        return view('search', compact('get_tread', 'id', 'gt'));
    }

    
    public function shareSponsoredPost($slug)
    {
        if (Auth::check()) {

            $user_check = Auth::user();
            $user = User::where('id', $user_check->id)->first();

            if (!SponsoredPostHistory::where('tread_id', $slug)->where('user_id', $user->id)->exists()) {
                $tread = Treads::where('slug', $slug)->first();
                $last_login = Carbon::createFromFormat('Y-m-d H:s:i', $user->last_login_at);
                $tread_created_at = Carbon::createFromFormat('Y-m-d H:s:i', $tread->created_at);
                $now = Carbon::now();

                $the_last_login = $last_login->diffInHours($now);
                $tread_last_created = $tread_created_at->diffInHours($now);

                if ($the_last_login <= 24 && $tread_last_created <= 24 && $user->no_of_sponsored == 0 && $user->is_block == 0) {
                    //Credit the user for sharing the sponsored post
                    $plan = Plan::where('id', $user->plan)->first();

                    $user->no_of_sponsored = 1;
                    $user->allowi_balance += $plan->sponsored;
                    $user->save();

                    $earning = new EarningHistory();
                    $earning->user_id = $user->id;
                    $earning->amount = $plan->sponsored;
                    $earning->type = "Sponsored Post Bonus";
                    $earning->save();

                    $share = new SponsoredPostHistory();
                    $share->user_id = $user->id;
                    $share->tread_id = $slug;
                    $share->status = 1;
                    $share->save();
                }
            }
        }

        $notify[] = ['success', 'You have earned for today\'s post '.date('Y-m-d') ];
        return \redirect()->back()->withNotify($notify);

        // return Redirect::to("https://www.facebook.com/sharer/sharer.php?u=" . urlencode(url('/') . "/" . $slug));
    }

    public function AdsID($id) {
        $tread = Advert::findOrFail($id);
        return \redirect()->to(route('AdsE', $tread->slug));
    }
    public function AdsE($id){
        try{
            $gt = GeneralSettings::first();
            $tread = Advert::where('slug', $id)->firstOrFail();
            $gists = Advert::where('status', 1)->orderBy('created_at', 'DESC')->limit(5)->get();

            $pageTitle = 'Post Details';
            $pageSubtitle = $tread->slug;
            $this->seo()->setTitle($tread->slug);
            $this->seo()->setTitle($tread->title);
            $this->seo()->setDescription( $tread->content ? Str::limit(strip_tags(preg_replace('#^data:image/[^;]+;base64,#', '', $tread->content), 200)) : '---' );
            $this->seo()->opengraph()->setUrl(Url::current());
            $this->seo()->opengraph()->addProperty('type', 'articles');
            $this->seo()->opengraph()->addImage($this->catch_that_image($tread, $gt), ['height' => 300, 'width' => 300]);

            if (Auth::check()== true) {
                $user = Auth::user();

                if ($tread->status) {
                    return view('ads-details', compact('tread', 'gt','gists', 'pageTitle', 'pageSubtitle'));
                } else {
                    return abort('404');
                }
            } else {
                if ($tread->status) {
                    return view('ads-details', compact('tread', 'gt','pageSubtitle', 'pageTitle'));
                } else {
                    return abort('404');
                }
            }
        } catch (\Exception $e) {
            // Handle exceptions here
        }
    }

    public function shareAdvert($slug)
    {
        if (Auth::check()) {

            $user_check = Auth::user();
            $user = User::where('id', $user_check->id)->first();

            if (!AdvertPostHistory::where('tread_id', $slug)->where('user_id', $user->id)->exists()) {
                $tread = Advert::where('slug', $slug)->first();
                $last_login = Carbon::createFromFormat('Y-m-d H:s:i', $user->last_login_at);
                $tread_created_at = Carbon::createFromFormat('Y-m-d H:s:i', $tread->created_at);
                $now = Carbon::now();

                $the_last_login = $last_login->diffInHours($now);
                $tread_last_created = $tread_created_at->diffInHours($now);

                if ($the_last_login <= 24 && $tread_last_created <= 24 && $user->no_of_ads == 0 && $user->is_block == 0) {
                    //Credit the user for sharing the sponsored post
                    $plan = Plan::where('id', $user->plan)->first();

                    $user->no_of_ads = 1;
                    $user->allowi_balance += $plan->advert;
                    $user->save();

                    $earning = new EarningHistory();
                    $earning->user_id = $user->id;
                    $earning->amount = $plan->advert;
                    $earning->type = "Advert Post Bonus";
                    $earning->save();

                    $share = new AdvertPostHistory();
                    $share->user_id = $user->id;
                    $share->tread_id = $slug;
                    $share->status = 1;
                    $share->save();
                }
            }else{
                $notify[] = ['warning', 'You have earned from this advert'];
                return back()->withNotify($notify);
            }
        }
        
        

        return Redirect::to($tread->ad_link);
    }

}
