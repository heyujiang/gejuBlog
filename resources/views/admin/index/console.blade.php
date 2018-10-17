<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>首页</title>
    <link rel="stylesheet" href="{{ asset('static/admin/layui/css/layui.css') }}">
    <link rel="stylesheet" href="{{ asset('static/admin/static/css/style.css') }}">
    <link rel="icon" href="{{ asset('static/admin/static/image/logo.jpg') }}">
</head>
<body class="body">
<!-- 导航 -->
<ul class="btn-nav row">
    <li class="panel-nav col" href-url="demo/btn.html">
        <div class="btn-nav-icon">
            <i class="layui-icon">&#xe621;</i>
        </div>
        <div class="btn-nav-word">
            <span>40</span>
            <span class="layui-elip">按钮(菜单可自定义)</span>
        </div>
    </li>
    <li class="panel-nav col" href-url="demo/form.html">
        <div class="btn-nav-icon">
            <i class="layui-icon">&#xe628;</i>
        </div>
        <div class="btn-nav-word">
            <span>100</span>
            <span class="layui-elip">引擎</span>
        </div>
    </li>
    <li class="panel-nav col" href-url="demo/table.html">
        <div class="btn-nav-icon">
            <i class="layui-icon">&#xe609;</i>
        </div>
        <div class="btn-nav-word">
            <span>20</span>
            <span class="layui-elip">发布</span>
        </div>
    </li>
    <li class="panel-nav col" href-url="demo/tab-card.html">
        <div class="btn-nav-icon">
            <i class="layui-icon">&#xe62c;</i>
        </div>
        <div class="btn-nav-word">
            <span>30</span>
            <span class="layui-elip">图表</span>
        </div>
    </li>
    <li class="panel-nav col" href-url="demo/progress-bar.html">
        <div class="btn-nav-icon">
            <i class="layui-icon">&#xe60e;</i>
        </div>
        <div class="btn-nav-word">
            <span>80</span>
            <span class="layui-elip">记录</span>
        </div>
    </li>
    <li class="panel-nav col" href-url="demo/folding-panel.html">
        <div class="btn-nav-icon">
            <i class="layui-icon">&#xe63a;</i>
        </div>
        <div class="btn-nav-word">
            <span>5</span>
            <span class="layui-elip">消息</span>
        </div>
    </li>
</ul>
<!-- 两列 -->
<div class="row">
    <div class="panel-2 col">

        <div class="layui-collapse" lay-accordion>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">图表</h2>
                <div class="layui-colla-content layui-show">
                    <div id="main-map" style="height: 300px;overflow: hidden;"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="panel-2 col">

        <div class="layui-collapse" lay-accordion>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">表格</h2>
                <div class="layui-colla-content layui-show">

                    <table class="layui-table">
                        <colgroup>
                            <col width="150">
                            <col width="200">
                            <col>
                        </colgroup>
                        <thead>
                        <tr>
                            <th>昵称</th>
                            <th>加入时间</th>
                            <th>签名</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>贤心</td>
                            <td>2016-11-29</td>
                            <td>人生就像是一场修行</td>
                        </tr>
                        <tr>
                            <td>贤心</td>
                            <td>2016-11-29</td>
                            <td>人生就像是一场修行</td>
                        </tr>
                        <tr>
                            <td>贤心</td>
                            <td>2016-11-29</td>
                            <td>人生就像是一场修行</td>
                        </tr>
                        <tr>
                            <td>贤心</td>
                            <td>2016-11-29</td>
                            <td>人生就像是一场修行</td>
                        </tr>
                        <tr>
                            <td>贤心</td>
                            <td>2016-11-29</td>
                            <td>人生就像是一场修行</td>
                        </tr>
                        <tr>
                            <td>贤心</td>
                            <td>2016-11-29</td>
                            <td>人生就像是一场修行</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>
