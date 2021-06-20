<div class="footer">
    <img src="{{url('images/car.png')}}" alt="" class="car_img">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 text-justify" style="margin-bottom: 20px">
                    <h3 style="margin: 0 0 15px 0; color: #efefef">{{trans('footer.about')}}</h3>
                    <p>{{trans('footer.about_content')}} </p>
                </div>
                <div class="col-sm-6 text-justify" style="margin-bottom: 20px">
                    <h3 style="margin: 0 0 15px 0; color: #efefef">{{trans('footer.policy')}}</h3>
                    <p>{{trans('footer.policy_content')}}
                    </p>
                </div>
                <div class="col-sm-2"></div>
            </div>
            <div class="row">
                <div class="col-md-10 text-center t">
                    <p class="text-justify">pubg mobile hack | hack pubg pc steam | hack hack game online | tool pubg | tool pubg mobile | apex legends | undetected pc hacks | aimbot esp radar cheats | pubg mobile hack | hack pubg mb | pubg hack tool pubg | thue hackpubg | thue tool pubg | pubg mobile | pubg mobile simulator | hack ring of eysium | ring of eysium esp | hire hack roe
                    </p>
                    Copyright ©2019 {{config('const.site_url')}}. All rights reserved.<br>
                </div>
            </div>
        </div>

    </div>
</div>

@if(isset($siteSettings['float_content_left']) && $siteSettings['float_content_left'] != "")
    <div style="position: fixed; left: 0; top: 30%">
        {!!$siteSettings['float_content_left']!!}
    </div>
@endif

@if(isset($siteSettings['float_content_right']) && $siteSettings['float_content_right'] != "")
    <div style="position: fixed; right: 0; top: 30%">
        {!!$siteSettings['float_content_right']!!}
    </div>
@endif

@if(isset($siteSettings['popup']) && $siteSettings['popup'] != "")
    <div class="poup_background" style="display: none; width: 100%;height: 100vh; background: #000000c2; position: fixed; overflow: hidden; top: 0; z-index: 99999;">
        <div class="text-center" style="position: relative;  margin: 0 auto;   top: 10%;   z-index: 999999; max-width: 100%">
            <span id="close_promo_popup" style="    position: absolute;    top: 0;    right: 0;    color: white; background: red;    padding: 3px;    cursor: pointer;">Close</span>
            {!!$siteSettings['popup']!!}
        </div>
    </div>
@endif

<!--
<a href="https://www.facebook.com/groups/618459838608905/" target="_blank" rel="nofollow">
	<img src="https://static-v.tawk.to/a-v3-47/images/bubbles/164-r-br.svg" style="width: 8%; position: fixed; bottom: 20px; right: 10px; z-index: 999;" title="Group facebook" alt="Group FB" />
</a>
-->
