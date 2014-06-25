jQuery(document).ready(function($) {
    var net = {};
    net.touchdata = {};

    net.touchdata.datepickerFix = function() {
        this.supportHtml5 = {
            date: false,
            email: false,
            number: false,
            placeholder: false,
            range: false,
            tel: false,
            url: false
        };

        this.supportHtml5 = this.setHtml5Support();
    };

    net.touchdata.datepickerFix.prototype.getInternetExplorerVersion = function() {
        /* thx to http://stackoverflow.com/questions/17907445/how-to-detect-ie11 */
        var rv = -1;
        if (navigator.appName == 'Microsoft Internet Explorer')
        {
            var ua = navigator.userAgent;
            var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        }
        else if (navigator.appName == 'Netscape')
        {
            var ua = navigator.userAgent;
            var re = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        }
        return rv;
    };

    net.touchdata.datepickerFix.prototype.isInternetExplorer = function() {
        var isMSIE = eval("/*@cc_on!@*/0");
        var isMSIE2 = ('\v' == 'v');

        if (this.getInternetExplorerVersion() !== -1) {
            return true;
        }
        return (isMSIE || isMSIE2);
    };

    net.touchdata.datepickerFix.prototype.setHtml5Support = function() {
        var features = {};
        var input = document.createElement('input');

        features.placeholder = 'placeholder' in input;

        var inputTypes = ['email', 'url', 'tel', 'number', 'range', 'date'];

        $.each(inputTypes, function(index, value) {
            input.setAttribute('type', value);
            features[value] = input.type !== 'text';
        });

        return features;
    };

    net.touchdata.datepickerFix.prototype.addSpinnerToObject = function(object) {
        var options = {};
        var min = object.attr('min');
        var max = object.attr('max');
        var step = object.attr('step');

        if (min != "undefined" && min != undefined) {
            options.min = min;
        }

        if (max != "undefined" && max != undefined) {
            options.max = max;
        }

        if (step != "undefined" && step != undefined) {
            options.step = step;
        }

        object.spinner(options);
    };

    net.touchdata.datepickerFix.prototype.doMagic = function() {
         var that = this;
        if (this.isInternetExplorer() || !this.supportHtml5.date) {
            $.each($('[type="date"][class*="wpcf7-date"]'), function() {
                $(this).datepicker({
                    autoclose: true,
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true, 
                    changeYear: true,
                    yearRange: "-100:+0"
                });
            });
        }
        if (this.isInternetExplorer() || !this.supportHtml5.number) {
            $.each($('[type="number"][class*="wpcf7-number"]'), function() {
                that.addSpinnerToObject($(this));
            });

            $.each($('[type="text"][class*="wpcf7-number"]'), function() {
                that.addSpinnerToObject($(this));
            });
        }
    };


    var datepickerFix = new net.touchdata.datepickerFix();
    datepickerFix.doMagic();

});