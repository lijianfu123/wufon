<?php /*a:4:{s:68:"/Users/mac/site/an_ke_rui/wwwroot/app/index/pc_view/intro/about.html";i:1590364139;s:63:"/Users/mac/site/an_ke_rui/wwwroot/app/index/pc_view/layout.html";i:1590364119;s:63:"/Users/mac/site/an_ke_rui/wwwroot/app/index/pc_view/header.html";i:1590364119;s:63:"/Users/mac/site/an_ke_rui/wwwroot/app/index/pc_view/footer.html";i:1590397535;}*/ ?>
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
    header a {color: white;}
    header a:hover {color: #05A25F;}
    nav a:hover, nav li a:hover {color: #05A25F;}
</style>

<!--头部_start-->
<header>
    <ul class="wrap">
        <li class="rotateInDownLeft animated wow">
            <img src="/app/index/pc_view/image/ac.png" alt="">
            <span>
                <a href="http://www.acrelcloud.cn/Login.html" target="_blank">变电所运维平台</a>
            </span>
        </li>
        <li class="rotateInDownLeft animated wow">
            <img src="/app/index/pc_view/image/acc.png" alt="">
            <span>
                <a href="http://safe.acrelcloud.cn/" target="_blank">安全用电管理云平台</a>
            </span>
        </li>
        <li class="rotateInDownLeft animated wow">
            <img src="/app/index/pc_view/image/2.png" alt="">
            <span>
                <a href="http://yun.acrel-eem.com/" target="_blank">预付费云平台</a>
            </span>
        </li>
        <li class="rotateInDownLeft animated wow">
            <img src="/app/index/pc_view/image/hb.png" alt="">
            <span>
                <a href="http://hb.acrelcloud.cn/" target="_blank">环保用电监管平台</a>
            </span>
        </li>
        <li class="rotateInDownLeft animated wow">
            <img src="/app/index/pc_view/image/3.png" alt="">
            <span>
                <a href="http://116.236.149.165:18091/" target="_blank">Acrel-5000建筑能耗分析管理系统</a>
            </span>
        </li>
        <li class="rotateInDownLeft animated wow">
            <img src="/app/index/pc_view/image/dpc1.png" alt="">
            <span>
                <a href="http://evcharging.acrel-eem.com/" target="_blank">电瓶车充电桩云</a>
            </span>
        </li>
    </ul>
</header>
<!--头部_end-->

<!-- PC端的导航栏 -->
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
                <input type="text" placeholder="请输入搜索内容"/>
            </li>
        </ul>
        <ul class="nav-ul">
            <li>
                <a href="/">首页</a>
            </li>
            <li>
                <a href="<?php echo intro_detail_url(1); ?>">企业介绍</a>
                <div class="hide-nav">
<!--                    <h1>企业介绍>></h1>-->
                    <div class="jieshao">
                        <ul style="margin-right: 20px;margin-left: 20px;">
                            <h3>
                                <a href="/intro_detail1.html?tab=0"><img src="/app/index/pc_view/image/ico_menu_intro.png"></a>
                                <a href="/intro_detail1.html?tab=0">公司介绍</a>
                            </h3>
                        </ul>
                        <ul style="margin-right: 20px;margin-left: 20px;">
                            <h3>
                                <a href="/intro_detail1.html?tab=1"><img src="/app/index/pc_view/image/ico_menu_honnor.png"></a>
                                <a href="/intro_detail1.html?tab=1">企业资质</a>
                            </h3>
                        </ul>
                        <ul style="margin-right: 20px;margin-left: 20px;">
                            <h3>
                                <a href="/intro_detail1.html?tab=2"><img src="/app/index/pc_view/image/ico_menu_news.png"></a>
                                <a href="/intro_detail1.html?tab=2">新闻中心</a>
                            </h3>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="product-center">
                <a href="<?php echo product_list_url(1); ?>">产品中心</a>

                <div class="hide-nav">
<!--                    <h1>所有产品>></h1>-->
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
                <a href="<?php echo news_detail_url($solution_id); ?>">解决方案</a>

                <div class="hide-nav" style="position: absolute;left: -562px;">
<!--                    <h1>解决方案</h1>-->
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
                <a href="<?php echo news_detail_url($cloud_id); ?>">云平台</a>

                <div class="hide-nav" style="position: absolute;left: -660px;">
<!--                    <h1>云平台</h1>-->
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
                <a href="<?php echo download_list_url(1); ?>">下载中心</a>
                <div class="hide-nav" style="position: absolute;left: -758px;">
<!--                    <h1>下载中心</h1>-->
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
                <a href="<?php echo intro_detail_url(2); ?>">联系我们</a>
            </li>
            <li>
                <a href="https://shop110519718.taobao.com" target="_blank">在线商城</a>
            </li>
        </ul>
    </div>
</nav>

<!-- 手机端的导航栏 -->
<nav class="wrap phone-nav">
    <div class="left">
        <img src="/app/index/pc_view/image/logo.png" alt="">
        <p>安科瑞电气股份有限公司</p>
        <img src="/app/index/pc_view/image/mian.png" class="fold" alt="">
    </div>
    <div class="right">
        <ul class="nav-ul">
            <li>
                <a href="/">首页</a>
            </li>
            <li>
                <a href="<?php echo intro_detail_url(1); ?>">企业介绍</a>
            </li>
            <li>
                <a href="<?php echo product_list_url(1); ?>">产品中心</a>
            </li>
            <li>
                <a href="<?php echo news_detail_url($solution_id); ?>">解决方案</a>
            </li>
            <li>
                <a href="<?php echo news_detail_url($cloud_id); ?>">云平台</a>
            </li>
            <li>
                <a href="<?php echo download_list_url(1); ?>">下载中心</a>
            </li>
            <li>
                <a href="<?php echo intro_detail_url(2); ?>">联系我们</a>
            </li>
            <li>
                <a href="https://shop110519718.taobao.com" target="__blank">在线商城</a>
            </li>
        </ul>
    </div>
</nav>
<!-- 轮播图 -->
<div class="swiper-container swiper-container1">
    <div class="swiper-wrapper">
        <?php $Model = new app\common\model\SwiperModel();$detail = $Model->get_pass_detail(2);$__list__ = $detail["image_list_json"];if(is_array($__list__) || $__list__ instanceof \think\Collection || $__list__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__list__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
            <div class="swiper-slide">
                <img src="<?php echo htmlentities($value['image']); ?>" class="pc_banner">
            </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="swiper-pagination"></div>
</div>

<!-- 选项卡 -->
<!--
<ul class="switchTab">
    <li class="aboutPlateCheck rotateInDownLeft animated wow" onclick="switchTab(1,event)">公司介绍</li>
    <li class="rotateInDownRight animated wow" onclick="switchTab(2,event)">企业资质</li>
</ul>
-->

<ul class="switchTab" style="position: relative;display: flex;">
    <li class="aboutPlateCheck rotateInDownLeft animated wow switchLi" onclick="switchTab(0,event)">公司介绍</li>
    <li class="rotateInDownRight animated wow switchLi" onclick="switchTab(1,event)">企业资质</li>
    <li class="rotateInDownRight animated wow switchLi" onclick="switchTab(2,event)">新闻中心</li>
</ul>

<div class="about-container aboutDetail" style="background: none;">
    <!--面包屑-->
    <ul class="wrap navigation">
        <li class="rotateInDownLeft animated wow">
            <img src="/app/index/pc_view/image/address2.png" alt="地标"/>
            当前位置：
        </li>
        <li class="rotateInDownLeft animated wow">
            <a href="/" class="selectText">首页</a> >
        </li>
        <li class="rotateInDownLeft animated wow">
            <span class="selectText"><?php echo htmlentities($main_detail['intro_name']); ?></span> >
        </li>
        <li class="rotateInDownLeft animated wow">
            <span class="selectText" id="intro_name">
                <?php 
                    switch(input('tab')){
                        case '0':
                            echo '公司介绍';
                            break;
                        case '1':
                            echo '企业资质';
                            break;
                        case '2':
                            echo '新闻中心';
                            break;
                    }
                 ?>
            </span>
        </li>
    </ul>

    <div class="wrap aboutUs switchCot">
        <div class="about-content">
            <div class="left">
                <h1 class="fadeInLeft animated wow"><?php echo htmlentities($site_detail['site_name']); ?></h1>
            </div>
        </div>

        <div class="comcontul" >
            <video controls="" src="http://www.acrel.cn/image/movie20171114.mp4" style="float:right; width: 600px; height: 350px; margin: 0 0 20px 20px;">
                <source src="../image/movie20171114.mp4" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                您的浏览器不支持Video标签。
            </video>

            <div style="padding: 10px; font-size: 22px;"><?php echo $main_detail['content']; ?></div>
        </div>

        <ul class="patent-wrap">
            <li class="rotateInDownRight animated wow">
                <img src="/app/index/pc_view/image/patent1.png" alt="">
                <b></b>
                <p><?php echo htmlentities($site_detail['zhuan_li']); ?>项专利</p>
            </li>
            <li class="rotateInDownLeft animated wow">
                <img src="/app/index/pc_view/image/patent2.png" alt="">
                <b></b>
                <p><?php echo htmlentities($site_detail['fa_ming']); ?>项发明专利</p>
            </li>
            <li class="rotateInDownRight animated wow">
                <img src="/app/index/pc_view/image/patent3.png" alt="">
                <b></b>
                <p><?php echo htmlentities($site_detail['shi_yong_xin_xing']); ?>项实用新型专利</p>
            </li>
            <li class="rotateInDownLeft animated wow">
                <img src="/app/index/pc_view/image/patent4.png" alt="">
                <b></b>
                <p><?php echo htmlentities($site_detail['wai_guan']); ?>外观专利</p>
            </li>
            <li class="rotateInDownRight animated wow">
                <img src="/app/index/pc_view/image/patent5.png" alt="">
                <b></b>
                <p><?php echo htmlentities($site_detail['ji_suan_ji_ruan_zhu']); ?>项计算机软著专利</p>
            </li>
        </ul>
    </div>

    <div class="credential-wrap switchCot">
        <!--效果html开始-->
        <div class="poster-main">
            <div class="poster-btn poster-prev-btn"></div>
            <ul class="poster-list">
                <?php if(is_array($main_detail['honor_list_json']) || $main_detail['honor_list_json'] instanceof \think\Collection || $main_detail['honor_list_json'] instanceof \think\Paginator): $i = 0; $__LIST__ = $main_detail['honor_list_json'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                    <li class="poster-item">
                        <img src="<?php echo htmlentities($value['image']); ?>">
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="poster-btn poster-next-btn"></div>
        </div>
        <ul class="wrap credentials">
            <?php if(is_array($main_detail['certificate_list_json']) || $main_detail['certificate_list_json'] instanceof \think\Collection || $main_detail['certificate_list_json'] instanceof \think\Paginator): $i = 0; $__LIST__ = $main_detail['certificate_list_json'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                <li>
                    <img src="<?php echo htmlentities($value['image']); ?>" alt="证书"/>
                </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>

    <!-- // 新增的HTML 第三个分类   新闻~~~~~~~~~~~~~~~~~~~~~~~ -->
    <ul class="news-container container switchCot" style="width: auto;">
        <?php 
        $news_list = (new \app\common\Model\NewsModel())->where("first_news_class_id = 4")->order('id desc')->select();
        foreach ($news_list as $key => $news) {
         ?>

        <li style="box-shadow: none;" class="getchange">
            <a href="/news_detail<?php echo htmlentities($news['id']); ?>.html">
                <img src="<?php echo htmlentities($news['image']); ?>" alt="新闻图片" style="width: 314px;height: 200px;margin:18px;" />
                <div>
                <div style="width: 100%; margin: 20px 20px 0 20px;" >
                    <a href="/news_detail<?php echo htmlentities($news['id']); ?>.html">
                        <div class="title-wrap">
                            <h4><?php echo htmlentities($news['news_name']); ?></h4>
                        </div>
                        <div class="title-wrap">
                            <h5><?php echo htmlentities($news['update_time']); ?></h5>
                        </div>
                        <p style="padding: 5px 0 5px 0;">
                            <?php echo htmlentities(text_length($news['content'],200)); ?>
                        </p>
                    </a>
                </div></div>
            </a>
        </li>
        <!--
        <li style="box-shadow: none;">
            <a href="/news_detail<?php echo htmlentities($news['id']); ?>.html">
                <img src="<?php echo htmlentities($news['image']); ?>" alt="新闻图片" />
                <div style="width: 100%;">
                    <a href="/news_detail<?php echo htmlentities($news['id']); ?>.html">
                        <div class="title-wrap">
                            <h4><?php echo htmlentities($news['news_name']); ?></h4>
                            <span><?php echo htmlentities($news['update_time']); ?></span>
                        </div>
                        <p style="padding: 5px 0 10px 0;">
                            <?php echo htmlentities(text_length($news['content'],100)); ?>
                        </p>
                    </a>
                </div>
            </a>
        </li>
        -->
        <?php 
        }
         ?>
    </ul>
    <!-- // 新增的HTML 第三个分类   新闻~ END -->
</div>

<?php 
$tab = input('tab');
 ?>

<script>
    $(function () {
        set_nav(1); //设置 导航
    });

    $(".poster-main").Carousel({
        "width": 900,
        "height": 383,
        "posterWidth": 306,
        "posterHeight": 403,
        "scale": 0.85,
        "speed": 500,
        "autoPlay": true,
        "delay": 2000,
        "verticalAlign": "middle"
    });

    // 切换
    /*
    function switchTab(type, e) {
        console.log(type)
        let pre = e.target.previousElementSibling;
        let next = e.target.nextElementSibling;

        let aboutUs = document.getElementsByClassName('aboutUs')[0];
        let credential = document.getElementsByClassName('credential-wrap')[0];
        console.log(aboutUs)
        if (pre != null) {
            e.target.previousElementSibling.className = ''
        } else {
            e.target.nextElementSibling.className = ''
        }
        switch (type) {
            case 1:
                aboutUs.style = 'display:block';
                credential.style = 'display:none'
                break;
            case 2:
                aboutUs.style = 'display:none';
                credential.style = 'display:block';
                break
        }

        e.target.className = 'aboutPlateCheck';
    }
    */

    // 此次新加！！！！！！！！！！！！！原文件中有个相同名字的方法， 那个有点low 这是优化后的版本 覆盖就好
    function switchTab(type, e) {
        let pre = e.target.previousElementSibling;
        let next = e.target.nextElementSibling;
        let nodeTop = document.getElementsByClassName('switchLi'); // 所有顶部节点
        let nodeBody = document.getElementsByClassName('switchCot'); // 所有内容节点
        let presentText = document.getElementsByClassName('selectText')[0]; //当前nav文字

        let newTopList = [];

        [...nodeTop].map((item, index) => {
            if (type == index) {
                nodeBody[index].style = 'display:block'
                item.className = 'aboutPlateCheck switchLi'
            } else {
                nodeBody[index].style = 'display:none'
                item.className = 'switchLi'
            }
            newTopList.push(item);
        })
        switch(type){
            case 0:
                //presentText.innerHTML = '公司介绍'
                $('#intro_name').html('公司介绍');
                break;
            case 1:
                //presentText.innerHTML = '企业资质'
                $('#intro_name').html('企业资质');
                break;
            case 2:
                //presentText.innerHTML = '新闻中心'
                $('#intro_name').html('新闻中心');
                break;
        }
    }
    // 新增JS END

    // 2020年3月18日 14:21:13 新增
    window.onload = function() {
        let params = 0;
        if (window.location.search.split('=')[1] == undefined) {
            params = 0;
        } else {
            params = window.location.search.split('=')[1];
        }

        let nodeTop = document.getElementsByClassName('switchLi'); // 所有顶部节点
        let nodeBody = document.getElementsByClassName('switchCot'); // 所有内容节点

        if (params > 0) {
            nodeBody[0].style = 'display:none';
            nodeTop[0].className = 'switchLi';
        }

        nodeTop[params - 0].className = 'aboutPlateCheck switchLi';
        nodeBody[params - 0].style = 'display:block';

        console.log(params)
    }
</script>
<!-- 底部 -->
<footer>
    <ul class="wrap">
        <li>
            <h2>产品中心</h2>
            <ul>
                <?php $Model = new app\common\model\ProductClassModel();$__list__ = $Model->where("parent_id = 0")->select();if(is_array($__list__) || $__list__ instanceof \think\Collection || $__list__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__list__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;$list_url = "product_list_url";$value[$list_url] = product_list_url($value["id"]); ?>
                    <li>
                        <a href="<?php echo htmlentities($value['product_list_url']); ?>"><?php echo htmlentities($value['product_class_name']); ?></a>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </li>
        <li class="switchTab1">
            <h2>解决方案</h2>
            <ul>
                <?php $list = (new \app\common\model\NewsModel())->where("(is_pass = 1) and (delete_time = 0) and (first_news_class_id = 1)")->order('sort asc, id desc')->limit(9)->select(); if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                    <li>
                        <a href="<?php echo news_detail_url($value['id']); ?>"><?php echo htmlentities($value['news_name_eng']); ?> <?php echo htmlentities($value['news_name']); ?></a>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </li>
        <li class="switchTab1">
            <h2>云平台</h2>
            <ul>
                <?php $list = (new \app\common\model\NewsModel())->where("(is_pass = 1) and (delete_time = 0) and (first_news_class_id = 2)")->order('sort asc, id desc')->limit(9)->select(); if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                    <li>
                        <a href="<?php echo news_detail_url($value['id']); ?>"><?php echo htmlentities($value['news_name_eng']); ?> <?php echo htmlentities($value['news_name']); ?></a>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </li>
        <li>
            <h2>联系我们</h2>
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
            版权所有Copyright@2020<br/><?php echo htmlentities($site_detail['icp']); ?>
        </p>
    </div>
</footer>

<!-- 新增侧边栏改动 2020年3月20日 13:40:03 -->
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
                <p style="margin: 16px auto auto;font-size: 16px;">欢迎您的来电</p>
                <?php 
                    $site_tel = $site_detail['tel'];
                    $site_tel = trim($site_tel);
                    $array = explode(' ', $site_tel);
                 ?>
                <input type="text" class="inpName" style="color: #000;font-size: 16px;" value="<?php echo htmlentities($array[0]); ?>" placeholder="手机号码" readonly>
                <input type="text" class="inpName" style="color: #000;font-size: 16px;" value="<?php echo htmlentities($site_detail['mobile']); ?>" placeholder="手机号码" readonly>
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
            <div>首页</div>
        </a>
    </div>
    <div style="float: left; width: 25%; text-align: center;">
        <a href="<?php echo product_list_url(1); ?>">
            <div><img src="/app/index/pc_view/image/ico_product.png"></div>
            <div>产品中心</div>
        </a>
    </div>
    <div style="float: left; width: 25%; text-align: center;">
        <a href="https://shop110519718.taobao.com/">
            <div><img src="/app/index/pc_view/image/ico_cart.png"></div>
            <div>商城</div>
        </a>
    </div>
    <div style="float: left; width: 25%; text-align: center;">
        <a href="<?php echo intro_detail_url(1); ?>">
            <div><img src="/app/index/pc_view/image/ico_tel.png"></div>
            <div>联系我们</div>
        </a>
    </div>
    <div style="clear: both;"></div>
</div>
<?php } ?>
</body>
</html>