
<li class="nav-header">Assignment section</li>

</li>

<li class="nav-item @if($commons['main_menu'] == 'activity') menu-open @endif">
    <a
        href="{{route('student.index')}}"
        class="nav-link @if($commons['current_menu'] == 'activity_index') active @endif"
    >
        <i class="nav-icon fas fa-list"></i>
        <p>My Assignment</p>
    </a>
</li>
