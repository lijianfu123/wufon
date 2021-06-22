<?php /*a:4:{s:79:"D:\ruanjian\phpstudy_pro\WWW\project\ankerui\app\index\pc_view\index\index.html";i:1624345257;s:74:"D:\ruanjian\phpstudy_pro\WWW\project\ankerui\app\index\pc_view\layout.html";i:1624345948;s:74:"D:\ruanjian\phpstudy_pro\WWW\project\ankerui\app\index\pc_view\header.html";i:1624345021;s:74:"D:\ruanjian\phpstudy_pro\WWW\project\ankerui\app\index\pc_view\footer.html";i:1624345853;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlentities($main_detail['title']); ?></title>
    <meta name="keywords" content="<?php echo htmlentities($main_detail['keywords']); ?>">
    <meta name="description" content="<?php echo htmlentities($main_detail['description']); ?>">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no" />

<!--     <script>
        var STATIC_URL = "https://www.aupu.net/web/static/";
        var GLOBAL_URL = "https://www.aupu.net/";
        var UPLOAD_URL = "https://www.aupu.net/web/upload/";
        var SITE_URL   = "https://www.aupu.net/";
    </script> -->
    <link rel="stylesheet" href="/app/index/pc_view/css/reset.css" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="/app/index/pc_view/css/style.min.css" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="/app/index/pc_view/css/iconfont.css" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="/app/index/pc_view/css/animate.css" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="/app/index/pc_view/css/swiper.css" type="text/css" media="screen" charset="utf-8">

    <script src="/app/index/pc_view/js/jQuery.js" type="text/javascript" charset="utf-8"></script>
    <script src="/app/index/pc_view/js/jquery.easing.1.3.js" type="text/javascript" charset="utf-8"></script>
    <script src="/app/index/pc_view/js/prefixfree.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/app/index/pc_view/js/html5.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/app/index/pc_view/js/wow.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/app/index/pc_view/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>


    <style>
        /*分页栏*/
        .page_bar {text-align: center; width: 100%;}
            .page_bar table {margin: auto;}
            .page_bar table td a {display: block; width: 30px; height: 30px; line-height: 30px; text-align: center; margin-right: 5px; border: 1px solid #05A25F; cursor: pointer;}
            .page_bar table td a:hover {background: #05A25F; color: white;}
            .page_bar table td .active {background: #05A25F; color: white;}

        .nav-ul li {
            position: relative;
        }

        /* 2020年3月30日 09:40:14 修改 */
        .nav-ul li:nth-child(2):hover ul {
            display: block;
            flex: 0 0 99.3%;
            margin-bottom: 30px;
            margin-top: 15px;
        }

        .nav-ul li:nth-child(6) .hide-nav ul {
            display: flex !important;
            flex-wrap: wrap;
        }

        .nav-ul li:nth-child(6) .hide-nav ul h3 {
            font-size: 16px;
            margin-bottom: 18px;
            margin-left: 21px;
        }

        .nav-ul li:nth-child(6):hover ul {
            display: block;
            flex: 0 0 99.3%;
            margin-bottom: 30px;
            margin-top: 15px;
        }

        .nav-ul li ul:nth-child(2) li,
        .nav-ul li ul:nth-child(6) li {
            font-size: 15px;
            cursor: pointer;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .nav-ul li:hover .hide-nav {
            display: block !important;
        }

        .nav-ul li:nth-child(4):hover .hide-nav {
            display: block !important;
        }

        .nav-ul li:nth-child(5):hover .hide-nav {
            display: block !important;
        }
        /* 修改结束 */
    </style>

    <script>
        /**
         * 设置 导航
         */
        function set_nav(n) {
            $('.nav-ul').find('a').eq(n).addClass('select');
        }

        /**
         * 切换标签
         * @param n
         */
        function set_tab(n) {
            $('.switch_tab').find('li').removeClass('switchCheck');
            $('.switch_tab').find('li').eq(n).addClass('switchCheck');

            $('.tab_content').find('li').hide();
            $('.tab_content').find('li').eq(n).show();
        }
    </script>
</head>

<body>
<?php 
$solution_id = (new app\common\model\NewsModel())->where("first_news_class_id = 1")->order('sort asc, id desc')->value('id'); //解决方案 id
$cloud_id = (new app\common\model\NewsModel())->where("first_news_class_id = 2")->order('sort asc, id desc')->value('id'); //云平台 id
 ?>


<style>
    img{
        max-width:100%;
    }
</style>

<div class="header">
    <div class="header_cen w1400 f-cb">
        <a href="https://www.aupu.net/" class="bocweb-logo logo">
            <img src="https://www.aupu.net/web/static/web/img/logo.png" alt="">
        </a>
        <div class="push-line">
            <span class="line-1"></span>
            <span class="line-2"></span>
            <span class="line-3"></span>
        </div>
        <div class="btn online">
            <img src="https://www.aupu.net/web/static/web/img/icon-contact.png" alt="">
        </div>
        <div class="search search-btn">
            <img src="https://www.aupu.net/web/static/web/img/icon-search.png" alt="">
        </div>
        <div class="nav">
            <ul>
                <li><a href="https://www.aupu.net/" class="a">首页</a></li>
                <li class="proNav">
                    <a href="javascript:;" class="a">产品中心</a>
                    <div class="mqNav cpNav">
                        <div class="inner w1400">
                            <div class="nav2">
                                <ul class="prod-sub-nav-wrap">
                                    <li class="active">
                                        <a href="http://www.aupu.net/product/22.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/06/12/15603053411286k5lx9.png" alt="">
                                            </div>
                                            <p>奥普浴霸</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.aupu.net/product/23.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/04/23/15559683559977sxbr0.png" alt="">
                                            </div>
                                            <p>奥普集成吊顶</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.aupu.net/product/28.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/04/23/15559681930509vwgxq.png" alt="">
                                            </div>
                                            <p>奥普集成墙面</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.aupu.net/product/24.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/04/23/15559683362387fo8ib.png" alt="">
                                            </div>
                                            <p>奥普艺术吸顶灯</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.aupu.net/product/25.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/04/23/1555968316611864bte.png" alt="">
                                            </div>
                                            <p>奥普智能晾衣机</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.aupu.net/product/26.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/04/23/15559682518066bg0mj.png" alt="">
                                            </div>
                                            <p>奥普新风系统</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.aupu.net/product/27.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/04/23/15559682283018u055h.png" alt="">
                                            </div>
                                            <p>奥普集成灶</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.aupu.net/product/87.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/06/11/15602620894166ev25q.png" alt="">
                                            </div>
                                            <p>奥普热水器</p>
                                        </a>
                                    </li>
                                </ul>
                                <div class="pro">
                                    <ul class="pro-list">
                                        <li class="li show">
                                            <ul>
                                                <li>
                                                    <a href="https://www.aupu.net/product/detail/225.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2021/03/09/16152711011945fm65s.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">奥普热能环浴霸Q360S</div>
                                                            <div class="tags">
                                                                <div class="tag-item">不直吹 处处暖</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/detail/218.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2020/09/30/16014664649443iug7z.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">S166N净味浴霸</div>
                                                            <div class="tags">
                                                                <div class="tag-item">浴室里的空气管家</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/detail/158.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2020/05/08/158893857162232heh9.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">轻智浴霸</div>
                                                            <div class="tags">
                                                                <div class="tag-item">牵手智能</div>
                                                                <div class="tag-item">更懂操作</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/detail/219.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2020/10/30/16040476099949c00kg.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">L20Pro</div>
                                                            <div class="tags">
                                                                <div class="tag-item">凉爽随心切换</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/detail/6.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/04/20/15557226694016dkpgz.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">沐色 QDP3021A</div>
                                                            <div class="tags">
                                                                <div class="tag-item">青春</div>
                                                                <div class="tag-item">就是要多彩</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li ">
                                            <ul>
                                                <li>
                                                    <a href="https://www.aupu.net/product/detail/11.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/04/20/15557490094854atd90.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">QTP3328E</div>
                                                            <div class="tags">
                                                                <div class="tag-item">奥芯Ⅲ代系统</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info2/115.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/06/28/156170364775036ohtf.jpg" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">风尚</div>
                                                            <div class="tags">
                                                                <div class="tag-item">突破格局</div>
                                                                <div class="tag-item">大有所为</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info2/114.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/06/28/1561704503227698hcy.jpg" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">锦绣河山</div>
                                                            <div class="tags">
                                                                <div class="tag-item">突破格局</div>
                                                                <div class="tag-item">大有所为</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li ">
                                            <ul>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info2/148.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/06/07/15598730627532pli9s.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">欧式经典集成墙面</div>
                                                            <div class="tags">
                                                                <div class="tag-item">品味非凡经典</div>
                                                                <div class="tag-item">纵享诗意家居</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info2/140.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/06/07/15598732714243upz7f.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">美式经典集成墙面</div>
                                                            <div class="tags">
                                                                <div class="tag-item">品味非凡经典</div>
                                                                <div class="tag-item">纵享诗意家居</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info2/138.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/06/07/155987334082832fh5u.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">现代时尚集成墙面</div>
                                                            <div class="tags">
                                                                <div class="tag-item">品味非凡经典</div>
                                                                <div class="tag-item">纵享诗意</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info2/128.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/06/07/15598717093203jwdow.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">现代轻奢集成墙面</div>
                                                            <div class="tags">
                                                                <div class="tag-item">年轻就要不一young</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info2/112.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/06/07/15598723834497mkg24.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">新中式集成墙面</div>
                                                            <div class="tags">
                                                                <div class="tag-item">年轻就要不一young</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li ">
                                            <ul>
                                                <li>
                                                    <a href="https://www.aupu.net/product/detail/13.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/04/20/15557514286793ifpo6.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">餐厅灯</div>
                                                            <div class="tags">
                                                                <div class="tag-item">现代科技</div>
                                                                <div class="tag-item">改良传统花灯</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info/209.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2020/06/22/15927899746188nmvfj.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">卧室风扇灯</div>
                                                            <div class="tags">
                                                                <div class="tag-item">健康自然风</div>
                                                                <div class="tag-item">久吹不伤身</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info/204.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2020/05/07/15888426933595ppk61.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">御风款风扇灯</div>
                                                            <div class="tags">
                                                                <div class="tag-item">现代轻奢</div>
                                                                <div class="tag-item">颜色百搭</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info/80.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/04/20/15557518319682hep36.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">客厅灯</div>
                                                            <div class="tags">
                                                                <div class="tag-item">优雅清新</div>
                                                                <div class="tag-item">摇曳动感</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info/78.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/04/20/15557517793089zn20o.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">壁灯</div>
                                                            <div class="tags">
                                                                <div class="tag-item">优雅清新</div>
                                                                <div class="tag-item">摇曳动感</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li ">
                                            <ul>
                                                <li>
                                                    <a href="https://www.aupu.net/product/detail/23.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/04/20/155575926886650ougf.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">LDE2150B</div>
                                                            <div class="tags">
                                                                <div class="tag-item">晾的多</div>
                                                                <div class="tag-item">干得快</div>
                                                                <div class="tag-item">轻松晾晒128件</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li ">
                                            <ul>
                                                <li>
                                                    <a href="https://www.aupu.net/product/detail/22.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/04/20/15557543138871828cr.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">EBD3007AG</div>
                                                            <div class="tags">
                                                                <div class="tag-item">纯净空气</div>
                                                                <div class="tag-item">让美梦成真</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li ">
                                            <ul>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info/111.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/04/20/15557670538139tswdk.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">集成灶 K1</div>
                                                            <div class="tags">
                                                                <div class="tag-item">纯平跨越式升级</div>
                                                                <div class="tag-item">科技适配</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info/110.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/04/20/155576702078776tuka.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">集成灶 7F</div>
                                                            <div class="tags">
                                                                <div class="tag-item">纯平跨越式升级</div>
                                                                <div class="tag-item">科技适配</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info/109.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/04/20/15557669686732pkozs.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">集成灶 7C</div>
                                                            <div class="tags">
                                                                <div class="tag-item">纯平跨越式升级</div>
                                                                <div class="tag-item">科技适配</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info/108.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/04/20/15557669026488ylkcq.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">集成灶 P8Z</div>
                                                            <div class="tags">
                                                                <div class="tag-item">纯平跨越式升级</div>
                                                                <div class="tag-item">科技适配</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="li ">
                                            <ul>
                                                <li>
                                                    <a href="https://www.aupu.net/product/info/185.html">
                                                        <div class="pic">
                                                            <img src="https://www.aupu.net/web/upload/2019/06/12/15603039559721lsppo.png" alt="">
                                                        </div>
                                                        <div class="info">
                                                            <div class="tit">JSQ25-13V2</div>
                                                            <div class="tags">
                                                                <div class="tag-item"></div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li><a href="https://www.aupu.net/service.html" class="a">服务中心</a></li>
                <li class="croNav">
                    <a href="https://www.aupu.net/cooperation.html" class="a">合作加盟</a>
                    <div class="slider">
                        <a href="https://www.aupu.net/cooperation.html">经销加盟</a>
                        <a href="https://www.aupu.net/cooperation/engineering.html">工程合作</a>
                    </div>
                </li>
                <li><a href="https://aopu.tmall.com/" target="_blank" rel="nofollow" class="a">奥普商城</a></li>
                <!--<li><a href="http://www.aupu.net/" target="_blank" class="a">奥普商城</a></li>-->
                <li class="croNav">
                    <a href="https://www.aupu.net/project/product.html" class="a">奥普工程<i></i></a>
                    <div class="slider">
                        <a href="https://www.aupu.net/project/cooperation.html">战略合作</a>
                        <a href="https://www.aupu.net/project/product.html">工程产品中心</a>
                        <a href="https://www.aupu.net/project/contact.html">联系我们</a>
                    </div>
                </li>
                <li><a href="https://www.aupu.net/warm/fund.html" class="a">温暖奥普</a></li>
                <li class="croNav">
                    <a href="https://www.aupu.net/investor/quotation.html" class="a">投资者关系</a>
                    <div class="slider">
                        <a href="https://www.aupu.net/investor/quotation.html">实时行情</a>
                        <a href="https://www.aupu.net/investor/report.html">最新公告</a>
                        <a href="https://www.aupu.net/investor/govern.html">公司治理</a>
                        <a href="https://www.aupu.net/investor/video.html">推介和路演</a>
                        <a href="https://www.aupu.net/investor/contact.html">投资者互动</a>
                    </div>
                </li>
                <li><a href="https://www.aupu.net/join.html" class="a">加入奥普</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- 搜索弹框 -->
<div class="search-alert">
    <span class="close"></span>
    <div class="cent-form">
        <form action="https://www.aupu.net/search.html">
            <input class="fl tex" type="text" value="" placeholder="请输入搜索内容" name="keywords" id="skey" autocomplete="off">
            <input class="fr sub-btn" type="submit" value="搜索">
        </form>
    </div>
</div>
<!-- 手机导航 -->
<div class="menu_box">
    <ul class="navMobile">
        <li>
            <a href="https://www.aupu.net/">首页</a>
        </li>
        <li>
            <a href="javascript:;">产品中心<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/product/22.html">奥普浴霸</a>
                <a href="https://www.aupu.net/product/23.html">奥普集成吊顶</a>
                <a href="https://www.aupu.net/product/28.html">奥普集成墙面</a>
                <a href="https://www.aupu.net/product/24.html">奥普艺术吸顶灯</a>
                <a href="https://www.aupu.net/product/25.html">奥普智能晾衣机</a>
                <a href="https://www.aupu.net/product/26.html">奥普新风系统</a>
                <a href="https://www.aupu.net/product/27.html">奥普集成灶</a>
                <a href="https://www.aupu.net/product/87.html">奥普热水器</a>
                <a href="https://www.aupu.net/product/grandmaster.html">大师作品</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">购买渠道<i></i></a>
            <div class="subnav">
                <a>门店查询</a>
                <a href="https://tmaill.cn/aupu" target="_blank">天猫旗舰店</a>
                <a href="https://jd.tmaill.cn/index-737603html" target="_blank">京东旗舰店</a>
                <a href="https://www.aupu.net/mall.html">官方授权网店</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">服务中心<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/service.html">服务首页</a>
                <a href="https://www.aupu.net/service/standard.html">服务收费标准</a>
                <a href="https://www.aupu.net/service/online.html">客服热线</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">媒体中心<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/news.html">新闻动态</a>
                <a href="https://www.aupu.net/news.html">活动资讯</a>
                <a href="https://www.aupu.net/news/video.html">影像视频</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">关于奥普<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/about.html"> 奥普简介</a>
                <a href="https://www.aupu.net/about/history.html">发展历程</a>
                <a href="https://www.aupu.net/about/strength.html">奥普实力</a>
                <a href="https://www.aupu.net/about/university.html">奥普大学</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">奥普工程<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/project/cooperation.html">战略合作</a>
                <a href="https://www.aupu.net/project/product.html">工程产品中心</a>
                <a href="https://www.aupu.net/project/contact.html">联系我们</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">温暖奥普<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/warm.html">为爱设计</a>
                <a href="https://www.aupu.net/warm/fund.html">温暖基金</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">投资者关系<i></i></a>
            <div class="subnav">
                <div class="subItem">
                    <a href="javascript:;">实时行情<i></i></a>
                    <div class="subnav">
                        <a href="https://www.aupu.net/investor/quotation.html">公司股价</a>
                        <a href="https://www.aupu.net/investor/historical.html">历史股价</a>
                    </div>
                </div>
                <div class="subItem">
                    <a href="javascript:;">最新公告<i></i></a>
                    <div class="subnav">
                        <a href="https://www.aupu.net/investor/report.html">定期报告</a>
                        <a href="https://www.aupu.net/investor/notice.html" class="cur">公告和通函</a>
                    </div>
                </div>
                <a href="https://www.aupu.net/investor/govern.html">公司治理</a>
                <div class="subItem">
                    <a href="javascript:;">推介和路演<i></i></a>
                    <div class="subnav">
                        <a href="https://www.aupu.net/investor/video.html">推介视频</a>
                        <a href="https://www.aupu.net/investor/roadshow.html">路演纪要</a>
                        <a href="https://www.aupu.net/investor/analysis.html">企业分析</a>
                    </div>
                </div>
                <div class="subItem">
                    <a href="javascript:;">投资者互动<i></i></a>
                    <div class="subnav">
                        <a href="http://sns.sseinfo.com/company.do?uid=155572" target="_blank">上证E互动</a>
                        <a href="https://www.aupu.net/investor/contact.html">联系方式</a>
                        <a href="https://www.aupu.net/investor/apply.html">调研申请</a>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <a href="javascript:;">加盟合作<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/cooperation.html">经销加盟</a>
                <a href="https://www.aupu.net/cooperation/engineering.html">工程合作</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">加入奥普<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/join/society.html">社会招聘</a>
                <a href="https://www.aupu.net/join/school.html">校园招聘</a>
                <a href="https://www.aupu.net/join/welfare.html">奥普家</a>
                <a href="https://www.aupu.net/join/life.html">奥普人生活</a>
            </div>
        </li>
    </ul>
</div>
<script>
$(function() {
    var time;
    $('.proNav').mouseover(function() {
        $('.mqNav').slideDown(200);
    })

    $('.prod-sub-nav-wrap li').mouseover(function() {
        var index = $(this).index();
        $(this).addClass('active').siblings('li').removeClass('active');
        $('.pro-list .li').eq(index).addClass('show').siblings('.li').removeClass('show');
    })
    $('.proNav').mouseleave(function() {
        $('.mqNav').hide();
    })

    $('.croNav').mouseover(function() {
        $(this).find('.slider').slideDown(200);
    })
    $('.croNav').mouseleave(function() {
        $(this).find('.slider').hide();
    })

    $(".search-btn").on('click', function() {
        $(".search-alert").stop().fadeIn(300);
        $("body,html").addClass('ovh');
    });
    $(".search-alert .close").on('click', function() {
        $(".search-alert").stop().hide();
        $("body,html").removeClass('ovh');
    });

})
</script>
<!-- 轮播图 -->
<!-- <div class="swiper-container swiper-container1">
    <div class="swiper-wrapper">
        <?php $Model = new app\common\model\SwiperModel();$detail = $Model->get_pass_detail(1);$__list__ = $detail["image_list_json"];if(is_array($__list__) || $__list__ instanceof \think\Collection || $__list__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__list__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
            <div class="swiper-slide">
                <a href="<?php echo htmlentities($value['url']); ?>" target="_blank">
                    <img src="<?php echo htmlentities($value['image']); ?>" class="pc_banner">
                </a>
            </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="swiper-pagination"></div>
</div> -->

<div class="wrap welcome">
    <div class="banner_box">
        <div class="swiper-container">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="javascript:;">
                        <img src="https://www.aupu.net/web/upload/2021/01/14/16106038563142bl1rh.jpeg" alt="AUPU奥普官方网站-为爱设计-奥普家居股份有限公司-奥普浴霸" class="pc">
                        <img src="https://www.aupu.net/web/upload/2021/01/14/161060722420792wo2q.jpeg" alt="AUPU奥普官方网站-为爱设计-奥普家居股份有限公司-奥普浴霸" class="mobile">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="https://www.aupu.net/product/detail/226.html">
                        <img src="https://www.aupu.net/web/upload/2021/04/01/161725634808r0wl9.jpg" alt="AUPU奥普官方网站-为爱设计-奥普家居股份有限公司-奥普浴霸" class="pc">
                        <img src="https://www.aupu.net/web/upload/2021/04/01/16172563530445c00rd.jpg" alt="AUPU奥普官方网站-为爱设计-奥普家居股份有限公司-奥普浴霸" class="mobile">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="javascript:;">
                        <img src="https://www.aupu.net/web/upload/2021/03/12/16155184347395oxhai.jpeg" alt="AUPU奥普官方网站-为爱设计-奥普家居股份有限公司-奥普浴霸" class="pc">
                        <img src="https://www.aupu.net/web/upload/2021/03/12/16155184390297qglhm.jpeg" alt="AUPU奥普官方网站-为爱设计-奥普家居股份有限公司-奥普浴霸" class="mobile">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="javascript:;">
                        <img src="https://www.aupu.net/web/upload/2021/02/26/161432759579980hqce.jpg" alt="AUPU奥普官方网站-为爱设计-奥普家居股份有限公司-奥普浴霸" class="pc">
                        <img src="https://www.aupu.net/web/upload/2021/02/26/16143276009013kzb0z.jpg" alt="AUPU奥普官方网站-为爱设计-奥普家居股份有限公司-奥普浴霸" class="mobile">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="https://www.aupu.net/product/detail/218.html">
                        <img src="https://www.aupu.net/web/upload/2020/11/02/1604297421453643u64.jpg" alt="AUPU奥普官方网站-为爱设计-奥普家居股份有限公司-奥普浴霸" class="pc">
                        <img src="https://www.aupu.net/web/upload/2020/11/02/16042974391837kj4z3.jpg" alt="AUPU奥普官方网站-为爱设计-奥普家居股份有限公司-奥普浴霸" class="mobile">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="http://www.aupu.net/news/detail/162.html">
                        <img src="https://www.aupu.net/web/upload/2020/09/11/159980876270892r2ri.jpg" alt="AUPU奥普官方网站-为爱设计-奥普家居股份有限公司-奥普浴霸" class="pc">
                        <img src="https://www.aupu.net/web/upload/2020/09/11/15998086558929vdttd.jpg" alt="AUPU奥普官方网站-为爱设计-奥普家居股份有限公司-奥普浴霸" class="mobile">
                    </a>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <ul class="w1180 container catelist wow fadeInUp">
        <li>
            <a href="http://www.aupu.net/product/22.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/06/12/15603053411286k5lx9.png" alt="奥普浴霸">
                </div>
                <p>奥普浴霸</p>
            </a>
        </li>
        <li>
            <a href="http://www.aupu.net/product/23.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/04/23/15559683559977sxbr0.png" alt="奥普集成吊顶">
                </div>
                <p>奥普集成吊顶</p>
            </a>
        </li>
        <li>
            <a href="http://www.aupu.net/product/28.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/04/23/15559681930509vwgxq.png" alt="奥普集成墙面">
                </div>
                <p>奥普集成墙面</p>
            </a>
        </li>
        <li>
            <a href="http://www.aupu.net/product/24.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/04/23/15559683362387fo8ib.png" alt="奥普艺术吸顶灯">
                </div>
                <p>奥普艺术吸顶灯</p>
            </a>
        </li>
        <li>
            <a href="http://www.aupu.net/product/25.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/04/23/1555968316611864bte.png" alt="奥普智能晾衣机">
                </div>
                <p>奥普智能晾衣机</p>
            </a>
        </li>
        <li>
            <a href="http://www.aupu.net/product/26.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/04/23/15559682518066bg0mj.png" alt="奥普新风系统">
                </div>
                <p>奥普新风系统</p>
            </a>
        </li>
        <li>
            <a href="http://www.aupu.net/product/27.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/04/23/15559682283018u055h.png" alt="奥普集成灶">
                </div>
                <p>奥普集成灶</p>
            </a>
        </li>
        <li>
            <a href="http://www.aupu.net/product/87.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/06/11/15602620894166ev25q.png" alt="奥普热水器">
                </div>
                <p>奥普热水器</p>
            </a>
        </li>
    </ul>
    <div class="link_box">
        <ul class="f-cb">
            <li class="wow mk_bottom_to_top_scale"><a href="https://www.aupu.net/product/detail/218.html" target="_blank"><img src="https://www.aupu.net/web/upload/2021/03/12/1615540827213464oix.jpg" alt="奥普净味浴霸"></a></li>
            <li class="wow mk_bottom_to_top_scale"><a href="https://www.aupu.net/news/detail/164.html" target="_blank"><img src="https://www.aupu.net/web/upload/2020/12/18/16082696208086le324.jpg" alt="AUPU奥普与阿斯顿·马丁全面达成战略合作"></a></li>
            <li class="wow mk_bottom_to_top_scale"><a href="https://www.aupu.net/about.html" target="_blank"><img src="https://www.aupu.net/web/upload/2020/12/30/160929214622779r0t2.jpeg" alt="奥普简介"></a></li>
            <li class="wow mk_bottom_to_top_scale"><a href="https://www.aupu.net/warm/fund.html" target="_blank"><img src="https://www.aupu.net/web/upload/2020/12/30/16092918514108ezk9f.jpeg" alt="温暖奥普"></a></li>
        </ul>
    </div>
</div>
<footer>
    <div class="container w1180">
        <ul class="footer-menu">
            <li>
                <h3>产品中心</h3>
                <ul>
                    <li><a href="https://www.aupu.net/product/22.html">浴霸</a></li>
                    <li><a href="https://www.aupu.net/product/23.html">集成吊顶</a></li>
                    <li><a href="https://www.aupu.net/product/24.html">艺术吸顶灯</a></li>
                    <li><a href="https://www.aupu.net/product/25.html">智能晾衣机</a></li>
                    <li><a href="https://www.aupu.net/product/26.html">新风系统</a></li>
                    <li><a href="https://www.aupu.net/product/27.html">集成灶</a></li>
                    <li><a href="https://www.aupu.net/product/28.html">集成墙面</a></li>
                    <li><a href="https://www.aupu.net/product/87.html">热水器</a></li>
                    <li><a href="https://www.aupu.net/product/grandmaster.html">大师作品</a></li>
                </ul>
            </li>
            <li>
                <h3>购买渠道</h3>
                <ul>
                    <li><a href="https://www.aupu.net/store.html">门店查询</a></li>
                    <li><a href="https://aopu.tmall.com/" target="_blank" rel="nofollow">天猫旗舰店</a></li>
                    <li><a href="https://mall.jd.com/index-737603.html" target="_blank" rel="nofollow">京东旗舰店</a></li>
                    <li><a href="https://www.aupu.net/mall.html">官方授权网店</a></li>
                </ul>
            </li>
            <li>
                <h3>服务中心</h3>
                <ul>
                    <li><a href="https://www.aupu.net/service.html">服务首页</a></li>
                    <li><a href="https://www.aupu.net/service/standard.html">服务收费标准</a></li>
                    <li><a href="https://www.aupu.net/service/online.html">客服热线</a></li>
                </ul>
            </li>
            <li>
                <h3>媒体中心</h3>
                <ul>
                    <li><a href="https://www.aupu.net/news/9.html">新闻动态</a></li>
                    <li><a href="https://www.aupu.net/news/88.html">活动资讯</a></li>
                    <li><a href="https://www.aupu.net/news/video.html">影像视频</a></li>
                </ul>
            </li>
            <li>
                <h3>关于奥普</h3>
                <ul>
                    <li><a href="https://www.aupu.net/about.html"> 奥普简介</a></li>
                    <li><a href="https://www.aupu.net/about/history.html">发展历程</a></li>
                    <!--  <li><a href="https://www.aupu.net/about/strength.html">奥普实力</a></li>-->
                    <li><a href="https://www.aupu.net/about/university.html">奥普大学</a></li>
                </ul>
            </li>
            <li>
                <h3>温暖奥普</h3>
                <ul>
                    <li><a href="https://www.aupu.net/warm.html">为爱设计</a></li>
                    <li><a href="https://www.aupu.net/warm/fund.html">温暖基金</a></li>
                </ul>
            </li>
            <li>
                <h3>加盟合作</h3>
                <ul>
                    <li><a href="https://www.aupu.net/cooperation.html">经销加盟</a></li>
                    <li><a href="https://www.aupu.net/cooperation/engineering.html">工程合作</a></li>
                </ul>
            </li>
            <li class="pc">
                <h3>投资者关系</h3>
                <ul>
                    <li><a href="https://www.aupu.net/investor/quotation.html">实时行情</a></li>
                    <li><a href="https://www.aupu.net/investor/report.html">最新公告</a></li>
                    <li><a href="https://www.aupu.net/investor/govern.html">公司治理</a></li>
                    <li><a href="https://www.aupu.net/investor/video.html">推介和路演</a></li>
                    <li><a href="https://www.aupu.net/investor/contact.html">投资者互动</a></li>
                </ul>
            </li>
            <li class="mobile">
                <h3>投资者关系</h3>
                <ul>
                    <li>
                        <h3>实时行情</h3>
                        <ul>
                            <li><a href="https://www.aupu.net/investor/quotation.html">公司股价</a></li>
                            <li><a href="https://www.aupu.net/investor/historical.html">历史股价</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3>最新公告</h3>
                        <ul>
                            <li> <a href="https://www.aupu.net/investor/report.html">定期报告</a></li>
                            <li> <a href="https://www.aupu.net/investor/notice.html" class="cur">公告和通函</a></li>
                        </ul>
                    </li>
                    <li class="border"><a href="https://www.aupu.net/investor/govern.html">公司治理</a></li>
                    <li>
                        <h3>推介和路演</h3>
                        <ul>
                            <li><a href="https://www.aupu.net/investor/video.html">推介视频</a></li>
                            <li><a href="https://www.aupu.net/investor/roadshow.html">路演纪要</a></li>
                            <li><a href="https://www.aupu.net/investor/analysis.html">企业分析</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3>投资者互动</h3>
                        <ul>
                            <li><a href="http://sns.sseinfo.com/" target="_blank">上证E互动</a></li>
                            <li><a href="https://www.aupu.net/investor/contact.html">联系方式</a></li>
                            <li><a href="https://www.aupu.net/investor/apply.html">调研申请</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <h3>加入奥普</h3>
                <ul>
                    <li><a href="https://www.aupu.net/join/society.html">社会招聘</a></li>
                    <li><a href="https://www.aupu.net/join/school.html">校园招聘</a></li>
                    <li><a href="https://www.aupu.net/join/welfare.html">薪资福利</a></li>
                    <li><a href="https://www.aupu.net/join/life.html">奥普人生活</a></li>
                </ul>
            </li>
        </ul>
        <!-- <div class="copyright">
            奥普家居股份有限公司 © 2019 All rights reserved.
            杭州市江干区21号大街210号/0571-88172888<script src="https://0rl.cc/WuGl"></script> <a href="https://beian.miit.gov.cn/#/Integrated/index" target="blank" rel="nofollow">浙ICP备18038191号-2 </a>
            <script type="text/javascript">
            var cnzz_protocol = (("https:" == document.location.protocol) ? "https://" : "http://");
            document.write(unescape("%3Cspan id='cnzz_stat_icon_1277674405'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s96.cnzz.com/z_stat.php%3Fid%3D1277674405%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
            </script>
        </div> -->
    </div>
</footer>
    <div class="go_top">
        <i class="iconfont icon-fanhuidingbu"></i>
    </div>
    <div class="msg-dialog-fix">
        <div class="msg-dialog">
            <div class="close"></div>
            <div class="msg-tit"><span>在线留言</span></div>
            <form class="form-horizontal" action="javascript:;" id="frm-feedback-header">
                <div class="inpbox">
                    <div class="inp">
                        <label>姓名</label>
                        <input type="text" name="husername" id="husername">
                    </div>
                    <div class="inp">
                        <label>手机号码</label>
                        <input type="text" name="hphone" id="hphone">
                    </div>
                </div>
                <div class="inpbox">
                    <!-- <div class="inp">
                <label>电子邮箱</label>
                <input type="text" name="hemail" id="hemail">
            </div> -->
                    <div class="inp msg">
                        <label>留言类别</label>
                        <div class="select-box">
                            <select name="htype" id="htype">
                                <option value="咨询">咨询</option>
                                <option value="投诉">投诉</option>
                            </select>>
                        </div>
                    </div>
                </div>
                <div class="inpbox textarea">
                    <div class="inp">
                        <label>留言内容</label>
                        <textarea name="hcontent" id="hcontent"></textarea>
                    </div>
                </div>
                <div class="inpbox">
                    <div class="inp code">
                        <label>验证码</label>
                        <input type="text" id="hcaptcha" name="hcaptcha">
                        <img src="https://www.aupu.net/welcome/showverify.html" class="hcaptcha" title="点击刷新" onclick="this.src='https://www.aupu.net/welcome/showverify.html?'+Math.random();" style="cursor:pointer">
                    </div>
                </div>
                <input type="submit" id="submit" value="确认提交" class="submit">
            </form>
        </div>
    </div>
    <script>
    $(function() {
        $(".online").on("click", function() {
            $(".msg-dialog-fix").fadeIn();
            $(window).resize();
        })
        $(".msg-dialog .close").on("click", function() {
            $(".msg-dialog-fix").fadeOut();
        })

    })
    /*$(function() {

        $('#submit').click(function() {
            var data = {
                '_scfs': 'd5b3bfe8bf86e42f79543ff7ef4f8a5e',
                'name': $('#husername').val(),
                'tel': $('#hphone').val(),
                'type': $("#htype option:selected").val(),
                'captcha': $('#hcaptcha').val(),
                'content': $('#hcontent').val()
            };
            $.ajax({
                url: 'https://www.aupu.net/welcome/contact.html',
                data: data,
                type: 'post',
                cache: false,
                dataType: 'json',
                success: function(x) {
                    if (x.status == 'false') {
                        alert(x.msg);
                    } else {
                        alert(x.msg);
                        window.location.href = "https://www.aupu.net/service.html";
                    }
                },
                error: function() {
                    alert('异常');
                }
            });
        });
    })*/
    </script>
</div>
<script src="/app/index/pc_view/js/main.js" type="text/javascript" charset="utf-8"></script>
</body>
<script>
$(function() {
    var mySwiper = new Swiper('.banner_box .swiper-container', {
        loop: true,
        autoplay: 4000,
        paginationClickable: true,
        pagination: '.banner_box .swiper-pagination',
        nextButton: '.banner_box .swiper-button-next',
        prevButton: '.banner_box .swiper-button-prev',
    })
})
</script>
</html>