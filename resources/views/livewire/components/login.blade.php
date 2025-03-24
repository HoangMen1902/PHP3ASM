<!-- Sign In Form -->
<section class="sign-in py-5 d-flex align-items-center" style="min-height: 100vh; background-color:rgb(25, 85, 137);">
    <div class="container" style="max-width: 800px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Sign In</h2>
                    <form method="POST" id="login-form">
                        <div class="form-group">
                            <label for="your_name"></label>
                            <input type="text" name="your_name" id="your_name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"></label>
                            <input type="password" name="your_pass" id="your_pass" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" name="remember-me" id="remember-me" class="form-check-input">
                            <label for="remember-me" class="form-check-label">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Log in</button>
                    </form>
                    <div class="text-center mt-3">
                        <span>Or login with</span>
                        <div class="d-flex justify-content-center mt-2">
                            <a href="#" class="btn btn-outline-primary mx-1"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-outline-info mx-1"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-outline-danger mx-1"><i class="fab fa-google"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>