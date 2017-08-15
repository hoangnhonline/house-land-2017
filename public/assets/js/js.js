function ChangeTab(n) {
    $("#tabList .tabContent").removeClass("list-active");
    $(".project").addClass("hidden");
    n == 1 ? ($("#tabList #list").addClass("list-active"), $(".listProduct").removeClass("hidden"), $(".project").addClass("hidden")) : ($("#tabList #project").addClass("list-active"), $(".listProduct").addClass("hidden"), $(".project").removeClass("hidden"))
}

function ForgotPassWord() {
    $("#hplForgotPass").attr("href", "/quen-mat-khau.htm");
    $("#hplForgotPass").fancybox({
        padding: 0,
        width: 473,
        maxwidth: 473,
        height: 250,
        maxHeight: 250,
        autoSize: !1,
        autoDimensions: !1,
        fitToView: !1,
        preload: !0,
        helpers: {
            title: null
        },
        afterShow: function() {},
        afterClose: function() {
            $.fancybox.close()
        }
    })
}

function BoxHotHide() {
    var t, n;
    if ($("#showBoxhot").hide(), t = $("#ulBoxHot li").size(), t > 10)
        for ($("#showBoxhot").show(), n = 10; n < t; n++) $("ul#ulBoxHot li:nth-child(" + n + ")").hide()
}

function showBoxHot() {
    $("#ulBoxHot li").show();
    $("#showBoxhot").hide()
}

function showBoxHotHome() {
    $("#ulBoxHotHome li").show();
    $("#showBoxhotHome").hide()
}

function ProductCountHide(n) {
    var i, f, e;
    $("#showProductCount").hide();
    var t = $("#ulProductCount li").size(),
        u = 20,
        r = n * u;
    if (t > r)
        for ($("#showProductCount").show(), i = r; i < t; i++) $("ul#ulProductCount li:nth-child(" + i + ")").hide();
    else $("#showProductCount").hide();
    f = (n + 1) * u;
    e = n + 1;
    r < t && f < t && $("#showAdd").attr("href", "javascript:showProductCount(" + e + ");")
}

function showProductCount(n) {
    var t, f;
    $("#showProductCount").hide();
    var i = $("#ulProductCount li").size(),
        r = 20,
        u = n * r,
        e = (n + 1) * r;
    if (u < i || e < i) {
        for ($("#showProductCount").show(), $("ul#ulProductCount li").hide(), t = 0; t <= u; t++) $("ul#ulProductCount li:nth-child(" + t + ")").show();
        f = n + 1;
        $("#showAdd").attr("href", "javascript:showProductCount(" + f + ");")
    } else $("ul#ulProductCount li").show(), $("#showProductCount").hide()
}

function CmtFacebook() {
    $("div#CmtFaceBook").hasClass("cm-fb-active") || ($("div#CmtFaceBook").toggleClass("cm-fb-active"), $("div#CmtGooglePlus").removeClass("cm-gp-active"), $("div.cm-content-fb").show(), $("div.cm-content-gp").hide())
}

function CmtGoogle() {
    $("div#CmtGooglePlus").hasClass("cm-gp-active") || ($("div#CmtFaceBook").removeClass("cm-fb-active"), $("div#CmtGooglePlus").toggleClass("cm-gp-active"), $("div.cm-content-gp").removeClass("positionfixed"), $("div.cm-content-gp").show(), $("div.cm-content-fb").hide())
}

function refreshCaptcha(n) {
    $("#" + n).attr("src", "/Layout/Capchar/CaptchaGenerator.aspx?t=" + (new Date).getMilliseconds())
}

function ProductRelateSale() {
    $("div#product-relate-sale").hasClass("bs-tab-active") || ($("div#product-relate-sale").toggleClass("bs-tab-active"), $("div#product-relate-rent").removeClass("bs-tab-active"), $("div#ProductRelatedSale").show(), $("div#ProductRelatedRent").hide())
}

function ProductRelateRent() {
    $("div#product-relate-rent").hasClass("bs-tab-active") || ($("div#product-relate-rent").toggleClass("bs-tab-active"), $("div#product-relate-sale").removeClass("bs-tab-active"), $("div#ProductRelatedRent").show(), $("div#ProductRelatedSale").hide())
}

function ShowHomeDirection_From() {
    $("div#HomeDirectionForm").is(":visible") || ($("div#HomeDirectionForm").show(), $("div#AgeBuildHomeForm").hide(), $("div.ff-tab1").addClass("ff-tab-active"), $("div.ff-tab2").removeClass("ff-tab-active"))
}

