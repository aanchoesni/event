<li><a href="{{ URL::to('/') }}">Front</a></li>
<li><a href="{{ URL::to('home') }}">Dashboard</a></li>
@if (Session::get('ss_status_biodata') != false)
<li><a href="{{ url('biodata/show') }}">Biodata</a></li>
@endif
@if (Auth::user()->role != 'umum')
<li><a href="{!! url('admin/events') !!}">Manage Event</a></li>
@endif
<li><a href="{!! url('school/history') !!}">My Event</a></li>
