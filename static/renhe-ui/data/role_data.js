/**
 * 角色 - 数据
 */
let role_data = base_data(role_controller, {
    get_admin_app_any_list() {
        return {
            api_controller: role_controller,
            api_action: 'get_admin_app_any_list'
        }
    },
    get_admin_app_pass_option() {
        return {
            api_controller: role_controller,
            api_action: 'get_admin_app_pass_option'
        }
    },
    get_site_app_any_list() {
        return {
            api_controller: role_controller,
            api_action: 'get_site_app_any_list'
        }
    },
    get_site_app_pass_option() {
        return {
            api_controller: role_controller,
            api_action: 'get_site_app_pass_option'
        }
    },
    get_user_app_any_list() {
        return {
            api_controller: role_controller,
            api_action: 'get_user_app_any_list'
        }
    },
    get_user_app_pass_option() {
        return {
            api_controller: role_controller,
            api_action: 'get_user_app_pass_option'
        }
    },
});