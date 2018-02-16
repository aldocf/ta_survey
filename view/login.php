<body class="account separate-inputs" data-page="login">
<!-- BEGIN LOGIN BOX -->
<div class="container" id="login-block">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <i class="user-img icons-faces-users-03"></i>
                <form class="form-signin" role="form" method="post">
                    <div class="append-icon" style="margin-bottom: 8px;">
                        <input type="email" name="email" id="email" class="form-control form-white username" placeholder="Email" required>
                        <i class="icon-envelope"></i>
                    </div>
                    <div class="append-icon m-b-20">
                        <input type="password" name="password" class="form-control form-white password" placeholder="Password" required>
                        <i class="icon-lock"></i>
                    </div>
                    <button type="submit" id="submit-form" class="btn btn-lg btn-success btn-block ladda-button" data-style="expand-left" name="btnSubmit">Sign In</button>
                    <a href="index.php" id="" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Back To Home</a>
                    <div class="clearfix">
                        <p class="pull-left m-t-20"><a id="password" href="#">Forgot password?</a></p>
                        <p class="pull-right m-t-20"><a href="index.php?menu=register">Register</a></p>
                    </div>
                </form>
                <form class="form-password" role="form">
                    <div class="append-icon m-b-20">
                        <input type="password" name="password" class="form-control form-white password" placeholder="Password" required>
                        <i class="icon-lock"></i>
                    </div>
                    <button type="submit" id="submit-password" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Send Password Reset Link</button>
                    <div class="clearfix">
                        <p class="pull-left m-t-20"><a id="login" href="#">Already got an account? Sign In</a></p>
                        <p class="pull-right m-t-20"><a href="index.php?menu=register">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <p class="account-copyright">
        <span>Copyright © 2015 </span><span>THEMES LAB</span>.<span>All rights reserved.</span>
    </p>
</div>
<script src="./assets/global/plugins/jquery/jquery-3.1.0.min.js"></script>
<script src="./assets/global/plugins/jquery/jquery-migrate-3.0.0.min.js"></script>
<script src="./assets/global/plugins/gsap/main-gsap.min.js"></script>
<script src="./assets/global/plugins/tether/js/tether.min.js"></script>
<script src="./assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="./assets/global/plugins/backstretch/backstretch.min.js"></script>
<script src="./assets/global/plugins/bootstrap-loading/lada.min.js"></script>
<script src="./assets/global/js/pages/login-v1.js"></script>
