<!-- Sign Up Form -->
<section class="sign-up py-5 d-flex align-items-center" style="min-height: 100vh; background-color: rgb(25, 85, 137);">
    <div class="container" style="max-width: 800px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Sign Up</h2>
                    <form method="POST" id="register-form">
                        <div class="form-group">
                            <label for="name"></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email"></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <label for="pass"></label>
                            <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="re_pass"></label>
                            <input type="password" name="re_pass" id="re_pass" class="form-control" placeholder="Repeat your password" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" name="agree-term" id="agree-term" class="form-check-input">
                            <label for="agree-term" class="form-check-label">I agree to all statements in <a href="#" class="text-primary">Terms of Service</a></label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>
                    <div class="text-center mt-3">
                        <span>Already a member?</span> <a href="login.html" class="text-primary">Log in here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
