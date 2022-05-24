@guest()
<a onclick='window.location.href = "/login"'>
    <h1 style="font-weight: 700; color: #3be85f">Paypal/Alipay/Visa/MasterCard</h1>
</a>
@endguest
@auth()
<a target="blank" data-bs-toggle="offcanvas" role="button" href="#extra-payment"
   aria-controls="extra-payment">
    <h1 style="font-weight: 700; color: #3be85f">Paypal/Alipay/Visa/MasterCard</h1>
</a>
<div class="offcanvas offcanvas-start" tabindex="-1" id="extra-payment" aria-labelledby="extra-payment">
    <div class="offcanvas-body">
        <h4 class="no-margin-bottom" style="animation: Color 4s linear infinite;-webkit-animation: Color 4s
        ease-in-out infinite;">Paypal/Alipay/Visa/MasterCard</h4>
        <br/>
        <span>Open ticket in Discord to purchase via Paypal/Alipay/Visa/Master Card </span>
        <hr/>
        <div class="mt-3">
            <a href="https://discord.gg/sA9btKuaFS" target="_blank">
                <lottie-player src="https://assets5.lottiefiles.com/private_files/lf30_mAfXxk.json"
                               background="transparent"  speed="1"  style="width: 150px"  loop  autoplay></lottie-player>
            </a>


        </div>

    </div>
</div>
@endauth

