<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\RoleTranslation;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $roles = new Role();
        if ($request->has('search')){
            $sort_search = $request->search;
            $roles = $roles->where('name', 'like', '%'.$sort_search.'%');
        }
        $roles = $roles->paginate(15)->appends(request()->query());
        return view('backend.SettingManagement.staff_roles.index', compact('roles','sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.SettingManagement.staff_roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('permissions')){
            $role = new Role;
            $role->name = $request->name;
            $role->permissions = json_encode($request->permissions);
            $role->save();

            $role_translation = RoleTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'role_id' => $role->id]);
            $role_translation->name = $request->name;
            $role_translation->save();

            flash(translate('تم إدخــال الدور بنجــاح'))->success();
            return redirect()->route('roles.index');
        }
        flash(translate('حــدث خطــأ مــا'))->error();
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $lang = $request->lang;
        $role = Role::findOrFail($id);
        return view('backend.SettingManagement.staff_roles.edit', compact('role','lang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        if($request->has('permissions')){
            if($request->lang == env("DEFAULT_LANGUAGE")){
                $role->name = $request->name;
            }
            $role->permissions = json_encode($request->permissions);
            $role->save();

            $role_translation = RoleTranslation::firstOrNew(['lang' => $request->lang, 'role_id' => $role->id]);
            $role_translation->name = $request->name;
            $role_translation->save();

            flash(translate('تم تحديث الدور بنجاح'))->success();
            return redirect()->route('roles.index');
        }
        flash(translate('حدث خطأ ما'))->error();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        foreach ($role->role_translations as $key => $role_translation) {
            $role_translation->delete();
        }

        Role::destroy($id);
        flash(translate('تم حذف الدور بنجــاح'))->success();
        return redirect()->route('roles.index');
    }
}
