/**
 @Name：treeGrid树状表格
 @Author：lrd
 */

//https://fly.layui.com/extend/treeGrid

layui.config({
    base: '/static/layui-2.4.5/extend/treeGrid/'
}).extend({
    dltable: 'dltable'
}).define(['laytpl', 'laypage', 'dltable', 'layer', 'form'], function (exports) {
    'use strict';

    var $ = layui.jquery;
    var layer = layui.layer;
    var dltable = layui.dltable;
    var MOD_NAME = 'treeGrid';
    var treeGrid = $.extend({}, dltable);

    treeGrid._render = treeGrid.render;
    treeGrid.render = function (param) {//重写渲染方法
        param.isTree = true;//是树表格
        treeGrid._render(param);
    };
    exports(MOD_NAME, treeGrid);
});