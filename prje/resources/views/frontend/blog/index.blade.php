@extends('frontend.layout')
@section('title',"Anasayfa Başlığı")
@section('content')

    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Blog
            <small>Bloglar Listeleniyor</small>
        </h1>


        @foreach($data['blog'] as $blog)
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        @if($blog->blog_file != null)
                        <a href="{{route('blog.Detail',$blog->id)}}">
                            <img class="img-fluid rounded img-sm" style="object-fit: cover!important;" src="../images/blogs/{{$blog->blog_file}}" alt="">
                        </a>
                        @else
                            <img src="../public/sistem-resimleri/not-found.png" class="card-img-top" alt="...">
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <h2 class="card-title">{{$blog->blog_title}}</h2>
                        <p class="card-text">{!! substr($blog->blog_content,0,140) !!}</p>
                        <a href="{{route('blog.Detail',$blog->id)}}" class="btn btn-primary">Devamını Oku &rarr;</a>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted row bg-transparent">
               <p class="col-6">Yayınlama Zamanı {{$blog->created_at->format('d-m-Y h:i')}}</p>
                <p class="col-6 text-right">Görüntülenme Sayısı: {{$blog->tiklanma_sayisi}}</p>
            </div>
        </div>
            @endforeach
        <div  class="sayfa">
        {{$data['blog']->links()}}
        </div>
    </div>

@endsection
@section('css') @endsection
@section('js') @endsection
