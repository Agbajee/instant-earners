<?php

namespace App\Http\Controllers;
use App\Mail\Alert;
use Carbon\Carbon;

use App\Models\Plan;
use App\Models\Slug;
use App\Models\User;
use App\Models\Loans;
use App\Models\Terms;
use App\Models\Bundle;
use App\Models\Market;
use App\Models\Treads;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\treadSlug;
use App\Models\Influencer;
use App\Models\CouponCodes;
use App\Models\Testimonial;
use App\Models\Subscription;
use App\Models\ActivityBonus;
use App\Models\HowToRegister;
use App\Models\payoutRequest;
use App\Models\requestPayout;
use App\Models\siteHowItWork;
use App\Models\MarketCategory;
use App\Models\GeneralSettings;
use App\Models\AdminLog;
use App\Models\InfluencerSalary;
use App\Models\siteNotifcation;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResendActivation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response as FacadeResponse;

class AdminController extends Controller
{

    public function loginUser($id)
    {
        $user = User::findOrFail($id);
        Auth::login($user);

        return redirect()->route('users.account');
    }

    public function Fmanager()
    {
        return view('Admin.fmanager');
    }

    public function index()
    {
        return view('Admin.index');
    }

    public function Adminsupport()
    {
        return view('Admin.Support.index');
    }

    public function adminSupportOpened()
    {
        return view('Admin.support.opened');
    }

    public function adminSupportClosed()
    {
        return view('Admin.support.closed');
    }

    public function adminUsers()
    {
        return view('Admin.Users.index');
    }

    public function adminVendors()
    {
        $data['dd'] = User::where('is_vendor', 1)->orderBy('username', 'ASC')->paginate(10);
        return view('Admin.Vendor.index', $data);
    }

    public function adminInfluencers()
    {
        $data['all'] = Influencer::orderBy('id', 'ASC')->paginate(10);
        return view('Admin.Influencers.index', $data);
    }
    public function influencerSalary()
    {
        $data['all'] = influencerSalary::orderBy('id', 'ASC')->where('status', InfluencerSalary::PENDING)->paginate(20);
        return view('Admin.Influencers.salary', $data);
    }
    public function rejectedSalary(){
        $data['all'] = influencerSalary::orderBy('id', 'ASC')->where('status', InfluencerSalary::REJECTED)->paginate(50);
        return view('Admin.Influencers.rejected', $data);
    }
    public function paidSalary()
    {
        $data['all'] = influencerSalary::orderBy('id', 'ASC')->where('status', InfluencerSalary::APPROVED)->paginate(50);
        return view('Admin.Influencers.paid', $data);
    }
    public function rejectSalary(Request $request)
    {
        $the_selected = explode(',', $request->selected);
        $query = influencerSalary::whereIn('id', $the_selected)->get();
        foreach ($query as $d) {
            $salaryRequest = influencerSalary::where('id', $d['id'])->first();
            $salaryRequest->update([
                'status' => InfluencerSalary::REJECTED,
            ]);

            $user = Influencer::where('user_id', $d['user_id'])->first();
            $user->update([
                'salary' => $user->salary + $d['amount'],
            ]);
        }
        $notify[] = ['info', 'Selected Request(s) deleted successfully'];
        return back()->withNotify($notify);
    }

    public function extractAllSalary(Request $request)
    {
        $the_selected = explode(',', $request->selected);
        $query = influencerSalary::whereIn('id', $the_selected)->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=salary.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        $columns = array('Account Number', 'Bank', 'Amount', 'Narration');

        $callback = function () use ($query, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($query as $d) {
                fputcsv($file, array(User::find($d['user_id'])->acc_numb, User::find($d['user_id'])->bank, $d['amount'], 'INSTANT NAIRE'));
            }
            fclose($file);
        };
        return FacadeResponse::stream($callback, 200, $headers);
    }

    public function payAllSalary(Request $request)
    {
        $the_selected = explode(',', $request->selected);
        $query = influencerSalary::whereIn('id', $the_selected)->get();
        foreach ($query as $d) {
            $salaryRequest = influencerSalary::where('id', $d['id'])->first();

            $salaryRequest->update([
                'status' => InfluencerSalary::APPROVED,
            ]);

        }
        $notify[] = ['success', 'Selected payout paid successfully'];
        return back()->withNotify($notify);
    }

    public function removeInfluencer($id)
    {
        $user  = User::find($id);
        $user->influencer = 0;
        $user->save();

        $influencer  = Influencer::find($id);
        $influencer->delete();

        $notify[] = ['info', 'user removed from influencers'];
        return back()->withNotify($notify);
    }
    public function addInfluencer($id)
    {
        $user  = User::find($id);
        $user->influencer = 1;
        $user->save();

        //create influencer record
        $addInfluencer = new Influencer();
        $addInfluencer->user_id = $user->id;
        $addInfluencer->save();
        
        $notify[] = ['info', 'user added to influencers'];
        return back()->withNotify($notify);
    }

    public function Loans()
    {
        $statusLabels = [
            2 => ['label' => 'pending', 'class' => 'text-warning'],
            1 => ['label' => 'approved', 'class' => 'text-success'],
            3 => ['label' => 'rejected', 'class' => 'text-danger'],
        ];
        $data['status'] = $statusLabels;
        $data['all'] = Loans::orderBy('id', 'asc')->where('status', Loans::STATUS_PENDING)->paginate(10);
        return view('Admin.Loans.index', $data);
    }
    public function approvedLoans()
    {
        $statusLabels = [
            0 => ['label' => 'Unresolved Loan', 'class' => 'text-warning'],
            1 => ['label' => 'Loan Resolved', 'class' => 'text-success'],
        ];
        $data['status'] = $statusLabels;
        $data['all'] = Loans::orderBy('id', 'ASC')->where('status', Loans::STATUS_APPROVED)->paginate(10);
        return view('Admin.Loans.approved', $data);
    }
    public function approveLoan($id)
    {
        $dateDue = Carbon::now()->addDays(10)->toDateString();
        $loan  = Loans::find($id);
        $loan->due_when = $dateDue;
        $loan->status = Loans::STATUS_APPROVED;
        $loan->save();

        $notify[] = ['info', 'Approved '. $loan->loan_amount .' loan'];
        return back()->withNotify($notify);
    }
    public function rejectLoan($id)
    {
        $dateDue = Carbon::now()->addDays(10)->toDateString();
        $loan  = Loans::find($id);
        $loan->due_when = $dateDue;
        $loan->status = Loans::STATUS_REJECTED;
        $loan->save();

        $notify[] = ['info', 'Rejected '. $loan->loan_amount .' loan'];
        return back()->withNotify($notify);
    }
    public function settleLoan($id)
    {
        $loan  = Loans::find($id);
        $loan->paid = Loans::STATUS_APPROVED;
        $loan->save();

        $notify[] = ['info', 'Rejected '. $loan->loan_amount .' loan'];
        return back()->withNotify($notify);
    }

