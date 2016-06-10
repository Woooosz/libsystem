$(document).ready(function () {
    Date.prototype.format = function (format) {
        var o = {
            "M+": this.getMonth() + 1,
            "d+": this.getDate(),
            "h+": this.getHours(),
            "m+": this.getMinutes(),
            "s+": this.getSeconds(),
            "q+": Math.floor((this.getMonth() + 3) / 3),
            "S": this.getMilliseconds()
        };

        if (/(y+)/.test(format)) {
            format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        }

        for (var k in o) {
            if (new RegExp("(" + k + ")").test(format)) {
                format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
            }
        }
        return format;
    };


    Date.prototype.minus = function (date) {
        var y1 = this.getFullYear();
        var m1 = this.getMonth();
        var d1 = this.getDate();
        var date1 = new Date(y1,m1,d1);

        var y2 = date.getFullYear();
        var m2 = date.getMonth();
        var d2 = date.getDate();
        var date2 = new Date(y2,m2,d2);
        return (date1 - date2) / (24 * 60 * 60 * 1000);
    }
});