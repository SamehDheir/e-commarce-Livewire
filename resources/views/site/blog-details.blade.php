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
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="">
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
                        {{-- <div class="blog__details__btns">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__btn__item">
                                        <h6><a href="#"><i class="fa fa-angle-left"></i> Previous posts</a></h6>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__btn__item blog__details__btn__item--next">
                                        <h6><a href="#">Next posts <i class="fa fa-angle-right"></i></a></h6>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="blog__details__comment">
                            <h5>{{ $count_blog_comment }} Comment</h5>
                            <a href="#" class="leave-btn">Leave a comment</a>
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
                                <h4>Feature posts</h4>
                            </div>
                            <a href="#" class="blog__feature__item">
                                <div class="blog__feature__item__pic">
                                    <img src="{{ asset('site/img/blog/sidebar/fp-1.jpg') }}" alt="">
                                </div>
                                <div class="blog__feature__item__text">
                                    <h6>Amf Cannes Red Carpet Celebrities Kend...</h6>
                                    <span>Seb 17, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__feature__item">
                                <div class="blog__feature__item__pic">
                                    <img src="{{ asset('site/img/blog/sidebar/fp-2.jpg') }}" alt="">
                                </div>
                                <div class="blog__feature__item__text">
                                    <h6>Amf Cannes Red Carpet Celebrities Kend...</h6>
                                    <span>Seb 17, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__feature__item">
                                <div class="blog__feature__item__pic">
                                    <img src="{{ asset('site/img/blog/sidebar/fp-3.jpg') }}" alt="">
                                </div>
                                <div class="blog__feature__item__text">
                                    <h6>Amf Cannes Red Carpet Celebrities Kend...</h6>
                                    <span>Seb 17, 2019</span>
                                </div>
                            </a>
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
