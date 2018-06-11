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
        <li class="active">Role用户列表</li>
    </ul>
@endsection

@section('content')
    <link rel="stylesheet" href="/assets/css/chosen.min.css"/>

    <div class="page-header">
        <h1>
            用户列表
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                用户列表
            </small>
        </h1>
    </div>

    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-12">
                <table id="simple-table" class="table  table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace">
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>ID</th>
                        <th>用户</th>
                        <th>Email</th>
                        <th>过期时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace">
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td class="center">
                                {{$item->id}}
                            </td>
                            <td>
                                {{$item->user->name}}
                            </td>
                            <td>
                                {{$item->user->email}}
                            </td>
                            <td>{{$item->expired_at}}</td>
                            <td>
                                <a href="/roles/users/del?id={{$item->id}}&role_id={{$item->role_id}}">移除</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="6" class="center">
                            <form action="/roles/users/add?" method="post">
                                <select name="user_id" class="chosen-select form-control" data-placeholder="选择用户..."
                                        style="width: 300px">
                                    <option value=""></option>
                                    @foreach($users as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <select name="expired_at">
                                    <option value="">不过期</option>
                                    <option value="+1 years">1年</option>
                                    <option value="+1 months">1月</option>
                                    <option value="+1 weeks">1周</option>
                                    <option value="+1 days">1天</option>
                                </select>
                                <input type="hidden" name="role_id" value="{{$role_id}}"/>
                                <button type="submit" class="btn btn-sm btn-info">保存</button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
                {{--                <div class="pagination">{{ $list->links() }}</div>--}}
            </div><!-- /.span -->
        </div><!-- /.row -->
    </div>
@endsection

@section('footer')
    <script src="/assets/js/chosen.jquery.min.js"></script>
    <script>
        $(function () {
            $('.chosen-select').chosen({allow_single_deselect: true});
        });
    </script>
@endsection
