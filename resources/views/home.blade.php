@extends('layouts.index')

@section('hero')
  @include('components/hero')
@endsection

@section('content')

    @php use App\Models\Master; @endphp

    @if (Master::whereCode('about')->first()->status)
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>About Us</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
            @foreach ($contents as $c)
              @if ($c->code=='about-1')
                {!! Illuminate\Support\Str::markdown($c->body) !!}
              @endif  
            @endforeach
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
            @foreach ($contents as $c)
              @if ($c->code=='about-2')
                {!! Illuminate\Support\Str::markdown($c->body) !!}
              @endif  
            @endforeach
            <a href="eic" class="btn-learn-more pointer">EIC</a>
            <a href="semnas" class="btn-learn-more">SEMNAS</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->
    @endif

    @if (Master::whereCode('teaser')->first()->status)
    <!-- ======= Teaser Section ======= -->
    <section id="teaser" class="teaser">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Teaser</h2>
        </div>
        <div class="row content">
          <video class="mx-auto mb-5 col-12 col-lg-10" controls data-aos="fade-up" data-aos-delay="150">
            <source src="assets/video/teaser.mp4" type="video/mp4">Your browser does not support the video tag.
          </video>
          <!-- <iframe id="vy" 
            class="mx-auto mb-5 col-12 col-lg-10" data-aos="fade-up" data-aos-delay="150"
            src="https://www.youtube.com/embed/4CYcUdBzknE" title="YouTube video player" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
        </div>

      </div>
    </section><!-- End About Us Section -->
    @endif

    @if (Master::whereCode('faq')->first()->status)
    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>FAQ</h2>
        </div>

        @foreach ($faqs as $f)
        <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-5">
            <i class="ri-question-line"></i>
            <h4>{{ $f->question }}</h4>
          </div>
          <div class="col-lg-7">
            <p>{{ $f->answer }}</p>
          </div>
        </div><!-- End F.A.Q Item-->
        @endforeach      

      </div>
    </section><!-- End F.A.Q Section -->
    @endif

    @include('components/sponsor')

    <script type="text/javascript">
      function setHeight(){
        var width = document.getElementById('vy').clientWidth;
        document.getElementById('vy').style.height = (width/1.85)+"px";
      }  
      setHeight();
      function eic(){
        Swal.fire({
          title: "Selamat Kepada Para Grand Finalis",
          text: "Kami Tunggu di Surabaya!",
          iconHtml: "<img src='assets/img/hero-img.png' style='width:100px'>",
          customClass: {
            icon: 'no-border'
          }
        })
        // .then(function() {
        //   window.location = "eic";
        // });
      }
      //eic()
    </script>

@endsection