function ShowAgeBuildHome_From() {
    $("div#AgeBuildHomeForm").is(":visible") || ($("div#HomeDirectionForm").hide(), $("div#AgeBuildHomeForm").show(), $("div.ff-tab2").addClass("ff-tab-active"), $("div.ff-tab1").removeClass("ff-tab-active"))
}

function getInterest(n, t, i) {
    $.ajax({
        type: "POST",
        cache: !1,
        url: "/Handler/UtilityHandler.ashx?v=" + Math.random(),
        data: {
            act: "InterestBank",
            bank: n,
            term: t,
            type: i
        },
        success: function(n) {
            if (n == 0) $("#txtInterestForm").val("Không có");
            else {
                var t = n + " %";
                $("#txtInterestForm").val(t)
            }
        }
    })
}

function SeparateMoney(n) {
    if (n.length > 3) {
        n = n.replaceAll(",", "");
        for (var t = n.length - 3; t > 0; t = t - 3) n = n.insert(t, ",");
        $("#txtTotalForm").val(n)
    }
}

function checkStatus() {
    if (productId == 0) return !1;
    if (userId == "") {
        var n = $.cookie("savedProductIds");
        n != null && n.search(productId) > -1 && changeHtml()
    } else $.ajax({
        type: "POST",
        cache: !1,
        url: "/Handler/ProductHandler.ashx?module=getProduct",
        data: {
            productId: productId
        },
        success: function(n) {
            n > 0 && changeHtml()
        }
    })
}

function checkCookie() {
    var n = $.cookie("savedProductIds");
    n == null ? $("#boxProductSaved").hide() : hideBox()
}

function changeHtml() {
    $("#saveNews").text("Đã lưu").removeClass("save").addClass("saved").removeAttr("onclick")
}

function GetProductlist() {
    var listProductId = $.cookie("savedProductIds"),
        html = "",
        likeReturn;
    listProductId != null ? (likeReturn = "", $("#boxProductSaved ul").html(html), $("body").data("GetProductlist_" + listProductId) != null ? (likeReturn = $("body").data("GetProductlist_" + listProductId), $.each(likeReturn, function(n, t) {
        html += '<li pid="' + t.ProductId + '" ><a href="' + t.SourceNews + '">' + t.Title + '<\/a><span title="Xóa" onclick="deleteProduct(this,' + t.ProductId + ');"><\/span><\/li>'
    }), html != "" ? ($("#boxProductSaved").show(), $("#boxProductSaved ul").html(html)) : ($.removeCookie("savedProductIds", {
        domain: domainCookie,
        path: "/"
    }), $("#boxProductSaved").hide())) : $.ajax({
        type: "POST",
        cache: !1,
        url: "/Handler/ProductHandler.ashx?module=getProductList",
        data: {
            productIds: listProductId
        },
        success: function(data) {
            data != null && (likeReturn = eval("(" + data + ")"), $("body").data("GetProductlist_" + listProductId, likeReturn), $.each(likeReturn, function(n, t) {
                html += '<li pid="' + t.ProductId + '"><a href="' + t.SourceNews + '">' + t.Title + '<\/a><span title="Xóa" onclick="deleteProduct(this,' + t.ProductId + ');"><\/span><\/li>'
            }), html != "" ? ($("#boxProductSaved").show(), $("#boxProductSaved ul").html(html)) : ($.removeCookie("savedProductIds", {
                domain: domainCookie,
                path: "/"
            }), $("#boxProductSaved").hide()))
        },
        error: function() {}
    })) : userId != "" && (listProductId = "", $.ajax({
        type: "POST",
        cache: !1,
        url: "/Handler/ProductHandler.ashx?module=getProductList",
        data: {
            productIds: listProductId
        },
        success: function(data) {
            data != null && data != "null" && (likeReturn = eval("(" + data + ")"), $.each(likeReturn, function(n, t) {
                html += '<li pid="' + t.ProductId + '"><a href="' + t.SourceNews + '">' + t.Title + '<\/a><span title="Xóa" onclick="deleteProduct(this,' + t.ProductId + ');"><\/span><\/li>';
                listProductId += t.ProductId + ","
            }), listProductId != "" ? ($("#boxProductSaved").show(), $("#boxProductSaved ul").html(html), hideBox(), $.cookie("savedProductIds", listProductId, {
                domain: domainCookie,
                path: "/",
                expires: 7
            })) : ($.removeCookie("savedProductIds", {
                domain: domainCookie,
                path: "/"
            }), $("#boxProductSaved").hide()))
        }
    }))
}

