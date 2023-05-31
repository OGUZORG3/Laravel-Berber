@extends('frontend.layout')
@section('title',"E-Berberim")
@section('content')
    <header>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner" role="listbox">
                @php($count=0)
                @foreach($data['slider'] as $slider)
                    <div class="carousel-item @if ($count++==0) active @endif"
                         style="background-image: url('../images/sliders/{{$slider->slider_file}}')">
                        <div class="carousel-caption d-none d-md-block">
                            <a href="@if (strlen($slider->slider_url)>0) {{$slider->slider_url}} @else javascript:void(0) @endif">
                                <h3>{{$slider->slider_title}}</h3>
                            </a>
                        </div>
                    </div>
                @endforeach


            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </header>

    <!-- Page Content -->

    <div class="container cusContainer">


        <!-- Portfolio Section -->
        <h2 class="mt-4">Bloglarımız</h2>

        <div class="row">

            @foreach($data['blog'] as $blog)
                <div class="col-lg-4 col-sm-6 portfolio-item Ablog">
                    <div class="card h-100">

                        <a href="{{route('blog.Detail',$blog->blog_slug)}}"><img class="card-img-top" src="../images/blogs/{{$blog->blog_file}}" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{route('blog.Detail',$blog->blog_slug)}}">{{$blog->blog_title}}</a>
                            </h4>
                            <p class="card-text">{!! substr($blog->blog_content,0,140) !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <!-- /.row -->

        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-6">
                <h2>{{$home_title}}</h2>
                {!! $home_detail !!}
            </div>
            <div class="col-lg-6">
                <img class="img-fluid rounded" src="../images/settings/{{$home_image}}" alt="">
            </div>
        </div>
        <!-- /.row -->

        <hr>
        @if(!empty($data['packages']))
        <h1>Paketlerimiz</h1>

        <section class="justify-content-center align-self-center d-flex">
            <div class="row">
                @foreach($data['packages'] as $paket)
                <div class="col-4">
                    <div class="kart">
                        <div class="kart2">
                            <div class="card-body " style="background-color: rgb(0,0,0,0)!important;">
                                <h5 class="card-title">{{$paket->paket_ad}}</h5>
                                <p class="card-text">{{$paket->paket_icerik}}</p>
                            </div>
                            <ul class="list-group list-group-flush bg-transparent paketozel">
                                {{print $paket->paket_ozellik}}
                            </ul>
                            <div class="card-body">
                                <a href="#" class="card-link">Card link</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </section>
        @endif
        <section>

        </section>
        <!-- Call to Action Section -->
        <div class="row mb-4">
            <div class="col-md-8">

            </div>
            <div class="col-md-4">
                <a class="btn btn-lg btn-secondary btn-block" href="#">Bize Ulaşın</a>
            </div>
        </div>

    </div>

    <!-- /.container -->

@endsection
@section('css') @endsection
@section('js') @endsection
