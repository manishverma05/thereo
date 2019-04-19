<div class="banner-content">
    <div class="container">
        <div class="row">
            <div class="login_wrap login_wrap_mk">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <p class="log_p" style="font-size:17px">Sign in or join up below to access all our programs, resources, and more.</p>
                <div class="rjbtn discover_rj"><a href="javascript::void(0);" onclick="loginstep(2)">Sign In</a></div>
                <div class="or_rj">or</div>
                <div class="rjbtn browse_pro"><a href="{{ route('register') }}">Join Up</a></div>
            </div>
        </div>
    </div>
</div>