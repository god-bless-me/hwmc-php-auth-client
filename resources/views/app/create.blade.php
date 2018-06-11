@extends('layout/ace')

@section('title')
    创建App
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
        <li class="active">创建App</li>
    </ul>
@endsection

@section('content')
<form class="form-horizontal" role="form" method="post" action="/apps/create">
    <div class="space-4"></div>
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> App名称 </label>

        <div class="col-sm-9">
            <input type="text" name="App[name]" id="form-field-1" placeholder="请输入App名称" class="col-xs-10 col-sm-5" />
        </div>
    </div>

    <div class="space-4"></div>
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 跳转域名 </label>

        <div class="col-sm-9">
            <input type="text" name="App[redirect_host]" id="form-field-1" placeholder="请输入跳转域名" class="col-xs-10 col-sm-5" />
        </div>
    </div>

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>
                提交
            </button>

            &nbsp; &nbsp; &nbsp;
            <button class="btn" type="reset">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                返回
            </button>
        </div>
    </div>

</form>
@endsection
