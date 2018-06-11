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
            <a href="#">应用</a>
        </li>
        <li class="active">应用列表</li>
    </ul>
@endsection

@section('content')

    <div class="page-header">
        <h1>
            应用
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                应用列表
            </small>
        </h1>
    </div>

    <div class="col-xs-12" style="overflow-x: scroll">
        <div class="row">
            <div class="col-xs-12">
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
                        <th class="hidden-480">回调域名</th>
                        <th class="hidden-480">Secret</th>
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
                                {{$item->name}}
                            </td>
                            <td class="hidden-480">{{$item->redirect_host}}</td>
                            <td class="center hidden-480">
                                {{$item->secret}}
                            </td>
                            <td>
                                <a href="/roles?app_id={{$item->id}}">角色</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination">{{ $list->links() }}</div>
            </div><!-- /.span -->
        </div><!-- /.row -->
    </div>


@endsection

@section('footer')
@endsection
