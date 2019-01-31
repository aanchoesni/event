<li><a href="{{ URL::to('home') }}">Dashboard</a></li>
@if (Session::get('ss_status_biodata') != false)
<li><a href="{{ url('biodata/show') }}">Biodata</a></li>
@endif
<li><a href="{!! url('school/history') !!}">History</a></li>
