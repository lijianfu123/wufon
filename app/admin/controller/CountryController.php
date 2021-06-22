<?php

namespace app\admin\controller;

use think\facade\Db;
use think\Request;
use app\common\model\CountryModel;

/**
 * 后台管理 > 国家
 * Class CountryController
 * @package app\admin\controller
 */
class CountryController extends BaseController
{
    private $CountryModel;

    /**
     * 构造方法
     * CountryController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->CountryModel = new CountryModel();
    }

    /**
     * 导入 国家数据
     * @return bool|int
     * @throws \Exception
     */
    public function import_country_data()
    {
        die();

        Db::execute('truncate ' . DB_PREFIX . $this->CountryModel->name); //清空数据

        $list = [];

        $country_json = $this->get_country_json();
        foreach ($country_json as $key => $country) {
            $list[$key] = [
                'is_pass' => 1,
                'sort' => $key + 1,
                'country_name' => $country['country_name'],
                'country_code' => $country['country_code']
            ];
        }

        $result = $this->CountryModel->insert_all_data($list);
        if ($result === false) {
            echo '操作失败';
        } else {
            echo '导入完成';
        }
    }

    /**
     * 获取 国家 jsong
     * @return mixed
     */
    private function get_country_json()
    {
        $str = '[  
            {"country_code": "CN", "en": "China", "country_name": "中国"},
            {"country_code": "US", "en": "United States of America (USA)", "country_name": "美国"},
            {"country_code": "AR", "en": "Argentina", "country_name": "阿根廷"},
            {"country_code": "AD", "en": "Andorra", "country_name": "安道尔"},
            {"country_code": "AE", "en": "United Arab Emirates", "country_name": "阿联酋"},
            {"country_code": "AF", "en": "Afghanistan", "country_name": "阿富汗"},
            {"country_code": "AG", "en": "Antigua & Barbuda", "country_name": "安提瓜和巴布达"},
            {"country_code": "AI", "en": "Anguilla", "country_name": "安圭拉"},
            {"country_code": "AL", "en": "Albania", "country_name": "阿尔巴尼亚"},
            {"country_code": "AM", "en": "Armenia", "country_name": "亚美尼亚"},
            {"country_code": "AO", "en": "Angola", "country_name": "安哥拉"},
            {"country_code": "AQ", "en": "Antarctica", "country_name": "南极洲"},
            {"country_code": "AS", "en": "American Samoa", "country_name": "美属萨摩亚"},
            {"country_code": "AT", "en": "Austria", "country_name": "奥地利"},
            {"country_code": "AU", "en": "Australia", "country_name": "澳大利亚"},
            {"country_code": "AW", "en": "Aruba", "country_name": "阿鲁巴"},
            {"country_code": "AX", "en": "Aland Island", "country_name": "奥兰群岛"},
            {"country_code": "AZ", "en": "Azerbaijan", "country_name": "阿塞拜疆"},
            {"country_code": "BA", "en": "Bosnia & Herzegovina", "country_name": "波黑"},
            {"country_code": "BB", "en": "Barbados", "country_name": "巴巴多斯"},
            {"country_code": "BD", "en": "Bangladesh", "country_name": "孟加拉"},
            {"country_code": "BE", "en": "Belgium", "country_name": "比利时"},
            {"country_code": "BF", "en": "Burkina", "country_name": "布基纳法索"},
            {"country_code": "BG", "en": "Bulgaria", "country_name": "保加利亚"},
            {"country_code": "BH", "en": "Bahrain", "country_name": "巴林"},
            {"country_code": "BI", "en": "Burundi", "country_name": "布隆迪"},
            {"country_code": "BJ", "en": "Benin", "country_name": "贝宁"},
            {"country_code": "BL", "en": "Saint Barthélemy", "country_name": "圣巴泰勒米岛"},
            {"country_code": "BM", "en": "Bermuda", "country_name": "百慕大"},
            {"country_code": "BN", "en": "Brunei", "country_name": "文莱"},
            {"country_code": "BO", "en": "Bolivia", "country_name": "玻利维亚"},
            {"country_code": "BQ", "en": "Caribbean Netherlands", "country_name": "荷兰加勒比区"},
            {"country_code": "BR", "en": "Brazil", "country_name": "巴西"},
            {"country_code": "BS", "en": "The Bahamas", "country_name": "巴哈马"},
            {"country_code": "BT", "en": "Bhutan", "country_name": "不丹"},
            {"country_code": "BV", "en": "Bouvet Island", "country_name": "布韦岛"},
            {"country_code": "BW", "en": "Botswana", "country_name": "博茨瓦纳"},
            {"country_code": "BY", "en": "Belarus", "country_name": "白俄罗斯"},
            {"country_code": "BZ", "en": "Belize", "country_name": "伯利兹"},
            {"country_code": "CA", "en": "Canada", "country_name": "加拿大"},
            {"country_code": "CC", "en": "Cocos (Keeling) Islands", "country_name": "科科斯群岛"},
            {"country_code": "CD", "en": "Democratic Republic of the Congo", "country_name": "刚果（金）"},
            {"country_code": "CF", "en": "Central African Republic", "country_name": "中非"},
            {"country_code": "CG", "en": "Republic of the Congo", "country_name": "刚果（布）"},
            {"country_code": "CH", "en": "Switzerland", "country_name": "瑞士"},
            {"country_code": "CI", "en": "Cote d Ivoire", "country_name": "科特迪瓦"},
            {"country_code": "CK", "en": "Cook Islands", "country_name": "库克群岛"},
            {"country_code": "CL", "en": "Chile", "country_name": "智利"},
            {"country_code": "CM", "en": "Cameroon", "country_name": "喀麦隆"},  
            {"country_code": "CO", "en": "Colombia", "country_name": "哥伦比亚"},
            {"country_code": "CR", "en": "Costa Rica", "country_name": "哥斯达黎加"},
            {"country_code": "CU", "en": "Cuba", "country_name": "古巴"},
            {"country_code": "CV", "en": "Cape Verde", "country_name": "佛得角"},
            {"country_code": "CW", "en": "Curacao", "country_name": "库拉索"},
            {"country_code": "CX", "en": "Christmas Island", "country_name": "圣诞岛"},
            {"country_code": "CY", "en": "Cyprus", "country_name": "塞浦路斯"},
            {"country_code": "CZ", "en": "Czech Republic", "country_name": "捷克"},
            {"country_code": "DE", "en": "Germany", "country_name": "德国"},
            {"country_code": "DJ", "en": "Djibouti", "country_name": "吉布提"},
            {"country_code": "DK", "en": "Denmark", "country_name": "丹麦"},
            {"country_code": "DM", "en": "Dominica", "country_name": "多米尼克"},
            {"country_code": "DO", "en": "Dominican Republic", "country_name": "多米尼加"},
            {"country_code": "DZ", "en": "Algeria", "country_name": "阿尔及利亚"},
            {"country_code": "EC", "en": "Ecuador", "country_name": "厄瓜多尔"},
            {"country_code": "EE", "en": "Estonia", "country_name": "爱沙尼亚"},
            {"country_code": "EG", "en": "Egypt", "country_name": "埃及"},
            {"country_code": "EH", "en": "Western Sahara", "country_name": "西撒哈拉"},
            {"country_code": "ER", "en": "Eritrea", "country_name": "厄立特里亚"},
            {"country_code": "ES", "en": "Spain", "country_name": "西班牙"},
            {"country_code": "ET", "en": "Ethiopia", "country_name": "埃塞俄比亚"},
            {"country_code": "FI", "en": "Finland", "country_name": "芬兰"},
            {"country_code": "FJ", "en": "Fiji", "country_name": "斐济群岛"},
            {"country_code": "FK", "en": "Falkland Islands", "country_name": "马尔维纳斯群岛（福克兰）" },
            {"country_code": "FM", "en": "Federated States of Micronesia", "country_name": "密克罗尼西亚联邦"},
            {"country_code": "FO", "en": "Faroe Islands", "country_name": "法罗群岛"},
            {"country_code": "FR", "en": "France", "country_name": "法国 法国"},
            {"country_code": "GA", "en": "Gabon", "country_name": "加蓬"},
            {"country_code": "GB", "en": "Great Britain (United Kingdom; England)", "country_name": "英国"},
            {"country_code": "GD", "en": "Grenada", "country_name": "格林纳达"},
            {"country_code": "GE", "en": "Georgia", "country_name": "格鲁吉亚"},
            {"country_code": "GF", "en": "French Guiana", "country_name": "法属圭亚那"},
            {"country_code": "GG", "en": "Guernsey", "country_name": "根西岛"},
            {"country_code": "GH", "en": "Ghana", "country_name": "加纳"},
            {"country_code": "GI", "en": "Gibraltar", "country_name": "直布罗陀"},
            {"country_code": "GL", "en": "Greenland", "country_name": "格陵兰"},
            {"country_code": "GM", "en": "Gambia", "country_name": "冈比亚"},
            {"country_code": "GN", "en": "Guinea", "country_name": "几内亚"},
            {"country_code": "GP", "en": "Guadeloupe", "country_name": "瓜德罗普"},
            {"country_code": "GQ", "en": "Equatorial Guinea", "country_name": "赤道几内亚"},
            {"country_code": "GR", "en": "Greece", "country_name": "希腊"},
            {"country_code": "GS", "en": "South Georgia and the South Sandwich Islands", "country_name": "南乔治亚岛和南桑威奇群岛"},
            {"country_code": "GT", "en": "Guatemala", "country_name": "危地马拉"},
            {"country_code": "GU", "en": "Guam", "country_name": "关岛"},
            {"country_code": "GW", "en": "Guinea-Bissau", "country_name": "几内亚比绍"},
            {"country_code": "GY", "en": "Guyana", "country_name": "圭亚那"},
            {"country_code": "HM", "en": "Heard Island and McDonald Islands", "country_name": "赫德岛和麦克唐纳群岛"},
            {"country_code": "HN", "en": "Honduras", "country_name": "洪都拉斯"},
            {"country_code": "HR", "en": "Croatia", "country_name": "克罗地亚"},
            {"country_code": "HT", "en": "Haiti", "country_name": "海地"},
            {"country_code": "HU", "en": "Hungary", "country_name": "匈牙利"},
            {"country_code": "ID", "en": "Indonesia", "country_name": "印尼"},
            {"country_code": "IE", "en": "Ireland", "country_name": "爱尔兰"},
            {"country_code": "IL", "en": "Israel", "country_name": "以色列"},
            {"country_code": "IM", "en": "Isle of Man", "country_name": "马恩岛"},
            {"country_code": "IN", "en": "India", "country_name": "印度"},
            {"country_code": "IO", "en": "British Indian Ocean Territory", "country_name": "英属印度洋领地"},
            {"country_code": "IQ", "en": "Iraq", "country_name": "伊拉克"},
            {"country_code": "IR", "en": "Iran", "country_name": "伊朗"},
            {"country_code": "IS", "en": "Iceland", "country_name": "冰岛"},
            {"country_code": "IT", "en": "Italy", "country_name": "意大利"},
            {"country_code": "JE", "en": "Jersey", "country_name": "泽西岛"},
            {"country_code": "JM", "en": "Jamaica", "country_name": "牙买加"},
            {"country_code": "JO", "en": "Jordan", "country_name": "约旦"},
            {"country_code": "JP", "en": "Japan", "country_name": "日本"},
            {"country_code": "KE", "en": "Kenya", "country_name": "肯尼亚"},
            {"country_code": "KG", "en": "Kyrgyzstan", "country_name": "吉尔吉斯斯坦"},
            {"country_code": "KH", "en": "Cambodia", "country_name": "柬埔寨"},
            {"country_code": "KI", "en": "Kiribati", "country_name": "基里巴斯"},
            {"country_code": "KM", "en": "The Comoros", "country_name": "科摩罗"},
            {"country_code": "KN", "en": "St. Kitts & Nevis", "country_name": "圣基茨和尼维斯"},
            {"country_code": "KP", "en": "North Korea", "country_name": "朝鲜"},
            {"country_code": "KR", "en": "South Korea", "country_name": "韩国"},
            {"country_code": "KW", "en": "Kuwait", "country_name": "科威特"},
            {"country_code": "KY", "en": "Cayman Islands", "country_name": "开曼群岛"},
            {"country_code": "KZ", "en": "Kazakhstan", "country_name": "哈萨克斯坦"},
            {"country_code": "LA", "en": "Laos", "country_name": "老挝"},
            {"country_code": "LB", "en": "Lebanon", "country_name": "黎巴嫩"},
            {"country_code": "LC", "en": "St. Lucia", "country_name": "圣卢西亚"},
            {"country_code": "LI", "en": "Liechtenstein", "country_name": "列支敦士登"},
            {"country_code": "LK", "en": "Sri Lanka", "country_name": "斯里兰卡"},
            {"country_code": "LR", "en": "Liberia", "country_name": "利比里亚"},
            {"country_code": "LS", "en": "Lesotho", "country_name": "莱索托"},
            {"country_code": "LT", "en": "Lithuania", "country_name": "立陶宛"},
            {"country_code": "LU", "en": "Luxembourg", "country_name": "卢森堡"},
            {"country_code": "LV", "en": "Latvia", "country_name": "拉脱维亚"},
            {"country_code": "LY", "en": "Libya", "country_name": "利比亚"},
            {"country_code": "MA", "en": "Morocco", "country_name": "摩洛哥"},
            {"country_code": "MC", "en": "Monaco", "country_name": "摩纳哥"},
            {"country_code": "MD", "en": "Moldova", "country_name": "摩尔多瓦"},
            {"country_code": "ME", "en": "Montenegro", "country_name": "黑山"},
            {"country_code": "MF", "en": "Saint Martin (France)", "country_name": "法属圣马丁"},
            {"country_code": "MG", "en": "Madagascar", "country_name": "马达加斯加"},
            {"country_code": "MH", "en": "Marshall islands", "country_name": "马绍尔群岛"},
            {"country_code": "MK", "en": "Republic of Macedonia (FYROM)", "country_name": "马其顿"},
            {"country_code": "ML", "en": "Mali", "country_name": "马里"},
            {"country_code": "MM", "en": "Myanmar (Burma)", "country_name": "缅甸"},
            {"country_code": "MN", "en": "Mongolia", "country_name": "蒙古国"},
            {"country_code": "MP", "en": "Northern Mariana Islands", "country_name": "北马里亚纳群岛"},
            {"country_code": "MQ", "en": "Martinique", "country_name": "马提尼克"},
            {"country_code": "MR", "en": "Mauritania", "country_name": "毛里塔尼亚"},
            {"country_code": "MS", "en": "Montserrat", "country_name": "蒙塞拉特岛"},
            {"country_code": "MT", "en": "Malta", "country_name": "马耳他"},
            {"country_code": "MU", "en": "Mauritius", "country_name": "毛里求斯"},
            {"country_code": "MV", "en": "Maldives", "country_name": "马尔代夫"},
            {"country_code": "MW", "en": "Malawi", "country_name": "马拉维"},
            {"country_code": "MX", "en": "Mexico", "country_name": "墨西哥"},
            {"country_code": "MY", "en": "Malaysia", "country_name": "马来西亚"},
            {"country_code": "MZ", "en": "Mozambique", "country_name": "莫桑比克"},
            {"country_code": "NA", "en": "Namibia", "country_name": "纳米比亚"},
            {"country_code": "NC", "en": "New Caledonia", "country_name": "新喀里多尼亚"},
            {"country_code": "NE", "en": "Niger", "country_name": "尼日尔"},
            {"country_code": "NF", "en": "Norfolk Island", "country_name": "诺福克岛"},
            {"country_code": "NG", "en": "Nigeria", "country_name": "尼日利亚"},
            {"country_code": "NI", "en": "Nicaragua", "country_name": "尼加拉瓜"},
            {"country_code": "NL", "en": "Netherlands", "country_name": "荷兰"},
            {"country_code": "NO", "en": "Norway", "country_name": "挪威"},
            {"country_code": "NP", "en": "Nepal", "country_name": "尼泊尔"},
            {"country_code": "NR", "en": "Nauru", "country_name": "瑙鲁"},
            {"country_code": "NU", "en": "Niue", "country_name": "纽埃"},
            {"country_code": "NZ", "en": "New Zealand", "country_name": "新西兰"},
            {"country_code": "OM", "en": "Oman", "country_name": "阿曼"},
            {"country_code": "PA", "en": "Panama", "country_name": "巴拿马"},
            {"country_code": "PE", "en": "Peru", "country_name": "秘鲁"},
            {"country_code": "PF", "en": "French polynesia", "country_name": "法属波利尼西亚"},
            {"country_code": "PG", "en": "Papua New Guinea", "country_name": "巴布亚新几内亚"},
            {"country_code": "PH", "en": "The Philippines", "country_name": "菲律宾"},
            {"country_code": "PK", "en": "Pakistan", "country_name": "巴基斯坦"},
            {"country_code": "PL", "en": "Poland", "country_name": "波兰"},
            {"country_code": "PM", "en": "Saint-Pierre and Miquelon", "country_name": "圣皮埃尔和密克隆"},
            {"country_code": "PN", "en": "Pitcairn Islands", "country_name": "皮特凯恩群岛"},
            {"country_code": "PR", "en": "Puerto Rico", "country_name": "波多黎各"},
            {"country_code": "PS", "en": "Palestinian territories", "country_name": "巴勒斯坦"},
            {"country_code": "PT", "en": "Portugal", "country_name": "葡萄牙"},
            {"country_code": "PW", "en": "Palau", "country_name": "帕劳"},
            {"country_code": "PY", "en": "Paraguay", "country_name": "巴拉圭"},
            {"country_code": "QA", "en": "Qatar", "country_name": "卡塔尔"},
            {"country_code": "RE", "en": "Réunion", "country_name": "留尼汪"},
            {"country_code": "RO", "en": "Romania", "country_name": "罗马尼亚"},
            {"country_code": "RS", "en": "Serbia", "country_name": "塞尔维亚"},
            {"country_code": "RU", "en": "Russian Federation", "country_name": "俄罗斯"},
            {"country_code": "RW", "en": "Rwanda", "country_name": "卢旺达"},
            {"country_code": "SA", "en": "Saudi Arabia", "country_name": "沙特阿拉伯"},
            {"country_code": "SB", "en": "Solomon Islands", "country_name": "所罗门群岛"},
            {"country_code": "SC", "en": "Seychelles", "country_name": "塞舌尔"},
            {"country_code": "SD", "en": "Sudan", "country_name": "苏丹"},
            {"country_code": "SE", "en": "Sweden", "country_name": "瑞典"},
            {"country_code": "SG", "en": "Singapore", "country_name": "新加坡"},
            {"country_code": "SH", "en": "St. Helena & Dependencies", "country_name": "圣赫勒拿"},
            {"country_code": "SI", "en": "Slovenia", "country_name": "斯洛文尼亚"},
            {"country_code": "SJ", "en": "Svalbard and Jan Mayen", "country_name": "斯瓦尔巴群岛和扬马延岛"},
            {"country_code": "SK", "en": "Slovakia", "country_name": "斯洛伐克"},
            {"country_code": "SL", "en": "Sierra Leone", "country_name": "塞拉利昂"},
            {"country_code": "SM", "en": "San Marino", "country_name": "圣马力诺"},
            {"country_code": "SN", "en": "Senegal", "country_name": "塞内加尔"},
            {"country_code": "SO", "en": "Somalia", "country_name": "索马里"},
            {"country_code": "SR", "en": "Suriname", "country_name": "苏里南"},
            {"country_code": "SS", "en": "South Sudan", "country_name": "南苏丹"},
            {"country_code": "ST", "en": "Sao Tome & Principe", "country_name": "圣多美和普林西比"},
            {"country_code": "SV", "en": "El Salvador", "country_name": "萨尔瓦多"},
            {"country_code": "SX", "en": "Sint Maarten", "country_name": "荷属圣马丁"},
            {"country_code": "SY", "en": "Syria", "country_name": "叙利亚"},
            {"country_code": "SZ", "en": "Swaziland", "country_name": "斯威士兰"},
            {"country_code": "TC", "en": "Turks & Caicos Islands", "country_name": "特克斯和凯科斯群岛"},
            {"country_code": "TD", "en": "Chad", "country_name": "乍得"},
            {"country_code": "TF", "en": "French Southern Territories", "country_name": "法属南部领地"},
            {"country_code": "TG", "en": "Togo", "country_name": "多哥"},
            {"country_code": "TH", "en": "Thailand", "country_name": "泰国"},
            {"country_code": "TJ", "en": "Tajikistan", "country_name": "塔吉克斯坦"},
            {"country_code": "TK", "en": "Tokelau", "country_name": "托克劳"},
            {"country_code": "TL", "en": "Timor-Leste (East Timor)", "country_name": "东帝汶"},
            {"country_code": "TM", "en": "Turkmenistan", "country_name": "土库曼斯坦"},
            {"country_code": "TN", "en": "Tunisia", "country_name": "突尼斯"},
            {"country_code": "TO", "en": "Tonga", "country_name": "汤加"},
            {"country_code": "TR", "en": "Turkey", "country_name": "土耳其"},
            {"country_code": "TT", "en": "Trinidad & Tobago", "country_name": "特立尼达和多巴哥"},
            {"country_code": "TV", "en": "Tuvalu", "country_name": "图瓦卢"},
            {"country_code": "TZ", "en": "Tanzania", "country_name": "坦桑尼亚"},
            {"country_code": "UA", "en": "Ukraine", "country_name": "乌克兰"},
            {"country_code": "UG", "en": "Uganda", "country_name": "乌干达"},
            {"country_code": "UM", "en": "United States Minor Outlying Islands", "country_name": "美国本土外小岛屿"},
            {"country_code": "UY", "en": "Uruguay", "country_name": "乌拉圭"},
            {"country_code": "UZ", "en": "Uzbekistan", "country_name": "乌兹别克斯坦"},
            {"country_code": "VA", "en": "Vatican City (The Holy See)", "country_name": "梵蒂冈"},
            {"country_code": "VC", "en": "St. Vincent & the Grenadines", "country_name": "圣文森特和格林纳丁斯"},
            {"country_code": "VE", "en": "Venezuela", "country_name": "委内瑞拉"},
            {"country_code": "VG", "en": "British Virgin Islands", "country_name": "英属维尔京群岛"},
            {"country_code": "VI", "en": "United States Virgin Islands", "country_name": "美属维尔京群岛"},
            {"country_code": "VN", "en": "Vietnam", "country_name": "越南"},
            {"country_code": "VU", "en": "Vanuatu", "country_name": "瓦努阿图"},
            {"country_code": "WF", "en": "Wallis and Futuna", "country_name": "瓦利斯和富图纳"},
            {"country_code": "WS", "en": "Samoa", "country_name": "萨摩亚"},
            {"country_code": "YE", "en": "Yemen", "country_name": "也门"},
            {"country_code": "YT", "en": "Mayotte", "country_name": "马约特"},
            {"country_code": "ZA", "en": "South Africa", "country_name": "南非"},
            {"country_code": "ZM", "en": "Zambia", "country_name": "赞比亚"},
            {"country_code": "ZW", "en": "Zimbabwe", "country_name": "津巴布韦"}
        ]';

        $json = json_decode($str, true);

        return $json;
    }
}