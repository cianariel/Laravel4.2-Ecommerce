!function($,o,t){$(function(){function o(){if(window.innerWidth<620)return!1;var o=$(window).scrollTop(),t=$("#sticky-anchor").offset().top;o>t?$(".sticks-on-scroll").addClass("stick"):$(".sticks-on-scroll").removeClass("stick")}$("body").on("click","[data-toggle]",function(o){o.preventDefault();var t=$(this),a=t.data("toggle"),e=t.data("hide"),l=t.data("overlay");e&&($(e).hide(),t.siblings().removeClass("active")),l&&$(".page-overlay").fadeToggle(),$(a).fadeToggle(),t.toggleClass("active")}),$(".page-overlay, .login-signup-modal").click(function(o){if(o.target===this){$(".modal, .page-overlay").fadeOut();var t=$('[data-overlay="true"]').data("toggle");t&&$(t).hide()}}),$("#back-to-top").click(function(){return $("html, body").animate({scrollTop:0},"slow"),!1}),$("[data-scrollto]").click(function(){var o=$(this).data("scrollto"),t=$(o),a=t.offset().top-70;return $("html, body").animate({scrollTop:a},"slow"),!1}),$("li.nested").click(function(){$(this).find("ul").fadeToggle()}),$('[data-toggle="modal"]').click(function(){var o=$(this).data("target");$(o).fadeToggle(),$(".page-overlay").fadeToggle()}),$('[data-dismiss="modal"]').click(function(){var o=$(this).parents(".modal");return o.fadeOut(),$(".page-overlay").fadeOut(),!0}),$(function(){$("#sticky-anchor").length&&($(window).scroll(o),o())}),$(function(){$(window).scroll(function(){$(".scroll-header").length?$(window).scrollTop()<60&&$("header.colophon").removeClass("scroll-header"):$(window).scrollTop()>60&&$("header.colophon").addClass("scroll-header")})}),$(function(){if(window.innerWidth<620)return!1;var o=$(".story-header");o.length&&$(window).scroll(function(){var t=$(window).scrollTop(),a=$("#hero-nav").offset().top,e=$("#top-nav");t>a?(o.fadeIn(),e.fadeOut()):(o.fadeOut(),e.fadeIn())})}),$("#about-button").click(function(){$("html, body").animate({scrollTop:$(document).height()},"slow")}),$("#main-content-filter a").click(function(o){o.preventDefault();var t=$(".main-content"),a=$(this).data("filter");t.removeClass("only-*"),t.addClass("only-"+a)})})}(jQuery,this);