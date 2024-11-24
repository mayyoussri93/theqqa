@extends('frontend.layouts.app')
<style>
    .navbar-toggler span{
        background: #fff!important
    }
    .navbar-signin-btn a{
        color: #fff!important;
        display: flex;
        align-items: center;
        justify-content: end;
        height: 100%;
    }
    .logo{
        -webkit-filter: brightness(0) invert(1);
        filter: brightness(0) invert(1);
    }
    .header{
        position: absolute;
        width: 100%;
        z-index: 100;
    }
    .nav-link{
        color: #fff!important;
    }
    .header-navigation{
        border-color: transparent!important
    }
    .signin .dropdown-btn i{
        color:#fff
    }
    @media (max-width : 768px){

        .nav-link{
            color: #0A0F33!important;
        }

    }
</style>
@section('content')

    <!-- START PAGE HEADER SECTION -->
    <section class="header-page header-page-bg-img ">
        <div class="container">
            <div class="wrapper-header-page mx-auto">
                <div>
                    <img src="{{ uploaded_asset(get_setting('client_home_banner')) }}"  alt="{{request()->path()}}" >
                </div>
                @if(!empty($tag_search) )
                    <h2>{{'#'.' '.$tag_search  }} </h2>
                @elseif( !empty($cat_id_search))
                    <h2>{{ '#'.' '.\App\Models\BlogCategory::find($cat_id_search)->category_name }} </h2>

                @elseif(!empty($tag_search) or !empty($cat_id_search))
                    <h2>{{'#'.' '.$tag_search .' - '. '#'.' '.\App\Models\BlogCategory::find($cat_id_search)->category_name }} </h2>


                @else
                    <h2>{{translate(get_setting('client_home_title'))}}  </h2>

                @endif

            </div>
        </div>
    </section>

    <!-- END PAGE HEADER SECTION -->

    <section class="wrapper-blog-pages mt-4 mb-4">
        <div class="container">
            <div class="flex-2between wrap-filter-nav">
                <div>
                    <button class="btn" data-toggle="modal" data-target="#tagsModal">{{translate('فئات اخري')}}</button>
                    <button class="btn" data-toggle="modal" data-target="#wordsModal">{{translate('كلمات بحث اخري')}}</button>
                </div>

                <div class="dropdown dropdown-btn">
                    <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown">
                        {{translate('المضاف حديثا')}}
                    </button>
                    <div class="dropdown-menu dropdown-list">
                        <a class="dropdown-item" href="{{route('search.tag',['check'=>1])}}"> {{translate('المضاف حديثا')}}</a>
                        <a class="dropdown-item" href="{{route('search.tag',['check'=>2])}}"> {{translate('الأكثر مناقشة')}}</a>
                        <a class="dropdown-item" href="{{route('search.tag',['check'=>3])}}">{{translate('الأكثر مشاهدة')}}</a>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($blogs as $key=>$val)
                    <div class="col-lg-3">
                        <div class="wrapper-posts bg-transparent">
                            <a href="{{route('article.details',$val->id)}}" class="card" style="">
                                <div class="side-div"><object data="" type=""><a href="#" class="pink-tag"> {{translate($val->category->category_name)}}</a></object></div>
                                <img class="card-img-top mt-0"  height="250px" src="{{uploaded_asset($val->banner)}}"  alt="{{request()->path()}}">
                                <div class="card-body post-info">
                                    <small>                                         {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$val->created_at)->format('F d,Y')}}
                                    </small>
                                    <h5 class="card-title">{{translate($val->title)}}</h5>
                                    <div class="right-icon">



                                        <div class="icon-num">
                                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24"><path fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11.995 7.23319C10.5455 5.60999 8.12832 5.17335 6.31215 6.65972C4.49599 8.14609 4.2403 10.6312 5.66654 12.3892L11.995 18.25L18.3235 12.3892C19.7498 10.6312 19.5253 8.13046 17.6779 6.65972C15.8305 5.18899 13.4446 5.60999 11.995 7.23319Z" clip-rule="evenodd"></path></svg>
                                            <span>{{$val->count_views}}</span>
                                        </div>
                                        <object data="" type="">
                                            <a href="#" class="icon-num">
                                                <svg width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.75 6.75C4.75 5.64543 5.64543 4.75 6.75 4.75H17.25C18.3546 4.75 19.25 5.64543 19.25 6.75V14.25C19.25 15.3546 18.3546 16.25 17.25 16.25H14.625L12 19.25L9.375 16.25H6.75C5.64543 16.25 4.75 15.3546 4.75 14.25V6.75Z"></path><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M9.5 11C9.5 11.2761 9.27614 11.5 9 11.5C8.72386 11.5 8.5 11.2761 8.5 11C8.5 10.7239 8.72386 10.5 9 10.5C9.27614 10.5 9.5 10.7239 9.5 11Z"></path><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M12.5 11C12.5 11.2761 12.2761 11.5 12 11.5C11.7239 11.5 11.5 11.2761 11.5 11C11.5 10.7239 11.7239 10.5 12 10.5C12.2761 10.5 12.5 10.7239 12.5 11Z"></path><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M15.5 11C15.5 11.2761 15.2761 11.5 15 11.5C14.7239 11.5 14.5 11.2761 14.5 11C14.5 10.7239 14.7239 10.5 15 10.5C15.2761 10.5 15.5 10.7239 15.5 11Z"></path></svg>
                                                <span>{{\App\Models\Comment::where('blog_id',$val->id)->count()}}</span>
                                            </a>
                                        </object>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="tagsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{translate('اكتشف فئات اخري')}}</h5>

                </div>
                <div class="modal-body">
                    <div class="flex-inline">
                        <ul>
                            @foreach(\App\Models\BlogCategory::get() as $key=>$val)
                                <li>
                                    <a href="{{route('search.tag',['cat_id'=>$val->id])}}" @if($val->id==$cat_id_search) style="background:#f1d7BE4D" @endif>
                                        <img src="{{uploaded_asset($val->banner)}}"  alt="{{request()->path()}}" >
                                        <div class="service-list-info"><h4>{{translate($val->category_name)}}</h4>
                                            <span>{{$val->posts->count().' '.translate('منشورات')}}</span></div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="wordsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{translate('اكتشف  كلمات اخري للبحث')}} </h5>

                </div>
                <div class="modal-body">
                    <div class="all-tags">

                        @php
                            $merged_collection =  \App\Models\Blog::get()->pluck('tags')->toArray();
                            $array_of_collections='';
                            foreach($merged_collection as $collection) {
                          $array_of_collections=     $array_of_collections.$collection;
                            }
                            $array_tags=array_unique(explode(',',$array_of_collections));
                        @endphp
                        <div class="all-tags">
                            @foreach($array_tags as $key=>$val)
                                <a href="{{route('search.tag',['tag'=>$val])}}" @if($val==$tag_search) style="background:#f1d7BE4D" @endif class="single-tag border">
                                    {{$val}}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
