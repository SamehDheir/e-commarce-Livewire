@extends('site.layouts')

@section('titlePage')
    Blog
@endsection


@section('content')
    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">

                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg" data-setbg="{{ asset('storage/' . $blog->image) }}"></div>
                            <div class="blog__item__text">
                                <h6>
                                    <form action="{{ route('site.blog.details', $blog->id) }}" method="get">
                                        @csrf
                                        <button type="submit"
                                            style="background-color: transparent; border: 0">{{ $blog->title }}</button>
                                    </form>
                                </h6>
                                <ul>
                                    <li>by <span>{{ $blog->auther }}</span></li>
                                    <li>{{ $blog->created_at }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $blogs->links('pagination::bootstrap-4') }}
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
