<section id="blog" class="section-padding bg-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 m-auto">
                <div class="section-heading">
                    <h4 class="section-title">Blog</h4>
                    <div class="line"></div>
                    <p>Conoce nuestras últimas noticias, características y funcionalidades</p>
                </div>
            </div>
        </div>
        @foreach($posts as $post)
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-md-4">
                    <div class="blog-block ">
                        
                        <img src="{{ asset($post->featured_image) }}" alt="" class="img-fluid">
                        <div class="blog-text">
                            <h6 class="author-name">
                                <span>
                                    @foreach($post->tags as $tag)
                                        {{ $tag->name}}
                                    @endforeach
                                </span>
                                Suricata
                            </h6>
                            <a href="{{ route('frontend.blog', $post->slug) }}" class="h5 my-2 d-inline-block">
                                {!! $post->title !!}
                            </a>
                            <p>{!! Str::limit($post->body, 200) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>