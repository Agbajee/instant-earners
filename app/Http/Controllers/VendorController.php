<?php

namespace App\Http\Controllers;
use App\Models\CouponCodes;
use Illuminate\Http\Request;
use App\Models\GeneralSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response as FacadeResponse;

class VendorController extends Controller
{
    
    public function coupon(){
        $data['title'] = "Vendor Dashboard";
        $data['gt'] = GeneralSettings::first();
        $data['dd1'] = CouponCodes::where('vendor_id', Auth::user()->id)->get();
        $data['dd']  = CouponCodes::orderBy('created_at', 'DESC')->where('vendor_id', Auth::user()->id)->paginate(100);
        $data['is_used'] = CouponCodes::where('is_used', 1)->where('vendor_id', Auth::user()->id)->get();
        $data['is_not_used'] = CouponCodes::where('is_used', 0)->where('vendor_id', Auth::user()->id)->get();
        
		return view('Vendor.Coupon.index', $data);
	}
	
	public function couponused( $used ){
        
        if(!empty($used)){
            $data['title'] = "Vendor || Used Codes";
            $data['gt'] = GeneralSettings::first();
            $data['dd1'] = CouponCodes::where('is_used', '=', $used)->where('vendor_id', Auth::user()->id)->get();
            $data['dd']  = CouponCodes::orderBy('created_at', 'DESC')->where('is_used', '=', $used)->where('vendor_id', Auth::user()->id)->paginate(100);
            $data['is_used'] = CouponCodes::where('is_used', 1)->where('vendor_id', Auth::user()->id)->get();
            $data['is_not_used'] = CouponCodes::where('is_used', 0)->where('vendor_id', Auth::user()->id)->get();
            
            if($data['dd1']->count() > 0){
                
        		return view('Vendor.Coupon.index', $data);
        		
            }
            else{
                $data['title'] = "Vendor || Active Codes";
                $data['gt'] = GeneralSettings::first();
                $data['dd1'] = CouponCodes::where('is_used', 0)->where('vendor_id', Auth::user()->id)->get();
                $data['dd']  = CouponCodes::orderBy('created_at', 'DESC')->where('is_used', 0)->where('vendor_id', Auth::user()->id)->paginate(100);
                $data['is_not_used'] = CouponCodes::where('is_used', 0)->where('vendor_id', Auth::user()->id)->get();
                
                if($data['dd1']->count() >= 0){
                    
            		return view('Vendor.Coupon.index', $data);
            		
                }
            }
        }
        
        abort(404);
        
	}
	
    
    public function couponExport(Request $request){
        $the_selected = explode( ',', $request->selected);
        $s_t_d = CouponCodes::whereIn('id', $the_selected)->where('vendor_id', Auth::user()->id)->get();
        
        $myFile = "coupon_code.txt";
        $fo = fopen($myFile, 'w') or die("can't open file");
        
        $stringData = "\r\n";
        foreach($s_t_d as $d) {
            $stringData.= "\r\n".$d['coupon_code']."\r\n";
        }
        fwrite($fo, $stringData);
        fclose($fo);
        $headers = array(
            'Content-Type' => 'text/plain',
        );
        return FacadeResponse::download($myFile, 'coupon_code.txt', $headers);
    }
}
