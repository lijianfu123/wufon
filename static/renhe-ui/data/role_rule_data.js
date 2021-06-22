/**
 * 权限规则 - 数据
 */
let role_rule_data = base_data(role_rule_controller, {
    /**
     * 面包屑
     * @returns {{api_controller: string, api_action: string}}
     */
    get_breadcrumb() {
        return {
            api_controller: role_rule_controller,
            api_action: 'get_breadcrumb'
        }
    },
    /**
     * 获取 基础 应用 任意 tree 列表
     * @param app_enum_type
     * @returns {{api_controller: string, api_action: string}}
     */
    get_base_app_any_tree_list(app_enum_type) {
        return {
            api_controller: role_rule_controller,
            api_action: 'get_' + app_enum_type + '_app_any_tree_list'
        }
    },
    /**
     * 获取 后台 应用 任意 tree 列表
     * @returns {*|{api_controller: string, api_action: string}}
     */
    get_admin_app_any_tree_list() {
        return this.get_base_app_any_tree_list(app_enum.admin.enum_type);
    },
    /**
     * 获取 站点 应用 任意 tree 列表
     * @returns {*|{api_controller: string, api_action: string}}
     */
    get_site_app_any_tree_list() {
        return this.get_base_app_any_tree_list(app_enum.site.enum_type);
    },
    /**
     * 获取 会员 应用 任意 tree 列表
     * @returns {*|{api_controller: string, api_action: string}}
     */
    get_user_app_any_tree_list() {
        return this.get_base_app_any_tree_list(app_enum.user.enum_type);
    },
    /**
     * 获取 基础 应用 审核 tree
     * @param app_enum_type
     * @returns {{api_controller: string, api_action: string}}
     */
    get_base_app_pass_tree(app_enum_type) {
        return {
            api_controller: role_rule_controller,
            api_action: 'get_' + app_enum_type + '_app_pass_tree'
        }
    },
    /**
     * 获取 后台 应用 审核 tree
     * @returns {*|{api_controller: string, api_action: string}}
     */
    get_admin_app_pass_tree() {
        return this.get_base_app_pass_tree(app_enum.admin.enum_type);
    },
    /**
     * 获取 站点 应用 审核 tree
     * @returns {*|{api_controller: string, api_action: string}}
     */
    get_site_app_pass_tree() {
        return this.get_base_app_pass_tree(app_enum.site.enum_type);
    },
    /**
     * 获取 会员 应用 审核 tree
     * @returns {*|{api_controller: string, api_action: string}}
     */
    get_user_app_pass_tree() {
        return this.get_base_app_pass_tree(app_enum.user.enum_type);
    },
    /**
     * 获取 基础 应用 审核 option
     * @param app_enum_type
     * @returns {{api_controller: string, api_action: string}}
     */
    get_base_app_pass_option(app_enum_type) {
        return {
            api_controller: role_rule_controller,
            api_action: 'get_' + app_enum_type + '_app_pass_option'
        }
    },
    /**
     * 获取 后台 基础 应用 审核 option
     * @returns {*|{api_controller: string, api_action: string}}
     */
    get_admin_app_pass_option() {
        return this.get_base_app_pass_option(app_enum.admin.enum_type);
    },
    /**
     * 获取 站点 应用 审核 option
     * @returns {*|{api_controller: string, api_action: string}}
     */
    get_site_app_pass_option() {
        return this.get_base_app_pass_option(app_enum.site.enum_type);
    },
    /**
     * 获取 会员 应用 审核 option
     * @returns {*|{api_controller: string, api_action: string}}
     */
    get_user_app_pass_option() {
        return this.get_base_app_pass_option(app_enum.user.enum_type);
    }
});