@extends('layout/ace')

@section('title')
    App列表
@endsection

@section('style')
    <link rel="stylesheet" href="/assets/css/b.page.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/b.page.bootstrap3.css" type="text/css">
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="#">主页</a>
        </li>
        <li>
            <a href="#">App管理</a>
        </li>
        <li class="active">App列表</li>
    </ul>
@endsection

@section('content')
    <table class="bTable table table-striped table-bordered table-hover table-condensed">
        <thead>
        <tr>
            <th class="selectColumn" >选择</th>
            <th>ID</th>
            <th>昵称</th>
            <th>姓名</th>
            <th>头像</th>
            <th>手机号</th>
            <th>邮箱</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td class="selectColumn"><input type="radio" name="userSelect" value="{{ $item->id }}" /></td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <img src="{{ $item->avatar }}" style="width: 30px;" />
                </td>
                <td>{{ $item->mobile }}</td>
                <td>{{ $item->email }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- 必须设置以下分页信息设置，否则插件将无法读取分页数据-->
    <!-- 隐藏内容设置后，在插件初始化时进行读取-->
    <input type="hidden" id="pageNumber" value="{{ $list->currentPage() }}">
    <input type="hidden" id="pageSize" value="{{ $limit }}">
    <input type="hidden" id="totalPage" value="{{ $list->lastPage() }}">
    <input type="hidden" id="totalRow" value="{{ $list->total() }}">
    <div class="pagination"></div>
@endsection

@section('footer')
    <script type="text/javascript" src="/assets/js/b.page.js" ></script>
    <script>
        //初始化插件
        $('.pagination').bPage({
            //分页目标链接
            url : '/apps',
            //读取页面设置的分页参数
            totalPage: $('#totalPage').val(),
            totalRow: $('#totalRow').val(),
            pageSize: $('#pageSize').val(),
            pageNumber: $('#pageNumber').val(),
            //自定义传递到服务端的参数
        });
    </script>
@endsection
