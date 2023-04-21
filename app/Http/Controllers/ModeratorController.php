<?php

namespace App\Http\Controllers;

use App\Models\Treads;
use App\Models\treadSlug;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;



class ModeratorController extends Controller
{
    public function Fmanager()
    {
        return view('Moderator.fmanager');
    }
    
    public function moderatorTreads(){
        return view('Moderator.Tread.index');
    }
    
    public function moderatorTreadsDraft(){
        return view('Moderator.Tread.draft');
    }

    public function moderatorTreadsPublished(){
        return view('Moderator.Tread.published');
    }
    
    
    public function moderatorTreadsID($id){
        $tread = Treads::where('id', $id)->firstOrFail();
        return view('Moderator.Tread.single', compact('tread'));
    }

    public function moderatorTreadsIDPostActions( Request $request, $tread, $id){
        if($id ==  1){
            $e = Treads::where('id', $tread)->firstOrFail();
            $e->status = 0;
            $e->save();
            $notify[] = ['info', 'Tread updated successfully'];
            return back()->withNotify($notify);

        } elseif ($id == 2){
            //Save Edit
            //return dd($request->all());
            $t = Treads::find($tread);
            $t->categories()->sync($request->select);
            //$s = Category::find($request->select);


            $t->title = $request->title;
            $t->slug = Str::slug($request->title);
            $t->tread_source = $request->source_link;
            $t->tread_source_name = $request->source;
            $t->content = $request->contents;

            if($request->is_tread == 'on'){
                $t->is_tread =  1;
            } else {
                $t->is_tread =  0;
            }
            if($request->is_commentable == 'on'){
                $t->is_commentable =  1;
            }else{
                $t->is_commentable =  0;
            }

            $t->save();
            $notify[] = ['info', 'Tread updated successfully'];
            return back()->withNotify($notify);

        } elseif ($id == 3){
            //Trash Tread
            $s = Treads::where('id', $tread)->firstOrFail();
            $s->delete();
            $notify[] = ['info', 'Tread updated successfully!'];
            return \redirect()->to(route('moderatorTreads'))->withNotify($notify);
        }elseif ($id == 4){
            //Publish Tread
            $s = Treads::where('id', $tread)->firstOrFail();
            $s->status = 1;
            $s->save();
            $notify[] = ['info', 'Tread updated successfully'];
            return back()->withNotify($notify);
        }else{
            return abort('404');
        }
    }

    public function moderatorTreadsCreate(){
        return view('Moderator.Tread.create');
    }
    public function moderatorTSelectedDraft(Request $request){
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
        }  else {
            $is_tread = '';
            if($request->is_tread == 'on'){
                $is_tread = 1;
            }else{
                $is_tread = 0;
            }

            $is_commentable = '';
            if($request->is_commentable == 'on'){
                $is_commentable = 1;
            }else{
                $is_commentable = 0;
            }
            try{

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

            } catch (\Exception $exception){
                $notify[] = ['error', 'Unable to create unique slug, please try a different one'];
                return back()->withNotify($notify);
            }

            $tread->categories()->sync($request->select);

            $notify[] = ['info', 'Tread published successfully!'];
            return \redirect()->to(route('moderatorTreadsID', $tread->id))->withNotify($notify);
        }
    }

    public function moderatorTreadsCreatePost(Request $request){
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
        }else {

            if($request->featured_image != ''){
                $file = $request->file('featured_image');
                $name = sha1(date('YmdHis') . Str::random(20));
                $resize_name = Str::slug($request->title).'-'.Str::random(5).'.'.$file->getClientOriginalExtension();
                Image::make($file)->save('images/treads/'.$resize_name);
                $featured_image = $resize_name;
            }

            try{

                $s = (new treadSlug);
                $slug = $s->createSlug($request->title);
                $tread = Treads::create([
                    'title' => $request->title,
                    'slug' => Str::slug($slug),
                    'content' => $request->content_2,
                    'tread_source' => $request->source_link,
                    'tread_source_name' => $request->source_name,
                    'featured_image' => $featured_image,
                    'is_tread' => 1,
                    'is_commentable' => 0,
                    'created_by' => Auth::user()->id,
                ]);

            } catch (\Exception $exception){
                $notify[] = ['error', 'Unable to create unique slug, please try a different one'];
                return back()->withNotify($notify);
            }

            $tread->categories()->sync($request->select);

            $notify[] = ['info', 'Post Published successfully!'];
            return \redirect()->to(route('moderator'))->withNotify($notify);
            }
    }

    public function moderatorTreadsSelected($id){
        $d = Treads::where('id', $id)->firstOrFail();
        $d->delete();
        $notify[] = ['info', 'Tread deleted successfully!'];
        return back()->withNotify($notify);
    }

    public function moderatorTSelected(Request $request){
        $the_selected = explode( ',', $request->selected);
        $s_t_d = Treads::whereIn('id', $the_selected)->get();
        foreach ($s_t_d as $d){
            $d->delete();
        }
        
        $notify[] = ['info', 'Tread deleted successfully!'];
        return back()->withNotify($notify);
    }
    
    
    public function moderatorContestCode(){
        return view('Moderator.User.contest-code');
    }



    public function editUser(){
        $data['the_block'] = User::where('is_block', 1)->count();
        $data['users'] = User::paginate(20);
        return view('Moderator.User.users', $data);
    }
    public function moderatorSearchUsers(Request $request){
        $id = $request->term;
        $data['term'] = $id;
        $data['the_block'] = User::where('is_block', 1)->count();

        $data['users'] = User::where('username','LIKE','%'.$id.'%')
        ->where('is_admin', '!=', 1)
        ->orWhere('fullname','LIKE','%'.$id.'%')
        ->orWhere('number','LIKE','%'.$id.'%')
        ->orWhere('email','LIKE','%'.$id.'%')
        ->orderBy('created_at', 'DESC')
        ->paginate(30);

        return view('Moderator.User.search', $data);
    }

    public function moderatorEditUser(Request $request){
        $user = User::findOrFail($request->id);

        $this->validate($request, [
            'new_password' => 'required|max:100|string',
        ]);

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        $notify[] = ['info', $user->fullname.' Password Updated successfully!'];
        return back()->withNotify($notify);

    }

}
