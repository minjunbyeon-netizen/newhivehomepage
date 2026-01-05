"use strict";

$(function(){

	// Side Menu Open
	$(".btn-nav-open").on("click", function(){
		
		const nav = $("aside.nav-wrap");
		const darkLight = $(".btn-dark-light");
		
		if(nav.hasClass("open")){
			$(this).removeClass("on");
			nav.removeClass("open");	
			setTimeout(function(){
				darkLight.removeClass("out");
				//clearTimeout(timer);
			}, 500);
		} else {
			$(this).addClass("on");
			nav.addClass("open");			
			darkLight.addClass("out");
			// $(this).removeClass('hover');
		}		
	});

	const darkLight = $(".btn-dark-light");
	let switchBtn = true;
	$(darkLight).on('click', function() {
		if(switchBtn == true) {
			$('.dark_bg').css('transform', 'translateX(0)');
			$('button.applyBtn').css('color','#000');
			$('.inquiry-manu li input[type=radio]:checked + label').css('color','#000')
			switchBtn = false;
		}
		else {
			$('.dark_bg').css('transform', 'translateX(100vw)');
			$('button.applyBtn').css('color','#fff')
			$('.inquiry-manu li input[type=radio]:checked + label').css('color','#fff')

			switchBtn = true;
		}

	})
	
	/*$(".btn-nav-open").on('mouseover', function(){
		const nav = $("aside.nav-wrap");
		
		if(nav.hasClass("open")){
			$(this).removeClass('hover');
		} else {
			$(this).addClass('hover');
		}		
	}).on('mouseout',function(){
		$(this).removeClass('hover');
	});	*/
	
	// Mode change
	$(".btn-dark-light").on("click", function(){
		let mode = $('html').attr('data-theme');
		if( mode == "light"){
			$('html').attr('data-theme', 'dark');
			$('.switch input').removeClass('light')
		} else {
			$('html').attr('data-theme', 'light');
			$('.switch input').addClass('light')
		}
	});
	
	//Animation
	//AOS.init();
	AOS.init({
	   once: true
	})
});




//스크롤 탑
$(function() {


	var subTopH = $(".sub-top").innerHeight() - 50;
	var indexTopH = $(".index-top").innerHeight() - 50;
	var footTop = $(".footer").offset().top;
	
	var quick_scroll = function() {
		var scrollTop = $(window).scrollTop();
		var innerHeight = $(window).innerHeight();
		//var scrollHeight = $(document).innerHeight();

		if (scrollTop < 120) {
			$(".btn-move-top").removeClass("on");
			$('.btn-move-top').removeClass('top');
		} else {
			$('.btn-move-top').addClass('top');
			$(".btn-move-top").addClass("on").removeClass("abs");

		}


		if ( scrollTop > subTopH){
			$(".header").addClass("color");

		} else {
			$(".header").removeClass("color");
		}


		if (scrollTop + innerHeight > footTop) {
			$(".btn-move-top").addClass("abs");
		}


	}
	$(window).scroll(quick_scroll);


	$(".btn-move-top").click(function() {
		$('html, body').animate({
			scrollTop : 0
		}, 400, 'swing');
		return false;
	});




});











