@php
    $category = App\Models\Category::latest()->limit(6)->get();
@endphp
<section class="category-area pb-90px">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9">
                <div class="category-content-wrap">
                    <div class="section-heading">
                        <h5 class="mb-2 ribbon ribbon-lg">Categories</h5>
                        <h2 class="section__title">Popular Categories</h2>
                        <span class="section-divider"></span>
                    </div><!-- end section-heading -->
                </div>
            </div><!-- end col-lg-9 -->
            <div class="col-lg-3">
                <div class="text-right category-btn-box">
                    <a href="categories.html" class="btn theme-btn">All Categories <i class="ml-1 la la-arrow-right icon"></i></a>
                </div><!-- end category-btn-box-->
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
        <div class="category-wrapper mt-30px">
            <div class="row">
                @foreach ($category as $item )

                @php
                    $course = App\Models\Course::where('category_id',$item->id)->get();
                @endphp
                    <div class="col-lg-4 responsive-column-half">
                        <div class="category-item">
                            <img  class="cat__img lazy" src="{{asset($item->image)}}" data-src="{{asset($item->image)}}" alt="Category image">
                            <div class="category-content">
                                <div class="category-inner">
                                    <h3 class="cat__title"><a href="{{url('category/'. $item->id.'/'. $item->category_slug)}}">{{$item->category_name}}</a></h3>
                                    <p class="cat__meta">{{count($course)}} courses</p>
                                    <a href="{{url('category/'. $item->id.'/'. $item->category_slug)}}" class="btn theme-btn theme-btn-sm theme-btn-white">Explore<i class="ml-1 la la-arrow-right icon"></i></a>
                                </div>
                            </div><!-- end category-content -->
                        </div><!-- end category-item -->
                    </div><!-- end col-lg-4 -->
                @endforeach


            </div><!-- end row -->
        </div><!-- end category-wrapper -->
    </div><!-- end container -->
</section><!-- end category-area -->
