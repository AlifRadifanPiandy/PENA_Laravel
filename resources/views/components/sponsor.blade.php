  @php use App\Models\Master; @endphp

  @if (Master::whereCode('sponsor')->first()->status)
  <!-- ======= Sponsor Section ======= -->
  <section id="sponsor" class="sponsor">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Our Sponsor</h2>
      </div>

      <div class="row mx-auto justify-content-center col-12 col-lg-10" data-aos="fade-up" data-aos-delay="300">
        
        @foreach ($sponsors as $s)
          @if ($s->type==1)
            <div class="{{ $s->class }}">
              <img class="col-12" src="/assets/img/sponsor/{{ $s->logo }}">
            </div>
          @endif
        @endforeach
      </div>

    </div>
  </section><!-- End Sponsor Section -->
  @endif

  @if (Master::whereCode('support')->first()->status)
  <section id="support" class="sponsor">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Supported By</h2>
      </div>

      <div class="row mx-auto justify-content-center col-12 col-lg-10" data-aos="fade-up" data-aos-delay="300">
        @foreach ($sponsors as $s)
          @if ($s->type==3)
            <div class="{{ $s->class }}">
              <img class="col-12" src="/assets/img/sponsor/{{ $s->logo }}">
            </div>
          @endif
        @endforeach
      </div>

    </div>
  </section><!-- End Sponsor Section -->
  @endif

  @if (Master::whereCode('medpart')->first()->status)
  <!-- ======= Sponsor Section ======= -->
  <section id="medpart" class="medpart">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Media Partner</h2>
      </div>

      <div class="row mx-auto justify-content-center col-12 col-lg-10" data-aos="fade-up" data-aos-delay="300">
        @foreach ($sponsors as $s)
          @if ($s->type==2)
            <div class="{{ $s->class }}">
              <img class="col-12" src="/assets/img/sponsor/{{ $s->logo }}">
            </div>
          @endif
        @endforeach
      </div>

    </div>
  </section><!-- End Sponsor Section -->
  @endif