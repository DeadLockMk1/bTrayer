var GID;
$(document).ready(function() {
    var pWrap = $("#props-wrapper ");
    var pAddButton = $("#add-new-prop");
    var pcountn = 1;
    var pcountv = 1;
    var fWrap = $("#filters-wrapper");
    var fAddButton = $("#add-new-filter");
    var fcount = $('[id^="filter_item"]').length;
    $( ".tooltiped" ).tooltip({
        content: function(callback) {
            callback($(this).prop('title').replace(/\|/g, '<br />'));
        }
    });
    $(document).click(function(e) {
            $(".ui-tooltip").remove();
        });
    $(pAddButton).click(function(e) {
        pItem = $('<tr>' +
        '<td width = "20%"><input type = "text" class = "gr-s-fe-prop-name"></td>' +
        '<td><textarea class = "edit textarea-big gr-s-fe-prop-val"></textarea></td>' +
        '<td width = "10em" class = "remove-column"><a href = "#" class = "removeclassp act-btn">Remove</a></td>' +
        '</tr>').hide();
        $(pWrap).append(pItem);
        pItem.slideDown('slow');
        return false;
    });
    $("body").on("click", ".removeclassp", function(e) {
        $(this).parent('td').parent('tr').remove();
        return false;
    });
    $(fAddButton).click(function(){
        window.GID = getFGroupID();
        var gid = window.GID;
        addFilterItem('1', '1', '5', '0', '', '1', '0', '', ++gid);
    });
    $("body").on("click", ".removeclassf", function(e) {
        rfItem = $(this).parent('td').parent('tr').parent('tbody').parent('table').parent('div');
        rfItem.slideUp('fast');
        setTimeout(function() {
            $(rfItem).remove();
        }, 400);

        return false;
    });
    $("#update-form-urls").click(function() {
        $('.submit-right').trigger('click');
    });
    $("#update-form").click(function() {
        $(".gr-s-fe-prop-name").each(function() {
            var vall = 'n_' + pcountn;
            $(this).attr('name', vall);
            pcountn++;
        });
        $(".gr-s-fe-prop-val").each(function() {
            var vall = 'v_' + pcountv;
            $(this).attr('name', vall);
            pcountv++;
        });
        $('.submit-right').trigger('click');
    });
    $("#site-new-form").click(function() {
        $(".gr-s-fe-prop-name").each(function() {
            var vall = 'n_' + pcountn;
            $(this).attr('name', vall);
            pcountn++;
        });
        $(".gr-s-fe-prop-val").each(function() {
            var vall = 'v_' + pcountv;
            $(this).attr('name', vall);
            pcountv++;
        });
        if ($('#rootUrls').val() == 0) {
            alert('Please specify at least one root URL !');
            $("#ui-accordion-yw0-header-0").trigger('click');
            return false;
        } else {
            if (!checkUrls())
                return false;
        }
        if ($("#f_item_0").length == 0) {
            showFiltersArea();
        } else {
            if (!validateFilters()) {
                var go = confirm('Filters are not matches with any of root URLs ! Continue?');
                if(go) {
                    $('.submit-right').trigger('click');
                } else {
                    $("#ui-accordion-yw0-header-2").trigger('click');
                }
            } else {
                $('.submit-right').trigger('click');
            }
        }
    });
    $(".gr-s-fv-props table thead").prepend("<col width = 20%>");
    $(".gr-s-sl-main table thead tr #itemGrid_c1").attr("class", "hide-switch")
    $("#toTop-log").click(function(){
        $("#log").animate({scrollTop:0}, '500', 'swing');
    });
    $("#toBottom-log").click(function(){
        $("#log").animate({scrollTop:$("#log")[0].scrollHeight}, '500', 'swing');
    });
    $("#NextPageSitesButton").click(
        function() {
            var page = $("#pN").val();
            page++;
            $("#pN").attr('value', String(page));
            //$("#filter_et_submit").trigger('click');
            $("#SiteFindForm").submit();
        }
    );
    $("#PrevPageSitesButton").click(
        function() {
            var page = $("#pN").val();
            page--;
            $("#pN").attr('value', String(page));
            //$("#filter_et_submit").trigger('click');
            $("#SiteFindForm").submit();
        }
    );
    $("#filter_et_submit").click(
        function() {
            $("#pN").attr('value', '1');
        }
    );
    $("#NextPageURLsButton").click(
        function() {
            var page = $("#form_pN").val();
            page++;
            $("#form_pN").attr('value', String(page));
            $("#urls-form").submit();
        }
    );
    $("#PrevPageURLsButton").click(
        function() {
            var page = $("#form_pN").val();
            page--;
            $("#form_pN").attr('value', String(page));
            $("#urls-form").submit();
        }
    );
    $("#NextPageHisButton").click(
        function() {
            var page = $("#pN").val();
            page++;
            $("#pN").attr('value', String(page));
            $("#HistoryForm").append('<input type="hidden" name = "custom" id = "custom" value = "true">');
            var form = $("#HistoryForm").serialize();
            $.ajax({
                    url:"/SitesView/history",
                    type: "POST",
                    data: form,
                    beforeSend: function () {
                        $("#historyContent").empty();
                        $("#historyContent").append("<div class=\'loader-overlay\'><div class=\'loader\'>Loading...</div></div>");
                    },
                    success: function(data) {
                        $("#historyContent").empty();
                        $("#historyContent").html(data);
                        $("#custom").remove();
                        $("#PrevPageHisButton").removeClass("hidden");
                    }
                }
            );
        }
    );
    $("#PrevPageHisButton").click(
        function() {
            var page = $("#pN").val();
            page--;
            $("#pN").attr('value', String(page));
            $("#HistoryForm").append('<input type="hidden" name = "custom" id = "custom" value = "true">');
            var form = $("#HistoryForm").serialize();
            $.ajax({
                    url:"/SitesView/history",
                    type: "POST",
                    data: form,
                    beforeSend: function () {
                        $("#historyContent").empty();
                        $("#historyContent").append("<div class=\'loader-overlay\'><div class=\'loader\'>Loading...</div></div>");
                    },
                    success: function(data) {
                        $("#historyContent").empty();
                        $("#historyContent").html(data);
                        $("#custom").remove();
                        if ($("#pN").val() <= 1) {
                            $("#PrevPageHisButton").addClass("hidden");
                        }
                    }
                }
            );
        }
    );
    $("#submit-res").click(
        function() {
            $("#form_pN").attr('value', '1');
        }
    );
    $("#NewPropName").change(
        function() {
            var name = $(this).val();
            var value = getPropDefault(name);
            $("#NewPropValue").val(value);
        }
    );
    $("#genTMask").click(function() {
        var mask = 0;
        var power;
        var bit;
        $('[id*="tagsToMask_"]:checked').each(function() {
            if ($(this).val() === '-1') {
                mask = '0';
                return false;
            }
            if ($(this).val() === 'Any') {
                mask = 'Any';
                return false;
            }
            power = $(this).val();
            bit = Math.pow(2, power);
            mask += bit;
        });
        $(".md-close").trigger('click');
        $("#form_tagsMask").val(mask);
    });
    $("#genEMask").click(function() {
        var mask = 0;
        var power;
        var bit;
        $('[id*="errorsToMask_"]:checked').each(function() {
            if ($(this).val() === '-1') {
                mask = '0';
                return false;
            }
            if ($(this).val() === 'Any') {
                mask = 'Any';
                return false;
            }
            power = $(this).val();
            bit = Math.pow(2, power);
            mask += bit;
        });
        $(".md-close").trigger('click');
        $("#form_errorMask").val(mask);
    });
    $('[id*="loadContent"]').click(function() {
        $('#editor').append("<div class='loader-overlay'><div class='loader'>Loading...</div></div>");
    });
    $(".hide-switch").click(function() {
        if (!$(this).hasClass('exp-list')) {
            $(this).children(".slideList").css({"overflow": "hidden"});
            $(this).children(".slideList").animate({"max-height": "20em"}, 1000);
            //$(this).children(".slideList").css({"overflow": "auto"});
            $(this).addClass('exp-list');
        } else {
            $(this).children(".slideList").animate({"max-height": "1.5em"}).css({"overflow": "hidden"});
            $(this).removeClass('exp-list');
        }

    });
    $(".slideList").each(function () {
        var count = $(this).children('a').size();
        if (count > 1) {
            $(this).parent().append('<div class = "drop-arrow"></div>');
        }
    });
    $("#hisMore").click(function () {
        if ($(this).text() == "More") {
            $("#hisMoreTable").toggleClass("hidden");
            $(this).text("Less");
        } else {
            $(this).text("More");
            $("#hisMoreTable").toggleClass("hidden")
        }
    });
    $("#statsMore").click(function () {
        if ($(this).text() == "More") {
            $("#statsMoreTable").toggleClass("hidden");
            $(this).text("Less");
        } else {
            $(this).text("More");
            $("#statsMoreTable").toggleClass("hidden")
        }
    });
    $("#fetchType").change(function () {
        if ($(this).val() == '2') {
            $("#httpTimeout").val("10000");
        } else {
            $("#httpTimeout").val("30000");
        }
    });
    flashes();
});
function collectProps() {
    var ret = {};
    $('#props-wrapper tbody tr').each(function () {
        var $pName = $(this).children('td').children('.gr-s-fe-prop-name').val();
        ret[$pName] = $(this).children('td').children('.gr-s-fe-prop-val').val();
    });
    return ret;

}
function getFirstRootUrl() {
    var rootURLsStr = $("#rootUrls").val();
    var rootURLs = rootURLsStr.split("\n");
    if (rootURLs.length > 1) {
        return rootURLs[0]
    } else  if (rootURLs.length == 1) {
        return rootURLs[0]
    } else {
        return false;
    }
}
function checkUrls() {
    var rootURLsStr = $("#rootUrls").val();
    var rootURLs = rootURLsStr.split("\n");
    var re = /^\s*[a-z](?:[-a-z0-9\+\.])*:(?:\/\/(?:(?:%[0-9a-f][0-9a-f]|[-a-z0-9\._~\uA0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\u10000-\u1FFFD\u20000-\u2FFFD\u30000-\u3FFFD\u40000-\u4FFFD\u50000-\u5FFFD\u60000-\u6FFFD\u70000-\u7FFFD\u80000-\u8FFFD\u90000-\u9FFFD\uA0000-\uAFFFD\uB0000-\uBFFFD\uC0000-\uCFFFD\uD0000-\uDFFFD\uE1000-\uEFFFD!\$&\'\(\)\*\+,;=:])*@)?(?:\[(?:(?:(?:[0-9a-f]{1,4}:){6}(?:[0-9a-f]{1,4}:[0-9a-f]{1,4}|(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(?:\.(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3})|::(?:[0-9a-f]{1,4}:){5}(?:[0-9a-f]{1,4}:[0-9a-f]{1,4}|(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(?:\.(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3})|(?:[0-9a-f]{1,4})?::(?:[0-9a-f]{1,4}:){4}(?:[0-9a-f]{1,4}:[0-9a-f]{1,4}|(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(?:\.(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3})|(?:[0-9a-f]{1,4}:[0-9a-f]{1,4})?::(?:[0-9a-f]{1,4}:){3}(?:[0-9a-f]{1,4}:[0-9a-f]{1,4}|(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(?:\.(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3})|(?:(?:[0-9a-f]{1,4}:){0,2}[0-9a-f]{1,4})?::(?:[0-9a-f]{1,4}:){2}(?:[0-9a-f]{1,4}:[0-9a-f]{1,4}|(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(?:\.(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3})|(?:(?:[0-9a-f]{1,4}:){0,3}[0-9a-f]{1,4})?::[0-9a-f]{1,4}:(?:[0-9a-f]{1,4}:[0-9a-f]{1,4}|(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(?:\.(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3})|(?:(?:[0-9a-f]{1,4}:){0,4}[0-9a-f]{1,4})?::(?:[0-9a-f]{1,4}:[0-9a-f]{1,4}|(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(?:\.(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3})|(?:(?:[0-9a-f]{1,4}:){0,5}[0-9a-f]{1,4})?::[0-9a-f]{1,4}|(?:(?:[0-9a-f]{1,4}:){0,6}[0-9a-f]{1,4})?::)|v[0-9a-f]+[-a-z0-9\._~!\$&\'\(\)\*\+,;=:]+)\]|(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(?:\.(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}|(?:%[0-9a-f][0-9a-f]|[-a-z0-9\._~\uA0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\u10000-\u1FFFD\u20000-\u2FFFD\u30000-\u3FFFD\u40000-\u4FFFD\u50000-\u5FFFD\u60000-\u6FFFD\u70000-\u7FFFD\u80000-\u8FFFD\u90000-\u9FFFD\uA0000-\uAFFFD\uB0000-\uBFFFD\uC0000-\uCFFFD\uD0000-\uDFFFD\uE1000-\uEFFFD!\$&\'\(\)\*\+,;=@])*)(?::[0-9]*)?(?:\/(?:(?:%[0-9a-f][0-9a-f]|[-a-z0-9\._~\uA0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\u10000-\u1FFFD\u20000-\u2FFFD\u30000-\u3FFFD\u40000-\u4FFFD\u50000-\u5FFFD\u60000-\u6FFFD\u70000-\u7FFFD\u80000-\u8FFFD\u90000-\u9FFFD\uA0000-\uAFFFD\uB0000-\uBFFFD\uC0000-\uCFFFD\uD0000-\uDFFFD\uE1000-\uEFFFD!\$&\'\(\)\*\+,;=:@]))*)*|\/(?:(?:(?:(?:%[0-9a-f][0-9a-f]|[-a-z0-9\._~\uA0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\u10000-\u1FFFD\u20000-\u2FFFD\u30000-\u3FFFD\u40000-\u4FFFD\u50000-\u5FFFD\u60000-\u6FFFD\u70000-\u7FFFD\u80000-\u8FFFD\u90000-\u9FFFD\uA0000-\uAFFFD\uB0000-\uBFFFD\uC0000-\uCFFFD\uD0000-\uDFFFD\uE1000-\uEFFFD!\$&\'\(\)\*\+,;=:@]))+)(?:\/(?:(?:%[0-9a-f][0-9a-f]|[-a-z0-9\._~\uA0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\u10000-\u1FFFD\u20000-\u2FFFD\u30000-\u3FFFD\u40000-\u4FFFD\u50000-\u5FFFD\u60000-\u6FFFD\u70000-\u7FFFD\u80000-\u8FFFD\u90000-\u9FFFD\uA0000-\uAFFFD\uB0000-\uBFFFD\uC0000-\uCFFFD\uD0000-\uDFFFD\uE1000-\uEFFFD!\$&\'\(\)\*\+,;=:@]))*)*)?|(?:(?:(?:%[0-9a-f][0-9a-f]|[-a-z0-9\._~\uA0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\u10000-\u1FFFD\u20000-\u2FFFD\u30000-\u3FFFD\u40000-\u4FFFD\u50000-\u5FFFD\u60000-\u6FFFD\u70000-\u7FFFD\u80000-\u8FFFD\u90000-\u9FFFD\uA0000-\uAFFFD\uB0000-\uBFFFD\uC0000-\uCFFFD\uD0000-\uDFFFD\uE1000-\uEFFFD!\$&\'\(\)\*\+,;=:@]))+)(?:\/(?:(?:%[0-9a-f][0-9a-f]|[-a-z0-9\._~\uA0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\u10000-\u1FFFD\u20000-\u2FFFD\u30000-\u3FFFD\u40000-\u4FFFD\u50000-\u5FFFD\u60000-\u6FFFD\u70000-\u7FFFD\u80000-\u8FFFD\u90000-\u9FFFD\uA0000-\uAFFFD\uB0000-\uBFFFD\uC0000-\uCFFFD\uD0000-\uDFFFD\uE1000-\uEFFFD!\$&\'\(\)\*\+,;=:@]))*)*|(?!(?:%[0-9a-f][0-9a-f]|[-a-z0-9\._~\uA0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\u10000-\u1FFFD\u20000-\u2FFFD\u30000-\u3FFFD\u40000-\u4FFFD\u50000-\u5FFFD\u60000-\u6FFFD\u70000-\u7FFFD\u80000-\u8FFFD\u90000-\u9FFFD\uA0000-\uAFFFD\uB0000-\uBFFFD\uC0000-\uCFFFD\uD0000-\uDFFFD\uE1000-\uEFFFD!\$&\'\(\)\*\+,;=:@])))(?:\?(?:(?:%[0-9a-f][0-9a-f]|[-a-z0-9\._~\uA0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\u10000-\u1FFFD\u20000-\u2FFFD\u30000-\u3FFFD\u40000-\u4FFFD\u50000-\u5FFFD\u60000-\u6FFFD\u70000-\u7FFFD\u80000-\u8FFFD\u90000-\u9FFFD\uA0000-\uAFFFD\uB0000-\uBFFFD\uC0000-\uCFFFD\uD0000-\uDFFFD\uE1000-\uEFFFD!\$&\'\(\)\*\+,;=:@])|[\uE000-\uF8FF\uF0000-\uFFFFD|\u100000-\u10FFFD\/\?])*)?(?:\#(?:(?:%[0-9a-f][0-9a-f]|[-a-z0-9\._~\uA0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\u10000-\u1FFFD\u20000-\u2FFFD\u30000-\u3FFFD\u40000-\u4FFFD\u50000-\u5FFFD\u60000-\u6FFFD\u70000-\u7FFFD\u80000-\u8FFFD\u90000-\u9FFFD\uA0000-\uAFFFD\uB0000-\uBFFFD\uC0000-\uCFFFD\uD0000-\uDFFFD\uE1000-\uEFFFD!\$&\'\(\)\*\+,;=:@])|[\/\?])*)?\s*$/i;
    var ret = false;
    rootURLs.forEach(function(e){
        if (!re.test(e)) {
            if (!confirm("\""+e+"\" is not a valid URL, continue?")) {
                $("#rootUrls").focus();
                ret = false;
            } else {
                ret = true;
            }
        } else {
            ret = true;
            console.log(ret);
        }
    });
    return ret;
}
function showFiltersArea() {
    $("#ui-accordion-yw0-header-2").trigger('click');
    if (confirm("Filters are not created. Create automatically ?")) {
        var rootURLsStr = $("#rootUrls").val();
        var rootURLs = rootURLsStr.split("\n");
        rootURLs.forEach(function(e){
            if (e == '') return;
            window.GID = getFGroupID();
            var gid = window.GID;
            var url = purl(e);
            var hostStr = replace_www(url.attr('host'));
            if (url.attr('query') != "") {
                addFilterItem('1', '1', '5', '0', '', '1', '0', '^(?:http(?:s)?://)?(?:[^.]+.)?'+hostStr+'(.*)', ++gid);
                return ;
            }
            var isScript = url.attr('path').indexOf('.');
            if (isScript != -1) {
                addFilterItem('1', '1', '5', '0', '', '1', '0', '^(?:http(?:s)?://)?(?:[^.]+.)?'+hostStr+'(.*)', ++gid);
                return ;
            }
            addFilterItem('1', '1', '5', '0', '', '1', '0', '^(?:http(?:s)?://)?(?:[^.]+.)?'+hostStr+url.attr('relative')+'(.*)', ++gid);
        });
    }
}
function replace_www(str) {
    return str.replace(/(?:((?:\/\/)|^)www\.)(?=[^/]*?\.)/i, "$1");
}
function addFilterItem(st, at, sg, oc, sj, t, m, u ,gr) {
    if (typeof(st)==='undefined') st = '';
    if (typeof(sg)==='undefined') sg = '';
    if (typeof(at)==='undefined') at = '';
    if (typeof(oc)==='undefined') oc = '';
    if (typeof(sj)==='undefined') sj = '';
    if (typeof(t)==='undefined') t = '';
    if (typeof(m)==='undefined') m = '';
    if (typeof(u)==='undefined') u = '';
    if (typeof(gr)==='undefined') gr = '';
    var fcount = $('[id^="filter_item"]').length;
    $.ajax({
            url:"/Ajax/addFilter",
            type: "POST",
            async: false,
            data: {
                "st": st,
                "sg": sg,
                "at": at,
                "oc": oc,
                "sj": sj,
                "t": t,
                "m": m,
                "u": u,
                "gr": gr,
                "fcount": fcount
            },
            success: function(data) {
                var fItem = $(data).hide();
                var fWrap = $("#filters-wrapper");
                $(fWrap).prepend(fItem);
                fItem.slideDown('fast');
                fcount++;
                return false;
            }
        }
    );
}
function getFGroupID() {
    var map = [];
    $('[id^="fgroupId"]').each(function(){
        if (typeof($(this).val())==='undefined') return;
        map.push($(this).val());
    });
    if (Math.max.apply(null, map) == 0)
        return 0;
    if (Math.max.apply(null, map) != -Infinity)
        return Math.max.apply(null, map);
    return -1;
}
function flashes() {
    $('.flashH')
        .animate({opacity: 1}, {duration: 1000});
    setTimeout("$('.flashH').animate({opacity: 0}, {duration: 1000})", 7000);
}
function toggleLog() {
    $("#log").slideToggle( 600 );
};
function toggleUrlsForm() {
    $("#urls-form").slideToggle( 600 );
}
function cancelCleanup() {
    $(".dialog-overlay").remove();
    $("#cleanup-dialog").remove();
}

function cancelIntegrityCheck() {
    $(".dialog-overlay").remove();
    $("#integrityCheck-dialog").remove();
}

function cancelDelete() {
    $(".dialog-overlay").remove();
    $("#delete-dialog").remove();
}

function cancelRecrawl() {
    $(".dialog-overlay").remove();
    $("#recrawl-dialog").remove();
}

function cancelDw() {
    $(".dialog-overlay").remove();
    $("#dw-dialog").remove();
}
function cancelNewProp() {
    $(".dialog-overlay").remove();
    $("#new-property-dialog").remove();
}
function addUniqueProps() {
    var createArr = {"t": true, "p": true};
    $(".gr-s-fe-prop-name").each(function(e) {
        if ( $(this).val() == 'PROCESSOR_PROPERTIES' ) {
            createArr["p"] = false;
        } else if ( $(this).val() == 'template' ) {
            createArr["t"] = false;
        }
    });
    if (createArr["p"] == true) {
        addProperty(name, 'news_processor_properties');
    } else {
        alert('Property PROCESSOR_PROPERTIES already exists!');
    }
    if (createArr["t"] == true) {
        addProperty(name, 'news_template');
    } else {
        alert('Property "template" already exists!');
    }
}
function addProperty(name, value) {
    $.ajax({
            url:"/Ajax/addProperty",
            type: "POST",
            data: {
                "name": name,
                "value": value
            },
            success: function(data) {
                var pItem = $(data).hide();
                var pWrap = $("#props-wrapper ");
                $(pWrap).prepend(pItem);
                pItem.slideDown('fast');
                return false;
            }
        }
    );
}
function addNewProperty() {
    $.ajax({
            url:"/Ajax/addNewProperty",
            type: "POST",
            success: function(data) {
                $("#new-property-dialog").remove();
                $("body").append(data);
            }
        }
    );
    flashes();
}
function propExists(propName) {
    var ret;
    $(".gr-s-fe-prop-name").each(function() {
        if ($(this).val() == propName) {
            ret = true;
            return false;
        }
        ret = false;
        return false;
    });
    return ret;
}
function removeProperty(name) {
    $(".gr-s-fe-prop-name").each(function () {
        if ($(this).val() == name) {
            $(this).parent().parent().remove();
        }
    });
}
function getPropDefault(sel) {
    var name = $(sel).val();
    var result;
    switch(name) {
        case 'CONTENT_HASH':
            result = '{ "algorithm": 1, "tags": "title,description,content_encoded,media,pubdate", "delete": 1 }';
            break;
        case 'PROCESS_CTYPES':
            result = 'text/html';
            break;
        case 'STORE_HTTP_HEADERS':
            result = '1';
            break;
        case 'STORE_HTTP_REQUEST':
            result = '1';
            break;
        case 'AUTO_REMOVE_RESOURCES':
            result = '1';
            break;
        case 'AUTO_REMOVE_WHERE':
            result = 'ParentMd5<>"" AND (Status IN (4, 7) OR (`Status`=4 AND `Crawled`=0 AND `Processed`=0)) AND DATE_ADD(UDate, INTERVAL %RecrawlPeriod% MINUTE)<NOW()';
            break;
        case 'AUTO_REMOVE_ORDER':
            result = 'ContentType ASC, Crawled ASC, TagsCount ASC, CDate ASC';
            break;
        case 'RECRAWL_DELETE_WHERE':
            result = '(`Status`=1 OR (`Status`=4 AND Crawled=0 AND Processed=0) OR `PDate`<CURDATE() OR `PDate` IS NULL OR CDate<CURDATE()) AND `ParentMd5`<>\'\'';
            break;
        case 'STATS_FREQ_ENABLED':
            result = '1';
            break;
        case 'STATS_LOG_ENABLED':
            result = '1';
            break;
        case 'URL_TEMPLATE_REGULAR':
            result = '%URL%';
            break;
        case 'URL_TEMPLATE_REALTIME':
            result = '%URL%';
            break;
        case 'URL_TEMPLATE_REGULAR_URLENCODE':
            result = '1';
            break;
        case 'URL_TEMPLATE_REALTIME_URLENCODE':
            result = '1';
            break;
        case 'ROBOTS_MODE':
            result = '1';
            break;

        default:
            result = '';
    }
    var value = result;
    $("#NewPropValue").text(value);
}
function appendProp() {
    var name = $("#NewPropName").val();
    var value = $("#NewPropValue").val();
    addProperty(name, value);
    cancelNewProp();
}
function validateFilters() {
    var urlsArr = $('#rootUrls').val().split("\n");
    var valid = false;
    urlsArr.forEach(function (e) {
        $('[id*="fpattern"]').each(function () {
            var expr = new RegExp($(this).val());
            if (expr.test(e)) {
                valid = true;
                return;
            }
        });
    });
    return valid;
}
function integrityCheckSubmit() {

        var form = $("#integrityCheckForm").serialize();

        $(".dialog-overlay").remove();
        $('#page').append("<div class='loader-overlay'><div class='loader'>Loading...</div></div>");

        var url = "/SitesView/integrityCheckRequest";

        $.ajax({
            type: "POST",
            url: url,
            data: form,
            success: function (data) {
                $("#page").append(data);
                $(".loader-overlay").remove();
            }
        });
}
function integrityFixSubmit() {

        var form = $("#integrityCheckForm").serialize();

        $(".dialog-overlay").remove();
        $('#page').append("<div class='loader-overlay'><div class='loader'>Loading...</div></div>");

        var url = "/SitesView/integrityFix";

        $.ajax({
            type: "POST",
            url: url,
            data: form,
            success: function () {
                location.reload();
            }
        });
}
function tpModalClose() {
    $(".dialog-overlay").remove();
}
function rmRssProps() {
    var props = [
        'SCRAPING_TYPE_NAME',
        'PROCESSOR_NAME',
        'PROCESSOR_CTYPES',
        'DB_TASK_MODE',
        'HTTP_REDIRECTS_MAX',
        'HTML_REDIRECTS_MAX',
        'HTML_RECOVER',
        'template'
    ];
    props.forEach(function (prop) {
        removeProperty(prop);
    });
}
function rmNewsProps() {
    var props = [
        'SCRAPING_TYPE_NAME',
        'PROCESSOR_PROPERTIES',
        'DB_TASK_MODE',
        'HTTP_REDIRECTS_MAX',
        'HTML_REDIRECTS_MAX',
        'HTML_RECOVER',
        'template'
    ];
    props.forEach(function (prop) {
        removeProperty(prop);
    });
}
function rmTemplateProps() {
    var props = [
        'SCRAPING_TYPE_NAME',
        'PROCESSOR_PROPERTIES',
        'DB_TASK_MODE',
        'HTTP_REDIRECTS_MAX',
        'HTML_REDIRECTS_MAX',
        'HTML_RECOVER',
        'template'
    ];
    props.forEach(function (prop) {
        removeProperty(prop);
    });
}
function tpModalApply() {
    var demoFormName = '#Demo1_form';
    $.ajax({
        type: 'POST',
        async: false, // is deprecated!
        url: $(demoFormName).attr('action') + '&api[returnJsonDataOnly]=true',
        data: $(demoFormName).serialize(),
        success: function(data) {
            $.ajax({
                type: 'POST',
                async: false,
                url: '/SiteNew/getTProps',
                data: data,
                success: function(res) {
                    var news = $("#scraping_tab2").attr("aria-expanded");
                    var template = $("#scraping_tab1").attr("aria-expanded");
                    var rss = $("#scraping_tab3").attr("aria-expanded");
                    if (news == 'true') {
                        rmTemplateProps();
                        rmRssProps();
                        addProperty('SCRAPING_TYPE_NAME', 'NEWS');
                        $("td[id='scraping-type']").text('NEWS');
                    } else if (template == 'true') {
                        rmRssProps();
                        rmNewsProps();
                        addProperty('SCRAPING_TYPE_NAME', 'TEMPLATE');
                        $("td[id='scraping-type']").text('TEMPLATE');
                    } else if (rss == 'true') {
                        rmTemplateProps();
                        rmNewsProps();
                        addProperty('SCRAPING_TYPE_NAME', 'RSS');
                        $("td[id='scraping-type']").text('RSS');
                    }
                    tpModalClose();
                    res = $.parseJSON(res);
                    $.each(res, function(k, v) {
                        rmPropIfExists(k);
                        if (v !== null && typeof v === 'object') {
                            v = JSON.stringify(v);
                        }
                        addProperty(k, v);
                    });
                }
            });
        }
    });
}
function rmPropIfExists(name) {
    $(".gr-s-fe-prop-name").each(function(e) {
        if ( $(this).val() == name ) {
            $(this).parent().parent().remove();
        }
    });
}
function toTheDarkSide() {
    $("html").toggleClass("inverted100");
    $("#logo").toggleClass("darkSide");
}

function curDateISO() {
    var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();
    var hour = d.getHours();
    var minute = d.getMinutes();
    var second = d.getSeconds();

    var output = ((''+day).length<2 ? '0' : '') + day + '-' +
        ((''+month).length<2 ? '0' : '') + month + '-' +
        d.getFullYear() + ' ' +
        ((''+hour).length<2 ? '0' :'') + hour + ':' +
        ((''+minute).length<2 ? '0' :'') + minute + ':' +
        ((''+second).length<2 ? '0' :'') + second;
    return output;
}
function uc() {
    $("body").addClass('uc');
}