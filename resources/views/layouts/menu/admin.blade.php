<li>
    <a href="{{ URL::to('home') }}">
        <i class="fa fa-home"></i>
        <span>Dashboard</span>
    </a>
</li>
@if (Session::get('ss_status_biodata') != false)
    <li><a href="{{ url('biodata/show') }}"><i class="fa fa-user"></i><span>Biodata</span></a></li>
    @if (Auth::user()->role == 'admin')
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-lock"></i>
                <span>Master</span>
            </a>
            <ul class="sub">
                <li><a href="{{ url('admin/events') }}"><i class="fa fa-bicycle"></i>Master Event</i></a></li>
                <li><a href="{{ url('admin/type') }}"><i class="fa fa-trophy"></i>Master Tipe Peserta</i></a></li>
                <li><a href="{{ url('admin/categories') }}"><i class="fa fa-trophy"></i>Master Kategori Kegiatan</i></a></li>
                <li><a href="{{ url('admin/units') }}"><i class="fa fa-trophy"></i>Master Unit</i></a></li>
            </ul>
        </li>
        <li><a href="{{ URL::to('admin/users') }}"><i class="fa fa-users"></i><span>User</span></a></li>
    @endif
    @if (Auth::user()->role == 'adminevent')
        <li><a href="{{ url('admin/events') }}"><i class="fa fa-bicycle"></i>Master Event</i></a></li>
    @endif
@endif

