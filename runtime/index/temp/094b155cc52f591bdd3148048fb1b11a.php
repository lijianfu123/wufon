<?php /*a:4:{s:68:"/Users/mac/site/an_ke_rui/wwwroot/app/index/pc_view/index/index.html";i:1590371848;s:63:"/Users/mac/site/an_ke_rui/wwwroot/app/index/pc_view/layout.html";i:1590364119;s:63:"/Users/mac/site/an_ke_rui/wwwroot/app/index/pc_view/header.html";i:1590364119;s:63:"/Users/mac/site/an_ke_rui/wwwroot/app/index/pc_view/footer.html";i:1590398373;}*/ ?>
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
        <?php $Model = new app\common\model\SwiperModel();$detail = $Model->get_pass_detail(1);$__list__ = $detail["image_list_json"];if(is_array($__list__) || $__list__ instanceof \think\Collection || $__list__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__list__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
            <div class="swiper-slide">
                <a href="<?php echo htmlentities($value['url']); ?>" target="_blank">
                    <img src="<?php echo htmlentities($value['image']); ?>" class="pc_banner">
                </a>
            </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="swiper-pagination"></div>
</div>

<!-- ???????????? -->
<div class="about-container">
    <div class="wrap">
        <h1 class="plate-title fadeInLeft animated wow">????????????</h1>
        <h6 class="plate-slogan fadeInRight animated wow">??????????????????????????</h6>
        <div class="about-content">
            <?php $Model = new app\common\model\IntroModel();$value = $Model->get_pass_detail(1);$value["intro_detail_url"] = intro_detail_url($value["id"]);?>
                <div class="left">
                    <p class="slogan fadeInRightBig animated wow" style="font-size: 18px;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 3;overflow: hidden;">
                        <?php echo htmlentities(text_length($value['content'],'360')); ?>...
                    </p>
                    <a href="<?php echo htmlentities($value['intro_detail_url']); ?>" class="more">????????????>></a>
                </div>
                <div class="right fadeInLeft animated wow" >
                    <video controls="controls" src="<?php echo htmlentities($value['video']); ?>" style="    margin: 0 17px;
                    ">
                        ?????????????????????????????????
                    </video>
                </div>
            
        </div>
    </div>
</div>

<script>
    function??mouseover(e,??checked)??{
        let??childNode??=??e.querySelector('.imgBck');
        childNode.src??=??checked;
    }

    function??mouseleave(e,??unchecked)??{
        let??childNode??=??e.querySelector('.imgBck');
        childNode.src??=??unchecked
    }
</script>

<!-- ?????????????????? -->
<div class="solution wrap">
    <h1 class="plate-title">??????????????????</h1>
    <h6 class="plate-slogan">
        ??????????????????????????

        <a href="<?php echo news_detail_url($solution_id); ?>" style="position: absolute;
            right: 0;
            width: 105px;
            text-align: center;
            line-height: 30px;
            height: 30px;
            border: 1px solid #05a25f;
            border-radius: 17px;
            color: #05A25F;
            font-weight: 900;">????????????</a>
    </h6>
    <ul class="wrap">
        <?php $list = (new \app\common\model\NewsModel())->where("(is_pass = 1) and (is_commend = 1) and (delete_time = 0) and (first_news_class_id = 1)")->order('id desc')->limit(5)->select(); if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
            <li class="slideInDown??animated??wow??solutionLi" data-wow-duration=".3s" onmouseover="mouseover(this,'<?php echo htmlentities($value['icon_2']); ?>')" onmouseleave="mouseleave(this,'<?php echo htmlentities($value['icon']); ?>')" onclick="location.href='<?php echo news_detail_url($value['id']); ?>'">
????????????      <img src="<?php echo htmlentities($value['icon']); ?>" class="imgBck" alt="">
            <h5 style="text-align: center;"><?php echo htmlentities($value['news_name_eng']); ?></h5>
??????????????     <p style="text-align: center;"><?php echo htmlentities(text_length($value['news_name'],30)); ?></p>
????????    </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>

<!-- ??????????????????_????????? -->
<?php if ($app['is_mobile']) { ?>
<div class="product-wrap wrap">
    <h1 class="plate-title fadeInRight animated wow" id="aaaa">??????????????????</h1>
    <h6 class="plate-slogan fadeInLeft animated wow">
        ??????????????????????????
        <a href="/product_list1.html" style="position: absolute;
            right: 0;
            width: 105px;
            text-align: center;
            line-height: 30px;
            height: 30px;
            border: 1px solid #05a25f;
            border-radius: 17px;
            color: #05A25F;
            font-weight: 900;">????????????</a>
    </h6>
    <ul>
        <?php $list = (new \app\common\model\NewsModel())->where("(is_pass = 1) and (is_commend = 1) and (delete_time = 0) and (first_news_class_id = 1)")->order('id desc')->limit(4)->select(); if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
        <li class="fadeInRight animated wow">
            <a href="<?php echo news_detail_url($value['id']); ?>">
                <img src="<?php echo htmlentities($value['icon']); ?>"/>
                <p class="product-info"><?php echo htmlentities(text_length($value['news_name'],'20')); ?></p>
            </a>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
<?php } ?>

<!-- ?????????????????? -->
<div class="platform-wrap">
    <h1 class="plate-title">??????????????????</h1>
    <h6 class="plate-slogan">
        ??????????????????????????

        <a href="<?php echo news_detail_url($cloud_id); ?>" style="position: absolute;
            right: 0;
            width: 105px;
            text-align: center;
            line-height: 30px;
            height: 30px;
            border: 1px solid #05a25f;
            border-radius: 17px;
            color: #05A25F;
            font-weight: 900;">????????????</a>
    </h6>
    <!-- Swiper -->
    <div class="swiper-container swiper-container2 wrap">
        <div class="swiper-wrapper">
            <?php $list = (new \app\common\model\NewsModel())->where("(is_pass = 1) and (is_commend = 1) and (delete_time = 0) and (first_news_class_id = 2)")->order('id desc')->limit(5)->select(); if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                <div class="swiper-slide fadeInLeft animated wow mateSlide" onclick="location.href='<?php echo news_detail_url($value['id']); ?>';" style="margin-right:9px">
                    <img src="<?php echo htmlentities($value['icon']); ?>" class="pc_banner">
                    <h5 style="text-align: center; font-weight: normal;"><?php echo htmlentities($value['news_name_eng']); ?></h5>
                    <h5 style="text-align: center;"><?php echo htmlentities($value['news_name']); ?></h5>
                    <div class="heng"></div>
                    <p style="height: 70px;"><?php echo htmlentities(text_length($value['gong_neng'],70)); ?></p>
                </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="swiper-pagination2 swiper-pagination"></div>
    </div>
</div>

<!-- ??????????????????_????????? -->
<?php if ($app['is_mobile']) { ?>
<div class="product-wrap wrap">
    <h1 class="plate-title fadeInRight animated wow" id="aaaa">??????????????????</h1>
    <h6 class="plate-slogan fadeInLeft animated wow">
        ??????????????????????????
        <a href="/product_list1.html" style="position: absolute;
            right: 0;
            width: 105px;
            text-align: center;
            line-height: 30px;
            height: 30px;
            border: 1px solid #05a25f;
            border-radius: 17px;
            color: #05A25F;
            font-weight: 900;">????????????</a>
    </h6>
    <ul>
        <?php $list = (new \app\common\model\NewsModel())->where("(is_pass = 1) and (is_commend = 1) and (delete_time = 0) and (first_news_class_id = 2)")->order('id desc')->limit(4)->select(); if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
        <li class="fadeInRight animated wow">
            <a href="<?php echo news_detail_url($value['id']); ?>">
                <img src="<?php echo htmlentities($value['icon']); ?>"/>
                <p class="product-info"><?php echo htmlentities(text_length($value['news_name'],'20')); ?></p>
            </a>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
<?php } ?>

<!-- ???????????? -->
<div class="product-wrap wrap">
    <h1 class="plate-title fadeInRight animated wow" id="aaaa">????????????</h1>
    <h6 class="plate-slogan fadeInLeft animated wow">
        ??????????????????????????

        <a href="/product_list1.html" style="position: absolute;
            right: 0;
            width: 105px;
            text-align: center;
            line-height: 30px;
            height: 30px;
            border: 1px solid #05a25f;
            border-radius: 17px;
            color: #05A25F;
            font-weight: 900;">????????????</a>
    </h6>
    <ul>
        <?php $list = (new \app\common\model\ProductModel())->where("(is_pass = 1) and (is_commend = 1) and (delete_time = 0)")->order('id desc')->limit(12)->select(); if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
            <li class="fadeInRight animated wow">
                <a href="<?php echo product_detail_url($value['id']); ?>">
                    <img src="<?php echo htmlentities($value['image']); ?>" alt="??????"/>
                    <p class="product-info"><?php echo htmlentities(text_length($value['product_name'],'20')); ?></p>
                </a>
            </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>

<!-- ???????????? -->
<div class="case-container">
    <h1 class="plate-title">????????????</h1>
    <h6 class="plate-slogan">??????????????????????????</h6>
    <!--??????html??????-->
    <div class="poster-main">
        <div class="poster-btn poster-prev-btn"></div>
        <ul class="poster-list">
            <?php $list = (new \app\common\model\NewsModel())->where("(is_pass = 1) and (is_commend = 1) and (delete_time = 0) and (first_news_class_id = 3)")->order('id desc')->limit(5)->select(); if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;
                    switch ($key) {
                        case 0:
                            $class_name = 'rollIn';
                            break;
                        case 1:
                            $class_name = 'rotateInDownRight';
                            break;
                        case 2:
                            $class_name = 'rotateInDownRight';
                            break;
                        case 3:
                            $class_name = 'rotateInDownLeft';
                            break;
                        case 4:
                            $class_name = 'rotateInDownRight';
                            break;
                    }
                 ?>
                <li class="poster-item animated wow <?php echo htmlentities($class_name); ?>">
                    <a href="<?php echo news_detail_url($value['id']); ?>">
                        <img src="<?php echo htmlentities($value['image']); ?>">
                        <span class="poster-item-title"><?php echo htmlentities($value['news_name']); ?></span>
                    </a>
                </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <div class="poster-btn poster-next-btn"></div>
    </div>
</div>

<script src="/app/index/pc_view/js/wow.min.js"></script>
<script>
    set_nav(0); //?????? ??????
    new WOW().init();

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

    var swiper2 = new Swiper('.swiper-container2', {
        direction: 'horizontal',
        slidesPerView: 5,
        spaceBetween: 9,
        slidesPerGroup: 5,
        autoplay: true,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
            el: '.swiper-pagination2',
            clickable: true,
        }
    });

    $(".poster-main").Carousel({
        "width": 1200,
        "height": 383,
        "posterWidth": 602,
        "posterHeight": 383,
        "scale": 0.85,
        "speed": 500,
        "autoPlay": true,
        "delay": 3000
    });
</script>
<!-- ?????? -->
<?php if (!$app['is_mobile']) { ?>
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
<?php } else { ?>
<style>
    .footer_menu {background: black; color: white; position: fixed; bottom: 0; width: 100%; padding: 15px 0;}
        .footer_menu img {width: 20px; height: 20px;}
        .footer_menu a {color: white;}
</style>
<div style="height: 20px;">&nbsp;</div>
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
        <a href="https://shop110519718.taobao.com/">
            <div><img src="/app/index/pc_view/image/ico_cart.png"></div>
            <div>??????</div>
        </a>
    </div>
    <div style="float: left; width: 25%; text-align: center;">
        <a href="<?php echo intro_detail_url(1); ?>">
            <div><img src="/app/index/pc_view/image/ico_tel.png"></div>
            <div>????????????</div>
        </a>
    </div>
    <div style="clear: both;"></div>
</div>
<?php } ?>
</body>
</html>