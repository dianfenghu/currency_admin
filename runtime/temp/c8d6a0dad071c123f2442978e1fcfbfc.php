<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"D:\wamp\www\web1\public/../application/admin\view\group\fenpei.html";i:1493458826;s:68:"D:\wamp\www\web1\public/../application/common\view\Public\admin.html";i:1493455912;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>首页</title>
   
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/css/style.css" />
    <link rel="icon" href="/static/image/code.png">
</head>
<body>
<div class="my-header">
    <a href="javascript:;">
        <!--<img class="my-header-logo" src="" alt="logo">-->
        <a href="<?php echo url('admin/index/index'); ?>"><div class="my-header-logo">后台管理系统</div></a>
    </a>
    <!-- <ul class="layui-nav" lay-filter="">
        <li class="layui-nav-item"><a href="javascript:;">列1</a></li>
        <li class="layui-nav-item"><a href="javascript:;">列2</a></li>
        <li class="layui-nav-item">
            <a href="javascript:;">列3</a>
            <dl class="layui-nav-child">
                <dd><a href="javascript:;">列3-1</a></dd>
                <dd><a href="javascript:;">列3-2</a></dd>
                <dd><a href="javascript:;">列3-3</a></dd>
            </dl>
        </li>
    </ul> -->
    <ul class="layui-nav my-header-user-nav" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;"><img src="" alt="logo"> Admin </a>
            <dl class="layui-nav-child">
                <dd><a href="javascript:;">个人信息</a></dd>
                <dd><a href="javascript:;">修改密码</a></dd>
                <dd><a href="javascript:;">退出</a></dd>
            </dl>
        </li>
    </ul>
