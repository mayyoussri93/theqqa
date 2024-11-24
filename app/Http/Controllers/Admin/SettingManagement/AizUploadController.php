<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use Auth;
use Illuminate\Http\Request;
use Image;
use Response;
use Storage;

class AizUploadController extends Controller
{


    public function index(Request $request){

        $all_uploads = Upload::query();
        $search = null;
        $sort_by = null;

        if ($request->search != null) {
            $search = $request->search;
            $all_uploads->where('file_original_name', 'like', '%'.$request->search.'%');
        }

        $sort_by = $request->sort;
        switch ($request->sort) {
            case 'newest':
                $all_uploads->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $all_uploads->orderBy('created_at', 'asc');
                break;
            case 'smallest':
                $all_uploads->orderBy('file_size', 'asc');
                break;
            case 'largest':
                $all_uploads->orderBy('file_size', 'desc');
                break;
            default:
                $all_uploads->orderBy('created_at', 'desc');
                break;
        }

        $all_uploads = $all_uploads->paginate(60)->appends(request()->query());

        return view('backend.SettingManagement.uploaded_files.index', compact('all_uploads', 'search', 'sort_by') );
    }

    public function create(){
        return view('backend.SettingManagement.uploaded_files.create');
    }

    public function destroy(Request $request,$id)
    {
        try{
            if(env('FILESYSTEM_DRIVER') == 's3'){
                Storage::disk('s3')->delete(Upload::where('id', $id)->first()->file_name);
            }
            else{
                unlink(public_path().'/'.Upload::where('id', $id)->first()->file_name);
            }
            Upload::destroy($id);
            flash(translate('تـم حـــذف الــمـلــف بــنــجـــاح'))->success();
        }
        catch(\Exception $e){
            Upload::destroy($id);
            flash(translate('تــم حــذف الــمـلـــف بـــنـجــاح'))->success();
        }
        return back();
    }
    public function file_info(Request $request)
    {
        $file = Upload::findOrFail($request['id']);
        return view('backend.SettingManagement.uploaded_files.info',compact('file'));
    }

}