function deleteProduct(n, t) {
    if (confirm("Bạn có chắc chắn muốn xóa ?")) {
        $(n).parent().remove();
        var i = $.cookie("savedProductIds") != null ? $.cookie("savedProductIds") : "";
        i = i.replace(t, "").replace(",,", ",");
        deleteProductSaved(t);
        i != "" && i != "," ? $.cookie("savedProductIds", i, {
            domain: domainCookie,
            path: "/",
            expires: 7
        }) : $.removeCookie("savedProductIds", {
            domain: domainCookie,
            path: "/"
        });
        $("#boxProductSaved ul li").length == 0 && $("#boxProductSaved").hide()
    }
}

function deleteAllNews() {
    if (confirm("Bạn có chắc chắn muốn xóa tất cả ?")) {
        var n = $.cookie("savedProductIds");
        (n == null || n == "") && (n = "", $("#boxProductSaved li").each(function() {
            n += $(this).attr("pid") + ","
        }));
        deleteListProductSaved(n);
        $.removeCookie("savedProductIds", {
            domain: domainCookie,
            path: "/"
        });
        $("#boxProductSaved").hide()
    }
}

function openBox() {
    $("#boxProductSaved ul").show();
    var n = $("#boxProductSaved").css("bottom");
    n.replace("px", "") < -1 && $("#boxProductSaved").animate({
        bottom: "0"
    }, 200, function() {
        $("#boxProductSaved #btn_close").removeClass().addClass("hideAll")
    })
}

function hideBox() {
    $.cookie("statusBox") == 0 && ($("#boxProductSaved ul").hide(), $("#boxProductSaved").css("bottom", "-10px"), $("#boxProductSaved #btn_close").removeClass().addClass("showAll"))
}

function deleteProductSaved(n) {
    userId != "" && $.ajax({
        type: "POST",
        cache: !1,
        url: "/Handler/ProductHandler.ashx?module=deleteProductId",
        data: {
            productId: n
        },
        success: function() {}
    })
}

function deleteListProductSaved(n) {
    userId != "" && $.ajax({
        type: "POST",
        cache: !1,
        url: "/Handler/ProductHandler.ashx?module=deleteListProductId",
        data: {
            productIds: n
        },
        success: function() {}
    })
}

function productSaved(n, t) {
    var i = $.cookie("savedProductIds");
    i != null ? i.search(t) == -1 && $.cookie("savedProductIds", t + "," + i, {
        domain: domainCookie,
        path: "/",
        expires: 7
    }) : $.cookie("savedProductIds", t, {
        domain: domainCookie,
        path: "/",
        expires: 7
    });
    $("#boxProductSaved").show();
    userId == "" ? GetProductlist() : $.ajax({
        type: "POST",
        cache: !1,
        url: "/Handler/ProductHandler.ashx?module=productInsert",
        data: {
            productId: t
        },
        success: function() {
            GetProductlist()
        }
    });
    $("li#" + t).removeClass("hover");
    $(".boxSave" + t).addClass("dplblock");
    $("#saveProduct" + t).hide();
    $("#hideProduct" + t).hide();
    $("#savedProduct" + t).show();
    $(n).text("Đã lưu").removeClass("save").addClass("saved").removeAttr("onclick");
    openBox()
}

function checkStatusListId() {
    var n, listId;
    userId == "" ? (n = $.cookie("savedProductIds"), n != null && $(".productlist .item .save").each(function() {
        var t = $(this).attr("id");
        n.search(t) > -1 && $("#" + t).text("Đã lưu").removeClass().addClass("saved").removeAttr("onclick")
    })) : (listId = "", $(".productlist .item .save").each(function() {
        listId += $(this).attr("id") + ","
    }), listId != "" && $.ajax({
        type: "POST",
        cache: !1,
        url: "/Handler/ProductHandler.ashx?module=getListProductId",
        data: {
            productIds: listId
        },
        success: function(data) {
            listId = "";
            data != null && (likeReturn = eval("(" + data + ")"), $.each(likeReturn, function(n, t) {
                listId += t.ProductId + ","
            }), $(".productlist .item .save").each(function() {
                var n = $(this).attr("id");
                listId.search(n) > -1 && $("#" + n).text("Đã lưu").removeClass().addClass("saved").removeAttr("onclick")
            }))
        }
    }))
}

