<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Contact Us
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Contact Us</h3>
                                        </div>
                                        {{-- <form method="post" action="{{ route('login.process') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required="" name="email" placeholder="Your Email" :value="old('email')" required autofocus>
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password" placeholder="Password" required autocomplete="current-password">
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="exampleCheckbox1" value="">
                                                        <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                                    </div>
                                                </div>
                                                <a class="text-muted" href="{{ route('password.request') }}">Forgot password?</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Log in</button>
                                            </div>
                                        </form> --}}
                                        <form wire:submit.prevent="">
                                            <div class="mb-3 mt-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Name">
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" placeholder="Email">
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label for="subject" class="form-label">Subject</label>
                                                <input type="text" name="subject" class="form-control" placeholder="Subject">
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label for="message" class="form-label">Message</label>
                                                <textarea name="message" class="form-control" cols="40" rows="3" placeholder="Message"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary float-end">Send Message</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="location">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.064780548511!2d106.75797137372074!3d-6.255196261240877!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1b58e28dae5%3A0x39b9e86872da122e!2sSABI%20Konveksi%20Bintaro%20%7C%20Sablon%20Kaos%20Bintaro%20%7C%20Vendor%20Merchandise%20%7C%20Vendor%20Printing!5e0!3m2!1sen!2sid!4v1700149537098!5m2!1sen!2sid" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <h4> Workshop </h4>
                        <address>
                        Toko Bangunan Pusaka / Konveksi, <br>
                        Jl. Bintaro Permai Gang Samping No.56, RT.4/RW.2, <br>
                        Pesanggrahan, Kec. Pesanggrahan, Kota Jakarta Selatan, <br>
                        Daerah Khusus Ibukota Jakarta 12320 <br>
                        </address>
                    </div>
                    <div class="col-md-6">
                        <h4> Call Us : </h4>
                        <address>
                        <a href="tel:085281573272" target="_blank"><h4><i class="fa-solid fa-phone"></i> 0852-8157-3272</h4></a>
                        <abbr title="Email">
                        <strong>Email </strong>
                        </abbr> : cigem.creative@gmail.com
                        </address>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>