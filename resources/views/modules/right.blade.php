<div id="right" class="is-bottomPosition">
    <div class="right" style="min-width: 195px !important;">
        <!-- Widget [Authors Widget]-->
        <div class="widget author">
            <header>
                <h3 class="h6">Top Authors</h3>
                <span class="top-v1 badge-info navbar-badge" style="z-index: 100;"><a href="/user/all-auther">All</a></span>
            </header>
            <div class="blog-posts">
                @foreach($users as $user)
                    <figure class="profile--author profile--author__left">
                        <a href="/user/{{ $user->name }}" class="profile--ava">
                            <div class="item d-flex">
                                 <div class="image__author">
                                    <div class="circle__image--1"></div>
                                    <div class="circle__image--2"></div>
                                    <img src="{{ $user->avatar }}" width="70" height="70" alt="{{ $user->name }}">
                                </div>
                                <div class="title">
                                    <strong>{{ str_limit($user->name, config('blog.str_limit.name')) }}</strong>
                                    <div class="d-flex">
                                        <div class="views last--icon"><i class="fas fa-pencil-alt"></i> {{ $user->articles_count }} bài viết</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <figcaption class="profile--info hidden">
                            <div class="author-profile--popup">
                                <div class="profile--info__left">
                                    <img class="avatar" src="{{ $user->avatar }}" alt="Ash" />
                                    <a title="Theo dõi Huskywannafly" class="btn btn-outline-info btn-sm btn--follow" >Theo dõi</a>
                                </div>
                                <div class="profile--info__right">
                                    <div class="username"><a href="/user/{{ $user->name }}">{{ $user->name }}</a></div>
                                    <div class="bio">{{ $user->website }}</div>
                                    <div class="description">
                                        {{ $user->description }}
                                    </div>
                                </div>
                                <ul class="data">
                                    <li>
                                        <span>127</span><p>Posts</p>
                                    </li>
                                    <li>
                                        <span> 2</span><p>Followers</p>
                                    </li>
                                    <li>
                                        <span> 311</span><p>Following</p>
                                    </li>
                                </ul>
                            </div>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
        <!-- Widget [Teams Widget] -->
        <div class="widget teams">
            <header>
                <h3 class="h6">Top Teams</h3>
                <span class="top-v1 badge-info navbar-badge" style="z-index: 100;"><a href="/all-team">All</a></span>
            </header>
            <div class="blog-posts">
                @foreach ($teams['otherTeam'] as $team)
                    <figure class="profile--author profile--author__left">
                        <a href="{{ url('team') }}" class="profile--ava">
                            <div class="item d-flex">
                                <div class="image">
                                    @if ($team->avatar)
                                        <img class="img-fluid" src="{{ $team->avatar }}" alt="Team avatar">
                                    @else
                                        <img class="img-fluid" src="{{ asset('/images/team-default.png') }}" alt="Team avatar">
                                    @endif
                                </div>
                                <div class="title">
                                    <strong>{{ str_limit($team->name, config('blog.str_limit.name')) }}</strong>
                                    <div class="d-flex">
                                        <div class="views"><i class="fas fa-user-friends"></i> {{ $team->users_count }}</div>
                                        <span class="dot">&middot;</span>
                                        <div class="comments last--icon"><i class="fas fa-pencil-alt"></i> {{ $team->getTotalArticles($team->id) }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <figcaption class="profile--info hidden">
                            <div class="author-profile--popup">
                                <div class="profile--info__left">
                                    <img class="avatar avatar--team" src="{{ $team->avatar }}" alt="Ash" />
                                    <a title="Theo dõi Huskywannafly" class="btn btn-outline-info btn-sm btn--follow" >Theo dõi</a>
                                </div>
                                <div class="profile--info__right">
                                    <div class="username"><a href="">{{ $team->name }}</a></div>
                                    <div class="bio">{{ $team->path }}</div>
                                    <div class="description">
                                        {{ $team->description }}
                                    </div>
                                </div>
                                <ul class="data">
                                    <li>
                                        <span>127</span><p>Posts</p>
                                    </li>
                                    <li>
                                        <span> 2</span><p>Followers</p>
                                    </li>
                                    <li>
                                        <span> 311</span><p>Following</p>
                                    </li>
                                </ul>
                            </div>
                        </figcaption>
                    </figure>
                @endforeach
                @if (!Auth::guest())
                    @if(!$teams['yourTeam']->isEmpty())
                        <hr>
                        <div class="nav-team">
                            <span class="top-v1 badge-danger navbar-badge"><a href="#">Your Team</a></span>
                        </div>
                        @foreach ($teams['yourTeam'] as $team)
                            <a href="/team/{{ $team->slug }}">
                                <div class="item d-flex">
                                    <div class="image">
                                        @if ($team->avatar)
                                            <img class="img-fluid img-sm" src="{{ asset($team->avatar) }}" alt="Your team avatar">
                                        @else
                                            <img class="img-fluid img-sm" src="{{ asset('/images/team-default.png') }}" alt="Your team avatar">
                                        @endif
                                    </div>
                                    <div class="title"><strong>{{ str_limit($team->name, config('blog.str_limit.name')) }}</strong>
                                        <div class="d-flex">
                                            <div class="views" data-toggle="tooltip" data-placement="bottom" title="Members"><i class="fas fa-user-friends"></i> {{ $team->users_count }}</div>
                                            <span class="dot">&middot;</span>
                                            <div class="comments" data-toggle="tooltip" data-placement="bottom" title="Posts"><i class="fas fa-pencil-alt"></i> {{ $team->articles_count }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                    <div class="border-top text-center">
                        <a href="javascript:;" class="text-info button-toggle-team create-button"><strong><i class="fas fa-users-cog"></i> Create Team</strong></a>
                        <div class="optional-team  {{ $errors->isEmpty() ? 'hide' : ''}}">
                            <form action="{{ url('team') }}" method="POST">
                                @csrf
                                <textarea class="textarea form-control box__input textarea--autoHeight" placeholder="Your Team" rows="1" name="name"></textarea>
                                <div class="mb__10"></div>
                                <button type="submit" class="btn btn-outline-info btn-sm full-width"><i class="fas fa-check text-dark"></i></button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="border-top text-center">
                        <a href="{{ url('login') }}" class="text-info create-button"><strong><i class="fas fa-users-cog"></i> Create Team</strong></a>
                    </div>
                @endif
            </div>
        </div>
        <!-- Link -->
        <div class="widget links">
            <header>
                <h3 class="h6">Links</h3>
            </header>
            <ul class="list-unstyled">
                @if(config('blog.footer.facebook.open'))
                    <li><a href="{{ config('blog.footer.facebook.url') }}" target="_blank"><i class="fab fa-facebook-square"></i> Facebook</a></li>
                @endif
                <li><a href="#" target="_blank"><i class="fab fa-twitter"></i> Twitter</a></li>
                @if(config('blog.footer.github.open'))
                    <li><a href="{{ config('blog.footer.github.url') }}" target="_blank"><i class="fab fa-github"></i> Github</a></li>
                @endif
                <li><a href="#" target="_blank"><i class="fab fa-stack-overflow"></i> Stack Overflow</a></li>
            </ul>
        </div>
    </div>
</div>