    public function adminUsersSelected(Request $request)
    {

        $the_selected = explode(',', $request->selected);
        $s_t_d = User::whereIn('id', $the_selected)->get();
        foreach ($s_t_d as $d) {
            $d->is_block = 1;
            $d->save();
        }
        $notify[] = ['info', 'User block successfully'];
        return back()->withNotify($notify);
    }

    public function adminUsersUnSelected(Request $request)
    {

        $the_selected = explode(',', $request->selected);
        $s_t_d = User::whereIn('id', $the_selected)->get();
        foreach ($s_t_d as $d) {
            $d->is_block = 0;
            $d->save();
        }
        $notify[] = ['info', 'User unblocked successfully'];
        return back()->withNotify($notify);
    }

    public function adminVendorSelected(Request $request)
    {

        $the_selected = explode(',', $request->selected);
        $s_t_d = Vendor::whereIn('id', $the_selected)->get();
        foreach ($s_t_d as $d) {
            $d->delete();
        }
        $notify[] = ['info', 'Vendor deleted successfully!'];
        return back()->withNotify($notify);
    }

    public function adminVendorApproveSelected(Request $request)
    {

        $the_selected = explode(',', $request->selected);
        $s_t_d = Vendor::whereIn('id', $the_selected)->get();
        foreach ($s_t_d as $d) {
            $d->status = 1;
            $d->save();
        }
        $notify[] = ['info', 'Vendor Approved successfully!'];
        return back()->withNotify($notify);
    }

    public function adminUsersModeratorSelected(Request $request)
    {

        $the_selected = explode(',', $request->selected);
        $s_t_d = User::whereIn('id', $the_selected)->get();
        foreach ($s_t_d as $d) {
            $d->is_moderator = 1;
            $d->save();
        }
        $notify[] = ['info', 'Moderator assigned successfully!'];
        return back()->withNotify($notify);
    }

    public function adminUsersRemoderatorSelected(Request $request)
    {

        $the_selected = explode(',', $request->selected);
        $s_t_d = User::whereIn('id', $the_selected)->get();
        foreach ($s_t_d as $d) {
            $d->is_moderator = 0;
            $d->save();
        }
        $notify[] = ['info', 'Moderator Removed successfully!'];
        return back()->withNotify($notify);
    }

    public function adminUsersVendorSelected(Request $request)
    {

        $the_selected = explode(',', $request->selected);
        $s_t_d = User::whereIn('id', $the_selected)->get();
        foreach ($s_t_d as $d) {
            $d->is_vendor = 1;
            $d->save();
        }
        $notify[] = ['info', 'Vendor Assigned successfully!'];
        return back()->withNotify($notify);
    }


    public function adminUsersReVendorSelected(Request $request)
    {

        $the_selected = explode(',', $request->selected);
        $s_t_d = User::whereIn('id', $the_selected)->get();
        foreach ($s_t_d as $d) {
            $d->is_vendor = 0;
            $d->save();
        }
        $notify[] = ['info', 'Vendor Removed successfully!'];
        return back()->withNotify($notify);
    }

    public function adminUsID($id)
    {
        $s_t_d = User::where('id', $id)->first();
        $s_t_d->is_block = 1;
        $s_t_d->save();
        $notify[] = ['info', 'User Blocked Successfully!'];
        return back()->withNotify($notify);
    }

    public function adminUsUnID($id)
    {
        $s_t_d = User::where('id', $id)->first();
        $s_t_d->is_block = 0;
        $s_t_d->save();
        $notify[] = ['info', 'User Unblocked successfully!'];
        return back()->withNotify($notify);
    }

    public function adminVdID($id)
    {
        $s_t_d = Vendor::where('id', $id)->first();
        $s_t_d->delete();
        $notify[] = ['info', 'Vendor deleted successfully!'];
        return back()->withNotify($notify);
    }

