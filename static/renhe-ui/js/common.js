/**
 * 加法
 * @param arg1
 * @param arg2
 * @returns {number}
 */
function plus(arg1, arg2) {
    var r1, r2, m;

    try {
        r1 = arg1.toString().split('.')[1].length;
    } catch (e) {
        r1 = 0;
    }

    try {
        r2 = arg2.toString().split('.')[1].length;
    } catch (e) {
        r2 = 0;
    }

    m = Math.pow(10, Math.max(r1, r2));

    return ((arg1 * m + arg2 * m) / m);
}

/**
 * 减法
 * @param arg1
 * @param arg2
 * @returns {number}
 */
function minus(arg1, arg2) {
    return (count_add(arg1, arg2 * -1));
}

/**
 * 乘法
 * @param arg1
 * @param arg2
 * @returns {number}
 */
function multiply(arg1, arg2) {
    var m = 0;
    var s1 = arg1.toString();
    var s2 = arg2.toString();

    try {
        m += s1.split('.')[1].length;
    } catch (e) {

    }

    try {
        m += s2.split('.')[1].length;
    } catch (e) {

    }

    return (Number(s1.replace('.', '')) * Number(s2.replace('.', '')) / Math.pow(10, m));
}

/**
 * 除法
 * @param arg1
 * @param arg2
 * @returns {number}
 */
function divide(arg1, arg2) {
    var t1 = 0;
    var t2 = 0;
    var r1;
    var r2;

    try {
        t1 = arg1.toString().split('.')[1].length;
    } catch (e) {

    }

    try {
        t2 = arg2.toString().split('.')[1].length
    } catch (e) {

    }

    with (Math) {
        r1 = Number(arg1.toString().replace('.', ''));
        r2 = Number(arg2.toString().replace('.', ''));

        return (r1 / r2) * pow(10, t2 - t1);
    }
}

/**
 * 是否 数组
 * @param array
 * @returns {boolean}
 */
function is_array(array) {
    if (Array.isArray(array)) {
        return true;
    } else {
        return false;
    }
}

/**
 * 是否对象
 * @param object
 * @returns {boolean}
 */
function is_object(object) {
    if (typeof object === 'object') {
        return true;
    } else {
        return false;
    }
}

/**
 * 是否 时间
 * @param str
 * @returns {boolean}
 */
function is_time(str) {
    //let d = new Date(str);
    //return !isNaN(d);

    if (str instanceof Date) {
        return true;
    } else {
        return false;
    }
}

/**
 * 返回 浮点数
 * @param number
 * @returns {number}
 */
function parse_float(number) {
    if (isNaN(number) || number === '') {
        return (0);
    } else {
        return (parseFloat(number));
    }
}

/**
 * 保留 2 位小数
 * @param str
 * @param number
 * @returns {string}
 */
function number_format(str, number) {
    if (number === undefined) {
        number = 2;
    }

    str += '';
    if (str.indexOf('.') === -1) {
        str = parseFloat(str);
        str = str.toFixed(2);
    } else {
        str = str.substring(0, str.indexOf('.') + (number + 1));
    }

    return (str);
}

/**
 * 获取 地址栏参数
 * @param name
 * @returns {*}
 */
function get_url_param(name) {
    var url = document.location.toString();
    var arrObj = url.split('?');

    if (arrObj.length > 1) {
        var arr;
        var arr_param = arrObj[1].split('&');

        for (var i = 0; i < arr_param.length; i++) {
            arr = arr_param[i].split('=');

            if (arr != null && arr[0] === name) {
                return arr[1];
            }
        }

        return '';
    } else {
        return '';
    }
}

/**
 * 获取 cookie
 * @returns {string}
 */
function get_cookie(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg)) {
        return unescape(arr[2]);
    } else {
        return '';
    }
}