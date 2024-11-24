(function($) {
	"use strict";

/* ----------------------------
    preloader
    ------------------------------ */

$(window).on('load', function(){        
	$('#preloader').fadeOut('slow',function(){
	$(this).remove();
	});
});

/* ----------------------------
    Top Scroll
    ------------------------------ */

var offset = 220;
var duration = 500;
jQuery(window).on('scroll', function() {
		jQuery('.scroll-top').fadeIn(duration);

});
jQuery('.scroll-top').on('click', function() {
// 	event.preventDefault();
// 	jQuery('html, body').animate({scrollTop: 0}, duration);
// 	return false;
})

/* ----------------------------
	@module       Copyright
	@description  Evaluates the copyright year
    ------------------------------ */
	
var currentYear = (new Date).getFullYear();
	$(document).ready(function () {
		$(".current-year").text((new Date).getFullYear());
});

/* ----------------------------
    Datepicker
    ------------------------------ */

/* check in */
$('#check-in').datepicker({
	uiLibrary: 'bootstrap4'
});

/* check out */
$('#check-out').datepicker({
	uiLibrary: 'bootstrap4'
});

/* Date of Birth */
$('#datepickerdob').datepicker({
	uiLibrary: 'bootstrap4'
});

/* ----------------------------
    venobox
    ------------------------------ */

$('.venobox').venobox();

/* ----------------------------
    popular hotel carousel
    ------------------------------ */

// $('.popular-hotel-carousel').owlCarousel({
// 	loop: true,
// 	margin: 15,
// 	dots:false,
// 	items: 4,
// 	nav: true,
// 	autoplay:true,
// 	navText : ['<i class="fas fa-long-arrow-alt-left"></i>','<i class="fas fa-long-arrow-alt-right"></i>'],
// 	responsiveClass: true,
// 	responsive: {
// 	  0: {
// 		items: 1
// 	  },
// 	  576: {
// 		items: 2
// 	  },
// 	  767: {
// 		items: 2
// 	  },
// 	  768: {
// 		items: 3
// 	  },
// 	  1000: {
// 		items: 4
// 	  }
// 	}
// })

/* ----------------------------
    testimonial carousel
    ------------------------------ */

// $('.testimonial-carousel').owlCarousel({
// 	loop: true,
// 	margin: 15,
// 	dots:false,
// 	items: 2,
// 	nav: true,
// 	autoplay:true,
// 	navText : ['<i class="fas fa-long-arrow-alt-left"></i>','<i class="fas fa-long-arrow-alt-right"></i>'],
// 	responsiveClass: true,
// 	responsive: {
// 	  0: {
// 		items: 1
// 	  },
// 	  576: {
// 		items: 1
// 	  },
// 	  767: {
// 		items: 1
// 	  },
// 	  768: {
// 		items: 2
// 	  },
// 	  1000: {
// 		items: 2
// 	  }
// 	}
// })

/* ----------------------------
    partner
    ------------------------------ */
	
$('.partner-carousel').owlCarousel({
	loop: true,
	margin: 10,
	dots:false,
	nav: false,
	autoplay:true,
	responsiveClass: true,
	responsive: {
	  0: {
		items: 2
	  },
	  767: {
		items: 3
	  },
	  768: {
		items: 3
	  },
	  1000: {
		items: 6,
		loop: true
	  }
	}
})

/* ----------------------------
    list box carousel
    ------------------------------ */
	
$('.list-box-carousel').owlCarousel({
	loop: true,
	margin: 10,
	dots:false,
	nav: true,
	autoplay:true,
	items: 1,
	responsiveClass: true,
	responsive: {
	  0: {
		items: 1
	  },
	  767: {
		items: 2
	  },
	  768: {
		items: 1
	  },
	  1000: {
		items: 1,
		loop: true
	  }
	}
})

/* ----------------------------
    list box carousel
    ------------------------------ */
	
$('.detail-page-gallery-carousel').owlCarousel({
	loop: true,
	margin: 10,
	dots:false,
	nav: true,
	autoplay:true,
	items: 1,
	responsiveClass: true
})



// START SELECT STYLE

var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);

// END SELECT STYLE


// START DROPDOWN JAVASCRIPT

$(document).click(function(){
	$(".dropdown-list").removeClass('show');
   });
   
   
//    $('.dropdown').click(function(){
   
// 	   $(this).toggleClass('show');
// 	   $(this).children('.dropdown-list').toggleClass('show');
//    })
   
   $('.dropdown-btn').click(function(e){
	   e.stopPropagation();


	   if($(this).hasClass('show')){
		$(this).removeClass('show');
		$(this).children('.dropdown-list').removeClass('show');
	   }else{
		$('.dropdown-btn').removeClass('show');
		$('.dropdown-list').removeClass('show');
 
 
		$(this).toggleClass('show');
		$(this).children('.dropdown-list').toggleClass('show');
	   }
	
   })
   


// END DROPDOWN JAVASCRIPT


// START FILTER BY TYPE
// 'use strict';

// var $filters = $('.filter [data-filter]'),
//   $boxes = $('.boxes [data-type]');

// $filters.on('click', function(e) {
//   e.preventDefault();
//   var $this = $(this);

//   $filters.removeClass('active');
//   $this.addClass('active');

//   var $filterColor = $this.attr('data-filter');

//   if ($filterColor == 'all') {
//     $boxes.removeClass('is-animated')
//       .fadeOut().promise().done(function() {
//         $boxes.addClass('is-animated').fadeIn();
//       });
//   } else {
//     $boxes.removeClass('is-animated')
//       .fadeOut().promise().done(function() {
//         $boxes.filter('[data-type = "' + $filterColor + '"]')
//           .addClass('is-animated').fadeIn();
//       });
//   }
// });

// END FILTER BY TYPE



// END CHAT SCRIPT





})(jQuery);


