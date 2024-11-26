<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\settingRequest;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:setting');

    }
    public function index()
    {
        return view('admin.Setting.update');
    }



    public function updateSetting(SettingRequest $request)
    {
        $request->validated();

        $setting = Setting::findOrFail($request->setting_info_id);


        if ($request->hasFile('favicon')) {
            if (File::exists(public_path($setting->favicon))) {
                File::delete(public_path($setting->favicon));
            }
            $file = $request->file('favicon');
            $faviconName = Str::uuid() . time() . '.' . $file->getClientOriginalExtension();
            $faviconPath = $file->storeAs('upload/setting', $faviconName, ['disk' => 'uploads']);
            $setting->update([
                'favicon'=> $faviconPath
            ]);
        }

        if ($request->hasFile('logo')) {
            if (File::exists(public_path($setting->logo))) {
                File::delete(public_path($setting->logo));
            }
            $file = $request->file('logo');
            $logoName = Str::uuid() . time() . '.' . $file->getClientOriginalExtension();
            $logoPath = $file->storeAs('upload/setting', $logoName, ['disk' => 'uploads']);

            $setting->update([
                'logo'=> $logoPath
            ]);
        }


        $setting->update($request->except(['_token', 'setting_info_id','logo','favicon']));

        return redirect()->back()->with('success', 'Setting updated successfully');
    }

}
