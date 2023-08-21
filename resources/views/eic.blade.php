@extends('layouts.index')

@section('content')

    @php use App\Models\Master; @endphp

    <div style="height: 90px; background-color: #EFEFEF"></div>

    <!-- ======= EIC Section ======= -->
    <section id="eic" class="eic">
      <div class="container">

        <div class="row content">
          <div class="mx-auto col-12 col-lg-8" data-aos="fade-up" data-aos-delay="200">
            <img src="assets/img/eic2023.png" style="width: 100%">  
          </div>
          <br>
          <div class="mx-auto col-10 pt-4 pt-lg-0 text-center" data-aos="fade-up" data-aos-delay="300">
            <p>
              @foreach ($contents as $c)
                @if ($c->code=='eic')
                  {!! Illuminate\Support\Str::markdown($c->body) !!}
                @endif  
              @endforeach
            </p>
            <!-- <a href="#" class="btn-learn-more">Learn More</a> -->
          </div>
        </div>

      </div>
    </section>

    @if (Master::whereCode('eic-category')->first()->status)
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Kategori Lomba</h2>
        </div>

        <div class="row">
          @foreach ($categories as $ct)
          <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="{{ $ct->icon }}"></i></div>
              <h4 class="title"><a href="#">{{ $ct->title }}</a></h4>
              <p class="description">{{ $ct->description }}</p>
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </section><!-- End Services Section -->
    @endif

    @if (Master::whereCode('eic-flow')->first()->status)
    <!-- ======= Pendaftaran Section ======= -->
    <section id="pendaftaran" class="about">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Alur Pendaftaran</h2>
        </div>

        <style>
          #pendaftaran li {margin-bottom: 20px;}
        </style>

        <div class="row content">
          <div class="mx-auto col-12 col-lg-10 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
            @foreach ($contents as $c)
              @if ($c->code=='eic-flow')
                {!! Illuminate\Support\Str::markdown($c->body) !!}
              @endif  
            @endforeach
            <!-- <a href="#" class="btn-learn-more">Learn More</a> -->
          </div>
        </div>

        @if (Master::whereCode('eic-card')->first()->status)
        <div class="row services mt-5">
          @foreach ($cards as $card)
          <div class="mx-auto col-md-5 d-flex align-items-stretch mb-5">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <h4 class="title"><a href="#">{{ $card->title }}</a></h4>
              <p class="description">{{ $card->description }}</p>
              <br>
              <a href="{{ $card->url }}" target="_blank" class="btn btn-eic">
                {{ $card->button }}
              </a>
            </div>
          </div>
          @endforeach
        </div>
        @endif

      </div>
    </section>
    @endif

    @if (Master::whereCode('eic-timeline')->first()->status)
    <!-- ======= Timeline Us Section ======= -->
    <section class="about">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Timeline</h2>
        </div>

        <div id="eic-timeline" class="mx-auto col-12 col-lg-8" data-aos="fade-up" data-aos-delay="200">
          @foreach ($contents as $c)
            @if ($c->code=='eic-timeline')
              {!! Illuminate\Support\Str::markdown($c->body) !!}
            @endif  
          @endforeach
        </div>

      </div>
    </section>
    @endif

    @if (Master::whereCode('eic-gallery')->first()->status)
    <!-- ======= Gallery Section ======= -->
    <section id="team2" class="team">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Gallery</h2>
        </div>

        <div class="row text-center">
          @foreach ($galleries as $g)
          <div class="col-lg-3 col-md-4 col-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="assets/img/gallery/{{ $g->image }}" class="img-fluid" style="aspect-ratio: 3/2; object-fit: cover;">
              </div>
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </section><!-- End Team Section -->
    @endif

    @include('components/sponsor')

@endsection

@section('script')
<script type="text/javascript">
  $("#eic-timeline").find("table").addClass("table table-bordered border-dark");
  $("#eic-timeline").find("table").find("th").addClass("text-center");
  $("#eic-timeline").find("table").find("td").addClass("text-center align-middle");
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