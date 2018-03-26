<!-- Second navbar -->
<div class="navbar navbar-default" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i
                        class="icon-menu7"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav navbar-nav-material">
            <li><a href="{{ route('Staff::dashboard') }}"><i class="icon-display4 position-left"></i> Dashboard</a></li>

            <li>
                <a href="{{ route('Staff::Management::collaborator@index') }}" class="dropdown-toggle"><i
                            class="icon-user position-left"></i> Cộng tác viên</a>
            </li>
            <li class="dropdown">
                <a href="{{ route('Staff::Management::user@index') }}" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="glyphicon glyphicon-user position-left"></i> Thành viên <span
                            class="caret"></span></a>

                <ul class="dropdown-menu">

                    <li>
                        <a href="{{ route('Staff::Management::user@index') }}" class="dropdown-toggle"><i
                                    class="glyphicon glyphicon-user position-left"></i> Thành viên</a>
                    </li>

                    <li>
                        <a href="{{ route('Staff::Management::role@index') }}" class="dropdown-toggle"><i
                                    class="icon-user position-left"></i> Group</a>
                    </li>

                    <li>
                        <a href="{{ route('Staff::Management::permission@index') }}" class="dropdown-toggle"><i
                                    class="icon-user position-left"></i> Permission</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /second navbar -->