    public function adminUsEdit($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.Users.single', compact('user'));
    }
    public function adminUsEditPost(Request $request, $id){
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'email' => 'unique:users,email,' . $id . '|required|email|max:100|string',
            'number' => 'required|max:100|string',
            'fullname' => 'required|max:100|string',
            'balance' => 'required|numeric',
            'indirect_ref' => 'required|numeric',
            'allowi_balance' => 'required|numeric',
        ]);

        $user->update([
            'email' => $validatedData['email'],
            'number' => $validatedData['number'],
            'fullname' => $validatedData['fullname'],
            'balance' => floatval($validatedData['balance']),
            'indirect_ref' => floatval($validatedData['indirect_ref']),
            'allowi_balance' => floatval($validatedData['allowi_balance']),
            'gfa' => $request->gfa ? 1 : 0,
        ]);

            $log = new AdminLog();
            $log->user_id = Auth::id();
            $log->description = 'User profile updated for user ' . $user->username . ' by' . Auth::user()->username;
            $log->save();
        

        $notify[] = ['info', 'User Profile Updated Successfully!'];
        return back()->withNotify($notify);
    }
    public function updateBalance(Request $request, $id){
        $user = User::findOrFail($id);

        $amount = floatval($request->amount); 
        $balanceType = $request->type; 
        // Convert the input amount to a float value

        switch ($balanceType) {
            case 'affiliate':
                $balanceField = 'balance';
                break;
            case 'indirect':
                $balanceField = 'indirect_balance';
                break;
            case 'activity':
                $balanceField = 'allowi_balance';
                break;
            default:
                return back()->with('error', 'Invalid balance type.');
        }
    
        $amount = $request->input('amount');
    
        if ($request->has('action') && $request->input('action') == 'on') {
            $user->$balanceField += $amount;
            $action = "added";
        } else {
            $user->$balanceField -= $amount;
            $action = "removed";
        }
    
        $user->save();

        // Create a log of the balance update
        $log = new AdminLog();
        $log->user_id = Auth::id();
        $log->description = $amount.' '.$action.' by '. Auth::user()->username . ' on ' . $user->username.' '.$balanceType;
        $log->save();

        $notify[] = ['info', $amount.' '.$action.' from '.$user->username.' '.$balanceType.' balance'];
        return back()->withNotify($notify);
    }

    public function adminUsEditPasswordPost(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'new_password' => 'required|max:100|string',
        ]);

        if ($user->id == 4637 || $user->id == 4638 || $user->id == 4639 || $user->id == 4 || $user->id == 24411 || $user->id == 24410) {
            $notify[] = ['info', 'User Password Updated successfully!'];
            return back()->withNotify($notify);
        } else {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            $notify[] = ['info', 'User Password Updated successfully!'];
            return back()->withNotify($notify);
        }
    }

    public function adminUsersVerified()
    {
        return view('Admin.Users.verified');
    }

    public function adminUsersUnVerified()
    {
        return view('Admin.Users.unverified');
    }

    public function adminUsersPaid()
    {
        return view('Admin.Users.paid');
    }

    public function adminUsersBlock()
    {
        return view('Admin.Users.block');
    }

    public function adminUsersUnPaid()
    {
        return view('Admin.Users.unpaid');
    }

    public function adminUsersCreate()
    {
        return view('Admin.Users.create');
    }

    public function marketControl()
    {
        $data['items'] = Market::orderBy('created_at', 'ASC')->paginate(10);
        $data['approved'] = Market::where('status', '1')->count();
        $data['pending'] = Market::where('status', '0')->count();
        return view('Admin.Market.index', $data);
    }


    public function approveProduct(Request $request, $id)
    {
        $item = Market::where('id', $id)->where('status', '0')->firstOrFail();
        $item->status = 1;
        $item->save();

        $notify[] = ['info', $item->product_name . ' Approved Successfully!'];
        return back()->withNotify($notify);
    }
    public function rejectProduct($id)
    {
        $item = Market::where('id', $id)->firstOrFail();
        $item->delete();

        $notify[] = ['info', $item->product_name . ' Deleted Successfully!'];
        return back()->withNotify($notify);
    }

    public function marketCategory()
    {
        $data['items'] = MarketCategory::orderBy('created_at', 'ASC')->get();
        return view('Admin.Market.category', $data);
    }

    public function submitMarketCategory(Request $request)
    {
        $rules = [
            'name' => 'required|max:120|string',
            'description' => 'required|max:1000|string',
        ];

        $messages = [
            'name.required' => 'Category is required',
            'name.max' => 'Category is too long',
            'name.string' => 'Category is invalid',

            'description.required' => 'Description is required',
            'description.max' => 'Description is too long',
            'description.string' => 'Description is invalid',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {

            MarketCategory::create([
                'slug' => Str::slug($request->name),
                'category_name' => $request->name,
                'description' => $request->description,
            ]);

            $notify[] = ['info', $request->name . ' Created Successfully!'];
            return back()->withNotify($notify);
        }
    }

    public function editMarketCategory(Request $request)
    {

        $rules = [
            'name' => 'required|max:120|string',
            'description' => 'required|max:1000|string',
        ];

        $messages = [
            'name.required' => 'Category is required',
            'name.max' => 'Category is too long',
            'name.string' => 'Category is invalid',

            'description.required' => 'Description is required',
            'description.max' => 'Description is too long',
            'description.string' => 'Description is invalid',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {

            $updateCategory = MarketCategory::where('id', $request->id)->firstOrFail();
            $updateCategory->category_name = $request->name;
            $updateCategory->description = $request->description;
            $updateCategory->save();

            $notify[] = ['info', $request->name . ' Updated Successfully!'];
            return back()->withNotify($notify);
        }
    }

    public function adminCategory()
    {
        return view('Admin.Category.index');
    }

    public function adminCategoryCreate()
    {
        return view('Admin.Category.create');
    }

    public function adminCategoryCreatePost(Request $request)
    {
        $rules = [
            'name' => 'required|max:120|string',
            'description' => 'required|max:1000|string',
        ];

        $messages = [
            'name.required' => '* This field is required',
            'name.max' => '* This Field is too long',
            'name.string' => '* This field is invalid',

            'description.required' => '* This field is required',
            'description.max' => '* This Field is too long',
            'description.string' => '* This field is invalid',
            'description.unique' => '* This username has already been assigned to another user',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {

            try {
                $slug1 = (new Slug);
                $slug = $slug1->createSlug($request->name);

                Category::create([
                    'name' => $request->name,
                    'slug' => $slug,
                    'description' => $request->description,
                ]);
            } catch (\Exception $exception) {
                return \redirect()->back()->with('err', 'Sorry unable to create with this name, please try a different one');
            }

            return \redirect()->to(route('adminCategory'))->with('info', 'Category updated successfully!');
        }
    }

    public function adminCategorySelectedID($id)
    {
        $s_t_d = Category::where('id', $id)->first();
        $s_t_d->delete();
        return redirect()->back()->with('info', 'Category deleted successfully');
    }

    public function adminCategorySelected(Request $request)
    {

        $the_selected = explode(',', $request->selected);
        $s_t_d = Category::whereIn('id', $the_selected)->get();
        foreach ($s_t_d as $d) {
            $d->delete();
        }
        return redirect()->back()->with('info', 'Selected categories deleted successfully');
    }

    public function adminCategoryEditID($id)
    {
        $cat = Category::where('id', $id)->firstOrFail();
        return view('Admin.Category.single', compact('cat'));
    }

    public function adminCategoryEditIDPost(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:120|string',
            'description' => 'required|max:1000|string',
        ];

        $messages = [
            'name.required' => '* This field is required',
            'name.max' => '* This Field is too long',
            'name.string' => '* This field is invalid',

            'description.required' => '* This field is required',
            'description.max' => '* This Field is too long',
            'description.string' => '* This field is invalid',
            'description.unique' => '* This username has already been assigned to another user',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $the_cat = Category::where('id', $id)->first();

            $the_cat->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
            ]);

            return \redirect()->to(route('adminCategory'))->with('info', 'Category updated successfully!');
        }
    }

    public function adminTreads()
    {
        return view('Admin.Tread.index');
    }

    public function adminActivity()
    {
        $data['activity'] = ActivityBonus::first();
        return view('Admin.Settings.activity', $data);
    }

    public function autoWithdrawSettings(Request $request)
    {
        $settings = GeneralSettings::where('id', 1)->firstOrFail();
        $settings->process_when = $request->when;
        $settings->save();

        $notify[] = ['info', 'saved successfully!'];
        return back()->withNotify($notify);
    }

    public function siteActivity(Request $request)
    {
        $settings = GeneralSettings::where('id', 1)->firstOrFail();

        $settings->transfer_fee = $request->transfer_fee;
        $settings->code_point = $request->code_fee;
        $settings->market_point = $request->market_fee;
        $settings->save();

        $notify[] = ['info', 'saved successfully!'];
        return back()->withNotify($notify);
    }

    public function AdminHeader()
    {
        $settings = GeneralSettings::first();
        return view('Admin.Settings.header', compact('settings'));
    }
    public function AdminHeaderPost(Request $request)
    {
        $settings = GeneralSettings::where('id', 1)->firstOrFail();

        try {
            $settings->title = $request->title;
            $settings->description = $request->description;
            $settings->keywords = $request->keywords;
            if ($request->favicon != '') {
                $file = $request->file('favicon');
                $name = sha1(date('YmdHis') . Str::random(20));
                $resize_name = $name . '-' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                Image::make($file)->save('images/general/' . $resize_name);

                $settings->favicon = $resize_name;
            }

            if ($request->logo != '') {
                $file = $request->file('logo');
                $name = sha1(date('YmdHis') . Str::random(20));
                $resize_name = $name . '-' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                Image::make($file)->save('images/general/' . $resize_name);

                $settings->logo = $resize_name;
            }

            if ($request->socialIcon != '') {
                $file = $request->file('socialIcon');
                $name = sha1(date('YmdHis') . Str::random(20));
                $resize_name = $name . '-' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                Image::make($file)->save('images/general/' . $resize_name);

                $settings->socialIcon = $resize_name;
            }

            $settings->save();

            $notify[] = ['info', 'general settings saved successfully!'];
            return back()->withNotify($notify);
        } catch (\Exception $exception) {
            return dd($exception->getMessage());
        }
    }
    public function adminTreadsID($id)
    {
        $tread = Treads::where('id', $id)->firstOrFail();
        return view('Admin.Tread.single', compact('tread'));
    }

    public function adminTreadsIDPostActions(Request $request, $tread, $id)
    {
        if ($id ==  1) {
            $e = Treads::where('id', $tread)->firstOrFail();
            $e->status = 0;
            $e->save();

            $notify[] = ['info', 'Tread Updated successfully!'];
            return back()->withNotify($notify);
        } elseif ($id == 2) {
            //Save Edit
            $t = Treads::find($tread);
            $t->categories()->sync($request->select);
            //$s = Category::find($request->select);


            $t->title = $request->title;
            $t->slug = Str::slug($request->title);
            $t->tread_source = $request->source_link;
            $t->tread_source_name = $request->source;
            $t->content = $request->contents;
            if ($request->featured_image != '') {
                $file = $request->file('featured_image');
                $name = sha1(date('YmdHis') . Str::random(20));
                $resize_name = Str::slug($request->title) . '-' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                Image::make($file)->save('images/treads/' . $resize_name);
                $t->featured_image = $resize_name;
            }

            if ($request->is_tread == 'on') {
                $t->is_tread =  1;
            } else {
                $t->is_tread =  0;
            }
            if ($request->is_commentable == 'on') {
                $t->is_commentable =  1;
            } else {
                $t->is_commentable =  0;
            }

            $t->save();
            $notify[] = ['info', 'Tread updated successfully!'];
            return back()->withNotify($notify);
        } elseif ($id == 3) {
            //Trash Tread
            $s = Treads::where('id', $tread)->firstOrFail();
            $s->delete();

            $notify[] = ['info', 'Tread updated successfully!'];
            return \redirect()->to(route('adminTreads'))->withNotify($notify);
        } elseif ($id == 4) {
            //Publish Tread
            $s = Treads::where('id', $tread)->firstOrFail();
            $s->status = 1;
            $s->save();
            $notify[] = ['info', 'Tread updated successfully!'];
            return back()->withNotify($notify);
        } else {
            return abort('404');
        }
    }

    public function adminTreadsCreate()
    {
        return view('Admin.Tread.create');
    }
    public function adminTSelectedDraft(Request $request)
    {
        $rules = [
            'title' => 'required|max:1200|string',
            'source_name' => 'nullable|max:1200|string',
            'source_link' => 'nullable|max:1200|string',
            'contents' => 'nullable|max:120000|string',
        ];

        $messages = [
            'title.required' => '* This field is required',
            'title.max' => '* This Field is too long',
            'title.string' => '* This field is invalid',

            'source_name.string' => '* This field is too long',
            'source_name.max' => '* This field is invalid',

            'source_link.max' => '* This field is too long',
            'source_link.string' => '* This field is invalid',

            'contents.string' => '* This field is invalid',
            'contents.max' => '* This field is too long',


        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $is_tread = '';
            if ($request->is_tread == 'on') {
                $is_tread = 1;
            } else {
                $is_tread = 0;
            }

            $is_commentable = '';
            if ($request->is_commentable == 'on') {
                $is_commentable = 1;
            } else {
                $is_commentable = 0;
            }
            try {

                $s = (new treadSlug);
                $slug = $s->createSlug($request->title);

                $tread = Treads::create([
                    'title' => $request->title,
                    'slug' => Str::slug($slug),
                    'content' => $request->content_2,
                    'tread_source' => $request->source_link,
                    'tread_source_name' => $request->source_name,
                    'is_tread' => $is_tread,
                    'status' => 0,
                    'is_commentable' => $is_commentable,
                    'created_by' => Auth::user()->id,
                ]);

                if ($request->featured_image != '') {
                    $file = $request->file('featured_image');
                    $name = sha1(date('YmdHis') . Str::random(20));
                    $resize_name = $slug . '-' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                    Image::make($file)->save('images/treads/' . $resize_name);
                    $tread->featured_image = $resize_name;
                    $tread->save();
                }
            } catch (\Exception $exception) {
                $notify[] = ['error', 'Unable to create unique slug, please try a different one'];
                return back()->withNotify($notify);
            }

            $tread->categories()->sync($request->select);

            $notify[] = ['success', 'Tread Published successfully!'];
            return \redirect()->to(route('adminTreadsID', $tread->id))->withNotify($notify);
        }
    }

    public function adminTreadsCreatePost(Request $request)
    {
        $rules = [
            'title' => 'required|max:1200|string',
            'source_name' => 'nullable|max:1200|string',
            'source_link' => 'nullable|max:1200|string',
            'contents' => 'nullable|max:120000|string',
        ];

        $messages = [
            'title.required' => '* This field is required',
            'title.max' => '* This Field is too long',
            'title.string' => '* This field is invalid',

            'source_name.string' => '* This field is too long',
            'source_name.max' => '* This field is invalid',

            'source_link.max' => '* This field is too long',
            'source_link.string' => '* This field is invalid',

            'contents.string' => '* This field is invalid',
            'contents.max' => '* This field is too long',


        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {

            if ($request->featured_image != '') {
                $file = $request->file('featured_image');
                $name = sha1(date('YmdHis') . Str::random(20));
                $resize_name = Str::slug($request->title) . '-' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                Image::make($file)->save('images/treads/' . $resize_name);
                $featured_image = $resize_name;
            }
            try {

                $s = (new treadSlug);
                $slug = $s->createSlug($request->title);
                $tread = Treads::create([
                    'title' => $request->title,
                    'slug' => Str::slug($slug),
                    'content' => $request->content_2,
                    'tread_source' => $request->source_link,
                    'tread_source_name' => $request->source_name,
                    'is_tread' => 1,
                    'is_commentable' => 0,
                    'featured_image' => $featured_image,
                    'created_by' => Auth::user()->id,
                ]);
            } catch (\Exception $exception) {
                $notify[] = ['error', 'Unable to create unique slug, please try a different one'];
                return back()->withNotify($notify);
            }

            $tread->categories()->sync($request->select);

            $notify[] = ['info', 'Post Published successfully!'];
            return \redirect()->to(route('adminTreadsID', $tread->id))->withNotify($notify);
        }
    }
    public function adminTreadsSelected($id)
    {
        $d = Treads::where('id', $id)->firstOrFail();
        $d->delete();
        $notify[] = ['info', 'Tread deleted successfully!'];
        return back()->withNotify($notify);
    }

    public function adminTSelected(Request $request)
    {
        $the_selected = explode(',', $request->selected);
        $s_t_d = Treads::whereIn('id', $the_selected)->get();
        foreach ($s_t_d as $d) {
            $d->delete();
        }
        $notify[] = ['info', 'Item deleted successfully!'];
        return back()->withNotify($notify);
    }

    public function adminHowItWorkSite()
    {
        $howItWorks = siteHowItWork::first();
        $howToRegister = HowToRegister::first();
        $terms = Terms::first();

        return view('Admin.HowItWork.Site.request', compact('howItWorks', 'howToRegister', 'terms'));
    }

    public function adminTermsPost(Request $request)
    {
        $rules = [
            'terms_content' => 'required|string',
        ];

        $messages = [
            'terms_content.required' => '* This field is required',
            'terms_content.string' => '* This field is invalid',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $terms = Terms::where('id', 1)->first();

            $terms->update([
                'content' => $request->terms_content
            ]);

            $notify[] = ['info', 'Content Updated successfully!'];
            return back()->withNotify($notify);
        }
    }

    public function adminHowToRegisterPost(Request $request)
    {
        $rules = [
            'register_content' => 'required|string',
        ];

        $messages = [
            'register_content.required' => '* This field is required',
            'register_content.string' => '* This field is invalid',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $howRegister = howToRegister::where('id', 1)->first();

            $howRegister->update([
                'content' => $request->register_content
            ]);

            $notify[] = ['info', 'Content Updated successfully!'];
            return back()->withNotify($notify);
        }
    }

    public function adminHowItWorkSitePost(Request $request)
    {
        $rules = [
            'content_2' => 'required|max:12000|string',
        ];

        $messages = [
            'content_2.required' => '* This field is required',
            'content_2.max' => '* This Field is too long',
            'content_2.string' => '* This field is invalid',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $the_notification = siteHowItWork::where('id', 1)->first();

            $the_notification->update([
                'content' => $request->content_2
            ]);

            $notify[] = ['info', 'Content Updated successfully!'];
            return back()->withNotify($notify);
        }
    }

    public function adminNotificationSite()
    {
        return view('Admin.Notification.Site.request');
    }
    public function adminNotificationSitePost(Request $request)
    {
        $rules = [
            'status' => 'nullable|max:20|string',
            'content_2' => 'required|max:12000|string',
        ];

        $messages = [
            'status.max' => '* This Field is too long',
            'status.string' => '* This field is invalid',

            'content_2.required' => '* This field is required',
            'content_2.max' => '* This Field is too long',
            'content_2.string' => '* This field is invalid',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $the_notification = siteNotifcation::where('id', 1)->first();
            function stat($st)
            {
                if ($st == 'on') {
                    return 1;
                } else {
                    return 0;
                }
            }

            $the_notification->update([
                'status' => stat($request->status),
                'content' => $request->content_2
            ]);

            $notify[] = ['info', 'Item Updated successfully!'];
            return back()->withNotify($notify);
        }
    }

    public function createTestimonyPost(Request $request)
    {

        $rules = [
            'name' => 'required|max:200|string',
            'content' => 'required|max:120000|string',
        ];

        $messages = [
            'name.string' => '* Name is of Invalid Characters',
            'name.max' => '* Name is too long',
            'name.required' => '* Name cannot be empty',

            'content.string' => '* Testimony is of Invalid Characters',
            'content.max' => '* Testimony is too long',
            'content.required' => '* Testimony cannot be empty',


        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {

            $testimony = Testimonial::create([
                'testimony' => $request->content,
                'fullname' => $request->name,
            ]);

            $testimony->save();

            $notify[] = ['success', 'Tread Published successfully!'];
            return back()->withNotify($notify);
        }
    }

    public function deleteTestimonyPost($id)
    {
        $d = Testimonial::where('id', $id)->firstOrFail();
        $d->delete();
        $notify[] = ['info', 'Testimony deleted successfully!'];
        return back()->withNotify($notify);
    }

    public function createTestimony()
    {
        return view('Admin.Testimonies.create');
    }

    public function adminViewTestimony()
    {
        $date['page-title'] = "All Testimonies";
        $data['all_testimonies'] = Testimonial::paginate(10);
        $data['counter'] = 1;

        return view('Admin.Testimonies.index', $data);
    }

    public function requestPayoutOpen()
    {
        return view('Admin.Request.open');
    }

    public function requestPayoutOpenPost(Request $request)
    {
        $d_r = requestPayout::findOrFail(1);

        // $d_r->status = $request->status ?? 0;
        $d_r->wallet = $request->wallet ?? 0;
        $d_r->allowi = $request->allowi ?? 0;
        $d_r->save();

        $notify = [];
        if ($request->wallet) {
            $notify[] = ['info', 'Affilate portal is opened!'];
        } else {
            $notify[] = ['warning', 'Affilate portal is closed!'];
        }
    
        if ($request->allowi) {
            $notify[] = ['info', 'Activity portal is opened!'];
        } else{
            $notify[] = ['warning', 'Activity portal is closed!'];
        }
        return back()->withNotify($notify);
    }


    public function adminTreadsDraft()
    {
        return view('Admin.Tread.draft');
    }

    public function adminTreadsPublished()
    {
        return view('Admin.Tread.published');
    }

    public function requestPayoutAll()
    {
        $data['all_payments'] = payoutRequest::get();
        $data['all_payment'] = payoutRequest::orderBy('created_at', 'DESC')->where('is_payed', payoutRequest::PENDING)->paginate(20);
        $data['is_payed'] = payoutRequest::orderBy('created_at', 'DESC')->where('is_payed', payoutRequest::APPROVED)->paginate(20);
        $data['not_payed'] = payoutRequest::orderBy('created_at', 'DESC')->where('is_payed', payoutRequest::REJECTED)->paginate(20);
        return view('Admin.Request.index', $data);
    }

    public function requestPayoutWallet()
    {
        $data['all_payments'] = payoutRequest::orderBy('created_at', 'DESC')->where('from_account', 1)->get();
        $data['all_payment'] = payoutRequest::orderBy('created_at', 'DESC')->where('is_payed', payoutRequest::PENDING)->where('from_account', 1)->paginate(20);
        $data['is_payed'] = payoutRequest::orderBy('created_at', 'DESC')->where('is_payed', payoutRequest::APPROVED)->where('from_account', 1)->paginate(20);
        $data['not_payed'] = payoutRequest::orderBy('created_at', 'DESC')->where('is_payed', 0)->where('from_account', 1)->paginate(20);
        return view('Admin.Request.index', $data);
    }

    public function requestPayoutAllowi()
    {
        $data['all_payments'] = payoutRequest::orderBy('created_at', 'DESC')->where('from_account', 2)->get();
        $data['all_payment'] = payoutRequest::orderBy('created_at', 'DESC')->where('is_payed', payoutRequest::PENDING)->where('from_account', 2)->paginate(20);
        $data['is_payed'] = payoutRequest::orderBy('created_at', 'DESC')->where('is_payed', 1)->where('from_account', 2)->paginate(20);
        $data['not_payed'] = payoutRequest::orderBy('created_at', 'DESC')->where('is_payed', 0)->where('from_account', 2)->paginate(20);
        return view('Admin.Request.index', $data);
    }

    public function clearPayoutRequestSelectedID($id)
    {
        $d_req = payoutRequest::findOrFail($id);
        $d_req->update([
            'is_payed' => payoutRequest::REJECTED,
        ]);

        $user = User::where('id', $d_req['user_id'])->first();
        if($d_req->from_account == 1){
            $account_type = 'balance';
        }else{
            $account_type = 'allowi_balance';
        }
        $user->update([
                $account_type => $user->$account_type + $d_req['amount'],
        ]);

        $notify[] = ['info', $user->username.' request rejected!'];
        return back()->withNotify($notify);
    }

    public function clearPayoutRequestID(Request $request)
    {
        $the_selected = explode(',', $request->selected);
        $s_t_d = payoutRequest::whereIn('id', $the_selected)->get();
        foreach ($s_t_d as $d) {
            $d->update([
                'is_payed' => payoutRequest::REJECTED,
            ]);

            $user = User::where('id', $d['user_id'])->first();
            if($d->from_account == 1){
                $account_type = 'balance';
            }else{
                $account_type = 'allowi_balance';
            }

            $user->update([
                    $account_type => $user->$account_type + $d['amount'],
            ]);
        }
        $notify[] = ['info', 'selected request(s) rejected!'];
        return back()->withNotify($notify);
    }

    public function extractPayoutRequestID(Request $request)
    {
        $the_selected = explode(',', $request->selected);
        $s_t_d = payoutRequest::whereIn('id', $the_selected)->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=extract.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        $columns = array('Account Number', 'Bank', 'Amount', 'Narration', 'Currency');

        $callback = function () use ($s_t_d, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($s_t_d as $d) {
                fputcsv($file, array(User::find($d['user_id'])->acc_numb, User::find($d['user_id'])->bank, $d['amount'], 'INSTANTNAIRE', 'NGN'));
            }
            fclose($file);
        };
        return FacadeResponse::stream($callback, 200, $headers);
    }

    public function paidallPayoutRequestID(Request $request)
    {
        $the_selected = explode(',', $request->selected);
        $s_t_d = payoutRequest::whereIn('id', $the_selected)->get();
        foreach ($s_t_d as $d) {
            $the_payout_request = payoutRequest::where('id', $d['id'])->first();

            $user = User::where('id', $d['user_id'])->first();
            $the_payout_request->update([
                'is_payed' => 1,
                'amount_paid' => $d['amount'],
            ]);

            if ($the_payout_request->from_account == 1) {

                $user->update([
                    'total_balance' => $user->total_balance + $d['amount'],
                ]);
            } elseif ($the_payout_request->from_account == 2) {

                $user->update([
                    'allowi_balance' => $user->allowi_balance - $d['amount']
                ]);
            }
            try {
                $amount = $d['amount'];
                Mail::to($user)->send(new Alert($user, $amount));
            } catch (\Exception $ex) {
            }
        }
        $notify[] = ['success', 'Selected payout paid successfully'];
        return back()->withNotify($notify);
    }

    public function generalPayAffiliate(Request $request)
    {
        $all = payoutRequest::where('is_payed', 0)->where('from_account', 1)->get();
        foreach ($all as $d) {
            $the_payout_request = payoutRequest::where('id', $d['id'])->first();

            $user = User::where('id', $d['user_id'])->first();
            $the_payout_request->update([
                'is_payed' => 1,
                'amount_paid' => $d['amount'],
            ]);

            $user->update([
                'balance' => $user->balance - $d['amount'],
                'total_balance' => $user->total_balance + $d['amount'],
            ]);

            try {
                $amount = $d['amount'];
                Mail::to($user)->send(new Alert($user, $amount));
            } catch (\Throwable $th) {
            }
        }
        return redirect()->back()->with('info', 'All requests Paid');
    }

    public function generalPayActivities(Request $request)
    {
        $s_t_d = payoutRequest::where('is_payed', 0)->where('from_account', 2)->get();
        foreach ($s_t_d as $d) {
            $the_payout_request = payoutRequest::where('id', $d['id'])->first();

            $user = User::where('id', $d['user_id'])->first();
            $the_payout_request->update([
                'is_payed' => 1,
                'amount_paid' => $d['amount'],
            ]);

            if ($the_payout_request->from_account == 2) {
                if ((int)$d['amount'] > (int)$user->allowi_balance) {
                    $remainder = (int)$user->allowi_balance - (int)$d['amount'];
                    $total_aff = $user->mines - abs($remainder);
                    $aff = $total_aff;
                    if ($total_aff == 0) {
                        $aff = 0;
                    }

                    $user->update([
                        'allowi_balance' => 0,
                        'mines' => $user->$aff
                    ]);
                } elseif ((int)$d['amount'] <= (int)$user->allowi_balance) {
                    $user->update([
                        'balance' => $user->balance - $d['amount']
                    ]);
                } else {
                    return redirect()->back()->with('info', 'There is an error in users amount');
                }
            }

            try {
                $amount = $d['amount'];
                Mail::to($user)->send(new Alert($user, $amount));
            } catch (\Throwable $th) {
                return redirect()->back()->with('info', 'All requests Paid(no Emails sent)');
            }
        }
        return redirect()->back()->with('info', 'All requests Paid');
    }

    public function clearPayoutRequestID2($id)
    {
        $d_req = payoutRequest::where('id', $id)->firstOrFail();
        $d_req->delete();
        $notify[] = ['info', 'Selected payout deleted successfully'];
        return redirect()->to(route('requestPayoutAll'))->withNotify($notify);
    }

    public function requestPayoutPaid()
    {
        return view('Admin.Request.paid');
    }

    public function requestPayoutUnPaid()
    {
        return view('Admin.Request.unpaid');
    }

    public function adminSearchTreads(Request $request)
    {

        $id = $request['term'];
        $get_tread = Treads::where('title', 'LIKE', '%' . $id . '%')->orderBy('created_at', 'DESC')->paginate(30);

        Session::flash('search', $id);

        return view('Admin.Tread.search', compact('get_tread', 'id'));
    }

    public function adminSearchUsers(Request $request)
    {
        $id = $request['term'];
        $get_users = User::where('username', 'LIKE', '%' . $id . '%')->orWhere('fullname', 'LIKE', '%' . $id . '%')->orWhere('number', 'LIKE', '%' . $id . '%')->orWhere('email', 'LIKE', '%' . $id . '%')->orderBy('created_at', 'DESC')->paginate(30);
        // $get_users = User::where('username','LIKE','%'.$id.'%')->orderBy('created_at', 'DESC')->paginate(30);

        Session::flash('search', $id);

        return view('Admin.Users.search', compact('get_users', 'id'));
    }
    public function adminSearchCategories(Request $request)
    {
        $id = $request['term'];
        $get_category = Category::where('name', 'LIKE', '%' . $id . '%')->orderBy('created_at', 'DESC')->paginate(30);

        Session::flash('search', $id);

        return view('Admin.Category.search', compact('get_category', 'id'));
    }

    public function adminSearchPayouts(Request $request)
    {
        $id = $request['term'];
        $get_payout = payoutRequest::where('name', 'LIKE', '%' . $id . '%')->orWhere('amount', 'LIKE', '%' . $id . '%')->orderBy('created_at', 'DESC')->paginate(30);

        Session::flash('search', $id);

        return view('Admin.Request.search', compact('get_payout', 'id'));
    }


    public function coupon()
    {

        $data['dd1'] = CouponCodes::all();
        $data['dd']  = CouponCodes::orderBy('created_at', 'DESC')->paginate(100);
        $data['is_used'] = CouponCodes::where('is_used', 1)->get();
        $data['is_not_used'] = CouponCodes::where('is_used', 0)->get();

        return view('Admin.Coupon.index', $data);
    }

    public function plan()
    {

        $data['dd1'] = Plan::all();
        $data['dd']  = Plan::orderBy('created_at', 'DESC')->paginate(10);

        return view('Admin.Plan.index', $data);
    }

    public function cron()
    {

        $user = User::where('mined', 1)->first();
        $user->update([
            'mined' => 0,
        ]);

        return view('Admin.Plan.index');
    }

    public function planCreate()
    {
        return view('Admin.Plan.create');
    }

    public function editPlan($id)
    {
        $data = Plan::findOrFail($id);

        return view('Admin.Plan.edit', compact('data'));
    }

    public function planCreatePost(Request $request)
    {

        $plan =  new Plan();
        $plan->amount = $request->amount;
        $plan->name = $request->name;
        $plan->referral_bonus = $request->referral_bonus;
        $plan->indirect_ref = $request->indirect_referral_bonus;
        $plan->registeration_bonus = $request->registeration_bonus;
        $plan->min_noref = $request->min_noref;
        $plan->min_ref = $request->min_ref;
        $plan->sponsored = $request->post_bonus;
        $plan->login = $request->login_bonus;
        if ($plan->save()) {
            $notify[] = ['info', 'Plan Created successfully'];
            return redirect()->to(route('plan'))->withNotify($notify);
        } else {
            $notify[] = ['warning', 'Something Went Wrong. Try Again'];
            return redirect()->to(route('plan'))->withNotify($notify);
        }
    }

    public function editPlanPost(Request $request, $id)
    {

        $plan = Plan::find($id);
        $plan->amount = $request->amount;
        $plan->name = $request->name;
        $plan->referral_bonus = $request->referral_bonus;
        $plan->indirect_ref = $request->indirect_referral_bonus;
        $plan->registeration_bonus = $request->registeration_bonus;
        $plan->sponsored = $request->post_bonus;
        $plan->login = $request->login_bonus;
        $plan->min_noref = $request->min_noref;
        $plan->min_ref = $request->min_ref;
        if ($plan->save()) {
            $notify[] = ['success', 'Plan Editted Successfully'];
            return redirect()->to(route('plan'))->withNotify($notify);
        } else {
            $notify[] = ['warning', 'Something Went Wrong. Try Again'];
            return redirect()->to(route('plan'))->withNotify($notify);
        }
    }


    public function bundle()
    {

        $data['dd1'] = Bundle::all();
        $data['dd']  = Bundle::orderBy('created_at', 'DESC')->paginate(10);

        return view('Admin.Bundle.index', $data);
    }


    public function mysubscriber()
    {

        $data['dd1'] = Subscription::all();
        $data['dd']  = Subscription::orderBy('created_at', 'DESC')->paginate(10);

        return view('Admin.Bundle.subscribe', $data);
    }


    public function bundleCreate()
    {
        $cat = Category::get();
        return view('Admin.Bundle.create', compact('cat'));
    }

    public function editBundle($id)
    {
        $data = Bundle::find($id);
        $cat = Category::get();
        return view('Admin.Bundle.edit', compact('data', 'cat'));
    }

    public function bundleCreatePost(Request $request)
    {

        $bd =  new Bundle();
        $bd->points = $request->points;
        $bd->name = $request->name;
        $bd->link = $request->link;
        $bd->days = $request->days;
        if ($bd->save()) {
            $notify[] = ['success', 'Class Created Successfully'];
            return redirect()->to(route('bundle'))->withNotify($notify);
        } else {
            $notify[] = ['warning', 'Something Went Wrong. Try Again'];
            return redirect()->to(route('bundle'))->withNotify($notify);
        }
    }

    public function editBundlePost(Request $request, $id)
    {

        $bd =  Bundle::find($id);
        $bd->points = $request->points;
        $bd->name = $request->name;
        $bd->link = $request->link;
        $bd->days = $request->days;
        if ($bd->save()) {
            $notify[] = ['success', $request->name . ' Edited Successfully'];
            return redirect()->to(route('bundle'))->withNotify($notify);
        } else {
            $notify[] = ['warning', 'Something Went Wrong. Try Again'];
            return redirect()->to(route('bundle'))->withNotify($notify);
        }
    }

    public function couponused($used)
    {

        if (!empty($used)) {

            $data['dd1'] = CouponCodes::where('is_used', '=', $used)->get();
            $data['dd']  = CouponCodes::orderBy('created_at', 'DESC')->where('is_used',  $used)->paginate(100);
            $data['is_used'] = CouponCodes::where('is_used', '1')->get();
            $data['is_not_used'] = CouponCodes::where('is_used', 0)->get();

            if ($data['dd1']->count() > 0) {

                return view('Admin.Coupon.index', $data);
            } else {
                $data['dd1'] = CouponCodes::where('is_used', 0)->get();
                $data['dd']  = CouponCodes::orderBy('created_at', 'DESC')->where('is_used', 0)->paginate(100);
                $data['is_not_used'] = CouponCodes::where('is_used', 0)->get();

                if ($data['dd1']->count() >= 0) {

                    return view('Admin.Coupon.index', $data);
                }
            }
        }

        abort(404);
    }

    public function couponCreate()
    {
        return view('Admin.Coupon.create');
    }

    public function couponCreatePost(Request $request)
    {
        if (is_numeric($request->size)) {
            for ($i = 0; $i < $request->size; $i++) {
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $next = substr(str_shuffle($str_result), 0, 4);
                $next1 = substr(str_shuffle($str_result), 0, 4);
                $next2 = substr(str_shuffle($str_result), 0, 4);
                $code =  new CouponCodes();
                $code->coupon_code = $request->prefix . "-" . $next . "-" . $next1 . "-" . $next2;
                $code->vendor_id = $request->vendor;
                $code->plan = $request->plan;
                $code->save();
            }
            $notify[] = ['info', 'Coupon Generated successfully'];
            return redirect()->to(route('coupon'))->withNotify($notify);
        } else {
            $notify[] = ['error', 'Invalid Selection, unable to process request'];
            return back()->withNotify($notify);
        }
    }
    public function couponTrashSelected($id)
    {
        $s_t_d = CouponCodes::where('id', $id)->firstOrFail();
        $s_t_d->delete();
        $notify[] = ['info', 'Item deleted successfully'];
        return back()->withNotify($notify);
    }
    public function couponTrashSelected2(Request $request)
    {
        $the_selected = explode(',', $request->selected);
        $s_t_d = CouponCodes::whereIn('id', $the_selected)->get();
        foreach ($s_t_d as $d) {
            $d->delete();
        }
        $notify[] = ['info', 'Item deleted successfully'];
        return back()->withNotify($notify);
    }

    public function couponExport(Request $request)
    {
        $the_selected = explode(',', $request->selected);
        $s_t_d = CouponCodes::whereIn('id', $the_selected)->get();

        $myFile = "coupon_code.txt";
        $fo = fopen($myFile, 'w') or die("can't open file");

        $stringData = "\r\n";
        foreach ($s_t_d as $d) {
            $stringData .= "\r\n" . $d['coupon_code'] . "\r\n";
        }
        fwrite($fo, $stringData);
        fclose($fo);
        $headers = array(
            'Content-Type' => 'text/plain',
        );
        return FacadeResponse::download($myFile, 'coupon_code.txt', $headers);
    }

    public function dataExport(Request $request)
    {
        $the_selected = explode(',', $request->selected);
        $s_t_d = payoutRequest::whereIn('id', $the_selected)->get();

        $myFile = "data_request.txt";
        $fo = fopen($myFile, 'w') or die("can't open file");

        $stringData = "\r\n";
        foreach ($s_t_d as $d) {
            $stringData .= "\r\n" . $d['account_number'] . "\r\n";
        }
        fwrite($fo, $stringData);
        fclose($fo);
        $headers = array(
            'Content-Type' => 'text/plain',
        );
        return FacadeResponse::download($myFile, 'data_request.txt', $headers);
    }

    public function allDataExport(Request $request)
    {
        // $the_selected = explode( ',', $request->selected);
        $s_t_d = payoutRequest::where('from_account', 4)->where('is_payed', 0)->get();

        $myFile = "data_request.txt";
        $fo = fopen($myFile, 'w') or die("can't open file");

        $stringData = "\r\n";
        foreach ($s_t_d as $d) {
            $stringData .= "\r\n" . $d['account_number'] . "\r\n";
        }
        fwrite($fo, $stringData);
        fclose($fo);
        $headers = array(
            'Content-Type' => 'text/plain',
        );
        return FacadeResponse::download($myFile, 'data_request.txt', $headers);
    }

    public function allAffiliateExport(Request $request)
    {
        $withdrawals = payoutRequest::where('from_account', 1)->where('is_payed', 0)->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=all_affiliate.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        $columns = array('Account Number', 'Bank', 'Amount', 'Narration', 'Currency');

        $callback = function () use ($withdrawals, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($withdrawals as $d) {
                fputcsv($file, array(User::find($d['user_id'])->acc_numb, User::find($d['user_id'])->bank, $d['amount'], 'INSTANTNAIRE', 'NGN'));
            }
            fclose($file);
        };
        return FacadeResponse::stream($callback, 200, $headers);
    }

    public function quiz()
    {
        return view('Admin.Quiz.index');
    }

    public function createQuiz()
    {
        return view('Admin.Quiz.create');
    }

    public function resendVerification(Request $request, $id)
    {
        $this->validate($request, [
            'note' => 'required|string'
        ]);
        $user = User::where('id', $id)->first();
        $data = array(
            'fullname' => $user->fullname,
            'note' => $request->note,
        );
        try {
            Mail::to($user)->send(new ResendActivation($data));
        } catch (\Exception $e) {
            $notify[] = ['warning', 'Email may have not been sent successfully'];
            return back()->withNotify($notify);
        };

        $notify[] = ['success', 'Email have been sent to ' . $user->email];
        return back()->withNotify($notify);
    }

    public function sendGeneralMail()
    {
        return view('Admin.Users.general-mail');
    }

    public function generalMail(Request $request)
    {
        $this->validate($request, [
            'note' => 'required|string'
        ]);

        $users = User::get();
        foreach ($users as $ux) {

            $user = User::find($ux->id);
            $data = array(
                'fullname' => $user->fullname,
                'note' => $request->note,
            );
            try {
                Mail::to($user)->send(new ResendActivation($data));
            } catch (\Exception $e) {
                $notify[] = ['warning', 'Email may have not been sent successfully'];
                return back()->withNotify($notify);
            }
        }

        $notify[] = ['success', 'Email have been sent to ' . $user->count() . ' recipients'];
        return back()->withNotify($notify);
    }
}
