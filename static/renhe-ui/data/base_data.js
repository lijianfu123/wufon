/**
 * 基础 - 数据
 * @param api_controller
 * @param extend_data_object
 * @returns {}
 */
let base_data = (api_controller, extend_data_object = {}) => {
    let base_data_object = {
        /**
         * 获取 枚举 列表
         * @returns {{api_controller: *, api_action: string}}
         */
        get_enum_tree() {
            return {
                api_controller: api_controller,
                api_action: 'get_enum_tree'
            }
        },
        /**
         * 获取 枚举 列表
         * @returns {{api_controller: *, api_action: string}}
         */
        get_enum_list() {
            return {
                api_controller: api_controller,
                api_action: 'get_enum_list'
            }
        },
        /**
         * 获取 枚举 option
         * @returns {{api_controller: *, api_action: string}}
         */
        get_enum_option() {
            return {
                api_controller: api_controller,
                api_action: 'get_enum_option'
            }
        },
        /**
         * 获取 搜索 默认 数据
         * @returns {{api_controller: *, api_action: string}}
         */
        get_search_default_data(){
            return {
                api_controller: api_controller,
                api_action: 'get_search_default_data'
            }
        },
        /**
         * 任意 列表
         * @returns {{api_controller: *, api_action: string}}
         */
        get_any_list() {
            return {
                api_controller: api_controller,
                api_action: 'get_any_list'
            }
        },
        get_site_any_list() {
            return {
                api_controller: api_controller,
                api_action: 'get_site_any_list'
            }
        },
        get_user_any_list() {
            return {
                api_controller: api_controller,
                api_action: 'get_user_any_list'
            }
        },
        /**
         * 任意 tree 列表
         * @returns {{api_controller: *, api_action: string}}
         */
        get_any_tree_list() {
            return {
                api_controller: api_controller,
                api_action: 'get_any_tree_list'
            }
        },
        get_any_first_level_tree_list() {
            return {
                api_controller: api_controller,
                api_action: 'get_any_first_level_tree_list'
            }
        },
        get_site_any_tree_list() {
            return {
                api_controller: api_controller,
                api_action: 'get_site_any_tree_list'
            }
        },
        get_user_any_tree_list() {
            return {
                api_controller: api_controller,
                api_action: 'get_user_any_tree_list'
            }
        },
        /**
         * 任意 分页
         * @returns {{api_controller: *, api_action: string}}
         */
        get_any_page() {
            return {
                api_controller: api_controller,
                api_action: 'get_any_page'
            }
        },
        get_site_any_page() {
            return {
                api_controller: api_controller,
                api_action: 'get_site_any_page'
            }
        },
        get_user_any_page() {
            return {
                api_controller: api_controller,
                api_action: 'get_user_any_page'
            }
        },
        /**
         * 任意数据
         * @param id
         * @returns {{api_controller: *, api_action: string, id: number}}
         */
        get_any_detail(id = 0) {
            return {
                id: id,
                api_controller: api_controller,
                api_action: 'get_any_detail'
            }
        },
        get_site_any_detail(id = 0) {
            return {
                id: id,
                api_controller: api_controller,
                api_action: 'get_site_any_detail'
            }
        },
        get_user_any_detail(id = 0) {
            return {
                id: id,
                api_controller: api_controller,
                api_action: 'get_user_any_detail'
            }
        },
        /**
         * 审核 列表
         * @returns {{api_controller: *, api_action: string}}
         */
        get_pass_list() {
            return {
                api_controller: api_controller,
                api_action: 'get_pass_list'
            }
        },
        get_site_pass_list() {
            return {
                api_controller: api_controller,
                api_action: 'get_site_pass_list'
            }
        },
        get_user_pass_list() {
            return {
                api_controller: api_controller,
                api_action: 'get_user_pass_list'
            }
        },
        /**
         * 审核 tree 列表
         * @returns {{api_controller: *, api_action: string}}
         */
        get_pass_tree_list() {
            return {
                api_controller: api_controller,
                api_action: 'get_pass_tree_list'
            }
        },
        get_site_pass_tree_list() {
            return {
                api_controller: api_controller,
                api_action: 'get_site_pass_tree_list'
            }
        },
        get_user_pass_tree_list() {
            return {
                api_controller: api_controller,
                api_action: 'get_user_pass_tree_list'
            }
        },
        /**
         * 审核 分页 列表
         * @returns {{api_controller: *, api_action: string}}
         */
        get_pass_page() {
            return {
                api_controller: api_controller,
                api_action: 'get_pass_page'
            }
        },
        get_site_pass_page() {
            return {
                api_controller: api_controller,
                api_action: 'get_site_pass_page'
            }
        },
        get_user_pass_page() {
            return {
                api_controller: api_controller,
                api_action: 'get_user_pass_page'
            }
        },
        /**
         * 审核 数据
         * @param id
         * @returns {{api_controller: *, api_action: string, id: number}}
         */
        get_pass_detail(id = 0) {
            return {
                id: id,
                api_controller: api_controller,
                api_action: 'get_pass_detail'
            }
        },
        get_site_pass_detail(id = 0) {
            return {
                id: id,
                api_controller: api_controller,
                api_action: 'get_site_pass_detail'
            }
        },
        get_user_pass_detail(id = 0) {
            return {
                id: id,
                api_controller: api_controller,
                api_action: 'get_user_pass_detail'
            }
        },
        /**
         * 审核 option
         * @returns {{api_controller: *, api_action: string}}
         */
        get_pass_option() {
            return {
                api_controller: api_controller,
                api_action: 'get_pass_option'
            }
        },
        get_site_pass_option() {
            return {
                api_controller: api_controller,
                api_action: 'get_site_pass_option'
            }
        },
        get_user_pass_option() {
            return {
                api_controller: api_controller,
                api_action: 'get_user_pass_option'
            }
        },
        /**
         * 获取 审核 第一层 option
         * @returns {{api_controller: *, api_action: string}}
         */
        get_pass_first_level_option() {
            return {
                api_controller: api_controller,
                api_action: 'get_pass_first_level_option'
            }
        },
        /**
         * 获取 站点 审核 第一层 option
         * @returns {{api_controller: *, api_action: string}}
         */
        get_site_pass_first_level_option() {
            return {
                api_controller: api_controller,
                api_action: 'get_site_pass_first_level_option'
            }
        },
        /**
         * 获取 用户 审核 第一层 option
         * @returns {{api_controller: *, api_action: string}}
         */
        get_user_pass_first_level_option() {
            return {
                api_controller: api_controller,
                api_action: 'get_user_pass_first_level_option'
            }
        },
        /**
         * 审核 tree
         * @returns {{api_controller: *, api_action: string}}
         */
        get_pass_tree() {
            return {
                api_controller: api_controller,
                api_action: 'get_pass_tree'
            }
        },
        get_site_pass_tree() {
            return {
                api_controller: api_controller,
                api_action: 'get_site_pass_tree'
            }
        },
        get_user_pass_tree() {
            return {
                api_controller: api_controller,
                api_action: 'get_user_pass_tree'
            }
        },
        /**
         * 审核 cascader
         * @returns {{api_controller: *, api_action: string}}
         */
        get_pass_cascader() {
            return {
                api_controller: api_controller,
                api_action: 'get_pass_cascader'
            }
        },
        get_site_pass_cascader() {
            return {
                api_controller: api_controller,
                api_action: 'get_site_pass_cascader'
            }
        },
        get_user_pass_cascader() {
            return {
                api_controller: api_controller,
                api_action: 'get_user_pass_cascader'
            }
        }
    };

    //合并 基础数据、扩展数据
    let extend_data_object_keys = Object.keys(extend_data_object);
    if(extend_data_object_keys.length > 0){
        extend_data_object_keys.forEach(value => {
            let object = {
                value: extend_data_object[value]
            };

            Object.defineProperty(base_data_object, value, object);
        });
    }

    return base_data_object;
};