function formatMoney(number, c, d, t) {
    'use strict';
    var n = number,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j;

    j = i.length;

    if (j > 3) {
        j = j % 3
    }
    else {
        j = 0;
    }

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

function round2(number) {
    'use strict';
    if (number == 0) {
        return 0.00;
    }
    return Math.round(number * 100) / 100;
};

function getRidOfSpace(number) {
    'use strict';

    var rgx, numb;

    rgx = /\s+/;
    numb = number;

    while (rgx.test(numb)) {
        numb = numb.replace(/\s+/g, "");
    }

    return numb;

}
function replaceComaWithDot(numberWithCommas) {
    'use strict';

    var numb, rgx;

    numb = numberWithCommas;
    rgx = /,/;

    while (rgx.test(numb)) {
        numb = numb.replace(/,/g, ".");
    }

    return numb;
}
function strToFloat(strNumber) {
    'use strict';

    return parseFloat(getRidOfSpace(replaceComaWithDot(strNumber)));
}
function floatToStr(number) {
    "use strict";

    return formatMoney(round2(number), 2, ",", " ");
}