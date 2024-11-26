    <!-- Footer Start -->
    <div class="footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6">
              <div class="footer-widget">
                <h3 class="title">Get in Touch</h3>
                <div class="contact-info">
                  <p><i class="fa fa-map-marker"></i>{{ $setting_info->street }} , {{ $setting_info->city }} , {{ $setting_info->country}}</p>
                  <p><i class="fa fa-envelope"></i>{{$setting_info->email}}</p>
                  <p><i class="fa fa-phone"></i>{{$setting_info->phone}}</p>
                  <div class="social">
                    <a href="{{$setting_info->twitter}}" title="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="{{$setting_info->facebook}}"  title="facebook"><i class="fab fa-facebook-f"></i></a>
                    {{-- <a href=""><i class="fab fa-linkedin-in"></i></a> --}}
                    <a href="{{$setting_info->instagram}}" title="instagram"><i class="fab fa-instagram"></i></a>
                    <a href="{{$setting_info->youtube}}" title="youtube"><i class="fab fa-youtube"></i></a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="footer-widget">
                <h3 class="title">Useful Links</h3>
                <ul>
                    @foreach ($related_site as $site)

                    <li><a href="{{$site->url}}" title="{{$site->name}}">{{$site->name}}</a></li>
                    @endforeach

                </ul>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="footer-widget">
                <h3 class="title">Quick Links</h3>
                <ul>
                  <li><a href="#">Lorem ipsum</a></li>
                  <li><a href="#">Pellentesque</a></li>
                  <li><a href="#">Aenean vulputate</a></li>
                  <li><a href="#">Vestibulum sit amet</a></li>
                  <li><a href="#">Nam dignissim</a></li>
                </ul>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="footer-widget">
                <h3 class="title">Newsletter</h3>
                <div class="newsletter">
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Vivamus sed porta dui. Class aptent taciti sociosqu
                  </p>
                 <form action="{{route('frontend.new.subsceiber')}}" method="post">
                    @csrf
                    <input name="email" class="form-control"  type="email" placeholder="Your email here" />
                    @error('email')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    <button class="btn">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer End -->



      <!-- Footer Bottom Start -->
      <div class="footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-md-6 copyright">
              <p>
                Copyright &copy; <a href="{{route('frontend.index')}}">{{config('app.name')}}</a>. All Rights
                Reserved
              </p>
            </div>

            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
            <div class="col-md-6 template-by">
              <p>Designed By <a href="https://htmlcodex.com">HTML Codex</a></p>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer Bottom End -->