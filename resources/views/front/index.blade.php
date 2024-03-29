@extends('layouts.front.master')

@section('title')
    Lists Event
@endsection

@section('content')
<!--blog start-->
<div class="col-lg-9 ">
    @foreach ($events as $value)
    <div class="blog-item">
        <div class="row">
            <div class="col-lg-2 col-sm-2 text-right">
                <div class="date-wrap">
                    <span class="date">{!! InseoHelper::tglpost($value->date) !!}</span>
                    <span class="month">{!! InseoHelper::blnpost($value->date) !!}</span>
                </div>
                <div class="author">
                    By <a href="#">{!! $value->rUnit->shortname !!}</a>
                </div>
                <ul class="list-unstyled">
                    @foreach ($value->rType as $val)
                    <li><a href="#"><em>{{$val->name}}</em></a></li>
                    @endforeach
                </ul>
                <div class="shate-view">
                    <ul class="list-unstyled">
                        <li>
                            @if ($value->quota == 0 || $value->quota == null)
                            Unlimited
                            @else
                            {!! $value->quota !!} Quota
                            @endif
                        </li>
                        <li>{{ $value->rEventParticipant->count() }} Registered</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10 col-sm-10">
                <h1><a href="{!! url('eventdetail/'.$value->code) !!}">{!! $value->title !!}</a></h1>
                <p>Theme : {!! $value->theme !!}</p>
                <p>{!! strip_tags(substr(html_entity_decode($value->description,ENT_COMPAT,"UTF-8"),0 , 250)) !!}</p>
                @if ($value->pamphlet)
                <img src="img/{!! $value->pamphlet !!}" alt="" style="width: 100%; height: auto;">
                @endif
                <a href="{!! url('eventdetail/'.$value->code) !!}" class="btn btn-danger">Continue Reading</a>
            </div>
        </div>
    </div>
    @endforeach

    <div class="text-center">
        <ul class="pagination">
            {!! $events->render() !!}
        </ul>
    </div>

</div>

<div class="col-lg-3">
    <div class="blog-side-item">
        <div class="search-row">
            <input type="text" class="form-control" placeholder="Search here">
        </div>
        <div class="category">
            <h3>Categories</h3>
            <ul class="list-unstyled">
                @foreach ($categories as $val)
                <li><a href="{!! url('category/'.$val->id) !!}"><i class="  fa fa-angle-right"></i> {!! $val->name !!}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!--blog end-->
@endsection
