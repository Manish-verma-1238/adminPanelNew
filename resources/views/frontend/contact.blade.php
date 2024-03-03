@include('frontend.common.header')

<div class="banner-block1 cc" style="height: 40vh; position: relative;">
    <!-- <img src="uploads/block-bg.png" loading="lazy"> -->
    <div class="center_search_about">
        <div class="container-fluid hero-header-about mb-5">
            <div class="container text-center">
                <h1 class="display-4 mb-3 animated">Contact Us</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0 animated slideInDown">
                        <li class="breadcrumb-item"><a class="text-reset" href="{{route('main')}}"><strong>Home</strong></a></li>
                        <li class="breadcrumb-item" style="color: var(--main-color);" aria-current="page"><b>Contact Us</b>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Contact Start -->
<div class="container-fluid px-0 contact py-5">
    <div class="p-5 bg-light rounded">
        <div class="row g-4">
            <div class="col-12">
                <div class="text-center mx-auto" style="max-width: 700px;">
                    <h1 class=""><b>Get in touch</b></h1><br>
                    <p>You can make a reservation 24/7 from our website, or call us at: +91 98887 99313</p>
                </div>
            </div>
            <div class="col-lg-7 mt-5">
                <form action="" class="">
                    <input type="text" class="w-100 form-control-contact border-0 py-4 mb-4" placeholder="Your Name">
                    <input type="email" class="w-100 form-control-contact border-0 py-4 mb-4" placeholder="Enter Your Email">
                    <textarea class="w-100 form-control-contact border-0 mb-4" rows="5" cols="10" placeholder="Your Message"></textarea>
                    <button class="w-100 sign singup_btn py-3" type="submit">Submit</button>
                </form>
            </div>
            <div class="col-lg-5 pad-to mt-5">
                <div class="d-flex p-4 rounded mb-4 bg-white">
                    <img src="{{asset('assets/frontend/uploads/address.png')}}" class="me-4" style="margin-right: 5px;  width: 50px; height: 50px;" alt="">
                    <div>
                        <h4>Address</h4>
                        <p class="mb-2">46, Krishna Enclave, Dhakoli, Zirakpur, Punjab 140603, India</p>
                    </div>
                </div>
                <div class="d-flex p-4 rounded mb-4 bg-white">
                    <img src="{{asset('assets/frontend/uploads/mail.png')}}" style="margin-right: 10px;  width: 40px; height: 40px;" class="me-4" alt="">
                    <div>
                        <h4>Mail Us</h4>
                        <p class="mb-2"><a href="mailto:zipzaptaxichd@gmail.com ">zipzaptaxichd@gmail.com </a></p>
                    </div>
                </div>
                <div class="d-flex p-4 rounded bg-white">
                    <img src="{{asset('assets/frontend/uploads/call.png')}}" style="margin-right: 10px;  width: 40px; height: 40px;" class="me-4" alt="">
                    <div>
                        <h4>Contact Number</h4>
                        <p class="mb-2"><a href="tel:9888799313">+91 98887 99313</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 py-5">
                <div class="h-100 rounded">
                    <!-- <iframe class="rounded w-100" style="height: 400px; border: none;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387191.33750346623!2d-73.97968099999999!3d40.6974881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1694259649153!5m2!1sen!2sbd" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                    <iframe class="rounded w-100" style="height: 400px; border: none;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3432.2941343142243!2d76.83413617465801!3d30.653844889442638!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390f94c897729183%3A0xe6426b487e30cf3a!2s46%2C%20Krishna%20Enclave%2C%20Dhakoli%2C%20Zirakpur%2C%20Punjab%20140603!5e0!3m2!1sen!2sin!4v1709344593617!5m2!1sen!2sin" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

@include('frontend.common.footer')