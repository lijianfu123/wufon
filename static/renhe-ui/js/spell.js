var key = "吖哎安肮凹八挀扳邦勹陂奔伻皀边灬憋汃冫癶峬嚓偲参仓撡冊嵾噌叉犲辿伥抄车抻阷吃充抽出膗巛刅吹旾踔呲从凑粗汆镩蹿崔邨搓咑呆丹当刀恴揼灯仾嗲敁刁爹丁丟东吺剢耑叾吨多妸奀鞥仒发帆匚飞分丰覅仏垺夫旮侅干冈皋戈给根更工勾估瓜乖关光归丨呙妎咍兯夯茠诃黒拫亨乊叿齁乎花怀欢巟灰昏吙丌加戋江艽阶巾坕冂丩凥姢噘军咔开刊忼尻匼肎劥空廤扝夸蒯宽匡亏坤扩垃来兰啷捞仂雷塄唎俩嫾簗蹽咧厸伶溜咯龙娄噜驴孪掠抡捋嘸妈埋颟牤猫庅呅椚掹踎宀喵乜民名谬摸哞某母拏腉囡囔孬疒娞嫩莻妮拈娘鸟捏脌宁妞农羺奴女疟奻硸噢妑拍眅乓抛呸喷匉丕片剽氕姘乒钋剖仆七掐千呛悄切亲靑宆丘区峑炔夋亽呥穣荛惹人扔日戎厹嶿堧桵闰挼仨毢三桒掻色杀筛山伤弰奢申升尸収书刷衰闩双谁妁厶忪凁苏狻夊孙唆他囼坍汤仐忑膯剔天旫怗厅囲偷凸湍推吞乇屲歪乛尣危塭翁挝乌夕呷仙乡灱些忄兴凶休戌吅疶坃丫咽央幺倻膶一乚应哟佣优扜囦曰蒀帀災兂牂傮啫贼怎曽吒夈沾张佋蜇贞凧之中州朱抓拽专妆隹宒卓仔孖宗邹租劗厜尊昨".split("");
var pinyin = "AAiAnAngAoBaBaiBanBangBaoBeiBenBengBiBianBiaoBieBinBingBoBuCaCaiCanCangCaoCeCenCengChaChaiChanChangChaoCheChenChengChiChongChouChuChuaiChuanChuangChuiChunChuoCiCongCouCuCuanChuanCuanCuiCunCuoDaDaiDanDangDaoDeDenDengDiDiaDianDiaoDieDingDiuDongDouDuDuanDuiDunDuoEEnEngErFaFanFangFeiFenFengFiaoFoFouFuGaGaiGanGangGaoGeGeiGenGengGongGouGuGuaGuaiGuanGuangGuiGunGuoHaHaiHanHangHaoHeHeiHenHengHoHongHouHuHuaHuaiHuanHuangHuiHunHuoJiJiaJianJiangJiaoJieJinJingJiongJiuJuJuanJueJunKaKaiKanKangKaoKeKenKengKongKouKuKuaKuaiKuanKuangKuiKunKuoLaLaiLanLangLaoLeLeiLengLiLiaLianLiangLiaoLieLinLingLiuLoLongLouLuLvLuanLveLunLuoMMaMaiManMangMaoMeMeiMenMengMiMianMiaoMieMinMingMiuMoMouMeiMuNaNaiNanNangNaoNeNeiNenNNiNianNiangNiaoNieNinNingNiuNongNouNuNvNveNuanNuoOuPaPaiPanPangPaoPeiPenPengPiPianPiaoPiePinPingPoPouPuQiQiaQianQiangQiaoQieQinQingQiongQiuQuQuanQueQunRaRanRangRaoReRenRengRiRongRouRuRuanRuiRunRuoSaSaiSanSangSaoSeShaShaiShanShangShaoSheShenShengShiShouShuShuaShuaiShuanShuangShuiShuoSiSongSouSuSuanSuiSunSuoTaTaiTanTangTaoTeTengTiTianTiaoTieTingTongTouTuTuanTuiTunTuoWaWaiWanWangWeiWenWengWoWuXiXiaXianXiangXiaoXieXinXingXiongXiuXuXuanXueXunYaYanYangYaoYeYenYiYinYingYoYongYouYuYuanYueYunZaZaiZanZangZaoZeZeiZenZengZhaZhaiZhanZhangZhaoZheZhenZhengZhiZhongZhouZhuZhuaZhuaiZhuanZhuangZhuiZhunZhuoZaiZiZongZouZuZuanZuiZunZuo".split(/(?=[A-Z])/g);

var cache = {};
var arr_tree = [];

/**
 * 拼音
 * 函数: Cn2PinYin(w)
 * 注释: w 为需转换成拼音的汉字
 */

var Cn2PinYin;

init();

/**
 * 生成一颗条件分支的二叉树
 * @param a
 * @param b
 */
function walk(a, b) {
    var c = Math.floor((a + b) / 2);

    if (c === b && b < a) { //节点
        arr_tree.push("r='", pinyin[c], "';");
        return;
    }

    arr_tree.push( //左分支
        "if(w.localeCompare('", key[c], "') < 0)");
    walk(a, c - 1);

    arr_tree.push("else "); //右分支
    walk(c + 1, b);
}

/**
 * 初始化Cn2PinYin函数'=
 * 对于转化过的汉字做缓存处理
 */
function init() {
    arr_tree.push("var r=cache[w];if(r)return r;"); //检查缓存
    walk(0, key.length - 1); //-递归生成源码
    arr_tree.push("return cache[w]=r;"); //-写入缓存

    Cn2PinYin = new Function("w", arr_tree.join("")); //编译
}

/**
 * 设置 拼音
 * n 0:全拼-首字母大写（默认），1:全拼-小写，2:简拼
 * @param source
 * @param target
 * @param spell_type
 * @returns {*|jQuery|string|undefined}
 */
function set_spell(source, target, spell_type) {
    return ($('[name=' + target + ']').val(get_spell($('[name=' + source + ']').val(), spell_type)));
}

/**
 * 获取 拼音
 *n 0:全拼-首字母大写（默认），1:全拼-小写，2:简拼
 * @param content
 * @param spell_type
 * @returns {string}
 */
function get_spell(content, spell_type) {
    if (!spell_type) {
        spell_type = 0;
    }

    var fn = Cn2PinYin;
    var arr = [];
    var ch;

    for (var i = 0, n = content.length; i < n; i++) {
        ch = content.charAt(i);

        switch (spell_type) {
            case(0):
                arr[i] = (ch < "一" || ch > "龥") ? ch : fn(ch);

                break;
            case(1):
                arr[i] = (ch < "一" || ch > "龥") ? ch : fn(ch).toLowerCase();

                break;
            case(2):
                arr[i] = (ch < "一" || ch > "龥") ? ch : fn(ch).substring(0, 1).toLowerCase();

                break;
        }
    }

    return (arr.join(''));
}