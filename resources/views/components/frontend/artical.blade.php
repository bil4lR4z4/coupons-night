@foreach ($posts as $post)
<style>
.article-image{
    display:block;
    height:100%;
    min-height:250px;
    overflow:hidden;
}

.article-image img{
    width:100%;
    height:100%;
    /* object-fit:cover; */
    display:block;
}
@media (max-width:767px){

    .article-image{
        height:220px;
        min-height:220px;
    }
}
</style>
<div>
    <div class="card rounded-4 overflow-hidden border-0 shadow-sm h-100">
        <div class="row h-100 g-0">
            <div class="col-md-6 article-image">
                <a href="{{ route('blog.detail', $post->slug ?? '') }}" class="" >
                    <img src="{{ asset($post->image ?? '') }}" class="img-fluid rounded-start h-100" alt="...">
                </a>
            </div>
            <div class="col-md-6">
                <div class="card-body pb-2">
                   <a href="{{ route('coupon_category.page', $post->categories->first()->slug ?? '') }}"> <h5 class="smaller fw-semibold text-uppercase  badge">{{ $post->categories->first()->name ?? '' }}</h5></a>
                    <h4 class="fw-bold text-truncate-2">{{$post->title ?? ''}}</h4>
                    <p class="small text-danger-emphasis text-truncate-2">{{$post->short_description ?? ''}}</p>
                    <p class="card-text "><small class="text-body-secondary">Last updated {{ $post->created_at->diffForHumans() }}</small></p>
                    <a href="{{ route('blog.detail', $post->slug ?? '') }}" class="text-decoration-none link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<style>
    .text-truncate-2{
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>