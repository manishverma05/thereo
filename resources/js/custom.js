var prevScrollpos = window.pageYOffset;
window.scroll = functions() {
var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("navbar").style.top = "0";
  } else {
    document.getElementById("navbar").style.top = "-80px";
  }
  prevScrollpos = currentScrollPos;
}

/*******************************
* ON SCROLL CHANGE MENU COLOR
*******************************/
$(functions() {
    $(window).on("scroll", functions() {
        if($(window).scrollTop() > 50) {
            $(".navbar").addClass("rjheadactive");
        } else {
            //remove the background property so it comes transparent again (defined in your css)
           $(".navbar").removeClass("rjheadactive");
        }
    });
});

/*******************************
* ACCORDION WITH TOGGLE ICONS
*******************************/
functions toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);

$(document).ready(functions(){
	$('a.back_rj').click(functions(){
		parent.history.back();
		return false;
	});
});

/*******************************
* SINGLE PAGE SCRIPT
*******************************/
(functions(){
    var $g_examples = document.querySelector('#examplesList');

    functions init(){
        bindEvents();
    }

    functions bindEvents(){
        document.querySelector('#showExamples').addEventListener('click', showExamples);
        document.querySelector('html').addEventListener('click', hideExamples);
    }

    functions showExamples(event){
        event = event || window.event;

        event.stopPropagation();
        event.preventDefault();


        if(!$g_examples.isVisible){
            $g_examples.style.display = 'block';
            $g_examples.isVisible = true;
        }else{
            $g_examples.style.display = 'none';
            $g_examples.isVisible = false;
        }
    }

    functions hideExamples(){
         $g_examples.style.display = 'none';
    }

    init();
})();

/*******************************
* VIDEO PAGE
*******************************/