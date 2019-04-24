@extends('layouts.app')

@section('title', $article->title)

@section('styles')
    <link rel="stylesheet" href="{{ asset(mix('css/detail-post.css')) }}">
    <style>
    .fixed-plugin {
        position: fixed;
        top: 200px;
        right: 0;
        width: 50px;
        background: rgba(0, 0, 0, .3);
        z-index: 1031;
        border-radius: 8px 0 0 8px;
        text-align: center;
    }

    .fixed-plugin .fa-cog {
        color: #FFFFFF;
        padding: 10px;
        border-radius: 0 0 6px 6px;
        width: auto;
    }

    .fixed-plugin .dropdown-menu {
        right: 80px !important;
        left: auto !important;
        width: 280px;
        border-radius: 10px;
        padding: 0 10px;
    }

    .fixed-plugin .dropdown .dropdown-menu {
        -webkit-transform: translateY(-15%);
        -moz-transform: translateY(-15%);
        -o-transform: translateY(-15%);
        -ms-transform: translateY(-15%);
        transform: translateY(-15%);
        top: -20px !important;
        opacity: 0;
        right: 0;
        transform-origin: 0 0 !important;
    }

    .fixed-plugin .dropdown.open .dropdown-menu {
        opacity: 1;
        -webkit-transform: translateY(-13%) !important;
        -moz-transform: translateY(-13%) !important;
        -o-transform: translateY(-13%) !important;
        -ms-transform: translateY(-13%) !important;
        transform: translateY(-13%) !important;
        transform-origin: 0 0 !important;
    }

    .fixed-plugin .dropdown-menu:before,
    .fixed-plugin .dropdown-menu:after {
        content: "";
        display: inline-block;
        position: absolute;
        top: 70px;
        width: 16px;
        transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        -moz-transform: translateY(-50%);

    }

    .fixed-plugin .dropdown-menu:before {
        border-bottom: 16px solid rgba(0, 0, 0, 0);
        border-left: 16px solid rgba(0, 0, 0, 0.2);
        border-top: 16px solid rgba(0, 0, 0, 0);
        right: -17px;
    }

    .fixed-plugin .dropdown-menu:after {
        border-bottom: 16px solid rgba(0, 0, 0, 0);
        border-left: 16px solid #FFFFFF;
        border-top: 16px solid rgba(0, 0, 0, 0);
        right: -16px;
    }

    .fixed-plugin {
        top: 210px;
    }

    .ql-toolbar.ql-snow {
        padding: 2.5% 0%;
        border: none !important;
    }

    .ql-container.ql-snow {
        padding: 0 2% 25px;
        border: none !important;
    }

    .ql-editor {
        font-size: 18px;
        font-weight: 400;
        margin: 0 0 20px;
        font-style: normal;
        line-height: 1.58;
        letter-spacing: -.003em;
    }

    .ql-editor.ql-blank::before {
        font-size: 16px !important;
    }
</style>
@endsection

