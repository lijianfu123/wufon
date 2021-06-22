/**
 * 操作码
 * @type {{api_success: number, request_success: number, upload_success: string}}
 */
const action_code = {
    api_success: 0, //api 操作成功
    upload_success: 'success', //上传成功
    request_success: 200, //http 请求成功
};

/**
 * 应用类型 枚举
 * @type {{site: {enum_name: string, enum_type: string, enum_number: number}, index: {enum_name: string, enum_type: string, enum_number: number}, admin: {enum_name: string, enum_type: string, enum_number: number}, api: {enum_name: string, enum_type: string, enum_number: number}, user: {enum_name: string, enum_type: string, enum_number: number}}}
 */
const app_enum = {
    index: {enum_number: 1, enum_name: '前台', enum_type: 'index'},
    api: {enum_number: 2, enum_name: 'api 接口', enum_type: 'api'},
    admin: {enum_number: 3, enum_name: '后台', enum_type: 'admin'},
    site: {enum_number: 4, enum_name: '站点', enum_type: 'site'}, //站点、网点、事权单位
    user: {enum_number: 5, enum_name: '会员', enum_type: 'user'}
};

/**
 * api 控制器
 * @type {string}
 */
//通用
let sex_enum_controller = 'SexEnum'; //性别 枚举 控制器
let nation_enum_controller = 'NationEnum'; //民族 枚举 控制器
let marriage_enum_controller = 'MarriageEnum'; //婚姻状况 枚举 控制器
let political_enum_controller = 'PoliticalEnum'; //政治面貌 枚举 控制器

let config_controller = 'Config'; //系统设置 控制器
let country_controller = 'Country'; //国家 控制器
let city_controller = 'City'; //省/市/县 控制器
let role_controller = 'Role'; //角色 控制器
let role_rule_controller = 'RoleRule'; //权限规则 控制器
let admin_controller = 'Admin'; //后台管理员 控制器
let user_controller = 'User'; //用户 控制器
let notice_controller = 'Notice'; //通知公告 控制器
let swiper_controller = 'Swiper'; //幻灯片 控制器
//当前系统 特有
let order_state_controller = 'OrderStateEnum'; //订单状态 枚举 控制器
let address_controller = 'Address'; //收货地址 控制器
let user_level_controller = 'UserLevel'; //会员级别 控制器
let intro_controller = 'Intro'; //单页面 控制器
let link_controller = 'Link'; //友情链接 控制器
let news_class_controller = 'NewsClass'; //新闻分类 控制器
let news_controller = 'News'; //新闻 控制器
let product_class_controller = 'ProductClass'; //商品分类 控制器
let product_controller = 'Product'; //商品 控制器
let download_class_controller = 'DownloadClass'; //下载分类 控制器
let download_controller = 'Download'; //下载 控制器
let order_controller = 'Order'; //订单 控制器
let express_controller = 'Express'; //快递 控制器
let bank_controller = 'Bank'; //银行 控制器
let color_controller = 'Color'; //颜色 控制器
let author_controller = 'Author'; //作者 控制器
let people_controller = 'People'; //适用人群 控制器
let pack_controller = 'Pack'; //包装单位 控制器
let source_controller = 'Source'; //来源 控制器
let spec_controller = 'Spec'; //规格 控制器
let ad_controller = 'Ad'; //广告 控制器
let award_controller = 'Award'; //佣金 控制器
let discount_plan_controller = 'DiscountPlan'; //优惠套餐 控制器
let point_controller = 'Point'; //积分 控制器
let recharge_controller = 'Recharge'; //充值 控制器
let withdraw_controller = 'Withdraw'; //提现 控制器
let recharge_plan_controller = 'RechargePlan'; //充值套餐 控制器
let site_controller = 'Site'; //站点 控制器
let siter_controller = 'Siter'; //站点管理员 控制器