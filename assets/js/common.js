"use strict";

$(function(){
	// AOS 애니메이션 초기화
	AOS.init({
		once: true
	});
});


// 스크롤 탑 & 헤더 색상
$(function() {

	var subTopH = $(".sub-top").innerHeight() - 50;
	var footTop = 0; // footer는 components.js가 DOMContentLoaded에서 주입하므로 스크롤 시 지연 계산

	var quick_scroll = function() {
		var scrollTop = $(window).scrollTop();
		var innerHeight = $(window).innerHeight();

		// footer 위치 최초 1회 계산
		if (!footTop && $(".footer").length) {
			footTop = $(".footer").offset().top;
		}

		if (scrollTop < 120) {
			$(".btn-move-top").removeClass("on");
			$('.btn-move-top').removeClass('top');
		} else {
			$('.btn-move-top').addClass('top');
			$(".btn-move-top").addClass("on").removeClass("abs");
		}

		if (scrollTop > subTopH) {
			$(".header").addClass("color");
		} else {
			$(".header").removeClass("color");
		}

		if (footTop && scrollTop + innerHeight > footTop) {
			$(".btn-move-top").addClass("abs");
		}
	};

	$(window).scroll(quick_scroll);
});