@section('content')
    <div class="article container body-white">
        <div class="row">
            <main class="col-lg-12">
                <div class="float-left action__social">
                    <div class="links fixed-link">
                        <ul class="list-unstyled">
                            <li>
                                <vote></vote>
                                {{-- @if(Auth::guest())
                                <clap article-id="{{ $article->id }}" api="article" vote-count="{{ $article->countUpVoters() }}"></clap>
                                @else
                                <clap article-id="{{ $article->id }}" api="article" vote-count="" can-vote></clap>
                                @endif --}}
                            </li>
                            <li><a href="#"><i class="fas fa-bookmark"></i></a></li>
                            <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="detail--post">
                    <div class="container center-content__800px mt-4 mb-4">
                        <div class="row">
                            <div class="ml-3 w-60 d-flex align-items-center">
                                <a href="/user/{{ $article->user->name }}">
                                    <img src="{{ $article->user->avatar }}" alt="{{ $article->user->name }}" class="avatar__60px align-middle">
                                </a>
                            </div>
                            <div class="col">
                                <div class="text-small text-small__black">
                                    <a href="/user/{{ $article->user->name }}" class="author-name">
                                        {{ $article->user->name or 'No Name' }}
                                    </a>
                                </div>
                                <div class="text-small text-light__grey truncate-line__2">
                                    Software Developer and Medium fan.
                                </div>
                                <div class="text-small text-light__grey truncate-line__1">
                                    <a href="#">
                                        {{ $article->published_at->diffForHumans() }}
                                    </a>
                                    <span class="dot">&middot;</span>
                                    <a href="#">
                                        8 min read
                                    </a>
                                    <span class="dot">&middot;</span>
                                    <a href="">
                                        <i class="far fa-eye"></i> {{ $article->getViews() }}
                                    </a>
                                    <span class="dot">&middot;</span>
                                    <a href="">
                                        <i class="far fa-comment-alt"></i> {{ $article->comments_count }}
                                    </a>
                                </div>
                                <div class="card__share">
                                    <div class="card__social">
                                        @if(Auth::check() && Auth::user()->id == $article->user_id)
                                            <a class="share-icon edit" href="{{ url("article/{$article->slug}/edit") }}"><span class="fas fa-pencil-alt"></span></a>
                                        @endif
                                        <a class="share-icon delete" href="#"><span class="fas fa-trash-alt"></span></a>
                                        <a class="share-icon report" href="#"><span class="fas fa-flag"></span></a>
                                    </div>
                                    <a id="share" class="share-toggle action-toggle share-icon" href="#"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container center-content__800px mb-4">
                        <h1>{{ $article->title }}</h1>
                        @if($article->category_id)
                            <a href="{{ url('category', ['name' => $article->category->name]) }}" class="topic--post"> {{ $article->category->name }}</a>
                        @endif
                        <div class="markdown ql-editor">
                            {!! $article->content['html'] !!}
                        </div>
                        <div class="mb__20"></div>
                        <div class="display__inline">
                            @if(count($article->tags))
                                <span>
                                    <div class="tag--v2">
                                        <ul>
                                            @foreach($article->tags as $tag)
                                                <li><a href="{{ url('tag', ['tag' => $tag->tag]) }}">{{ $tag->tag }}</a><span>20</span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </span>
                            @endif

                            @if(config('blog.social_share.article_share'))
                                <span class="float-right">
                                    <div class="social-share" data-title="{{ $article->title }}" data-description="{{ $article->title }}" {{ config('blog.social_share.sites') ? "data-sites=" . config('blog.social_share.sites') : '' }} {{ config('blog.social_share.mobile_sites') ? "data-mobile-sites=" . config('blog.social_share.mobile_sites') : '' }} initialized>
                                    </div>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="fixed-plugin">
                    <div class="dropdown show-dropdown open">
                        <a href="#" data-toggle="dropdown">
                            <i class="fa fa-cog fa-2x"> </i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header-title" style="min-height: 200px;"> Sidebar Filters</li>
                        </ul>
                    </div>
                </div>
            </main>
            <div class="related--list">
                <h4 class="h5">Bài viết  liên quan</h4>
                <ul class="flexgrid">
                    <li>
                        <figure>
                            <a class="background__cover" href="" style="background-image: url(https://cdn-images-1.medium.com/max/800/1*x-0E0Ueg1avtu8un3KyGIA.png);"></a>
                        </figure>
                        <header>
                            <a href="http://localhost:8080/category/Ms.%20Abigail%20Jacobi" class="topic--post__related"> Ms. Abigail Jacobi</a>
                            <a href="">
                                <h3>The Evolution of James Bond Cars From Dr. No to Spectre</h3>
                            </a>
                            <div class="info--post">
                               <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAP8AAAD/CAIAAACxapedAAAABnRSTlMAAAAAAABupgeRAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAC2klEQVR4nO3UQQ0CQRBFQZYgBGkjbaSNlDUAJJz68KoU/HRe+jprPyDpOT0AxqifLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXT9Zoe8Mt7r+kJH5y1pyd85WJ/8fvpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpus7a0xtght9Pl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+um59kwu/3+ks+QAAAABJRU5ErkJggg==" alt="..." class="img-fluid rounded-circle" style="height: 40px; width: 40px;">
                                <div class="info--detail">
                                   <a href="/user/trantrongbinh" class="name-author">
                                        trantrongbinh
                                    </a>
                                    <div class="info-time">
                                        <a href="#">
                                        2 days ago
                                        </a> 
                                        <span style="color: #999">·</span> 
                                        <a href="#">
                                            8 min read
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="bookmark--icon"><i class="far fa-bookmark"></i></a>
                        </header>
                    </li>
                    <li>
                        <figure>
                            <a class="background__cover" href="" style="background-image: url(http://localhost:8080/uploads/article/2019/04/08/sD1uPN3BBQPsSfrBbeQ4YcHS7mncX165uJfk4Wg0.png);"></a>
                        </figure>
                        <header>
                            <a href="http://localhost:8080/category/Ms.%20Abigail%20Jacobi" class="topic--post__related"> Giao duc</a>
                            <a href="">
                                <h3>The Evolution of James Bond Cars </h3>
                            </a>
                            <div class="info--post">
                               <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAP8AAAD/CAIAAACxapedAAAABnRSTlMAAAAAAABupgeRAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAC2klEQVR4nO3UQQ0CQRBFQZYgBGkjbaSNlDUAJJz68KoU/HRe+jprPyDpOT0AxqifLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXT9Zoe8Mt7r+kJH5y1pyd85WJ/8fvpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpus7a0xtght9Pl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+um59kwu/3+ks+QAAAABJRU5ErkJggg==" alt="..." class="img-fluid rounded-circle" style="height: 40px; width: 40px;">
                                <div class="info--detail">
                                   <a href="/user/trantrongbinh" class="name-author">
                                        trantrongbinh
                                    </a>
                                    <div class="info-time">
                                        <a href="#">
                                        2 days ago
                                        </a> 
                                        <span style="color: #999">·</span> 
                                        <a href="#">
                                            8 min read
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="bookmark--icon"><i class="far fa-bookmark"></i></a>
                        </header>
                    </li>
                    <li>
                        <figure>
                            <a class="background__cover" href="" style="background-image: url(https://1.bp.blogspot.com/-vtWhYkX68Qg/XJSiW6UaCOI/AAAAAAAADek/57w39VOVmvIs6eZE2Rr5PT-7-t5OFLyHACLcBGAs/s640/Snap%2B2019-03-22%2Bat%2B15.52.16.png);"></a>
                        </figure>
                        <header>
                            <a href="http://localhost:8080/category/Ms.%20Abigail%20Jacobi" class="topic--post__related"> Tinh yeu va tinh duc</a>
                            <a href="">
                                <h3>The Evolution of James Bond Cars From Dr. No to Spectre</h3>
                            </a>
                            <div class="info--post">
                               <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAP8AAAD/CAIAAACxapedAAAABnRSTlMAAAAAAABupgeRAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAC2klEQVR4nO3UQQ0CQRBFQZYgBGkjbaSNlDUAJJz68KoU/HRe+jprPyDpOT0AxqifLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXTpX661E+X+ulSP13qp0v9dKmfLvXT9Zoe8Mt7r+kJH5y1pyd85WJ/8fvpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpus7a0xtght9Pl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+utRPl/rpUj9d6qdL/XSpny7106V+um59kwu/3+ks+QAAAABJRU5ErkJggg==" alt="..." class="img-fluid rounded-circle" style="height: 40px; width: 40px;">
                                <div class="info--detail">
                                   <a href="/user/trantrongbinh" class="name-author">
                                        trantrongbinh
                                    </a>
                                    <div class="info-time">
                                        <a href="#">
                                        2 days ago
                                        </a> 
                                        <span style="color: #999">·</span> 
                                        <a href="#">
                                            8 min read
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="bookmark--icon"><i class="far fa-bookmark"></i></a>
                        </header>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @if(Auth::guest())
        <comment title="You must be logged to add a comment !" commentable-type="articles" commentable-id="{{ $article->id }}" comment-number="{{ $article->comments_count }}" null-text=""></comment>
    @else
        <comment title="Bình luận" username="{{ Auth::user()->name }}" user-avatar="{{ Auth::user()->avatar }}" commentable-type="articles" commentable-id="{{ $article->id }}" comment-number="{{ $article->comments_count }}" null-text="" can-comment></comment>
    @endif
@endsection

@section('scripts')
@endsection