</div>
<div class="my-side">
    <ul class="layui-nav layui-nav-tree" lay-filter="side">
        <li class="layui-nav-item"><a href="javascript:;" href-url="<?php echo url('index/wwwset'); ?>">网站设置</a></li>
        <?php if(($debug == true)): ?><li class="layui-nav-item"><a href="javascript:;" href-url="<?php echo url('AdminMenu/index'); ?>">后台菜单</a></li><?php endif; if(is_array($adminmenu) || $adminmenu instanceof \think\Collection || $adminmenu instanceof \think\Paginator): $i = 0; $__LIST__ = $adminmenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vomenu): $mod = ($i % 2 );++$i;if($vomenu['method'] == 'x'): ?>
                <li class="layui-nav-item layui-nav-itemed">
                    <a href="javascript:;"><?php echo $vomenu['name']; ?></a>
                    <dl class="layui-nav-child">
                        <?php if(is_array($vomenu['son']) || $vomenu['son'] instanceof \think\Collection || $vomenu['son'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vomenu['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sonmenu): $mod = ($i % 2 );++$i;?>
                        <dd class=""><a href="javascript:;" href-url="<?php echo url($sonmenu['controller'].'/'.$sonmenu['method']); ?>"><?php echo $sonmenu['name']; ?></a></dd>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </dl>
                </li>
            <?php else: ?>
                <li class="layui-nav-item"><a href="javascript:;" href-url="<?php echo url($vomenu['controller'].'/'.$vomenu['method']); ?>"><?php echo $vomenu['name']; ?></a></li>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
        
    </ul>
</div>
<div class="my-body">
    
<fieldset class="layui-elem-field layui-field-title site-title">
    <legend><a name="nob">分类</a></legend>
</fieldset>
<button class="layui-btn add" href-url="<?php echo url('admin/group/add'); ?>">
  <i class="layui-icon">&#xe608;</i> 添加用户组
</button>
<hr>

<div class="layui-form">
  <table class="layui-table">
    <colgroup>
      <col width="50">
      <col width="150">
      <col width="150">
      <col width="200">
      <col>
    </colgroup>
    <thead>
      <tr>
        <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
        <th colspan="10" text-align="center">权限管理</th>
      </tr> 
    </thead>
    <tbody>
      <tr>
        <td><input type="checkbox" checked name="" lay-skin="primary"></td>
        <td width="200px;"><input type="checkbox" checked name="" lay-skin="primary">贤心</td>
        <td><input type="checkbox" checked name="" lay-skin="primary">汉族</td>
        <td><input type="checkbox" checked name="" lay-skin="primary">1989-10-14</td>
        <td><input type="checkbox" checked name="" lay-skin="primary">人生似修行</td>
        <td><input type="checkbox" checked name="" lay-skin="primary">人生似修行</td>
        <td><input type="checkbox" checked name="" lay-skin="primary">人生似修行</td>
      </tr>
    </tbody>
  </table>
</div>

</div>
<script type="text/javascript" src="__PUBLIC__/static/layui/lay/dest/layui.all.js"></script>
<script type="text/javascript">
    ;!function(){
        var element = layui.element(),layer = layui.layer,$ = layui.jquery,util = layui.util,form = layui.form(); //导航的hover效果、二级菜单等功能，需要依赖element模块
        // 分辨率小于1024  使用内部工具组件
        if($(window).width() < 1024) {
            util.fixbar({
                bar1: '&#xe602;'
                ,css: {right:10, bottom:10}
                ,click: function(type){
                    if(type === 'bar1'){
                        //iframe层
                        layer.open({
                            type: 1,                        // 类型
                            title: false,                   // 标题
                            offset: 'l',                    // 定位 左边
                            closeBtn: 0,                    // 关闭按钮
                            anim: 0,                        // 动画
                            shadeClose: true,               // 点击遮罩关闭
                            shade: 0.8,                     // 半透明
                            area: ['150px', '100%'],        // 区域
                            skin: 'my-mobile',              // 样式
                            content: $('body .my-side').html() // 内容
                        });
                    }
                    element.init();
                }
            });
        }


        //监听导航(side)点击切换页面
        element.on('nav(side)', function(elem){
            layer.msg(elem.text());
            var src = elem.children('a').attr('href-url');
            setTimeout(function(){
                window.location.href = src;
            },1000);
        });

        //监听表单add提交
        form.on('submit(formadd)', function(data){
            console.log(data.field);
            var obj = $(this);
            var url = obj.attr('href-url');
            $.post(url,data.field,function(res){
                if(res){
                    layer.msg('添加成功');
                    //alert(url.substring(-3,url.length-8));
                    setTimeout(function(){
                        //window.location.href = url.substring(0,url.length-8);
                    },1000);
                }       
            });
            return false;
        });

        //监听表单add提交
        form.on('submit(formaddzi)', function(data){
            var obj = $(this);
            var url = obj.attr('href-url');
            $.post(url,data.field,function(res){
                if(res){
                    layer.msg('添加成功');
                    //alert(url.substring(0,url.length-8));
                    setTimeout(function(){
                       window.location.href = url.substring(0,url.length-8);
                    },1000);
                }else{
                    layer.msg('添加失败，不支持三级或三级以上的后台菜单');
                }      
            });
            return false;
        });

         //监听表单add提交
        form.on('submit(formupdate)', function(data){
            var obj = $(this);
            var url = obj.attr('href-url');
            $.post(url,data.field,function(res){
                if(res){
                    layer.msg('保存成功');
                    setTimeout(function(){
                        url = updatepath(url,'/',3);
                        window.location.href = url;
                    },1000);
                }else {
                    alert(res)
                   // layer.msg('保存失败');
                }       
            });
            return false;
        });

        $('.add').click(function(){
            var url = $(this).attr('href-url');
            window.location.href = url;
        });
        $('.update').click(function(){
            var url = $(this).attr('href-url');
            window.location.href = url;

        });

         $('.del').click(function(){
            var url = $(this).attr('href-url');
            var obj = $(this);
            layer.confirm('非开发人员，请勿删除', function(index){ 
                layer.close(index);
                setTimeout(function(){
                    $.get(url,function(data){
                        if(data){
                            obj.parents("tr").remove();
                            layer.msg('删除成功');
                        }else{
                            obj.parents("tr").remove();
                            layer.msg('已删除');
                        }           
                    },'json');
                },1000);
               
            });
        });
    }();

    function updatepath(str,f,n){
        var arr = str.split(f);
        for(var i=1;i<=n;i++){
            arr.pop();//去除后缀
        }
        var path = arr.join(f);
        return path;
    }
</script>



</body>
</html>