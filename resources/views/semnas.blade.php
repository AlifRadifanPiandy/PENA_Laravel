@extends('layouts.index')

@section('content')

    @php use App\Models\Master; @endphp

    <div style="height: 90px; background-color: #EFEFEF"></div>

    
    @if (Master::whereCode('semnas-banner')->first()->status)
    <!-- ======= Semnas Section ======= -->
    <section id="eic" class="eic">
      <div class="container">

        <div class="row content">
          <div class="mx-auto col-12 col-lg-8" data-aos="fade-up" data-aos-delay="200">
            <img src="assets/img/banner-semnas2.png" style="width: 100%; border: 1px solid #2F2051">  
          </div>
          <br>
          @if (Master::whereCode('semnas-about')->first()->status)
          <div class="mx-auto col-10 pt-4 pt-lg-0 text-center my-4" data-aos="fade-up" data-aos-delay="300">
            @foreach ($contents as $c)
              @if ($c->code=='semnas')
                {!! Illuminate\Support\Str::markdown($c->body) !!}
              @endif  
            @endforeach
            <!-- <a href="#" class="btn-learn-more">Learn More</a> -->
          </div>
          @endif
        </div>

      </div>
    </section>
    @endif

    @if (Master::whereCode('semnas-coming')->first()->status)
    <!-- ======= Services Section ======= -->
    <section id="coming" class="coming my-5">
      <div class="container my-5">

        <div class="section-title" data-aos="fade-up">
          <h2 class="h3">Coming Soon!</h2>
        </div>

      </div>
    </section><!-- End Services Section -->
    @endif

    @if (Master::whereCode('semnas-register')->first()->status)
    <!-- ======= Pendaftaran Section ======= -->
    <section id="pendaftaran" class="about">
      <div class="container">

        <div class="row content">
          <div class="mx-auto col-12 col-lg-10 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
            @foreach ($contents as $c)
            @if ($c->code=='semnas-register')
              {!! Illuminate\Support\Str::markdown($c->body) !!}
            @endif  
          @endforeach
            <!-- <a href="#" class="btn-learn-more">Learn More</a> -->
          </div>
        </div>

      </div>
    </section>
    @endif

    @if (Master::whereCode('semnas-gallery')->first()->status)
      <!-- ======= Gallery Section ======= -->
    <section id="team2" class="team">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Dokumentasi</h2>
        </div>

        <div class="row text-center">
          <?php
            for($i=1; $i<=6; $i++){            
          ?>
          <div class="col-lg-3 col-md-4 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="assets/img/dokumentasi/semnas/<?= $i ?>.png" class="img-fluid" alt="">
              </div>
            </div>
          </div>
          <?php } ?>
        </div>

      </div>
    </section><!-- End Team Section -->
    @endif

    @include('components/sponsor')

@endsection