(function($) {
	"use strict";

/* ----------------------------
    preloader
    ------------------------------ */

$(window).on('load', function(){        
	$('#preloader').fadeOut('slow',function(){
	$(this).remove();
	});
});

/* ----------------------------
    Top Scroll
    ------------------------------ */

var offset = 220;
var duration = 500;
jQuery(window).on('scroll', function() {
		jQuery('.scroll-top').fadeIn(duration);

});
jQuery('.scroll-top').on('click', function() {
// 	event.preventDefault();
// 	jQuery('html, body').animate({scrollTop: 0}, duration);
// 	return false;
})

/* ----------------------------
	@module       Copyright
	@description  Evaluates the copyright year
    ------------------------------ */
	
var currentYear = (new Date).getFullYear();
	$(document).ready(function () {
		$(".current-year").text((new Date).getFullYear());
});

/* ----------------------------
    Datepicker
    ------------------------------ */

/* check in */
$('#check-in').datepicker({
	uiLibrary: 'bootstrap4'
});

/* check out */
$('#check-out').datepicker({
	uiLibrary: 'bootstrap4'
});

/* Date of Birth */
$('#datepickerdob').datepicker({
	uiLibrary: 'bootstrap4'
});

/* ----------------------------
    venobox
    ------------------------------ */

$('.venobox').venobox();

/* ----------------------------
    popular hotel carousel
    ------------------------------ */

// $('.popular-hotel-carousel').owlCarousel({
// 	loop: true,
// 	margin: 15,
// 	dots:false,
// 	items: 4,
// 	nav: true,
// 	autoplay:true,
// 	navText : ['<i class="fas fa-long-arrow-alt-left"></i>','<i class="fas fa-long-arrow-alt-right"></i>'],
// 	responsiveClass: true,
// 	responsive: {
// 	  0: {
// 		items: 1
// 	  },
// 	  576: {
// 		items: 2
// 	  },
// 	  767: {
// 		items: 2
// 	  },
// 	  768: {
// 		items: 3
// 	  },
// 	  1000: {
// 		items: 4
// 	  }
// 	}
// })

/* ----------------------------
    testimonial carousel
    ------------------------------ */

// $('.testimonial-carousel').owlCarousel({
// 	loop: true,
// 	margin: 15,
// 	dots:false,
// 	items: 2,
// 	nav: true,
// 	autoplay:true,
// 	navText : ['<i class="fas fa-long-arrow-alt-left"></i>','<i class="fas fa-long-arrow-alt-right"></i>'],
// 	responsiveClass: true,
// 	responsive: {
// 	  0: {
// 		items: 1
// 	  },
// 	  576: {
// 		items: 1
// 	  },
// 	  767: {
// 		items: 1
// 	  },
// 	  768: {
// 		items: 2
// 	  },
// 	  1000: {
// 		items: 2
// 	  }
// 	}
// })

/* ----------------------------
    partner
    ------------------------------ */
	
$('.partner-carousel').owlCarousel({
	loop: true,
	margin: 10,
	dots:false,
	nav: false,
	autoplay:true,
	responsiveClass: true,
	responsive: {
	  0: {
		items: 2
	  },
	  767: {
		items: 3
	  },
	  768: {
		items: 3
	  },
	  1000: {
		items: 6,
		loop: true
	  }
	}
})

/* ----------------------------
    list box carousel
    ------------------------------ */
	
$('.list-box-carousel').owlCarousel({
	loop: true,
	margin: 10,
	dots:false,
	nav: true,
	autoplay:true,
	items: 1,
	responsiveClass: true,
	responsive: {
	  0: {
		items: 1
	  },
	  767: {
		items: 2
	  },
	  768: {
		items: 1
	  },
	  1000: {
		items: 1,
		loop: true
	  }
	}
})

/* ----------------------------
    list box carousel
    ------------------------------ */
	
$('.detail-page-gallery-carousel').owlCarousel({
	loop: true,
	margin: 10,
	dots:false,
	nav: true,
	autoplay:true,
	items: 1,
	responsiveClass: true
})



// START SELECT STYLE

var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);

// END SELECT STYLE


// START DROPDOWN JAVASCRIPT

$(document).click(function(){
	$(".dropdown-list").removeClass('show');
   });
   
   
//    $('.dropdown').click(function(){
   
// 	   $(this).toggleClass('show');
// 	   $(this).children('.dropdown-list').toggleClass('show');
//    })
   
   $('.dropdown-btn').click(function(e){
	   e.stopPropagation();


	   if($(this).hasClass('show')){
		$(this).removeClass('show');
		$(this).children('.dropdown-list').removeClass('show');
	   }else{
		$('.dropdown-btn').removeClass('show');
		$('.dropdown-list').removeClass('show');
 
 
		$(this).toggleClass('show');
		$(this).children('.dropdown-list').toggleClass('show');
	   }
	
   })
   


// END DROPDOWN JAVASCRIPT


// START FILTER BY TYPE
// 'use strict';

// var $filters = $('.filter [data-filter]'),
//   $boxes = $('.boxes [data-type]');

// $filters.on('click', function(e) {
//   e.preventDefault();
//   var $this = $(this);

//   $filters.removeClass('active');
//   $this.addClass('active');

//   var $filterColor = $this.attr('data-filter');

//   if ($filterColor == 'all') {
//     $boxes.removeClass('is-animated')
//       .fadeOut().promise().done(function() {
//         $boxes.addClass('is-animated').fadeIn();
//       });
//   } else {
//     $boxes.removeClass('is-animated')
//       .fadeOut().promise().done(function() {
//         $boxes.filter('[data-type = "' + $filterColor + '"]')
//           .addClass('is-animated').fadeIn();
//       });
//   }
// });

// END FILTER BY TYPE



// END CHAT SCRIPT

$('.reply-btn').click(function(){
  $('.main-comment-form').css('display' , 'none')
  $(this).closest('.wrapper-single-comment').siblings('.reply-form').css('display' , 'block')
})

$('.cancel-comment').click(function(){
  $('.main-comment-form').css('display' , 'block')
  $(this).closest('.reply-form').css('display' , 'none')
})
$( window ).scroll(function() {
  if(window.pageYOffset > 125){
    $('.dark-sub-nav').addClass('scrolled')
  }else{
    $('.dark-sub-nav').removeClass('scrolled')
  }
});



})(jQuery);

$(document).ready(function() {
  $('.acc-container .acc:nth-child(1) .acc-head').addClass('active');
  $('.acc-container .acc:nth-child(1) .acc-content').slideDown();
  $('.acc-head').on('click', function() {
      if($(this).hasClass('active')) {
        $(this).siblings('.acc-content').slideUp();
        $(this).removeClass('active');
      }
      else {
        $('.acc-content').slideUp();
        $('.acc-head').removeClass('active');
        $(this).siblings('.acc-content').slideToggle();
        $(this).toggleClass('active');
      }
  });






  $('#next').click(function(){
  
    if($('.acc-container').hasClass('apened')){
      $('.acc-container').removeClass('apened');
      $('#next').html('show more <i class="fas fa-chevron-down"></i>')
    }else{
      $('.acc-container').addClass('apened');
      $('#next').html('show less <i class="fas fa-chevron-up"></i>')
    }
  
  })









  });
