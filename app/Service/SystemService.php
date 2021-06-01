<?php
namespace App\Service;

use App\MasterSiteSetting;

class SystemService
{
    public function getMasterSetting($id) {
        return MasterSiteSetting::find($id);
    }

    public function changeLogo($class, $request) {
        $settings = $this->getMasterSetting(1);

        // change logo mini
        if ($request->hasFile('logo_mini')) {
            $logo_mini = $class->store($request, $settings, 'logo_mini');
        } else {
            $logo_mini = $settings->logo_mini;
        }

        // change logo
        if ($request->hasFile('text_logo')) {
            $text_logo = $class->store($request, $settings, 'text_logo');
        } else {
            $text_logo = $settings->text_logo;
        }

        // change favicon
        if ($request->hasFile('favicon')) {
            $favicon = $class->store($request, $settings, 'favicon');
        } else {
            $favicon = $settings->favicon;
        }

        // change verified_seller_logo
        if ($request->hasFile('verified_seller_logo')) {
            $verified_seller_logo = $class->store($request, $settings, 'verified_seller_logo');
        } else {
            $verified_seller_logo = $settings->verified_seller_logo;
        }
        $settings->logo_mini = $logo_mini;
        $settings->text_logo = $text_logo;
        $settings->favicon = $favicon;
        $settings->verified_seller_logo = $verified_seller_logo;
        $settings->about_us = $request->about_us;
        $settings->for_support = $request->for_support;
        $settings->verified_seller_url = $request->verified_seller_url;
        $settings->save();
    }

}