<!-- 三列 -->
<div class="row">
    <div class="panel-3 col">

        <div class="layui-collapse" lay-accordion>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">版本</h2>
                <div class="layui-colla-content layui-show">

                    <blockquote class="layui-elem-quote">
                        vip-admin-special-v1.0.0 更新日期：2017-07-19
                        <hr>
                        该模板为vip-admin-html-v1.7.0的特别版。<br>
                        继承了vip-admin-html-v1.7.0的所有特点并且深入修改而成的一套后台模板。<br>
                        该模板基于layui-v1.0.9。<br>
                        扩展了首页页面、登录页面。<br>
                        主题功能，默认、蓝白、黄色三种主题功能。<br>
                        全屏功能、锁屏功能、刷新功能、清理缓存功能、公告功能。<br>
                    </blockquote>

                </div>
            </div>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">辅助</h2>
                <div class="layui-colla-content">

                    <fieldset class="layui-elem-field">
                        <legend>字段集区块 - 默认风格</legend>
                        <div class="layui-field-box">
                            内容区域
                        </div>
                    </fieldset>

                    <fieldset class="layui-elem-field layui-field-title">
                        <legend>字段集区块 - 横线风格</legend>
                        <div class="layui-field-box">
                            内容区域
                        </div>
                    </fieldset>
                    你可以把它看作是一个有标题的横线

                </div>
            </div>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">横线</h2>
                <div class="layui-colla-content">

                    华丽的
                    <hr>
                    分割线

                </div>
            </div>
        </div>

    </div>
    <div class="panel-3 col">

        <div class="layui-collapse" lay-accordion>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">图表</h2>
                <div class="layui-colla-content layui-show">
                    <div id="main-bing" style="height: 300px;overflow: hidden;"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="panel-3 col">

        <div class="layui-collapse layui-form layui-form-pane" lay-accordion>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">表单</h2>
                <div class="layui-colla-content layui-show">
                    <div class="layui-form-item">
                        <label class="layui-form-label">输入框</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">密码框</label>
                        <div class="layui-input-inline">
                            <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">辅助文字</div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">选择框</label>
                        <div class="layui-input-block">
                            <select name="city" lay-verify="required">
                                <option value=""></option>
                                <option value="0">北京</option>
                                <option value="1">上海</option>
                                <option value="2">广州</option>
                                <option value="3">深圳</option>
                                <option value="4">杭州</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">复选框</label>
                        <div class="layui-input-block">
                            <input type="checkbox" name="like[write]" title="写作">
                            <input type="checkbox" name="like[read]" title="阅读" checked>
                            <input type="checkbox" name="like[dai]" title="发呆">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">开关</label>
                        <div class="layui-input-block">
                            <input type="checkbox" name="switch" lay-skin="switch">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">单选框</label>
                        <div class="layui-input-block">
                            <input type="radio" name="sex" value="男" title="男">
                            <input type="radio" name="sex" value="女" title="女" checked>
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">文本域</label>
                        <div class="layui-input-block">
                            <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        <button class="layui-btn fr" lay-submit lay-filter="formDemo">立即提交</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="{{ asset('static/admin/layui/layui.all.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/admin/plugins/echarts/echarts.min.js') }}"></script>
<script type="text/javascript">
    // 方法
    layui.use(['element','form'], function(){
        var element = layui.element
            ,form       = layui.form
            ,$          = layui.jquery;

        // 子页面跳转新页面
        $(document).on('click','.btn-nav li.panel-nav', function() {
            if($(this).attr('href-url')){
                console.log($(this).attr('href-url'));
                // 调用父级跳转刷新方法
                parent.setRUrl($(this).attr('href-url'));
            }
        });

        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main-map'));

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption({
            title: {
                text: '示例'
            },
            tooltip: {},
            legend: {
                data:['销量']
            },
            xAxis: {
                data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: [5, 20, 36, 10, 10, 20]
            }]
        });

        // 基于准备好的dom，初始化echarts实例
        var chart = echarts.init(document.getElementById('main-bing'));

        // 配置
        chart.setOption({
            series : [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius: '55%',
                    data:[
                        {value:400, name:'搜索引擎'},
                        {value:335, name:'直接访问'},
                        {value:310, name:'邮件营销'},
                        {value:274, name:'联盟广告'},
                        {value:235, name:'视频广告'}
                    ]
                }
            ]
        });

    });
</script>
</body>
</html>