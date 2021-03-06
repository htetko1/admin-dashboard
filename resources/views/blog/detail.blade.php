@extends('blog.master')
@section('content')
    <div class="">
        <div class="py-3">

            <div class="small post-category mb-3">
                <a href="{{ route('baseOnCategory',$article->category->id) }}" rel="category tag">{{ $article->category->title }}</a>
            </div>

            <h2 class="fw-bolder">{{ $article->title }}</h2>
            <div class="my-3 feature-image-box">
                <div class="d-block d-md-flex justify-content-between align-items-center my-3">

                    <div class="">
                        @if($article->user->name)
                            <img alt="" src="{{ asset('storage/profile/'.$article->user->photo) }}"
                                 class="avatar avatar-50 photo rounded-circle" height="50" width="50"
                                 loading="lazy">
                        @else
                            <img alt="" src="{{ asset('dashboard/img/hetko.jpg') }}"
                                 class="avatar avatar-50 photo rounded-circle" height="50" width="50"
                                 loading="lazy">
                        @endif
                            <a href="{{ route('baseOnUser',$article->user->id) }}"  class="ms-2 text-decoration-none">{{ $article->user->name }}</a>
                    </div>

                    <div class="text-primary">
                        <i class="feather-calendar"></i>
                        <a href="{{ route('baseOnDate',$article->created_at) }}" class="text-decoration-none">
                            {{ $article->created_at->format("d F Y H:i a") }}
                        </a>
                    </div>
                </div>

                <p class="text-black-50" style="white-space: pre-line">
                    {{ $article->description }}
                </p>
                @php
                    $previous = \App\Models\Article::where("id","<","$article->id")->latest("id")->first();
                    $next = \App\Models\Article::where("id",">","$article->id")->first();
                @endphp

                <div class="nav d-flex justify-content-between p-3">
                    <a href="{{isset($previous)? route('detail',$previous->id):'#' }}"
                       class="btn btn-outline-primary page-mover rounded-circle @empty($previous) disabled @endempty">
                        <i class="feather-chevron-left"></i>
                    </a>

                    <a class="btn btn-outline-primary px-3 rounded-pill" href="{{ route('index') }}">
                        Read All
                    </a>

                    <a href="{{ isset($next)? route('detail',$next->id):'#' }}"
                       class="btn btn-outline-primary page-mover rounded-circle @empty($next) disabled @endempty">
                        <i class="feather-chevron-right"></i>
                    </a>
                </div>
            </div>


        </div>

        <div class="d-block d-lg-none d-flex justify-content-center">
        </div>

    </div>

@endsection