function detectmob() {
    return navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i) ? !0 : !1
}

function UnicodeToKoDau(n) {
    var r = "",
        u, i, t;
    if (n == null) return r;
    for (i = "a", t = 0; t < n.length; t++)(i != " " || n[t] != " ") && (i = n[t], u = uniChars.indexOf(i), u >= 0 && (r += KoDauChars[u]));
    return r
}

function UnicodeToKoDauAndGach(n) {
    var i, t;
    for (n = UnicodeToKoDau(n.toLowerCase()), i = "", t = 0; t < n.length; t++) "abcdefghijklmnopqrstxyzuvxw0123456789 ".indexOf(n.charAt(t)) > -1 && (n.charAt(t) != " " ? i += n.charAt(t) : t > 0 && n.charAt(t - 1) != " " && n.charAt(t - 1) != "-" && (i += "-"));
    return i
}

function round(n, t) {
    var i = Math.pow(10, t || 0);
    return Math.round(n * i) / i
}
$(document).ready(function() {
    var c, l, u, f;
    BoxHotHide();
    ProductCountHide(1);
    GetProductlist();
    checkStatus();
    checkCookie();
    $("#btn_close").click(function() {
        var n = $("#boxProductSaved ul").height() + 15,
            t = $("#boxProductSaved").css("bottom");
        t == -n + "px" || t == "-10px" ? ($("#boxProductSaved ul").show(), $("#boxProductSaved #btn_close").removeClass().addClass("hideAll"), $("#boxProductSaved").animate({
            bottom: "0"
        }, 200, function() {
            $.cookie("statusBox", 1, {
                domain: domainCookie,
                path: "/",
                expires: 7
            })
        })) : $("#boxProductSaved").animate({
            bottom: -n
        }, 200, function() {
            $("#boxProductSaved #btn_close").removeClass().addClass("showAll");
            $.cookie("statusBox", 0, {
                domain: domainCookie,
                path: "/",
                expires: 7
            })
        })
    });
    $("body").on("click", "#Email_Register_Right", function() {
        var n = $("#txtemailregister_right").val();
        if (n.indexOf(" ") < 0 && /.+@.+\.[a-zA-Z]{2,4}$/.test(n)) {
            var t = $("#hddcboType").val(),
                i = $("#hddcboCate").val(),
                r = $("#hddcboCity").val(),
                u = $("#hddcboDist").val(),
                f = $("#hddcboProject").val(),
                e = "/Layout/EmailRegister/EmailRegisterSend.aspx?pType=" + t + "&cateId=" + i + "&cityCode=" + r + "&distId=" + u + "&projId=" + f + "&EmailRegister=" + n;
            $("#Email_Register_Right").attr("href", e);
            $("#Email_Register_Right").fancybox({
                padding: 0,
                fitToView: !1,
                preload: !0,
                afterShow: function() {},
                afterClose: function() {
                    $("#txtemailregister_right").val("");
                    $.fancybox.close()
                }
            })
        } else return alert("Email sai định dạng"), !1
    });
    $("body").on("click", "#UtilityRegisterEmail", function() {
        $("#UtilityRegisterEmail").attr("href", "/Layout/EmailRegister/EmailRegisterSend.aspx");
        $("#UtilityRegisterEmail").fancybox({
            padding: 0,
            fitToView: !1,
            preload: !0,
            afterShow: function() {},
            afterClose: function() {
                $.fancybox.close()
            }
        })
    });
    $("body").on("click", "#UtilityRegisterArticleEmail", function() {
        $("#UtilityRegisterArticleEmail").attr("href", "/Layout/EmailRegister/ArticleEmailRegisterSend.aspx");
        $("#UtilityRegisterArticleEmail").fancybox({
            padding: 0,
            width: "577",
            fitToView: !1,
            preload: !0,
            afterShow: function() {},
            afterClose: function() {
                $.fancybox.close()
            }
        })
    });
    $("body").on("click", "#BannerRegisterArticleEmail", function() {
        var n = $("#txtHomeEnewsEmail").val(),
            t = "/Layout/EmailRegister/ArticleEmailRegisterSend.aspx?homeEmail=" + n;
        $("#BannerRegisterArticleEmail").attr("href", t);
        $("#BannerRegisterArticleEmail").fancybox({
            padding: 0,
            width: "577",
            fitToView: !1,
            preload: !0,
            afterShow: function() {},
            afterClose: function() {
                $.fancybox.close()
            }
        })
    });
    $("#txtHomeEnewsEmail").keypress(function(n) {
        var t = n.which;
        if (t == 13) return console.log(t), $("#BannerRegisterArticleEmail").trigger("click"), !1
    });
    $(".UtilityEditEmail").on("click", function() {
        var n = $(this).attr("dataid"),
            t = "/Layout/EmailRegister/EmailRegisterSend.aspx?ItemId=" + n;
        $.fancybox({
            href: t,
            type: "ajax",
            padding: 0,
            fitToView: !1,
            preload: !0,
            afterShow: function() {},
            afterClose: function() {
                $.fancybox.close()
            }
        })
    });
    $("body").on("click", "#UtilityFengShui", function() {
        $("#UtilityFengShui").attr("href", "/Layout/FengShuis/FengShuiResult.aspx");
        $("#UtilityFengShui").fancybox({
            padding: 0,
            fitToView: !1,
            preload: !0,
            autoCenter: !1,
            afterShow: function() {},
            afterClose: function() {
                $.fancybox.close()
            }
        })
    });
    $("body").on("click", "#UtilityInterest", function() {
        $("#UtilityInterest").attr("href", "/Layout/FengShuis/InterestResult.aspx");
        $("#UtilityInterest").fancybox({
            padding: 0,
            fitToView: !1,
            preload: !0,
            autoCenter: !1,
            afterShow: function() {},
            afterClose: function() {
                $.fancybox.close()
            }
        })
    });
    $("body").on("click", "#lbtDirection", function() {
        var n = $("#txtBirthYearFromDirect").val(),
            t = $("#cmbSexForm").val(),
            i = $("#cmbDirectionForm").val();
        n != null && (/^(19|20)[0-9]{2}$/.test(n) ? ($("#errorHomeDirection").hide(), $("#divajax").show(), $.ajax({
            url: "/Handler/UtilityHandler.ashx?v=" + Math.random(),
            data: {
                act: "ResultDirection",
                year: n,
                gender: t,
                direction: i
            },
            success: function(n) {
                $("#divajax").hide();
                $("#divContentFS").show();
                $("#divContentRS").html(n)
            }
        })) : $("#errorHomeDirection").show())
    });
    $("body").on("click", "#lbtAgeBuildHome", function() {
        var n = $("#txtBirthYearFormAge").val(),
            t = $("#cmbYearForm").val();
        n != null && (/^(19|20)[0-9]{2}$/.test(n) ? ($("#errorBuildHome").hide(), $("#divajax").show(), $.ajax({
            url: "/Handler/UtilityHandler.ashx?v=" + Math.random(),
            data: {
                act: "ResultAge",
                year: n,
                expectedyear: t
            },
            success: function(n) {
                $("#divajax").hide();
                $("#divContentFS").show();
                $("#divContentRS").html(n)
            }
        })) : $("#errorBuildHome").show())
    });
    getInterest($("#ddlBankForm").val(), $("#ddlTermForm").val(), 0);
    $("#rdvndForm").change(function() {
        $("#hddMoneyForm").val(0);
        var n = $("#ddlBankForm").val(),
            t = $("#ddlTermForm").val();
        getInterest(n, t, 0)
    });
    $("#rdusdForm").change(function() {
        $("#hddMoneyForm").val(1);
        var n = $("#ddlBankForm").val(),
            t = $("#ddlTermForm").val();
        getInterest(n, t, 1)
    });
    $("#ddlBankForm").change(function() {
        var t = $(this).val(),
            i = $("#ddlTermForm").val(),
            n = $("#hddMoneyForm").val();
        (n == null || n == "") && (n = 0);
        getInterest(t, i, n)
    });
    $("#ddlTermForm").change(function() {
        var t = $(this).val(),
            i = $("#ddlBankForm").val(),
            n = $("#hddMoneyForm").val();
        (n == null || n == "") && (n = 0);
        getInterest(i, t, n)
    });
    $("body").on("click", "#InterestRateForm", function() {
        $("#ff_interest_content").html("");
        $("#ff_interest_content").hide();
        $("#diverrorTotalForm").hide();
        $("#diverrorTimeForm").hide();
        $("#diverrorRateForm").hide();
        var t = $("#txtTotalForm").val().replace(/\,/g, ""),
            i = $("#txtTimeForm").val(),
            r = $("#txtInterestRateForm").val(),
            u = $("#cmbTimeForm").val(),
            f = $("#cmbInterestRateForm").val(),
            e = $("#cmbTypeForm").val(),
            n = !0;
        /^[0-9,]+$/.test(t) || (n = !1, $("#diverrorTotalForm").show());
        /^[0-9]+$/.test(i) || (n = !1, $("#diverrorTimeForm").show());
        /^[0-9]+((\.|,)[0-9]+)?$/.test(r) || (n = !1, $("#diverrorRateForm").show());
        n && $.ajax({
            url: "/Handler/UtilityHandler.ashx?v=" + Math.random(),
            data: {
                act: "InterestRate",
                total: t,
                borrowingTime: i,
                interestRate: r,
                rentTimeType: u,
                interestRateTimeType: f,
                paymentType: e
            },
            success: function(n) {
                var i = n.data,
                    r = n.interestPay,
                    u = n.fundInterest,
                    t = "";
                t += "<table class='tableInterestRate' cellspacing='0' cellpadding='0' border='0'><thead><tr> <th> Số kỳ trả <\/th> <th> Dư nợ đầu kì (VND) <\/th> <th>Vốn phải trả (VND)<\/th><th>Lãi phải trả (VND)<\/th><th>Vốn + lãi (VND)<\/th><\/tr><\/thead><tbody>";
                i != null && $.each(i, function(n, i) {
                    t += "<tr><td align='center'>" + i.Period + "<\/td><td>" + i.FundStart + "<\/td><td>" + i.FundPay + "<\/td><td>" + i.InterestPay + "<\/td><td>" + i.FundInterest + "<\/td><\/tr>"
                });
                t += "<\/tbody>";
                t += "<tfoot><tr><td colspan='3'>  Tổng:  <\/td> <td>" + r + "<\/td><td>" + u + "<\/td><\/tr><\/tfoot>";
                t += "<\/table>";
                $("#ff_interest_content").html(t);
                $("#ff_interest_content").fadeIn("slow")
            }
        })
    });
    var n = new Date,
        i = new Date(2016, 1, 30),
        t = 864e5,
        s = $(".nav-menu li").find(".active").attr("href");
    if ($("#SiteLeft").show(), $("#SiteRight").show(), l = ".ban_scroll .item", l.length > 0) {
        var r = 1e3,
            o = $("#SiteLeft .ban_scroll").width(),
            a = $("#SiteRight .ban_scroll").width(),
            v = ($(document).width() - r) / 2 + r,
            e = ($(document).width() - r) / 2 - o;
        $(window).scroll(function() {
            h()
        });
        $(window).resize(function() {
            h()
        });

        function h() {
            if ($(document.body).width() < r + o + a) {
                $(".ban_scroll").css("display", "none");
                return
            }
            $(".ban_scroll").css("display", "block");
            v = ($(document.body).width() - 0 - r) / 2 + r + 10;
            e = o == null ? ($(document.body).width() - 0 - r) / 2 - a - 10 : ($(document.body).width() - 0 - r) / 2 - o - 10;
            var f = 0,
                n = $(window).scrollTop(),
                u = window.location.pathname != "/" ? 213 : 460,
                t = 0,
                i = $(".footer").position().top - $(".ban_scroll").height() - 6;
            t = n < u ? u - n : n >= i ? 246 : 0;
            $("#SiteLeft .ban_scroll .item").length != 0 && (n >= i ? $("#SiteLeft .ban_scroll").css({
                position: "fixed",
                bottom: t,
                top: "",
                left: e
            }) : $("#SiteLeft .ban_scroll").css({
                position: "fixed",
                top: t,
                bottom: "",
                left: e
            }));
            $("#SiteRight .ban_scroll .item").length != 0 && (n >= i ? $("#SiteRight .ban_scroll").css({
                position: "fixed",
                bottom: t,
                top: "",
                right: e
            }) : $("#SiteRight .ban_scroll").css({
                position: "fixed",
                top: t,
                bottom: "",
                right: e
            }));
            f = n
        }
        h()
    }
    u = $(".inews .inews-l .inews-l-content").height();
    f = $(".inews .inews-r .inews-l-content").height();
    u != f && (u > f ? f = u : u < f && (u = f), $(".inews .inews-l .inews-l-content").height(u), $(".inews .inews-r .inews-l-content").height(f))
});