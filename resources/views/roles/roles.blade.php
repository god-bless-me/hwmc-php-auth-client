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

                <form class="form-inline">
                    <select class="input-small" name="app_id">
                        <option value="">所有</option>
                        @foreach($apps as $app)
                            <option value="{{$app->id}}" @if($appId==$app->id) selected @endif >{{$app->name}}</option>
                        @endforeach
                    </select>
                    {{--<input type="password" class="input-small" placeholder="Password"/>--}}
                    {{--<label class="inline">--}}
                    {{--<input type="checkbox" class="ace"/>--}}
                    {{--<span class="lbl"> remember me</span>--}}
                    {{--</label>--}}

                    <button type="submit" class="btn btn-info btn-sm">
                        <i class="ace-icon fa fa-key bigger-110"></i>筛选
                    </button>
                </form>

                <hr>

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
                        <th>应用名称</th>
                        <th>Key</th>
                        <th>名称</th>
                        <th class="hidden-480">简介</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($list as $item)
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
                                {{$item->app->name}}
                            </td>
                            <td>{{$item->key}}</td>
                            <td>
                                {{$item->name}}
                            </td>
                            <td class="hidden-480">
                                {{$item->desc}}
                            </td>
                            <td>
                                <a href="/roles/users?role_id={{$item->id}}">管理用户</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <form action="/roles/add?app_id={{$appId}}" method="post">
                            <td class="center"></td>
                            <td>
                                <select name="app_id">
                                    @foreach($apps as $app)
                                        <option value="{{$app->id}}">{{$app->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input name="key" type="text"/></td>
                            <td><input name="name" type="text"/></td>
                            <td class="hidden-480"><input name="desc" type="text"/></td>
                            <td>
                                <button class="btn btn-sm">添加</button>
                            </td>
                        </form>
                    </tr>
                    </tbody>
                </table>
                <div class="pagination">{{ $list->links() }}</div>
            </div><!-- /.span -->
        </div><!-- /.row -->
    </div>


@endsection

@section('footer')
@endsection
