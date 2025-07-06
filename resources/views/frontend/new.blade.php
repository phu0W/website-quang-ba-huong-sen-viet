@extends('frontend.master')
@section('frt')
<section class="mymaincontent">
    <div class="container mt-4">
        <div class="text-center">
            <h1>Danh sách tin tức</h1>
        </div>
        <hr />
        <div class="row mb-5 list1">
            <div class="col-lg-6 col-sm-12">
                <div class="card border-0">
                    <img src="{{asset($post1->image)}}" alt="" class="img-fluid" />
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('new.detail', $post1->id) }}"><h4>{!!strip_tags($post1->title)!!}</h4></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 pic1">
                <div class="row">
                    @foreach ($post2 as $item)
                    <div class="col-lg-6 col-sm-6">
                        <div class="card border-0">
                            <img src="{{asset($item->image)}}" alt="" class="img-fluid" />
                            <div class="card-title mt-2">
                                <h5>{!!strip_tags($item->title)!!}</h5>
                            </div>
                            <div class="card-text">
                                <a href="{{route('new.detail', $item->id)}}">
                                    {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($item->content)), 110) }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row list2">
            @foreach ($post as $item)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card mb-5 shadow-sm">
                    <img src="{{asset($item->image)}}" alt="" class="img-fluid" />
                    <div class="card-body">
                        <div class="card-title">
                            <h5>{!!strip_tags($item->title)!!}</h5>
                        </div>
                        <div class="card-text">
                            {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($item->content)), 110) }}
                        </div>
                        <a href="{{route('new.detail', $item->id)}}" class="btn btn-outline-success rounded-0 float-end">Đọc thêm</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection