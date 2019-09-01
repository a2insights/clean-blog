<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    <meta name="description" content="{{ $blog->description }}">
    <meta name="author" content="{{ $blog->user->name }}">
    <title>{{ $blog->name }}</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/clean/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/clean/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!-- Custom styles for this template -->
    <link href="{{ asset('vendor/clean/assets/css/clean-blog.min.css') }}" rel="stylesheet">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg bg-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="/{{$blog->guard_name}}">{{$blog->name}}</a>
        <button class="navbar-toggler text-white navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-3x fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link card-link text-secondary" href="/">HasBlog</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link card-link text-secondary" href="/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();
                               ">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<!-- Page Header -->
<header class="masthead" style="background-image: url('{{asset('vendor/clean/assets/img/home-bg.jpg')}}')">
    <div class="overlay"></div>
    @if(!isset($_GET['page']))
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>{{$blog->name}}</h1>
                        <span class="subheading">{{$blog->description}}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</header>
<!-- Main Content -->
<div class="container {{ isset($_GET['page']) ? 'mt-5 pt-5' : '' }}"  id="content">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @foreach($posts as $post)
                <div class="post-preview">
                    <h1 class="post-title">
                        {{$post->title}}
                    </h1>
                    <p class="post-subtitle ">
                       {!! $post->content !!}
                    </p>
                    <p class="post-meta mb-1">Posted at
                        {{$post->created_at}}
                    </p>
                    @can('update' , $post)
                        <form method="POST" id="destroyPost-{{$post->id}}" action="/dashboard/post/{{$post->id}}">
                            <a class="btn px-0 btn-link text-primary" href="/dashboard/post/{{$post->id}}/edit">edit</a>
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button
                                type="submit"
                                onclick="
                                    event.preventDefault();
                                    let destroy = confirm('Really want to delete the post');
                                    if(destroy){ document.getElementById('destroyPost-{{$post->id}}').submit() }
                                "
                                class="btn btn-link ml-2 px-0 text-danger"
                            >
                                delete
                            </button>
                        </form>
                    @endauth
                </div>
                <hr>
            @endforeach
            @if($posts->currentPage() !== $posts->lastPage() || $posts->lastPage() !== 1)
                <div class="clearfix">
                    <a tabindex="-1" class="btn btn-primary {{$posts->previousPageUrl() ? '' : 'disabled'}} float-left" href="{{$posts->previousPageUrl()}}">News Posts &rarr;</a>
                    <a class="btn btn-primary {{$posts->nextPageUrl() ? '' : 'disabled'}} float-right" href="{{$posts->nextPageUrl()}}">Older Posts &rarr;</a>
                    <p class="text-sm-center text-muted pt-2">
                        Page: {{ $posts->currentPage() }} | Pages: {{ $posts->lastPage() }}
                    </p>
                    <div class="row  mb-5">
                        <div class="col text-sm-center text-muted">
                            <small>Showing {{ $posts->currentPage() }} of {{ $posts->lastPage() }} pages and a total of {{ $posts->total() }} posts</small>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<hr class="mb-0">
<!-- Footer -->
<footer class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <p class="copyright my-0 text-muted">Copyright &copy; 2019</p>
            </div>
        </div>
    </div>
</footer>
<!-- Bootstrap core JavaScript -->
<script src="{{ asset('vendor/clean/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/clean/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Custom scripts for this template -->
<script src="{{ asset('vendor/clean/assets/js/clean-blog.min.js') }}"></script>
<style>
    #mainNav.is-fixed .navbar-brand {
        color: #ffffff;
    }

    #mainNav .navbar-brand {
        font-weight: 800;
        color: #ffffff;
    }
</style>
</body>
</html>
