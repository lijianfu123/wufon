<?php /*a:4:{s:70:"/Users/mac/site/an_ke_rui/wwwroot/app/index/pc_view/intro/contact.html";i:1590364139;s:63:"/Users/mac/site/an_ke_rui/wwwroot/app/index/pc_view/layout.html";i:1590364119;s:63:"/Users/mac/site/an_ke_rui/wwwroot/app/index/pc_view/header.html";i:1590364119;s:63:"/Users/mac/site/an_ke_rui/wwwroot/app/index/pc_view/footer.html";i:1590397450;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlentities($main_detail['title']); ?></title>
    <meta name="keywords" content="<?php echo htmlentities($main_detail['keywords']); ?>">
    <meta name="description" content="<?php echo htmlentities($main_detail['description']); ?>">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport"/>

    <link rel="stylesheet" href="/app/index/pc_view/css/swiper.css">
    <link rel="stylesheet/less" href="/app/index/pc_view/css/index.less">
    <link rel="stylesheet/less" href="/app/index/pc_view/css/news.less">
    <link rel="stylesheet/less" href="/app/index/pc_view/css/newsPhone.less">
    <link rel="stylesheet/less" href="/app/index/pc_view/css/phone.less">
    <link rel="stylesheet" href="/app/index/pc_view/css/animate.min.css">

    <link rel="stylesheet" href="/app/index/pc_view/css/index.css">
    <link rel="stylesheet" href="/app/index/pc_view/css/phone.css">
    <link rel="stylesheet" href="/app/index/pc_view/css/style.css">

    <script src="/app/index/pc_view/js/flexible.js"></script>
    <script src="/app/index/pc_view/js/flexible_css.js"></script>
    <script src="/app/index/pc_view/js/jquery-3.2.1.min.js"></script>
    <script src="/app/index/pc_view/js/jquery-1.10.2.js"></script>
    <script src="/app/index/pc_view/js/Carousel.js"></script>
    <script src="/app/index/pc_view/js/PicCarousel.js"></script>
    <script src="/app/index/pc_view/js/swiper.min.js"></script>
    <script src="/app/index/pc_view/js/less.min.js"></script>

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
    header a {color: white;}
    header a:hover {color: #05A25F;}
    nav a:hover, nav li a:hover {color: #05A25F;}
</style>

<!--??????_start-->
<header>
    <ul class="wrap">
        <li class="rotateInDownLeft animated wow">
            <img src="/app/index/pc_view/image/ac.png" alt="">
            <span>
                <a href="http://www.acrelcloud.cn/Login.html" target="_blank">?????????????????????</a>
            </span>
        </li>
        <li class="rotateInDownLeft animated wow">
            <img src="/app/index/pc_view/image/acc.png" alt="">
            <span>
                <a href="http://safe.acrelcloud.cn/" target="_blank">???????????????????????????</a>
            </span>
        </li>
        <li class="rotateInDownLeft animated wow">
            <img src="/app/index/pc_view/image/2.png" alt="">
            <span>
                <a href="http://yun.acrel-eem.com/" target="_blank">??????????????????</a>
            </span>
        </li>
        <li class="rotateInDownLeft animated wow">
            <img src="/app/index/pc_view/image/hb.png" alt="">
            <span>
                <a href="http://hb.acrelcloud.cn/" target="_blank">????????????????????????</a>
            </span>
        </li>
        <li class="rotateInDownLeft animated wow">
            <img src="/app/index/pc_view/image/3.png" alt="">
            <span>
                <a href="http://116.236.149.165:18091/" target="_blank">Acrel-5000??????????????????????????????</a>
            </span>
        </li>
        <li class="rotateInDownLeft animated wow">
            <img src="/app/index/pc_view/image/dpc1.png" alt="">
            <span>
                <a href="http://evcharging.acrel-eem.com/" target="_blank">?????????????????????</a>
            </span>
        </li>
    </ul>
</header>
<!--??????_end-->

<!-- PC??????????????? -->
<nav class="wrap">
    <div class="left fadeInLeft animated wow">
        <img src="/app/index/pc_view/image/logo.png" alt="">
        <p><?php echo htmlentities($site_detail['site_name']); ?></p>
    </div>
    <div class="right">
        <ul class="contact-wrap">
            <li>
                <img src="/app/index/pc_view/image/phone.png" alt="">
                <span><?php echo htmlentities($site_detail['mobile']); ?></span>
            </li>
            <li>
                <img src="/app/index/pc_view/image/phone2.png" alt="">
                <span>
                    <?php 
                        $site_tel = $site_detail['tel'];
                        $site_tel = trim($site_tel);
                        $array = explode(' ', $site_tel);
                        echo $array[0];
                     ?>
                </span>
            </li>
            <li>
                <img src="/app/index/pc_view/image/QQ2.png" alt="">
                <span><?php echo htmlentities($site_detail['qq']); ?></span>
            </li>
            <li>
                <input type="text" placeholder="?????????????????????"/>
            </li>
        </ul>
        <ul class="nav-ul">
            <li>
                <a href="/">??????</a>
            </li>
            <li>
                <a href="<?php echo intro_detail_url(1); ?>">????????????</a>
                <div class="hide-nav">
<!--                    <h1>????????????>></h1>-->
                    <div class="jieshao">
                        <ul style="margin-right: 20px;margin-left: 20px;">
                            <h3>
                                <a href="/intro_detail1.html?tab=0"><img src="/app/index/pc_view/image/ico_menu_intro.png"></a>
                                <a href="/intro_detail1.html?tab=0">????????????</a>
                            </h3>
                        </ul>
                        <ul style="margin-right: 20px;margin-left: 20px;">
                            <h3>
                                <a href="/intro_detail1.html?tab=1"><img src="/app/index/pc_view/image/ico_menu_honnor.png"></a>
                                <a href="/intro_detail1.html?tab=1">????????????</a>
                            </h3>
                        </ul>
                        <ul style="margin-right: 20px;margin-left: 20px;">
                            <h3>
                                <a href="/intro_detail1.html?tab=2"><img src="/app/index/pc_view/image/ico_menu_news.png"></a>
                                <a href="/intro_detail1.html?tab=2">????????????</a>
                            </h3>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="product-center">
                <a href="<?php echo product_list_url(1); ?>">????????????</a>

                <div class="hide-nav">
<!--                    <h1>????????????>></h1>-->
                    <div>
                        <?php 
                        $ProductClassModel = new app\common\model\ProductClassModel();
                        $product_class_list = $ProductClassModel->get_pass_list();

                        foreach ($product_class_list as $first_product_class) {
                        if ($first_product_class['level'] == 1) {
                         ?>
                        <ul>
                            <h3>
                                <a href="<?php echo product_list_url($first_product_class['id']); ?>"><?php echo htmlentities($first_product_class['product_class_name']); ?>></a>
                            </h3>
                            <?php 
                            foreach ($product_class_list as $second_product_class) {
                            if ($second_product_class['parent_id'] == $first_product_class['id']) {
                             ?>
                            <li>
                                <a href="<?php echo product_list_url($second_product_class['id']); ?>" style="font-weight: normal; color: black; font-size: 16px;"><?php echo htmlentities($second_product_class['product_class_name']); ?></a>
                            </li>
                            <?php 
                            }
                            }
                             ?>
                        </ul>
                        <?php 
                        }
                        }
                         ?>
                    </div>
                </div>
            </li>
            <li>
                <a href="<?php echo news_detail_url($solution_id); ?>">????????????</a>

                <div class="hide-nav" style="position: absolute;left: -562px;">
<!--                    <h1>????????????</h1>-->
                    <div>
                        <?php 
                        $SolutionNewsModel = new \app\common\model\NewsModel();

                        $solution_news_list = $SolutionNewsModel->where('is_pass = 1 and first_news_class_id = 1')->order('sort asc, id desc')->select();
                        foreach ($solution_news_list as $key => $solution_news) {
                         ?>
                            <ul>
                                <h3>
                                    <a href="/news_detail<?php echo htmlentities($solution_news['id']); ?>.html"><!--<?php echo htmlentities($solution_news['news_name_eng']); ?>--> <?php echo htmlentities($solution_news['news_name']); ?></a>
                                </h3>
                            </ul>
                        <?php 
                        }
                         ?>
                    </div>
                </div>
            </li>
            <li>
                <a href="<?php echo news_detail_url($cloud_id); ?>">?????????</a>

                <div class="hide-nav" style="position: absolute;left: -660px;">
<!--                    <h1>?????????</h1>-->
                    <div>
                        <?php 
                        $SolutionNewsModel = new \app\common\model\NewsModel();

                        $solution_news_list = $SolutionNewsModel->where('is_pass = 1 and first_news_class_id = 2')->order('sort asc, id desc')->select();
                        foreach ($solution_news_list as $key => $solution_news) {
                         ?>
                        <ul>
                            <h3>
                                <a href="/news_detail<?php echo htmlentities($solution_news['id']); ?>.html"><!--<?php echo htmlentities($solution_news['news_name_eng']); ?>--> <?php echo htmlentities($solution_news['news_name']); ?></a>
                            </h3>
                        </ul>
                        <?php 
                        }
                         ?>
                    </div>
                </div>
            </li>
            <li>
                <a href="<?php echo download_list_url(1); ?>">????????????</a>
                <div class="hide-nav" style="position: absolute;left: -758px;">
<!--                    <h1>????????????</h1>-->
                    <div class="jieshao">
                        <ul>
                            <?php 
                                $DownloadClassModel = new \app\common\model\DownloadClassModel();

                                $download_class_list = $DownloadClassModel->where('is_pass = 1')->order('sort asc')->select();
                                foreach ($download_class_list as $key => $download_class) {
                                    $icon = '';

                                    switch ($download_class['id']) {
                                        case 1:
                                            $icon = 'she_ji';
                                            break;
                                        case 2:
                                            $icon = 'chan_pin';
                                            break;
                                        case 3:
                                            $icon = 'xi_tong';
                                            break;
                                        case 4:
                                            $icon = 'ji_shu';
                                            break;
                                        case 5:
                                            $icon = 'biao_zhun';
                                            break;
                                    }
                             ?>
                                    <h3>
                                        <a href="download_list<?php echo htmlentities($download_class['id']); ?>.html"><img src="/app/index/pc_view/image/ico_menu_<?php echo htmlentities($icon); ?>.png"></a>
                                        <a href="download_list<?php echo htmlentities($download_class['id']); ?>.html"><?php echo htmlentities($download_class['download_class_name']); ?></a>
                                    </h3>
                            <?php 
                            }
                             ?>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a href="<?php echo intro_detail_url(2); ?>">????????????</a>
            </li>
            <li>
                <a href="https://shop110519718.taobao.com" target="_blank">????????????</a>
            </li>
        </ul>
    </div>
</nav>

<!-- ????????????????????? -->
<nav class="wrap phone-nav">
    <div class="left">
        <img src="/app/index/pc_view/image/logo.png" alt="">
        <p>?????????????????????????????????</p>
        <img src="/app/index/pc_view/image/mian.png" class="fold" alt="">
    </div>
    <div class="right">
        <ul class="nav-ul">
            <li>
                <a href="/">??????</a>
            </li>
            <li>
                <a href="<?php echo intro_detail_url(1); ?>">????????????</a>
            </li>
            <li>
                <a href="<?php echo product_list_url(1); ?>">????????????</a>
            </li>
            <li>
                <a href="<?php echo news_detail_url($solution_id); ?>">????????????</a>
            </li>
            <li>
                <a href="<?php echo news_detail_url($cloud_id); ?>">?????????</a>
            </li>
            <li>
                <a href="<?php echo download_list_url(1); ?>">????????????</a>
            </li>
            <li>
                <a href="<?php echo intro_detail_url(2); ?>">????????????</a>
            </li>
            <li>
                <a href="https://shop110519718.taobao.com" target="__blank">????????????</a>
            </li>
        </ul>
    </div>
</nav>
<!-- ????????? -->
<div class="swiper-container swiper-container1">
    <div class="swiper-wrapper">
        <?php $Model = new app\common\model\SwiperModel();$detail = $Model->get_pass_detail(7);$__list__ = $detail["image_list_json"];if(is_array($__list__) || $__list__ instanceof \think\Collection || $__list__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__list__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
            <div class="swiper-slide">
                <img src="<?php echo htmlentities($value['image']); ?>" class="pc_banner">
            </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="swiper-pagination"></div>
</div>

<div class="about-container aboutDetail" style="background: none;">
    <!--?????????-->
    <ul class="wrap navigation">
        <li class="rotateInDownLeft animated wow">
            <img src="/app/index/pc_view/image/address2.png" alt="??????" />
            ???????????????
        </li>
        <li class="rotateInDownLeft animated wow">
            <a href="/" class="selectText">??????</a> >
        </li>
        <li class="rotateInDownLeft animated wow">
            <span class="selectText"><?php echo htmlentities($main_detail['intro_name']); ?></span>
        </li>
    </ul>

    <div class="contact-wrap wrap">
        <div class="left">
            <h2 class="rotateInDownRight animated wow"><?php echo htmlentities($site_detail['site_name']); ?></h2>
            <ul>
                <li class="slideInRight animated wow">
                    <label>???????????????</label>
                    <span><?php echo htmlentities($site_detail['address']); ?></span>
                </li>
                <li class="slideInLeft animated wow">
                    <label>??? ??? ??????</label>
                    <span><?php echo htmlentities($site_detail['linkman']); ?></span>
                </li>
                <li class="slideInRight animated wow">
                    <label>Q &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Q???</label>
                    <span><?php echo htmlentities($site_detail['qq']); ?></span>
                </li>
                <li class="slideInLeft animated wow">
                    <label>??? ??? ??????</label>
                    <span><?php echo htmlentities($site_detail['mobile']); ?>???????????????</span>
                </li>
                <li class="slideInRight animated wow">
                    <label>??? &nbsp;&nbsp;&nbsp; ??????</label>
                    <span>
                        <?php 
                            $site_tel = $site_detail['tel'];
                            $site_tel = trim($site_tel);

                            $array = explode(' ', $site_tel);
                            foreach ($array as $key => $value) {
                                if ($key == 0) {
                                    echo '<span>' . $value . '</span><br>';
                                } else {
                                    echo '<span style="padding-left: 76px;">' . $value . '</span><br>';
                                }
                            }
                     ?>
                    </span>
                </li>
                <li class="slideInLeft animated wow">
                    <label>??? &nbsp;&nbsp;&nbsp; ??????</label>
                    <span><?php echo htmlentities($site_detail['fax']); ?></span>
                </li>
                <li class="slideInRight animated wow">
                    <label>??? &nbsp;&nbsp;&nbsp; ??????</label>
                    <span><?php echo htmlentities($site_detail['post']); ?></span>
                </li>
                <li class="slideInLeft animated wow">
                    <label>E - mail???</label>
                    <span><?php echo htmlentities($site_detail['email']); ?></span>
                </li>
            </ul>
        </div>
        <div class="right lightSpeedIn animated wow">
<!--            <img src="<?php echo htmlentities($main_detail['image']); ?>" alt="">-->

            <!-- <div id="container"></div>

                       <script type="text/javascript" src="//api.map.baidu.com/api?type=webgl&v=1.0&ak=GMZRmeUda5D3WVNMPfrUHuryod9ACsvb"></script>
            <script type="text/javascript">
                var map = new BMapGL.Map("container");
                var point = new BMapGL.Point(116.404, 39.915);
                map.centerAndZoom(point, 15);
            </script>-->

            <?php 
                //121.307139, 31.34996
                $map_array = explode(',', $site_detail['map_point']);

                if (!$app['is_mobile']) {
             ?>
                <div id="allmap" style="width: 100%;height: 410px;"></div>
            <?php 
                }
             ?>
             <script type="text/javascript" src="//api.map.baidu.com/api?type=webgl&v=1.0&ak=GMZRmeUda5D3WVNMPfrUHuryod9ACsvb"></script>
             <script type="text/javascript">
                // ????????????API??????
                var map = new BMapGL.Map("allmap");
                
                var point = new BMapGL.Point('<?php echo htmlentities($map_array[0]); ?>', '<?php echo htmlentities($map_array[1]); ?>');
                map.centerAndZoom(point, 18);
                map.enableScrollWheelZoom(true);


                // ???????????????
                var pt = new BMapGL.Point('<?php echo htmlentities($map_array[0]); ?>', '<?php echo htmlentities($map_array[1]); ?>');
                var marker = new BMapGL.Marker(pt);  // ????????????
                map.addOverlay(marker);              // ???????????????????????????
            </script>
        </div>
    </div>

    <div class="wrap remittance-info">
        <ul class="slideInRight animated wow" style="width: 100%;padding-left: 6%;">
            <h5>?????????????????????</h5>
            <li>
                <label>???????????????</label>
                <span><?php echo htmlentities($site_detail['company_1']); ?></span>
            </li>
            <li>
                <label>???????????????</label>
                <span><?php echo htmlentities($site_detail['address_1']); ?></span>
            </li>
            <li>
                <label>??????????????????</label>
                <span><?php echo htmlentities($site_detail['tax_1']); ?></span>
            </li>
            <li>
                <label>????????????</label>
                <span><?php echo htmlentities($site_detail['bank_1']); ?></span>
            </li>
            <li>
                <label>?????????</label>
                <span><?php echo htmlentities($site_detail['account_1']); ?></span>
            </li>
            <li>
                <label>?????????</label>
                <span><?php echo htmlentities($site_detail['fax_1']); ?></span>
            </li>
        </ul>
        <div class="vertical"></div>
        <ul class="slideInLeft animated wow" style="width: 100%;padding-left: 6%;">
            <h5>?????????????????????</h5>
            <li>
                <label>???????????????</label>
                <span><?php echo htmlentities($site_detail['company_2']); ?></span>
            </li>
            <li>
                <label>???????????????</label>
                <span><?php echo htmlentities($site_detail['address_2']); ?></span>
            </li>
            <li>
                <label>??????????????????</label>
                <span><?php echo htmlentities($site_detail['tax_2']); ?></span>
            </li>
            <li>
                <label>????????????</label>
                <span><?php echo htmlentities($site_detail['bank_2']); ?></span>
            </li>
            <li>
                <label>?????????</label>
                <span><?php echo htmlentities($site_detail['account_2']); ?></span>
            </li>
            <li>
                <label>?????????</label>
                <span><?php echo htmlentities($site_detail['fax_2']); ?></span>
            </li>
        </ul>
    </div>
</div>

<script>
    set_nav(6); //?????? ??????

    var mySwiper = new Swiper('.swiper-container1', {
        direction: 'horizontal',
        loop: true,
        autoplay: true,
        delay: 3000,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            clickableClass: 'my-pagination-clickable',
            autoplay: true
        },
    });
</script>
<!-- ?????? -->
<footer>
    <ul class="wrap">
        <li>
            <h2>????????????</h2>
            <ul>
                <?php $Model = new app\common\model\ProductClassModel();$__list__ = $Model->where("parent_id = 0")->select();if(is_array($__list__) || $__list__ instanceof \think\Collection || $__list__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__list__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;$list_url = "product_list_url";$value[$list_url] = product_list_url($value["id"]); ?>
                    <li>
                        <a href="<?php echo htmlentities($value['product_list_url']); ?>"><?php echo htmlentities($value['product_class_name']); ?></a>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </li>
        <li class="switchTab1">
            <h2>????????????</h2>
            <ul>
                <?php $list = (new \app\common\model\NewsModel())->where("(is_pass = 1) and (delete_time = 0) and (first_news_class_id = 1)")->order('sort asc, id desc')->limit(9)->select(); if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                    <li>
                        <a href="<?php echo news_detail_url($value['id']); ?>"><?php echo htmlentities($value['news_name_eng']); ?> <?php echo htmlentities($value['news_name']); ?></a>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </li>
        <li class="switchTab1">
            <h2>?????????</h2>
            <ul>
                <?php $list = (new \app\common\model\NewsModel())->where("(is_pass = 1) and (delete_time = 0) and (first_news_class_id = 2)")->order('sort asc, id desc')->limit(9)->select(); if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                    <li>
                        <a href="<?php echo news_detail_url($value['id']); ?>"><?php echo htmlentities($value['news_name_eng']); ?> <?php echo htmlentities($value['news_name']); ?></a>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </li>
        <li>
            <h2>????????????</h2>
            <ul>
                <li>
                    <?php echo htmlentities($site_detail['site_name']); ?>
                </li>
                <li>
                    <img src="/app/index/pc_view/image/QQ.png" alt="">
                    <a href=""><?php echo htmlentities($site_detail['qq']); ?></a>
                </li>
                <li>
                    <img src="/app/index/pc_view/image/phone-.png" alt="">
                    <a href=""><?php echo htmlentities($site_detail['mobile']); ?></a>
                </li>
                <li>
                    <img src="/app/index/pc_view/image/telephone.png" alt="">
                    <a href="">
                        <?php 
                            $site_tel = $site_detail['tel'];
                            $site_tel = trim($site_tel);
                            $array = explode(' ', $site_tel);
                            echo $array[0];
                         ?>
                    </a>
                </li>
                <li>
                    <img src="/app/index/pc_view/image/email.png" alt="">
                    <a href=""><?php echo htmlentities($site_detail['email']); ?></a>
                </li>
                <li>
                    <img src="/app/index/pc_view/image/address.png" alt="">
                    <a href=""><?php echo htmlentities($site_detail['address']); ?></a>
                </li>
                <li>
                    <img src="<?php echo htmlentities($site_detail['wechat_image']); ?>" alt="" style="width: 110px; height: 110px;">
                </li>
            </ul>
        </li>
    </ul>
    <div class="copyright-wrap">
        <p>
            <?php echo htmlentities($site_detail['site_name']); ?>
            ????????????Copyright@2020<br/><?php echo htmlentities($site_detail['icp']); ?>
        </p>
    </div>
</footer>

<!-- ????????????????????? 2020???3???20??? 13:40:03 -->
<aside class="consulting" style="display: block; z-index: 1000;">
    <ul>
        <li class="em">
            <a><img src="/app/index/pc_view/image/wx.png" alt=""></a>
            <img src="<?php echo htmlentities($site_detail['wechat_image']); ?>" class="xun" />
            <div class="ewm">
                <div class="iBox1">
                    <img src="/app/index/pc_view/image/ewm1.png" alt="">
                    <img src="/app/index/pc_view/image/ewm2.png" alt="">
                </div>
                <img src="/app/index/pc_view/image/eimg.png" alt="">
            </div>
        </li>
        <li>
            <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo htmlentities($site_detail['qq']); ?>&site=qq&menu=yes">
                <img src="/app/index/pc_view/image/qqq.png" alt="">
            </a>
        </li>
        <li class="dh">
            <a><img src="/app/index/pc_view/image/dh.png" alt=""></a>
            <div class="dhh">
                <p style="margin: 16px auto auto;font-size: 16px;"><?php echo htmlentities($site_detail['site_name']); ?></p>
                <p style="margin: 16px auto auto;font-size: 16px;">??????????????????</p>
                <?php 
                    $site_tel = $site_detail['tel'];
                    $site_tel = trim($site_tel);
                    $array = explode(' ', $site_tel);
                 ?>
                <input type="text" class="inpName" style="color: #000;font-size: 16px;" value="<?php echo htmlentities($array[0]); ?>" placeholder="????????????" readonly>
                <input type="text" class="inpName" style="color: #000;font-size: 16px;" value="<?php echo htmlentities($site_detail['mobile']); ?>" placeholder="????????????" readonly>
            </div>
        </li>
        <li onclick="backTop()">
            <a class="scroll"><img src="/app/index/pc_view/image/top.png" alt=""></a>
        </li>
    </ul>
</aside>

<?php if ($app['is_mobile']) { ?>
<style>
    .footer_menu {background: black; color: white; position: fixed; bottom: 0; width: 100%; padding: 15px 0;}
        .footer_menu img {width: 20px; height: 20px;}
        .footer_menu a {color: white;}
</style>
<div style="height: 60px;">&nbsp;</div>
<div class="footer_menu">
    <div style="float: left; width: 25%; text-align: center;">
        <a href="/">
            <div><img src="/app/index/pc_view/image/ico_home.png"></div>
            <div>??????</div>
        </a>
    </div>
    <div style="float: left; width: 25%; text-align: center;">
        <a href="<?php echo product_list_url(1); ?>">
            <div><img src="/app/index/pc_view/image/ico_product.png"></div>
            <div>????????????</div>
        </a>
    </div>
    <div style="float: left; width: 25%; text-align: center;">
        <a href="#">
            <div><img src="/app/index/pc_view/image/ico_cart.png"></div>
            <div>??????</div>
        </a>
    </div>
    <div style="float: left; width: 25%; text-align: center;">
        <a href="#">
            <div><img src="/app/index/pc_view/image/ico_home.png"></div>
            <div>??????</div>
        </a>
    </div>
    <div style="clear: both;"></div>
</div>
<?php } ?>
</body>
</html>