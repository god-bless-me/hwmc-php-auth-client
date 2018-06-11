@extends('layout/ace')

@section('title')
    App列表
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="#">主页</a>
        </li>
        <li>
            <a href="#">Role管理</a>
        </li>
        <li class="active">Role列表</li>
    </ul>
@endsection

@section('content')

    <div class="page-header">
        <h1>
            角色
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                角色列表
            </small>
        </h1>
    </div>

    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-12" style="overflow-x: scroll">
                <table id="simple-table" class="table  table-bordered table-hover">
                    <thead>
                    <tr>
                        {{--<th class="center">--}}
                        {{--<label class="pos-rel">--}}
                        {{--<input type="checkbox" class="ace">--}}
                        {{--<span class="lbl"></span>--}}
                        {{--</label>--}}
                        {{--</th>--}}
                        <th>ID</th>
                        <th>姓名</th>
                        <th>头像</th>
                        <th>手机</th>
                        <th class="hidden-480">邮箱</th>
                        <th>性别</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $item)
                        <tr>
                            {{--<td class="center">--}}
                            {{--<label class="pos-rel">--}}
                            {{--<input type="checkbox" class="ace">--}}
                            {{--<span class="lbl"></span>--}}
                            {{--</label>--}}
                            {{--</td>--}}
                            <td class="center">
                                {{$item->id}}
                            </td>
                            <td>
                                {{$item->name}}
                            </td>
                            <td>
                                <img width="40" src="{{$item->avatar}}">
                            </td>
                            <td>{{$item->mobile}}</td>
                            <td class="hidden-480">
                                {{$item->email}}
                            </td>
                            <td>
                                {{$genders[$item->gender]}}
                            </td>
                            <td>
                                <a href="/roles/users?role_id={{$item->id}}">管理用户</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination">{{ $users->links() }}</div>
            </div><!-- /.span -->
        </div><!-- /.row -->
    </div>


@endsection

@section('footer')
@endsection
