$(document).ready(function(){
	
	var History = window.History, State = History.getState();

	History.Adapter.bind(window,'statechange',function(){
		$("#loading").fadeIn();
		var State = History.getState();
		$.ajax( { url:  State.url, success: function(html) {
			var element = "#" + State.data.element;
			$(element).fadeOut("fast", function(){
				if( typeof State.data.lang !== "undefined" )
					$("body").attr("class", State.data.lang );
				$(element).html($(html).find(element).html());
				$(element).fadeIn();
				$("#language-bar").html($(html).find("#language-bar").html());
				if( $(window).width() <= 320 ) {
					if( $("#menu-button").hasClass("up") ) {
						$("#language-bar > a").addClass("zindex");
						$("#language-bar").css({
							position: "relative"
						});
					}
				} else {
					$("#language-bar > a").addClass("zindex");
				}
				$("#loading").fadeOut();
			});
		}});
	});
	
	if( $(window).width() > 320 ) {
		$("#language-bar > a").addClass("zindex");
	} else {
		document.addEventListener("touchmove", function(){
			addIndex();
		}, false);
		
		$(document).scroll(function(){
			addIndex();
		});
	}
	
	function addIndex() {
		if( ! $("#menu-button").hasClass("up") ) {
			if( $(document).scrollTop() > 5 ) {
				$("#language-bar > a").addClass("zindex");
				$("#language-bar").css({
					position: "relative"
				});
			}
			else {
				$("#language-bar > a").removeClass("zindex");
				$("#language-bar").css({
					position: "static"
				});
			}
		}
	}
	
	$(document).on( "click", "#menu-button", function(){
		$("#drop-down-menu").stop(true, true).slideToggle({
			duration: 'fast',
			start: function(){
				$("#menu-button").toggleClass("up");
				if( $("#menu-button").hasClass("up") ) {
					$("#language-bar > a").addClass("zindex");
					$("#language-bar").css({
						position: "relative"
					});
				}
			},
			complete: function(){
				if( $(window).width() <= 320 )
					if( ! $("#menu-button").hasClass("up") && $(document).scrollTop() < 5 ) {
						$("#language-bar > a").removeClass("zindex");
						$("#language-bar").css({
							position: "static"
						});
					}
			}
		});
		return false;
	});
	
	$(document).on("click", ".col-title", function(){
		var $this = $(this);
		var next = $(this).next();
		next.slideToggle(300, function(){
			$this.toggleClass("expand");
			if( $this.hasClass("expand") && next.has( ".collapse-up" ).length )
				$("body, html").animate({scrollTop: $this.offset().top - 83}, 300);
		});
		return false;
	});
	$(document).on("click", ".collapse-up", function(){
		var parent = $(this).parent();
		var prev = parent.prev();
		$("body, html").animate({scrollTop: prev.offset().top - 83}, 300);
		parent.slideUp( 300, function(){
			prev.removeClass("expand");
		});
		return false;
	});
	
	$(document).on("click", "#faq-nav a", function(){
		var active = $("#faq-nav a").index($(this));
		var inactive = "1";
		if( active == "1" )
			var inactive = "0";
		
		$("#faq-response-nav > div").eq(inactive).fadeOut(function(){
			$("#faq-response-nav > div").eq(active).fadeIn(function(){
				$("#faq-nav a").eq(inactive).removeClass("active");
				$("#faq-nav a").eq(active).addClass("active");
			});
		});
	});
	
	$(document).on("click", "#drop-down-menu a", function(){
		var href = $(this).attr("href");
		if( href != "#" ) {
			var parent = $(this).parent();
			var parents = parent.parent();
			$("#drop-down-menu li").removeClass("active");
			parent.addClass("active");
			if( ! parents.hasClass("navigation") )
				parents.parent().addClass("active");
			$("#drop-down-menu").slideUp("fast", function(){
				$("#menu-button").removeClass("up");
			});
			History.pushState( { rand:Math.random(), element: "container-wrap" }, $("#title").html(), href );
		}
		return false;
	});
	$(document).on("click", "#logo", function(){
		var href = $(this).attr("href");
		History.pushState( { rand:Math.random(), element: "container-wrap" }, $("#title").html(), href );
		return false;
	});
	$(document).on("click", "#language-bar a", function(){
		var href = $(this).attr("href");
		History.pushState( { rand:Math.random(), element: "body", lang: $(this).attr("data-lang") }, $("#title").html(), href );
		return false;
	});
	$(document).on("click", "#button-group a, #services-nav a", function(){
		var index = $(this).parent().index();
		$("#drop-down-menu .navigation > li:eq(1) > ul > li:eq(" + index + ") > a").trigger("click");
		return false;
	});
	$(document).on("click", ".ajax-link", function(){
		var href = $(this).attr("href");
		History.pushState( { rand:Math.random(), element: "container-wrap" }, $("#title").html(), href );
		return false;
	});
	$(document).on("submit", "#send-mail", function(){
		var href = $(this).attr("action");
		var mail = $("#mail").val();
		$.post( href, { mail: mail }, function( data ) {
			var data = jQuery.parseJSON( data );
			if( data.result != 1 ) {
				$("#subscribe > label").css("color", "rgb(255, 102, 51)");
			} else {
				$("#subscribe > label").css("color", "#28dc49");
			}
			$("#subscribe > label").css("font-size", "9px");
			$("#subscribe > label").html( data.message );
			$("html, body").scrollTop($(document).height());
		});
		return false;
	});
});