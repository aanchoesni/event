@extends('layouts.front.master')

@section('title')
    Event Details
@endsection

@section('content')
<!--blog start-->
<div class="col-lg-9 ">
    <div class="blog-item">
        <div class="row">
            <div class="col-lg-2 col-sm-2 text-right">
                <div class="date-wrap">
                    <span class="date">{!! InseoHelper::tglpost($event->date) !!}</span>
                    <span class="month">{!! InseoHelper::blnpost($event->date) !!}</span>
                </div>
                <div class="author">
                    By <a href="#">{!! $event->rUnit->shortname !!}</a>
                </div>
                <ul class="list-unstyled">
                    <li><a href="javascript:;"><em>Dosen</em></a></li>
                    <li><a href="javascript:;"><em>Mahasiswa</em></a></li>
                </ul>
                <div class="shate-view">
                    <ul class="list-unstyled">
                        <li>
                            @if ($event->quota == 0 || $event->quota == null)
                            Unlimited
                            @else
                            {!! $event->quota !!} Kuota
                            @endif
                        </li>
                        <li><a href="javascript:;">23 Peserta</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10 col-sm-10">
                <h1><a href="{!! url('eventdetail/'.$event->id) !!}">{!! $event->title !!}</a></h1>
                @if ($event->pamphlet)
                <img src="../img/{!! $event->pamphlet !!}" alt="" style="width: 100%;">
                @endif
                <p>{!! $event->theme !!}</p>
                <p>{!! $event->description !!}</p>
                @guest
                @else
                    @if ($event->rParticipant)
                        <a class="btn btn-success" disabled>Anda Sudah Terdaftar</a>
                    @else
                    <form action="{!! route('regevent', ['data' => $event->id]) !!}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Register</button>
                    </form>
                    @endif
                @endguest
            </div>
        </div>
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
