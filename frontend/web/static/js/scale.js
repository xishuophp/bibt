$(function() {

	// var winHei = $(window).height();

	function doWinScale(vWidth) {
		var diff = null;

		function getClientWidth() {
			return Math.min(window.innerWidth, document.documentElement.clientWidth);
		}

		function scale() {
			var curWidth = getClientWidth(),
				value = 1;

			if(diff === null || curWidth !== diff) {
				diff = curWidth;
				value = curWidth / vWidth;
				window.SCALE = value;

				$(".container").css({
					"-webkit-transform":"scale("+ value +")",
					"-webkit-transform-origin":"left top",

					"-moz-transform":"scale("+ value +")",
					"-moz-transform-origin":"left top",

					"-ms-transform":"scale("+ value +")",
					"-ms-transform-origin":"left top"
				});
			}
		}

		scale();

	}

	doWinScale(640);

	$(window).resize(function() {
		doWinScale(640);
		// winHei = $(window).height();
	});

});