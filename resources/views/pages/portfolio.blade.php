@extends('layouts.master_home')
@section('home_content')
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
            </div>
        </section><!-- End Breadcrumbs -->
        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container">
                <div class="row portfolio-container" data-aos="fade-up">
                    @foreach ($images as $img)
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <img src="{{ $img->image }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>App 1</h4>
                                <p>App</p>
                                <a href="{{ $img->image }}" data-gall="portfolioGallery" class="venobox preview-link"
                                    title="App 1"><i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section><!-- End Portfolio Section -->
    </main><!-- End #main -->
@endsection
