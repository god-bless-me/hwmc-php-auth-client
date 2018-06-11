<div id="sidebar" class="sidebar responsive ace-save-state">
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {
        }
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <a class="btn btn-success" href="https://work.weixin.qq.com/" target="_blank">
                <i class="ace-icon fa fa-weixin"></i>
            </a>

            <a class="btn btn-info" href="https://mail.haowumc.com/" target="_blank">
                <i class="ace-icon fa fa-inbox"></i>
            </a>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li class="">
            <a href="/">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> 权限信息 </span>
            </a>

            <b class="arrow"></b>
        </li>
        @if( in_array('admin',$roles) )
            <li class="">
                <a href="/users">
                    <i class="menu-icon fa fa-user"></i>
                    <span class="menu-text"> 用户管理 </span>
                </a>

                <b class="arrow"></b>
            </li>
        @endif
        @if( in_array('admin',$roles) )
            <li class="open">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-connectdevelop"></i>
                    <span class="menu-text"> App管理 </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="">
                        <a href="/apps">
                            <i class="menu-icon fa fa-caret-right"></i>
                            App列表
                        </a>

                        <a href="/roles">
                            <i class="menu-icon fa fa-caret-right"></i>
                            角色列表
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
        @endif
    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
           data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>