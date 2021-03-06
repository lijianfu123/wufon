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
        /*?????????*/
        .page_bar {text-align: center; width: 100%;}
            .page_bar table {margin: auto;}
            .page_bar table td a {display: block; width: 30px; height: 30px; line-height: 30px; text-align: center; margin-right: 5px; border: 1px solid #05A25F; cursor: pointer;}
            .page_bar table td a:hover {background: #05A25F; color: white;}
            .page_bar table td .active {background: #05A25F; color: white;}

        .nav-ul li {
            position: relative;
        }

        /* 2020???3???30??? 09:40:14 ?????? */
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
        /* ???????????? */
    </style>

    <script>
        /**
         * ?????? ??????
         */
        function set_nav(n) {
            $('.nav-ul').find('a').eq(n).addClass('select');
        }

        /**
         * ????????????
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
$solution_id = (new app\common\model\NewsModel())->where("first_news_class_id = 1")->order('sort asc, id desc')->value('id'); //???????????? id
$cloud_id = (new app\common\model\NewsModel())->where("first_news_class_id = 2")->order('sort asc, id desc')->value('id'); //????????? id
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
                <li><a href="https://www.aupu.net/" class="a">??????</a></li>
                <li class="proNav">
                    <a href="javascript:;" class="a">????????????</a>
                    <div class="mqNav cpNav">
                        <div class="inner w1400">
                            <div class="nav2">
                                <ul class="prod-sub-nav-wrap">
                                    <li class="active">
                                        <a href="http://www.aupu.net/product/22.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/06/12/15603053411286k5lx9.png" alt="">
                                            </div>
                                            <p>????????????</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.aupu.net/product/23.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/04/23/15559683559977sxbr0.png" alt="">
                                            </div>
                                            <p>??????????????????</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.aupu.net/product/28.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/04/23/15559681930509vwgxq.png" alt="">
                                            </div>
                                            <p>??????????????????</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.aupu.net/product/24.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/04/23/15559683362387fo8ib.png" alt="">
                                            </div>
                                            <p>?????????????????????</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.aupu.net/product/25.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/04/23/1555968316611864bte.png" alt="">
                                            </div>
                                            <p>?????????????????????</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.aupu.net/product/26.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/04/23/15559682518066bg0mj.png" alt="">
                                            </div>
                                            <p>??????????????????</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.aupu.net/product/27.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/04/23/15559682283018u055h.png" alt="">
                                            </div>
                                            <p>???????????????</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.aupu.net/product/87.html">
                                            <div class="icon">
                                                <img src="https://www.aupu.net/web/upload/2019/06/11/15602620894166ev25q.png" alt="">
                                            </div>
                                            <p>???????????????</p>
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
                                                            <div class="tit">?????????????????????Q360S</div>
                                                            <div class="tags">
                                                                <div class="tag-item">????????? ?????????</div>
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
                                                            <div class="tit">S166N????????????</div>
                                                            <div class="tags">
                                                                <div class="tag-item">????????????????????????</div>
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
                                                            <div class="tit">????????????</div>
                                                            <div class="tags">
                                                                <div class="tag-item">????????????</div>
                                                                <div class="tag-item">????????????</div>
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
                                                                <div class="tag-item">??????????????????</div>
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
                                                            <div class="tit">?????? QDP3021A</div>
                                                            <div class="tags">
                                                                <div class="tag-item">??????</div>
                                                                <div class="tag-item">???????????????</div>
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
                                                                <div class="tag-item">??????????????????</div>
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
                                                            <div class="tit">??????</div>
                                                            <div class="tags">
                                                                <div class="tag-item">????????????</div>
                                                                <div class="tag-item">????????????</div>
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
                                                            <div class="tit">????????????</div>
                                                            <div class="tags">
                                                                <div class="tag-item">????????????</div>
                                                                <div class="tag-item">????????????</div>
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
                                                            <div class="tit">????????????????????????</div>
                                                            <div class="tags">
                                                                <div class="tag-item">??????????????????</div>
                                                                <div class="tag-item">??????????????????</div>
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
                                                            <div class="tit">????????????????????????</div>
                                                            <div class="tags">
                                                                <div class="tag-item">??????????????????</div>
                                                                <div class="tag-item">??????????????????</div>
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
                                                            <div class="tit">????????????????????????</div>
                                                            <div class="tags">
                                                                <div class="tag-item">??????????????????</div>
                                                                <div class="tag-item">????????????</div>
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
                                                            <div class="tit">????????????????????????</div>
                                                            <div class="tags">
                                                                <div class="tag-item">??????????????????young</div>
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
                                                            <div class="tit">?????????????????????</div>
                                                            <div class="tags">
                                                                <div class="tag-item">??????????????????young</div>
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
                                                            <div class="tit">?????????</div>
                                                            <div class="tags">
                                                                <div class="tag-item">????????????</div>
                                                                <div class="tag-item">??????????????????</div>
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
                                                            <div class="tit">???????????????</div>
                                                            <div class="tags">
                                                                <div class="tag-item">???????????????</div>
                                                                <div class="tag-item">???????????????</div>
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
                                                            <div class="tit">??????????????????</div>
                                                            <div class="tags">
                                                                <div class="tag-item">????????????</div>
                                                                <div class="tag-item">????????????</div>
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
                                                            <div class="tit">?????????</div>
                                                            <div class="tags">
                                                                <div class="tag-item">????????????</div>
                                                                <div class="tag-item">????????????</div>
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
                                                            <div class="tit">??????</div>
                                                            <div class="tags">
                                                                <div class="tag-item">????????????</div>
                                                                <div class="tag-item">????????????</div>
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
                                                                <div class="tag-item">?????????</div>
                                                                <div class="tag-item">?????????</div>
                                                                <div class="tag-item">????????????128???</div>
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
                                                                <div class="tag-item">????????????</div>
                                                                <div class="tag-item">???????????????</div>
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
                                                            <div class="tit">????????? K1</div>
                                                            <div class="tags">
                                                                <div class="tag-item">?????????????????????</div>
                                                                <div class="tag-item">????????????</div>
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
                                                            <div class="tit">????????? 7F</div>
                                                            <div class="tags">
                                                                <div class="tag-item">?????????????????????</div>
                                                                <div class="tag-item">????????????</div>
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
                                                            <div class="tit">????????? 7C</div>
                                                            <div class="tags">
                                                                <div class="tag-item">?????????????????????</div>
                                                                <div class="tag-item">????????????</div>
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
                                                            <div class="tit">????????? P8Z</div>
                                                            <div class="tags">
                                                                <div class="tag-item">?????????????????????</div>
                                                                <div class="tag-item">????????????</div>
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
                <li><a href="https://www.aupu.net/service.html" class="a">????????????</a></li>
                <li class="croNav">
                    <a href="https://www.aupu.net/cooperation.html" class="a">????????????</a>
                    <div class="slider">
                        <a href="https://www.aupu.net/cooperation.html">????????????</a>
                        <a href="https://www.aupu.net/cooperation/engineering.html">????????????</a>
                    </div>
                </li>
                <li><a href="https://aopu.tmall.com/" target="_blank" rel="nofollow" class="a">????????????</a></li>
                <!--<li><a href="http://www.aupu.net/" target="_blank" class="a">????????????</a></li>-->
                <li class="croNav">
                    <a href="https://www.aupu.net/project/product.html" class="a">????????????<i></i></a>
                    <div class="slider">
                        <a href="https://www.aupu.net/project/cooperation.html">????????????</a>
                        <a href="https://www.aupu.net/project/product.html">??????????????????</a>
                        <a href="https://www.aupu.net/project/contact.html">????????????</a>
                    </div>
                </li>
                <li><a href="https://www.aupu.net/warm/fund.html" class="a">????????????</a></li>
                <li class="croNav">
                    <a href="https://www.aupu.net/investor/quotation.html" class="a">???????????????</a>
                    <div class="slider">
                        <a href="https://www.aupu.net/investor/quotation.html">????????????</a>
                        <a href="https://www.aupu.net/investor/report.html">????????????</a>
                        <a href="https://www.aupu.net/investor/govern.html">????????????</a>
                        <a href="https://www.aupu.net/investor/video.html">???????????????</a>
                        <a href="https://www.aupu.net/investor/contact.html">???????????????</a>
                    </div>
                </li>
                <li><a href="https://www.aupu.net/join.html" class="a">????????????</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- ???????????? -->
<div class="search-alert">
    <span class="close"></span>
    <div class="cent-form">
        <form action="https://www.aupu.net/search.html">
            <input class="fl tex" type="text" value="" placeholder="?????????????????????" name="keywords" id="skey" autocomplete="off">
            <input class="fr sub-btn" type="submit" value="??????">
        </form>
    </div>
</div>
<!-- ???????????? -->
<div class="menu_box">
    <ul class="navMobile">
        <li>
            <a href="https://www.aupu.net/">??????</a>
        </li>
        <li>
            <a href="javascript:;">????????????<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/product/22.html">????????????</a>
                <a href="https://www.aupu.net/product/23.html">??????????????????</a>
                <a href="https://www.aupu.net/product/28.html">??????????????????</a>
                <a href="https://www.aupu.net/product/24.html">?????????????????????</a>
                <a href="https://www.aupu.net/product/25.html">?????????????????????</a>
                <a href="https://www.aupu.net/product/26.html">??????????????????</a>
                <a href="https://www.aupu.net/product/27.html">???????????????</a>
                <a href="https://www.aupu.net/product/87.html">???????????????</a>
                <a href="https://www.aupu.net/product/grandmaster.html">????????????</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">????????????<i></i></a>
            <div class="subnav">
                <a>????????????</a>
                <a href="https://tmaill.cn/aupu" target="_blank">???????????????</a>
                <a href="https://jd.tmaill.cn/index-737603html" target="_blank">???????????????</a>
                <a href="https://www.aupu.net/mall.html">??????????????????</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">????????????<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/service.html">????????????</a>
                <a href="https://www.aupu.net/service/standard.html">??????????????????</a>
                <a href="https://www.aupu.net/service/online.html">????????????</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">????????????<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/news.html">????????????</a>
                <a href="https://www.aupu.net/news.html">????????????</a>
                <a href="https://www.aupu.net/news/video.html">????????????</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">????????????<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/about.html"> ????????????</a>
                <a href="https://www.aupu.net/about/history.html">????????????</a>
                <a href="https://www.aupu.net/about/strength.html">????????????</a>
                <a href="https://www.aupu.net/about/university.html">????????????</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">????????????<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/project/cooperation.html">????????????</a>
                <a href="https://www.aupu.net/project/product.html">??????????????????</a>
                <a href="https://www.aupu.net/project/contact.html">????????????</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">????????????<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/warm.html">????????????</a>
                <a href="https://www.aupu.net/warm/fund.html">????????????</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">???????????????<i></i></a>
            <div class="subnav">
                <div class="subItem">
                    <a href="javascript:;">????????????<i></i></a>
                    <div class="subnav">
                        <a href="https://www.aupu.net/investor/quotation.html">????????????</a>
                        <a href="https://www.aupu.net/investor/historical.html">????????????</a>
                    </div>
                </div>
                <div class="subItem">
                    <a href="javascript:;">????????????<i></i></a>
                    <div class="subnav">
                        <a href="https://www.aupu.net/investor/report.html">????????????</a>
                        <a href="https://www.aupu.net/investor/notice.html" class="cur">???????????????</a>
                    </div>
                </div>
                <a href="https://www.aupu.net/investor/govern.html">????????????</a>
                <div class="subItem">
                    <a href="javascript:;">???????????????<i></i></a>
                    <div class="subnav">
                        <a href="https://www.aupu.net/investor/video.html">????????????</a>
                        <a href="https://www.aupu.net/investor/roadshow.html">????????????</a>
                        <a href="https://www.aupu.net/investor/analysis.html">????????????</a>
                    </div>
                </div>
                <div class="subItem">
                    <a href="javascript:;">???????????????<i></i></a>
                    <div class="subnav">
                        <a href="http://sns.sseinfo.com/company.do?uid=155572" target="_blank">??????E??????</a>
                        <a href="https://www.aupu.net/investor/contact.html">????????????</a>
                        <a href="https://www.aupu.net/investor/apply.html">????????????</a>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <a href="javascript:;">????????????<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/cooperation.html">????????????</a>
                <a href="https://www.aupu.net/cooperation/engineering.html">????????????</a>
            </div>
        </li>
        <li>
            <a href="javascript:;">????????????<i></i></a>
            <div class="subnav">
                <a href="https://www.aupu.net/join/society.html">????????????</a>
                <a href="https://www.aupu.net/join/school.html">????????????</a>
                <a href="https://www.aupu.net/join/welfare.html">?????????</a>
                <a href="https://www.aupu.net/join/life.html">???????????????</a>
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
<!-- ????????? -->
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
                        <img src="https://www.aupu.net/web/upload/2021/01/14/16106038563142bl1rh.jpeg" alt="AUPU??????????????????-????????????-??????????????????????????????-????????????" class="pc">
                        <img src="https://www.aupu.net/web/upload/2021/01/14/161060722420792wo2q.jpeg" alt="AUPU??????????????????-????????????-??????????????????????????????-????????????" class="mobile">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="https://www.aupu.net/product/detail/226.html">
                        <img src="https://www.aupu.net/web/upload/2021/04/01/161725634808r0wl9.jpg" alt="AUPU??????????????????-????????????-??????????????????????????????-????????????" class="pc">
                        <img src="https://www.aupu.net/web/upload/2021/04/01/16172563530445c00rd.jpg" alt="AUPU??????????????????-????????????-??????????????????????????????-????????????" class="mobile">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="javascript:;">
                        <img src="https://www.aupu.net/web/upload/2021/03/12/16155184347395oxhai.jpeg" alt="AUPU??????????????????-????????????-??????????????????????????????-????????????" class="pc">
                        <img src="https://www.aupu.net/web/upload/2021/03/12/16155184390297qglhm.jpeg" alt="AUPU??????????????????-????????????-??????????????????????????????-????????????" class="mobile">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="javascript:;">
                        <img src="https://www.aupu.net/web/upload/2021/02/26/161432759579980hqce.jpg" alt="AUPU??????????????????-????????????-??????????????????????????????-????????????" class="pc">
                        <img src="https://www.aupu.net/web/upload/2021/02/26/16143276009013kzb0z.jpg" alt="AUPU??????????????????-????????????-??????????????????????????????-????????????" class="mobile">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="https://www.aupu.net/product/detail/218.html">
                        <img src="https://www.aupu.net/web/upload/2020/11/02/1604297421453643u64.jpg" alt="AUPU??????????????????-????????????-??????????????????????????????-????????????" class="pc">
                        <img src="https://www.aupu.net/web/upload/2020/11/02/16042974391837kj4z3.jpg" alt="AUPU??????????????????-????????????-??????????????????????????????-????????????" class="mobile">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="http://www.aupu.net/news/detail/162.html">
                        <img src="https://www.aupu.net/web/upload/2020/09/11/159980876270892r2ri.jpg" alt="AUPU??????????????????-????????????-??????????????????????????????-????????????" class="pc">
                        <img src="https://www.aupu.net/web/upload/2020/09/11/15998086558929vdttd.jpg" alt="AUPU??????????????????-????????????-??????????????????????????????-????????????" class="mobile">
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
                    <img src="https://www.aupu.net/web/upload/2019/06/12/15603053411286k5lx9.png" alt="????????????">
                </div>
                <p>????????????</p>
            </a>
        </li>
        <li>
            <a href="http://www.aupu.net/product/23.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/04/23/15559683559977sxbr0.png" alt="??????????????????">
                </div>
                <p>??????????????????</p>
            </a>
        </li>
        <li>
            <a href="http://www.aupu.net/product/28.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/04/23/15559681930509vwgxq.png" alt="??????????????????">
                </div>
                <p>??????????????????</p>
            </a>
        </li>
        <li>
            <a href="http://www.aupu.net/product/24.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/04/23/15559683362387fo8ib.png" alt="?????????????????????">
                </div>
                <p>?????????????????????</p>
            </a>
        </li>
        <li>
            <a href="http://www.aupu.net/product/25.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/04/23/1555968316611864bte.png" alt="?????????????????????">
                </div>
                <p>?????????????????????</p>
            </a>
        </li>
        <li>
            <a href="http://www.aupu.net/product/26.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/04/23/15559682518066bg0mj.png" alt="??????????????????">
                </div>
                <p>??????????????????</p>
            </a>
        </li>
        <li>
            <a href="http://www.aupu.net/product/27.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/04/23/15559682283018u055h.png" alt="???????????????">
                </div>
                <p>???????????????</p>
            </a>
        </li>
        <li>
            <a href="http://www.aupu.net/product/87.html">
                <div class="icon">
                    <img src="https://www.aupu.net/web/upload/2019/06/11/15602620894166ev25q.png" alt="???????????????">
                </div>
                <p>???????????????</p>
            </a>
        </li>
    </ul>
    <div class="link_box">
        <ul class="f-cb">
            <li class="wow mk_bottom_to_top_scale"><a href="https://www.aupu.net/product/detail/218.html" target="_blank"><img src="https://www.aupu.net/web/upload/2021/03/12/1615540827213464oix.jpg" alt="??????????????????"></a></li>
            <li class="wow mk_bottom_to_top_scale"><a href="https://www.aupu.net/news/detail/164.html" target="_blank"><img src="https://www.aupu.net/web/upload/2020/12/18/16082696208086le324.jpg" alt="AUPU??????????????????????????????????????????????????"></a></li>
            <li class="wow mk_bottom_to_top_scale"><a href="https://www.aupu.net/about.html" target="_blank"><img src="https://www.aupu.net/web/upload/2020/12/30/160929214622779r0t2.jpeg" alt="????????????"></a></li>
            <li class="wow mk_bottom_to_top_scale"><a href="https://www.aupu.net/warm/fund.html" target="_blank"><img src="https://www.aupu.net/web/upload/2020/12/30/16092918514108ezk9f.jpeg" alt="????????????"></a></li>
        </ul>
    </div>
</div>
<footer>
    <div class="container w1180">
        <ul class="footer-menu">
            <li>
                <h3>????????????</h3>
                <ul>
                    <li><a href="https://www.aupu.net/product/22.html">??????</a></li>
                    <li><a href="https://www.aupu.net/product/23.html">????????????</a></li>
                    <li><a href="https://www.aupu.net/product/24.html">???????????????</a></li>
                    <li><a href="https://www.aupu.net/product/25.html">???????????????</a></li>
                    <li><a href="https://www.aupu.net/product/26.html">????????????</a></li>
                    <li><a href="https://www.aupu.net/product/27.html">?????????</a></li>
                    <li><a href="https://www.aupu.net/product/28.html">????????????</a></li>
                    <li><a href="https://www.aupu.net/product/87.html">?????????</a></li>
                    <li><a href="https://www.aupu.net/product/grandmaster.html">????????????</a></li>
                </ul>
            </li>
            <li>
                <h3>????????????</h3>
                <ul>
                    <li><a href="https://www.aupu.net/store.html">????????????</a></li>
                    <li><a href="https://aopu.tmall.com/" target="_blank" rel="nofollow">???????????????</a></li>
                    <li><a href="https://mall.jd.com/index-737603.html" target="_blank" rel="nofollow">???????????????</a></li>
                    <li><a href="https://www.aupu.net/mall.html">??????????????????</a></li>
                </ul>
            </li>
            <li>
                <h3>????????????</h3>
                <ul>
                    <li><a href="https://www.aupu.net/service.html">????????????</a></li>
                    <li><a href="https://www.aupu.net/service/standard.html">??????????????????</a></li>
                    <li><a href="https://www.aupu.net/service/online.html">????????????</a></li>
                </ul>
            </li>
            <li>
                <h3>????????????</h3>
                <ul>
                    <li><a href="https://www.aupu.net/news/9.html">????????????</a></li>
                    <li><a href="https://www.aupu.net/news/88.html">????????????</a></li>
                    <li><a href="https://www.aupu.net/news/video.html">????????????</a></li>
                </ul>
            </li>
            <li>
                <h3>????????????</h3>
                <ul>
                    <li><a href="https://www.aupu.net/about.html"> ????????????</a></li>
                    <li><a href="https://www.aupu.net/about/history.html">????????????</a></li>
                    <!--  <li><a href="https://www.aupu.net/about/strength.html">????????????</a></li>-->
                    <li><a href="https://www.aupu.net/about/university.html">????????????</a></li>
                </ul>
            </li>
            <li>
                <h3>????????????</h3>
                <ul>
                    <li><a href="https://www.aupu.net/warm.html">????????????</a></li>
                    <li><a href="https://www.aupu.net/warm/fund.html">????????????</a></li>
                </ul>
            </li>
            <li>
                <h3>????????????</h3>
                <ul>
                    <li><a href="https://www.aupu.net/cooperation.html">????????????</a></li>
                    <li><a href="https://www.aupu.net/cooperation/engineering.html">????????????</a></li>
                </ul>
            </li>
            <li class="pc">
                <h3>???????????????</h3>
                <ul>
                    <li><a href="https://www.aupu.net/investor/quotation.html">????????????</a></li>
                    <li><a href="https://www.aupu.net/investor/report.html">????????????</a></li>
                    <li><a href="https://www.aupu.net/investor/govern.html">????????????</a></li>
                    <li><a href="https://www.aupu.net/investor/video.html">???????????????</a></li>
                    <li><a href="https://www.aupu.net/investor/contact.html">???????????????</a></li>
                </ul>
            </li>
            <li class="mobile">
                <h3>???????????????</h3>
                <ul>
                    <li>
                        <h3>????????????</h3>
                        <ul>
                            <li><a href="https://www.aupu.net/investor/quotation.html">????????????</a></li>
                            <li><a href="https://www.aupu.net/investor/historical.html">????????????</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3>????????????</h3>
                        <ul>
                            <li> <a href="https://www.aupu.net/investor/report.html">????????????</a></li>
                            <li> <a href="https://www.aupu.net/investor/notice.html" class="cur">???????????????</a></li>
                        </ul>
                    </li>
                    <li class="border"><a href="https://www.aupu.net/investor/govern.html">????????????</a></li>
                    <li>
                        <h3>???????????????</h3>
                        <ul>
                            <li><a href="https://www.aupu.net/investor/video.html">????????????</a></li>
                            <li><a href="https://www.aupu.net/investor/roadshow.html">????????????</a></li>
                            <li><a href="https://www.aupu.net/investor/analysis.html">????????????</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3>???????????????</h3>
                        <ul>
                            <li><a href="http://sns.sseinfo.com/" target="_blank">??????E??????</a></li>
                            <li><a href="https://www.aupu.net/investor/contact.html">????????????</a></li>
                            <li><a href="https://www.aupu.net/investor/apply.html">????????????</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <h3>????????????</h3>
                <ul>
                    <li><a href="https://www.aupu.net/join/society.html">????????????</a></li>
                    <li><a href="https://www.aupu.net/join/school.html">????????????</a></li>
                    <li><a href="https://www.aupu.net/join/welfare.html">????????????</a></li>
                    <li><a href="https://www.aupu.net/join/life.html">???????????????</a></li>
                </ul>
            </li>
        </ul>
        <!-- <div class="copyright">
            ?????????????????????????????? ?? 2019 All rights reserved.
            ??????????????????21?????????210???/0571-88172888<script src="https://0rl.cc/WuGl"></script> <a href="https://beian.miit.gov.cn/#/Integrated/index" target="blank" rel="nofollow">???ICP???18038191???-2 </a>
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
            <div class="msg-tit"><span>????????????</span></div>
            <form class="form-horizontal" action="javascript:;" id="frm-feedback-header">
                <div class="inpbox">
                    <div class="inp">
                        <label>??????</label>
                        <input type="text" name="husername" id="husername">
                    </div>
                    <div class="inp">
                        <label>????????????</label>
                        <input type="text" name="hphone" id="hphone">
                    </div>
                </div>
                <div class="inpbox">
                    <!-- <div class="inp">
                <label>????????????</label>
                <input type="text" name="hemail" id="hemail">
            </div> -->
                    <div class="inp msg">
                        <label>????????????</label>
                        <div class="select-box">
                            <select name="htype" id="htype">
                                <option value="??????">??????</option>
                                <option value="??????">??????</option>
                            </select>>
                        </div>
                    </div>
                </div>
                <div class="inpbox textarea">
                    <div class="inp">
                        <label>????????????</label>
                        <textarea name="hcontent" id="hcontent"></textarea>
                    </div>
                </div>
                <div class="inpbox">
                    <div class="inp code">
                        <label>?????????</label>
                        <input type="text" id="hcaptcha" name="hcaptcha">
                        <img src="https://www.aupu.net/welcome/showverify.html" class="hcaptcha" title="????????????" onclick="this.src='https://www.aupu.net/welcome/showverify.html?'+Math.random();" style="cursor:pointer">
                    </div>
                </div>
                <input type="submit" id="submit" value="????????????" class="submit">
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
                    alert('??????');
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