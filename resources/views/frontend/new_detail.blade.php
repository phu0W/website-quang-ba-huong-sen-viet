@extends('frontend.master')
@section('frt')
<section class="mymaincontent">
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-lg-9 bg-light">
                <h1>{!!$post->title!!}</h1>
                {!!$post->content!!}
            </div>
            <div class="col-lg-3">
                <h2>Tin liên quan</h2>
                <div class="row list3">
                    @foreach ($list as $item)
                    <div class="col-lg-12">
                        <div class="card">
                            <img src="{{asset($item->image)}}" alt="" class="img-fluid">
                            <div class="card-body">
                                <div class="card-text ms-0">
                                    <a href="{{route('new.detail', $item->id)}}"><h5>{!!strip_tags(($item->title))!!}</h5></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection