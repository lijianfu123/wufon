/**
 * vue 基类
 */
let base_vue = Vue.extend({
    el: '#app',
    data() {
        return {
            editor: {}, //编辑器
            editor_xuan_xing: {},
            editor_chi_cun: {},
            editor_bao_jia: {},

            breadcrumb: {}, //面包屑
            promise_array: [], //Promise 对象数组

            tabs_active: 'first_tab', //tabs 激活页签
            tabs_content_active: 'first_content_tab', //

            current_row_id: 0, //当前行 id
            current_row_index: 0, //当前行 index
            table_max_height: 0, //表格最大高度

            is_init_data: false, //是否 完成初始化 数据
            is_dialog_form: true, //是否 弹窗表单
            is_loading_html: true, //是否 显示加载层
            is_loading_upload_button: false, //是否 显示 上传加载 按钮
            is_loading_submit_button: true, //是否 显示 提交加载 按钮
            is_disabled_upload_button: true, //是否 禁用 上传 按钮
            is_disabled_reload_data_button: true, //是否 禁用 刷新 数据 按钮
            is_disabled_update_sort_button: true, //是否 禁用 更新排序 按钮

            api_url: '/api/', //api app 地址
            api_main_data_controller: '', //api 主数据 控制器
            api_main_data_action: '', //api 主数据方法

            main_page: [], //主分页
            main_list: [], //主列表
            main_detail: {}, //主数据

            search_default_data: {}, //搜索 默认数据
            search_request_data: {} //搜索 请求数据
        }
    },
    created() {
        //初始化 数据
        Object.keys(this.$options.data.call(this)).forEach(value => {
            let vue_data = this[value];
            if ((vue_data.api_controller !== undefined) && (vue_data.api_action !== undefined)) {
                //主数据 控制器、方法 赋值
                if (['main_page', 'main_list', 'main_detail'].indexOf(value) > -1) {
                    this.api_main_data_controller = vue_data.api_controller;
                    this.api_main_data_action = vue_data.api_action;
                }

                this.get_vue_data(vue_data);
            }
        });
    },
    mounted() {
        //页面在 弹窗中 背景设置 白色
        if ((this.$refs.close_button !== undefined) || (this.is_dialog_form === false)) {
            $('#app').css('background', 'white');
        }

        //侧边 tree
        let aside_tree = this.$refs.aside_tree;
        if (aside_tree !== undefined) {
            aside_tree.$el.style.background = 'white';

            aside_tree.$el.style.borderTop = '1px solid #d4d4d4';
            aside_tree.$el.style.borderRight = '1px solid #d4d4d4';
            aside_tree.$el.style.height = (window.innerHeight - aside_tree.$el.offsetTop) + 'px';
        }

        //tab_bar 元素 前 添加 div
        if (this.$refs.tab_bar !== undefined) {
            $('.van-tabbar').before('<div style="height: 55px;"></div>');
        }

        //nav_bar 元素 后 添加 div
        if (this.$refs.nav_bar !== undefined) {
            $('.van-nav-bar').after('<div style="height: 45px;"></div>');
        }

        //nav_bar 元素 后 添加 div
        if (this.$refs.submit_bar !== undefined) {
            //$('.van-submit-bar__bar').before('<div style="height: 45px;"></div>');
        }

        this.$nextTick(() => {
            //表格最大高度
            if (this.$refs.main_table !== undefined) {
                this.table_max_height = window.innerHeight - this.$refs.main_table.$el.offsetTop;

                if (this.$refs.pagination !== undefined) {
                    this.table_max_height -= 44;
                }
            }

            Promise.all(this.promise_array).then(result => {
                let error_code = 0;
                result.map(value => {
                    error_code += parseInt(value['error_code']);
                });

                if (error_code === action_code.api_success) {
                    //vue 数据 重新 赋值
                    Object.keys(this.$options.data.call(this)).forEach(value => {
                        if ((this[value].api_controller !== undefined) && (this[value].api_action !== undefined)) {
                            if ((this[value].api_controller === this.api_main_data_controller) && (this[value].api_action === this.api_main_data_action)) {
                                this[value] = this[value].data;

                                //ref.main_list data 赋值
                                if (this.$refs.main_table !== undefined) {
                                    if (this.$refs.pagination === undefined) {
                                        this.$refs.main_table.data = this[value];
                                    } else {
                                        this.$refs.main_table.data = this[value].list;
                                    }
                                }
                            } else {
                                this[value] = this[value].data;
                            }
                        }
                    });

                    this.init_data(); //初始化数据
                } else {
                    this.is_loading_submit_button = true;
                    this.show_error_message('数据加载失败');
                }
            }).catch(error => {
            });
        });
    },
    methods: {
        /**
         * 格式化 时间
         * @param value
         * @returns {string}
         */
        format_time: value => {
            value = value * 1000;

            let date = new Date(value);
            let y = date.getFullYear();

            let MM = date.getMonth() + 1;
            MM = MM < 10 ? ('0' + MM) : MM;

            let d = date.getDate();
            d = d < 10 ? ('0' + d) : d;

            let h = date.getHours();
            h = h < 10 ? ('0' + h) : h;

            let m = date.getMinutes();
            m = m < 10 ? ('0' + m) : m;

            let s = date.getSeconds();
            s = s < 10 ? ('0' + s) : s;

            return y + '-' + MM + '-' + d;
        },
        /**
         * 高亮 关键字
         * @param value
         * @returns {string|*}
         */
        highlight_keyword(value) {
            if (value === undefined) {
                return '';
            } else if (value === '') {
                return '';
            }

            let keyword = this.search_request_data.keyword;
            if (keyword === undefined) {
                return value;
            } else if (keyword === '') {
                return value;
            } else {
                keyword = keyword.trim();
            }

            let reg = new RegExp("(" + keyword + ")", "g");
            let result = value.replace(reg, "<span style='color: red;'>$1</span>");

            return result;
        },
        /**
         * 随机数
         */
        rand_code() {
            return Math.random();
        },
        /**
         * 后退
         */
        back() {
            history.back(-1);
        },
        /**
         * 关闭 弹窗
         */
        close_dialog() {
            parent.layer.closeAll();
        },
        /**
         * 显示 弹窗
         * @param title
         * @param url
         * @param width
         * @param height
         */
        show_dialog(title, url, width, height) {
            if (!isNaN(width)) {
                width += 'px';
            }

            if (!isNaN(height)) {
                height += 'px';
            }

            layer.open({
                type: 2,
                shade: 0.1,
                title: title,
                content: url,
                area: [width, height]
            });
        },
        /**
         * 显示 图片
         * @param image
         */
        show_image(src) {
            top.layer.open({
                title: false,
                btn: false,
                shadeClose: true,
                maxWidth: 800,
                maxHeight: 600,
                content: '<img src="' + src + '" style="max-width: 800px; max-height: 600px;" />'
            });
        },
        /**
         * 显示 成功信息
         * @param message
         */
        show_success_message(message) {
            this.$message({
                type: 'success',
                duration: 1000,
                showClose: true,
                message: message
            });
        },
        /**
         * 显示 错误信息
         * @param message
         * @param is_auto_close
         */
        show_error_message(message, is_auto_close = true) {
            let duration = 1000;
            if (!is_auto_close) {
                duration = 0;
            }

            this.$message({
                type: 'error',
                showClose: true,
                message: message,
                duration: duration    //显示时间
            });
        },
        /**
         * 显示 编辑器
         * @param editor_name
         * @returns {UE.Editor}
         */
        show_editor(editor_name = 'content') {
            var editor = new UE.ui.Editor({
                zIndex: 0,
                initialFrameWidth: '100%',
                initialFrameHeight: 500
            });

            editor.render(editor_name);

            return editor;
        },
        /**
         * 联动 select
         * @param type
         * @param data
         */
        change_step_first_select(type, data) {
            data['second_' + type + '_id'] = 0;

            if (data['third_' + type + '_id'] !== undefined) {
                data['third_' + type + '_id'] = 0;
            }
        },
        /**
         * 开始 上传文件
         */
        before_upload() {
            this.is_loading_upload_button = true;
            this.is_disabled_upload_button = true;
        },
        /**
         * 上传 文件
         * @param file
         * @param data
         */
        upload_file(file = 'image', data) {
            let upload = this.$refs['upload_' + file];
            if (upload !== undefined) {
                let upload_files = upload.uploadFiles;
                if (upload_files !== undefined) {
                    let count = upload_files.length;
                    if (count > 0) {
                        let status = upload_files[count - 1].status;
                        if (status === action_code.upload_success) {
                            let response = upload_files[count - 1].response;
                            if (response.error_code === action_code.api_success) {
                                if (data === undefined) {
                                    data = this.main_detail;
                                }

                                data[file] = response.data[0];
                            } else {
                                this.show_error_message('上传失败！');
                            }
                        }
                    }

                    this.is_loading_upload_button = false;
                    this.is_disabled_upload_button = false;
                }
            }
        },
        /**
         * 上传 文件组
         * @param file_list
         * @param data
         */
        upload_file_list(file_list = 'image_list_json', data) {
            let upload = this.$refs['upload_' + file_list];
            if (upload !== undefined) {
                let upload_files = upload.uploadFiles;
                if (upload_files !== undefined) {
                    let array = [];

                    if (data === undefined) {
                        data = this.main_detail;
                    }

                    let count = upload_files.length;
                    if (count > 0) {
                        for (let i = 0; i < count; i++) {
                            let upload_file = upload_files[i];
                            if (upload_file.status === action_code.upload_success) {
                                let response = upload_file.response;
                                if (response === undefined) {
                                    array.push({
                                        image: upload_file.url
                                    });
                                } else {
                                    if (response.error_code === action_code.api_success) {
                                        array.push({
                                            image: upload_files[i].response.data[0]
                                        });
                                    }
                                }
                            }
                        }
                    }

                    data[file_list] = JSON.stringify(array);

                    this.is_loading_upload_button = false;
                    this.is_disabled_upload_button = false;
                }
            }
        },
        /**
         * 搜索 数据
         * @param is_page_bar
         */
        search_data(is_page_bar = false) {
            this.search_request_data = {}; //清空 搜索提交数据

            //遍历 搜索默认数据 合并搜索数据
            Object.keys(this.search_default_data).forEach(value => {
                let element = this.$refs['search_' + value];
                if (element !== undefined) {
                    if (element.isTree) {
                        this.search_request_data[value] = element.getCurrentKey();
                    } else {
                        let val = element.value;
                        if (val !== undefined) {
                            if (is_time(val)) {
                                this.search_request_data[value] = val.getFullYear() + '-' + (val.getMonth() + 1) + '-' + val.getDate();
                            } else {
                                this.search_request_data[value] = val;
                            }
                        }
                    }
                }
            });

            //页码
            if (this.$refs.pagination !== undefined) {
                if (!is_page_bar) {
                    this.$refs.pagination.$data.internalCurrentPage = 1;
                }

                this.search_request_data.page = this.$refs.pagination.$data.internalCurrentPage;
            }

            this.reload_data(); //刷新 数据
        },
        /**
         * 初始化数据
         */
        init_data() {
            this.is_init_data = true;
            this.is_loading_html = false;
            this.is_loading_submit_button = false;
            this.is_disabled_reload_data_button = false;

            if (this.$refs.main_table !== undefined) {
                //排序按钮
                if (this.$refs.pagination === undefined) {
                    if (this.main_list.length === 0) {
                        this.is_disabled_update_sort_button = true;
                    } else {
                        this.is_disabled_update_sort_button = false;
                    }
                } else {
                    if (this.main_page.list.length === 0) {
                        this.is_disabled_update_sort_button = true;
                    } else {
                        this.is_disabled_update_sort_button = false;
                    }
                }
            }

            //编辑器
            if (this.$refs.editor !== undefined) {
                this.editor = this.show_editor(this.$refs.editor.id); //显示 编辑器

                this.editor.ready(() => {
                    this.editor.setContent(this.$refs.editor.value, false);
                });
            }

            if (this.$refs.editor_xuan_xing !== undefined) {
                this.editor_xuan_xing = this.show_editor(this.$refs.editor_xuan_xing.id); //显示 编辑器

                this.editor_xuan_xing.ready(() => {
                    this.editor_xuan_xing.setContent(this.$refs.editor_xuan_xing.value, false);
                });
            }

            if (this.$refs.editor_chi_cun !== undefined) {
                this.editor_chi_cun = this.show_editor(this.$refs.editor_chi_cun.id); //显示 编辑器

                this.editor_chi_cun.ready(() => {
                    this.editor_chi_cun.setContent(this.$refs.editor_chi_cun.value, false);
                });
            }

            if (this.$refs.editor_bao_jia !== undefined) {
                this.editor_bao_jia = this.show_editor(this.$refs.editor_bao_jia.id); //显示 编辑器

                this.editor_bao_jia.ready(() => {
                    this.editor_bao_jia.setContent(this.$refs.editor_bao_jia.value, false);
                });
            }
        },
        /**
         * 刷新 列表
         */
        reload_data() {
            let main_table = this.$refs.main_table;

            //是否 懒加载子节点数据
            if (main_table.lazy) {
                location.reload();
            } else {
                this.is_loading_html = true;
                let request_data = this.search_request_data;

                this.get_base_api(this.api_main_data_controller, this.api_main_data_action, request_data).then(result => {
                    if (result.error_code === action_code.api_success) {
                        if (this.$refs.pagination === undefined) {
                            this.main_list = result.data;
                            this.$refs.main_table.data = this.main_list;
                        } else {
                            this.main_page = result.data;
                            this.$refs.main_table.data = this.main_page.list;
                        }

                        //遍历 data 定位
                        let result_data;
                        if (result.data.page === undefined) {
                            result_data = result.data;
                        } else {
                            result_data = result.data.list;
                        }

                        result_data.map(value => {
                            if (parseInt(value.id) === parseInt(this.current_row_id)) {
                                this.$refs.main_table.setCurrentRow(value);
                            }
                        });

                        this.init_data(); //初始化数据
                    }
                });
            }
        },
        /**
         * 提交数据
         * @param api_action
         * @param request_data
         * @returns {Promise<any>}
         */
        submit_data(api_action, request_data = {}) {
            if (Object.keys(request_data).length === 0) {
                request_data = this.main_detail;
            }

            this.is_loading_html = true;
            this.is_loading_submit_button = true;
            let url = this.api_url + this.api_main_data_controller + '/' + api_action;

            return new Promise((resolve, reject) => {
                axios.post(url, request_data).then(response => {
                    if (response.status === action_code.request_success) {
                        let result = response.data;
                        if (result.error_code === action_code.api_success) {
                            //是否 弹窗表单
                            if (this.is_dialog_form) {
                                //this.current_row_id = result.data;
                            }
                        } else {
                            this.show_error_message(result.error_message);
                        }

                        resolve(result);
                    } else {
                        this.show_error_message('数据操作失败');

                        reject('数据操作失败');
                    }

                    this.is_loading_html = false;
                    this.is_loading_submit_button = false;
                });
            }).catch(error => {
            });
        },
        /**
         * 解析 表单数据
         * 布尔字段 转 0 / 1
         * $ 前缀字段 过滤（例：$index）
         * @param form_data
         */
        parse_form_data(form_data) {
            let new_data = {};

            Object.keys(form_data).forEach(value => {
                if (value.substring(0, 1) !== '$') {
                    if (value.substring(0, 3) === 'is_') {
                        if (form_data[value]) {
                            new_data[value] = 1;
                        } else {
                            new_data[value] = 0;
                        }
                    } else {
                        new_data[value] = form_data[value];
                    }
                }
            });

            return new_data;
        },
        /**
         * 解析 api 数组 数据
         * @param data
         * @returns {*}
         */
        parse_api_array_data(data) {
            if (data.length > 0) {
                data.forEach((value, key) => {
                    data[key] = this.parse_api_data(value, key);

                    if (data[key]['children'] !== undefined) {
                        let children_1 = [];

                        for (let i = 0; i < data[key]['children'].length; i++) {
                            let data_1 = this.parse_api_data(data[key]['children'][i], i);
                            let children_2 = [];

                            if (data_1['children'] !== undefined) {
                                for (let j = 0; j < data_1['children'].length; j++) {
                                    let data_2 = this.parse_api_data(data_1['children'][j], j);

                                    children_2.push(data_2);
                                }

                                data_1['children'] = children_2;
                            }

                            children_1.push(data_1);
                        }

                        data[key]['children'] = children_1;
                    }
                });
            }

            return data;
        },
        /**
         * 解析 api 数据
         * @param original_data
         * @param index
         * @returns {{$index: number}}
         */
        parse_api_data(original_data, index = 0) {
            let new_data = {
                $index: index
            };

            Object.keys(original_data).forEach(value => {
                if (value.substring(0, 3) === 'is_') {
                    if (original_data[value] === '') {
                        new_data[value] = '';
                    } else {
                        if (original_data[value] === 1) {
                            new_data[value] = true;
                        } else {
                            new_data[value] = false;
                        }
                    }
                } else if (value.substring(value.length - 10) === '_list_json') {
                    //获取 element-ui Upload 组件 list_json
                    let el_upload_list_json = () => {
                        let list_json = original_data[value];
                        list_json = JSON.stringify(list_json);
                        list_json = list_json.replace(/image/g, 'url');
                        list_json = list_json.replace(/file/g, 'url');
                        list_json = JSON.parse(list_json);

                        return list_json;
                    };

                    new_data[value] = original_data[value];
                    new_data['el_upload_' + value] = el_upload_list_json();
                } else if (value === 'password') {
                    new_data['password'] = '';
                } else {
                    new_data[value] = original_data[value];
                }
            });

            return new_data;
        },
        /**
         * 选中 当前行
         * @param row
         * @param column
         * @param cell
         * @param event
         */
        click_current_row(row, column, event) {
            this.current_row_id = row.id;
            this.current_row_index = row.$index;
            this.$refs.main_table.setCurrentRow(row);
        },
        /**
         * 加载 vue 数据
         * @param vue_data
         */
        get_vue_data(vue_data) {
            //请求数据
            let request_data = {};
            if (vue_data.api_action.substr(-5) === '_page') {
                request_data = this.search_request_data;
            } else if (vue_data.id !== undefined) {
                if (vue_data.id > 0) {
                    request_data.id = vue_data.id;
                }
            }

            let promise = Promise.resolve(eval('this.get_base_api("' + vue_data.api_controller + '", "' + vue_data.api_action + '", request_data)')).then(result => {
                vue_data.error_code = result.error_code;
                vue_data.data = result.data;

                return result;
            });

            this.promise_array.push(promise);
        },
        /**
         * 获取 api 数据 - 基类
         * @param api_controller
         * @param api_action
         * @param request_data
         * @returns {Promise<any>}
         */
        get_base_api(api_controller, api_action, request_data = {}) {
            let url = this.api_url + api_controller + '/' + api_action;

            return new Promise(resolve => {
                axios.post(url, request_data).then(response => {
                    if (response.status === action_code.request_success) {
                        let result = response.data;
                        let result_data = result.data;

                        if (result_data !== undefined) {
                            if (api_action.substr(-5) === '_page') {
                                let list = result_data.list;

                                if (list.length > 0) {
                                    for (let i = 0; i < list.length; i++) {
                                        list[i] = this.parse_api_data(list[i], i);
                                    }

                                    result_data.list = list;
                                }
                            } else {
                                if (is_array(result_data)) {
                                    result_data = this.parse_api_array_data(result_data);
                                } else if (Object.keys(result_data).length) {
                                    result_data = this.parse_api_data(result_data);
                                }
                            }
                        }

                        result.data = result_data;

                        resolve(result);
                    } else {
                        this.show_error_message('数据读取失败');

                        reject('数据读取失败');
                    }
                });
            });
        },
        /**
         * 获取 tree 选中节点
         * @param tree
         */
        get_tree_ids(tree) {
            let arr = tree.getCheckedKeys();

            let ids = arr.join(',');
            ids = ',' + ids + ',';

            return ids;
        },
        /**
         * 获取 禁用 tree
         * @param tree
         * @returns {*}
         */
        get_disabled_tree(tree) {
            tree[0].disabled = 'disabled';

            if (tree[0].children !== undefined) {
                tree[0].children.map(value => {
                    value.disabled = 'disabled';

                    if (value.children !== undefined) {
                        value.children.map(val => {
                            val.disabled = 'disabled';

                            if (val.children !== undefined) {
                                val.children.map(v => {
                                    v.disabled = 'disabled';
                                });
                            }
                        });
                    }
                });
            }

            return tree;
        },
        /**
         * 获取 任意 子层级 tree 列表
         * @param row
         * @param treeNode
         * @param resolve
         */
        get_any_children_level_tree_list(row, treeNode, resolve) {
            let level = '';
            if (row.level === 1) {
                level = 'second_level';
            } else {
                level = 'third_level';
            }

            let url = this.api_url + this.api_main_data_controller + '/get_any_' + level + '_tree_list';

            axios.post(url, {
                parent_id: row.id
            }).then(response => {
                if (response.status === action_code.request_success) {
                    let result = response.data;
                    if (result.error_code === action_code.api_success) {
                        let result_data = this.parse_api_array_data(result.data);

                        row.children = result_data;
                        resolve(result_data);
                    } else {
                        this.show_error_message(result.error_message);
                    }
                } else {
                    this.show_error_message('数据读取失败');
                }
            });
        },
        /**
         * 设置 tree 节点（选中节点、超管禁用、是否第 3 层水平排放）
         * @param tree
         * @param node_ids
         * @param is_third_horizontal
         */
        set_tree_node_ids(tree, node_ids, is_third_horizontal = false) {
            let arr = node_ids.split(',');
            arr.shift(); //删除 数组 第一个元素
            arr.pop(); //删除 最后 一个元素

            tree.setCheckedKeys(arr);

            //超管角色 禁用 tree
            if (this.main_detail.is_main_admin) {
                //this.role_rule_pass_tree = this.get_disabled_tree(this.role_rule_pass_tree);
            }

            //第 3 层水平排放
            if (is_third_horizontal) {
                setTimeout(() => {
                    let node_list = this.$refs.role_rule_tree.$el.getElementsByClassName('el-tree-node__content');
                    for (let i = 0; i < node_list.length; i++) {
                        let node_class_name = node_list[i].getElementsByTagName('span')[0].className;
                        if (node_class_name.indexOf('is-leaf') !== -1) {
                            node_list[i].style.float = 'left';
                        }
                    }
                }, 50);
            }
        },
        /**
         * 注册
         * @param app_enum_type
         */
        register(app_enum_type) {

        },
        /**
         * 基础 登录
         * @param app_enum_type
         * @returns {boolean}
         */
        base_login(app_enum_type) {
            let username = undefined === this.main_detail.username ? '' : this.main_detail.username;
            if (username === '') {
                this.show_error_message('用户名为空！');

                return false;
            }

            let password = undefined === this.main_detail.password ? '' : this.main_detail.password;
            if (password === '') {
                this.show_error_message('密码为空！');

                return false;
            }

            if (this.$refs.captcha !== undefined) {
                let captcha = undefined === this.main_detail.captcha ? '' : this.main_detail.captcha;
                if (captcha === '') {
                    this.show_error_message('验证码为空！');

                    return false;
                }
            }

            let api_action = 'login';

            //提交数据
            this.submit_data(api_action).then(result => {
                if (result.error_code == action_code.api_success) {
                    top.location.replace('/' + app_enum_type);
                } else {
                    if (this.$refs.captcha !== undefined) {
                        $('.captcha').attr('src', '/captcha.html?' + Math.random());
                    }
                }
            });
        },
        /**
         * 后台 登录
         */
        admin_login() {
            this.base_login(app_enum.admin.enum_type);
        },
        /**
         * 站点 登录
         */
        site_login() {
            this.base_login(app_enum.site.enum_type);
        },
        /**
         * 会员 登录
         */
        user_login() {
            this.base_login(app_enum.user.enum_type);
        },
        /**
         * 基础 保存密码
         * @param app_enum_type
         */
        base_update_password(app_enum_type) {
            let data = this.main_detail;
            let api_action = app_enum_type + '_update_password';

            //提交数据
            this.submit_data(api_action, data).then(result => {
                if (result.error_code === action_code.api_success) {
                    this.show_success_message('操作成功');

                    this.main_detail.password = '';
                    this.main_detail.new_password = '';
                    this.main_detail.confirm_password = '';
                }
            });
        },
        /**
         * 后台 更新密码
         */
        admin_update_password() {
            this.base_update_password(app_enum.admin.enum_type);
        },
        /**
         * 站点 更新密码
         */
        site_update_password() {
            this.base_update_password(app_enum.site.enum_type);
        },
        /**
         * 会员 更新密码
         */
        user_update_password() {
            this.base_update_password(app_enum.user.enum_type);
        },
        /**
         * 基础 保存 数据
         * @param app_enum_type
         * @param api_action
         */
        base_save_data(app_enum_type, api_action = '') {
            let data = this.parse_form_data(this.main_detail);

            //编辑器
            if (this.$refs.editor !== undefined) {
                data[this.editor.key] = this.editor.getContent();
            }

            if (this.$refs.editor_xuan_xing !== undefined) {
                data[this.editor_xuan_xing.key] = this.editor_xuan_xing.getContent();
            }

            if (this.$refs.editor_chi_cun !== undefined) {
                data[this.editor_chi_cun.key] = this.editor_chi_cun.getContent();
            }

            if (this.$refs.editor_bao_jia !== undefined) {
                data[this.editor_bao_jia.key] = this.editor_bao_jia.getContent();
            }

            let vue = this;
            if (this.is_dialog_form) {
                vue = parent.eval('vue');
            }

            if (api_action === '') {
                api_action = app_enum_type + '_save_data';
            }

            //操作数据
            this.submit_data(api_action, data).then(result => {
                if (result.error_code === action_code.api_success) {
                    vue.show_success_message('操作成功');

                    //是否 弹窗表单
                    if (this.is_dialog_form) {
                        this.close_dialog();
                        vue.reload_data(); //刷新 数据
                    }
                }
            });
        },
        /**
         * 后台 保存 数据
         */
        admin_save_data() {
            this.base_save_data(app_enum.admin.enum_type);
        },
        /**
         * 站点 保存 数据
         */
        site_save_data() {
            this.base_save_data(app_enum.site.enum_type);
        },
        /**
         * 会员 保存 数据
         */
        user_save_data() {
            this.base_save_data(app_enum.user.enum_type);
        },
        /**
         * 基础 删除 数据
         * @param app_enum_type
         * @param id
         */
        base_delete_data(app_enum_type, id) {
            this.$confirm('删除是不可恢复的，您确定删除所选记录吗？', '系统提示').then(() => {
                let data = {id: id};
                let api_action = app_enum_type + '_delete_data';

                //操作数据
                this.submit_data(api_action, data).then(result => {
                    if (result.error_code === action_code.api_success) {
                        this.show_success_message('操作成功');
                        this.reload_data(); //刷新 数据
                    }
                });
            }).catch(error => {
            });
        },
        /**
         * 后台 删除 数据
         * @param id
         */
        admin_delete_data(id) {
            this.base_delete_data(app_enum.admin.enum_type, id);
        },
        /**
         * 站点 删除 数据
         * @param id
         */
        site_delete_data(id) {
            this.base_delete_data(app_enum.site.enum_type, id);
        },
        /**
         * 会员 删除 数据
         * @param id
         */
        user_delete_data(id) {
            this.base_delete_data(app_enum.user.enum_type, id);
        },
        /**
         * 基础 更新 排序
         * @param app_enum_type
         */
        base_update_sort(app_enum_type) {
            let sort_array = [];

            this.main_list.map(value => {
                sort_array.push({
                    'id': value.id,
                    'sort': value.sort
                });

                if (value.children !== undefined) {
                    if (value.children.length > 0) {
                        value.children.map(val => {
                            sort_array.push({
                                'id': val.id,
                                'sort': val.sort
                            });

                            if (val.children !== undefined) {
                                if (val.children.length > 0) {
                                    val.children.map(v => {
                                        sort_array.push({
                                            'id': v.id,
                                            'sort': v.sort
                                        });
                                    });
                                }
                            }
                        });
                    }
                }
            });

            this.$confirm('您确定保存排序吗？', '系统提示').then(() => {
                let api_action = app_enum_type + '_update_sort';

                //操作数据
                this.submit_data(api_action, sort_array).then(result => {
                    if (result.error_code === action_code.api_success) {
                        this.show_success_message('操作成功');
                        this.reload_data(); //刷新 数据
                    }
                });
            }).catch(error => {
            });
        },
        /**
         * 后台 更新 排序
         */
        admin_update_sort() {
            this.base_update_sort(app_enum.admin.enum_type);
        },
        /**
         * 站点 更新 排序
         */
        site_update_sort() {
            this.base_update_sort(app_enum.site.enum_type);
        },
        /**
         * 会员 更新 排序
         */
        user_update_sort() {
            this.base_update_sort(app_enum.user.enum_type);
        },
        /**
         * 基础 更新 是否审核
         * @param app_enum_type
         * @param row
         * @returns {boolean}
         */
        base_update_is_pass(app_enum_type, row) {
            let message = '';
            if (row.is_pass) {
                message = '您确定所选记录 通过审核？';
            } else {
                message = '您确定所选记录 取消审核？';
            }

            setTimeout(() => {
                row.is_pass = !row.is_pass;
            }, 10);

            this.$confirm(message, '系统提示').then(() => {
                let data = {
                    id: row.id,
                    is_pass: !row.is_pass
                };

                let api_action = app_enum_type + '_update_is_pass';

                //操作数据
                this.submit_data(api_action, data).then(result => {
                    if (result.error_code === action_code.api_success) {
                        this.show_success_message('操作成功');
                        row.is_pass = !row.is_pass;
                    }
                });
            }).catch(error => {
            });
        },
        /**
         * 后台 更新 是否审核
         * @param id
         * @param is_pass
         */
        admin_update_is_pass(id, is_pass) {
            this.base_update_is_pass(app_enum.admin.enum_type, id, is_pass);
        },
        /**
         * 站点 更新 是否审核
         * @param id
         * @param is_pass
         */
        site_update_is_pass(id, is_pass) {
            this.base_update_is_pass(app_enum.site.enum_type, id, is_pass);
        },
        /**
         * 会员 更新 是否审核
         * @param id
         * @param is_pass
         */
        user_update_is_pass(id, is_pass) {
            this.base_update_is_pass(app_enum.user.enum_type, id, is_pass);
        },
        /**
         * 基础 更新 是否 推荐
         * @param app_enum_type
         * @param row
         */
        base_update_is_commend(app_enum_type, row) {
            let message = '';
            if (row.is_commend) {
                message = '您确定所选记录 设为推荐？';
            } else {
                message = '您确定所选记录 设为推荐？';
            }

            setTimeout(() => {
                row.is_commend = !row.is_commend;
            }, 10);

            this.$confirm(message, '系统提示').then(() => {
                let data = {
                    id: row.id,
                    is_commend: !row.is_commend
                };

                let api_action = app_enum_type + '_update_is_commend';

                //操作数据
                this.submit_data(api_action, data).then(result => {
                    if (result.error_code === action_code.api_success) {
                        this.show_success_message('操作成功');
                        row.is_commend = !row.is_commend;
                    }
                });
            }).catch(error => {
            });
        },
        /**
         * 后台 更新 是否 推荐
         * @param id
         * @param is_commend
         */
        admin_update_is_commend(id, is_commend) {
            this.base_update_is_commend(app_enum.admin.enum_type, id, is_commend);
        },
        /**
         * 站点 更新 是否 推荐
         * @param id
         * @param is_commend
         */
        site_update_is_commend(id, is_commend) {
            this.base_update_is_commend(app_enum.site.enum_type, id, is_commend);
        },
        /**
         * 会员 更新 是否 推荐
         * @param id
         * @param is_commend
         */
        user_update_is_commend(id, is_commend) {
            this.base_update_is_commend(app_enum.user.enum_type, id, is_commend);
        },
        /**
         * 基础 更新 是否 最新、新品
         * @param app_enum_type
         * @param row
         */
        base_update_is_new(app_enum_type, row) {
            let message = '';
            if (row.is_new) {
                message = '您确定所选记录 设为最新？';
            } else {
                message = '您确定所选记录 设为最新？';
            }

            setTimeout(() => {
                row.is_new = !row.is_new;
            }, 10);

            this.$confirm(message, '系统提示').then(() => {
                let data = {
                    id: row.id,
                    is_new: !row.is_new
                };

                let api_action = app_enum_type + '_update_is_new';

                //操作数据
                this.submit_data(api_action, data).then(result => {
                    if (result.error_code === action_code.api_success) {
                        this.show_success_message('操作成功');
                        row.is_new = !row.is_new;
                    }
                });
            }).catch(error => {
            });
        },
        /**
         * 后台 更新 是否 最新、新品
         * @param id
         * @param is_new
         */
        admin_update_is_new(id, is_new) {
            this.base_update_is_new(app_enum.admin.enum_type, id, is_new);
        },
        /**
         * 站点 更新 是否 最新、新品
         * @param id
         * @param is_new
         */
        site_update_is_new(id, is_new) {
            this.base_update_is_new(app_enum.site.enum_type, id, is_new);
        },
        /**
         * 会员 更新 是否 最新、新品
         * @param id
         * @param is_new
         */
        user_update_is_new(id, is_new) {
            this.base_update_is_new(app_enum.user.enum_type, id, is_new);
        },
        /**
         * 基础 更新 是否 热点、热卖
         * @param app_enum_type
         * @param row
         */
        base_update_is_hot(app_enum_type, row) {
            let message = '';
            if (row.is_hot) {
                message = '您确定所选记录 设为热点？';
            } else {
                message = '您确定所选记录 设为热点？';
            }

            setTimeout(() => {
                row.is_hot = !row.is_hot;
            }, 10);

            this.$confirm(message, '系统提示').then(() => {
                let data = {
                    id: row.id,
                    is_hot: !row.is_hot
                };

                let api_action = app_enum_type + '_update_is_hot';

                //操作数据
                this.submit_data(api_action, data).then(result => {
                    if (result.error_code === action_code.api_success) {
                        this.show_success_message('操作成功');
                        row.is_hot = !row.is_hot;
                    }
                });
            }).catch(error => {
            });
        },
        /**
         * 后台 更新 是否 热点、热卖
         * @param id
         * @param is_hot
         */
        admin_update_is_hot(id, is_hot) {
            this.base_update_is_hot(app_enum.admin.enum_type, id, is_hot);
        },
        /**
         * 站点 更新 是否 热点、热卖
         * @param id
         * @param is_hot
         */
        site_update_is_hot(id, is_hot) {
            this.base_update_is_hot(app_enum.site.enum_type, id, is_hot);
        },
        /**
         * 会员 更新 是否 热点、热卖
         * @param id
         * @param is_hot
         */
        user_update_is_hot(id, is_hot) {
            this.base_update_is_hot(app_enum.user.enum_type, id, is_hot);
        },
        /**
         * 基础 更新 是否 置顶
         * @param app_enum_type
         * @param row
         */
        base_update_is_top(app_enum_type, row) {
            let message = '';
            if (row.is_top) {
                message = '您确定所选记录 设为置顶？';
            } else {
                message = '您确定所选记录 设为置顶？';
            }

            setTimeout(() => {
                row.is_top = !row.is_top;
            }, 10);

            this.$confirm(message, '系统提示').then(() => {
                let data = {
                    id: row.id,
                    is_top: !row.is_top
                };

                let api_action = app_enum_type + '_update_is_top';

                //操作数据
                this.submit_data(api_action, data).then(result => {
                    if (result.error_code === action_code.api_success) {
                        this.show_success_message('操作成功');
                        row.is_top = !row.is_top;
                    }
                });
            }).catch(error => {
            });
        },
        /**
         * 后台 更新 是否 置顶
         * @param id
         * @param is_top
         */
        admin_update_is_top(id, is_top) {
            this.base_update_is_top(app_enum.admin.enum_type, id, is_top);
        },
        /**
         * 站点 更新 是否 置顶
         * @param id
         * @param is_top
         */
        site_update_is_top(id, is_top) {
            this.base_update_is_top(app_enum.site.enum_type, id, is_top);
        },
        /**
         * 会员 更新 是否 置顶
         * @param id
         * @param is_top
         */
        user_update_is_top(id, is_top) {
            this.base_update_is_top(app_enum.user.enum_type, id, is_top);
        },
        /**
         * 基础 更新 是否 首页显示
         * @param app_enum_type
         * @param row
         */
        base_update_is_index(app_enum_type, row) {
            let message = '';
            if (row.is_index) {
                message = '您确定所选记录 设为首页显示？';
            } else {
                message = '您确定所选记录 设为首页显示？';
            }

            setTimeout(() => {
                row.is_index = !row.is_index;
            }, 10);

            this.$confirm(message, '系统提示').then(() => {
                let data = {
                    id: row.id,
                    is_index: !row.is_index
                };

                let api_action = app_enum_type + '_update_is_index';

                //操作数据
                this.submit_data(api_action, data).then(result => {
                    if (result.error_code === action_code.api_success) {
                        this.show_success_message('操作成功');
                        row.is_index = !row.is_index;
                    }
                });
            }).catch(error => {
            });
        },
        /**
         * 后台 更新 是否 首页显示
         * @param id
         * @param is_index
         */
        admin_update_is_index(id, is_index) {
            this.base_update_is_index(app_enum.admin.enum_type, id, is_index);
        },
        /**
         * 站点 更新 是否 首页显示
         * @param id
         * @param is_index
         */
        site_update_is_index(id, is_index) {
            this.base_update_is_index(app_enum.site.enum_type, id, is_index);
        },
        /**
         * 会员 更新 是否 首页显示
         * @param id
         * @param is_index
         */
        user_update_is_index(id, is_index) {
            this.base_update_is_index(app_enum.user.enum_type, id, is_index);
        },
        /**
         * 基础 更新 是否 默认
         * @param app_enum_type
         * @param row
         */
        base_update_is_default(app_enum_type, row) {
            let message = '';
            if (row.is_default) {
                message = '您确定所选记录 设为默认？';
            } else {
                message = '您确定所选记录 设为默认？';
            }

            setTimeout(() => {
                row.is_default = !row.is_default;
            }, 10);

            this.$confirm(message, '系统提示').then(() => {
                let data = {
                    id: row.id,
                    is_default: !row.is_default
                };

                let api_action = app_enum_type + '_update_is_default';

                //操作数据
                this.submit_data(api_action, data).then(result => {
                    if (result.error_code === action_code.api_success) {
                        this.show_success_message('操作成功');
                        row.is_default = !row.is_default;
                    }
                });
            }).catch(error => {
            });
        },
        /**
         * 后台 更新 是否 默认
         * @param id
         * @param is_default
         */
        admin_update_is_default(id, is_default) {
            this.base_update_is_default(app_enum.admin.enum_type, id, is_default);
        },
        /**
         * 站点 更新 是否 默认
         * @param id
         * @param is_default
         */
        site_update_is_default(id, is_default) {
            this.base_update_is_default(app_enum.site.enum_type, id, is_default);
        },
        /**
         * 会员 更新 是否 默认
         * @param id
         * @param is_default
         */
        user_update_is_default(id, is_default) {
            this.base_update_is_default(app_enum.user.enum_type, id, is_default);
        },
        /**
         * 后台 保存 站点数据
         */
        admin_save_siter_data() {
            this.base_save_data(app_enum.admin.enum_type, 'admin_save_siter_data');
        },
        /**
         * 保存系统设置
         */
        save_config() {
            this.base_save_data('', 'save_config');
        }
    }
});