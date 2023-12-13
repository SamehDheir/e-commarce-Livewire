@extends('site.layouts')

@section('titlePage')
    Blog Details
@endsection


@section('content')
    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="blog__details__content">
                        <div class="blog__details__item">
                            <img width="100%" height="400px" src="{{ asset('storage/' . $blog->image) }}" alt="">
                            <div class="blog__details__item__title">
                                <span class="tip">Street style</span>
                                <h4>{{ $blog->title }}</h4>
                                <ul>
                                    <li>by <span>{{ $blog->auther }}</span></li>
                                    <li>{{ $blog->created_at }}</li>
                                    <li>39 Comments</li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog__details__desc">

                            <p>{{ $blog->description }}</p>
                        </div>
                        <div class="blog__details__tags">
                            <a href="#">Fashion</a>
                            <a href="#">Street style</a>
                            <a href="#">Diversity</a>
                            <a href="#">Beauty</a>
                        </div>
                        <div class="blog__details__comment">
                            <h5>{{ $count_blog_comment }} Comment</h5>
                            <p class="text-danger" style="font-weight: 500">
                                @if ($count_blog_comment == 0)
                                    No Comment Yet 🙈
                                @endif
                            </p>

                            <form action="{{ route('site.comment.add', $blog->id) }}" method="post">
                                @csrf
                                <input type="text" name="comment" placeholder="text">
                                <button type="submit" class="site-btn">Subscribe</button>
                            </form>
                            {{-- <a href="#" class="leave-btn">Leave a comment</a> --}}
                            @foreach ($blogs_comment as $blog_comment)
                                <div class="blog__comment__item">
                                    <div class="blog__comment__item__pic">
                                        <img src="{{ asset('admin/assets/images/faces-clipart/pic-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="blog__comment__item__text">
                                        <h6>{{ $blog_comment->name }}</h6>
                                        <p>{{ $blog_comment->comment }}</p>
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i> {{ $blog_comment->created_at }}</li>
                                            <li><i class="fa fa-heart-o"></i> 12</li>
                                            <li><i class="fa fa-share"></i> 1</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                            {{ $blogs_comment->links('pagination::bootstrap-4')}}

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <ul>
                                <li><a href="#">All <span>(250)</span></a></li>
                                <li><a href="#">Fashion week <span>(80)</span></a></li>
                                <li><a href="#">Street style <span>(75)</span></a></li>
                                <li><a href="#">Lifestyle <span>(35)</span></a></li>
                                <li><a href="#">Beauty <span>(60)</span></a></li>
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Latest posts</h4>
                            </div>
                            @foreach ($blogs as $blog)
                                <a href="#" class="blog__feature__item">
                                    <div class="blog__feature__item__pic">
                                        <img width="100px" height="100%" src="{{ asset('storage/' . $blog->image) }}"
                                            alt="">
                                    </div>
                                    <div class="blog__feature__item__text">
                                        <h6>{{ $blog->title }}...</h6>
                                        <span>{{ $blog->created_at }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Tags cloud</h4>
                            </div>
                            <div class="blog__sidebar__tags">
                                <a href="#">Fashion</a>
                                <a href="#">Street style</a>
                                <a href="#">Diversity</a>
                                <a href="#">Beauty</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
@endsection
