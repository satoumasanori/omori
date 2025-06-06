// hamburger menu and Q&A show/hide functionality
document.addEventListener('DOMContentLoaded', function () {
  // Hamburger menu code
  const hamburger = document.querySelector('.hamburger-menu');
  const menu = document.querySelector('.menu');

  if (hamburger && menu) {
    hamburger.addEventListener('click', function () {
      menu.classList.toggle('menu-open');
    });
  }
  const qaElements = document.querySelectorAll('.qa-ele');

  qaElements.forEach(qa => {
    const answerButton = qa.querySelector('.answer-button');
    const answerContent = qa.querySelector('.qa-ele-answer');

    if (answerButton && answerContent) {
      answerButton.addEventListener('click', function () {
        answerContent.classList.toggle('show');
        answerButton.classList.toggle('active');
        const arrowImg = answerButton.querySelector('.icon img');
        if (arrowImg) {
          if (answerContent.classList.contains('show')) {
            arrowImg.alt = 'Close Answer';
          } else {
            arrowImg.alt = 'Open Answer';
          }
        }
      });
    }
  });
});


// firstview
var f_swiper = new Swiper(".f_Swiper", {
  slidesPerView: 2,
  spaceBetween: 30,
  // autoplay: true,
  loop: true,
  speed: 1000,

  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  },
  on: {
    init: function () {
      this.slideTo(1);
    }
  },
  breakpoints: {
    769: {
      slidesPerView: 2
    },
    300: {
      slidesPerView: 1.5
    },
  },
});

// question select
document.addEventListener("DOMContentLoaded", () => {
  var btn_val = ''

  const options = document.querySelectorAll("#question_select .quiz-option");
  console.log();
  
  options.forEach(button => {
    button.addEventListener("click", () => {
      options.forEach(btn => btn.classList.remove("selected"));
      button.classList.add("selected");
      btn_val = button.innerHTML
      document.getElementById('answer').setAttribute('answer',`${btn_val}`) 
      document.getElementById('answer').innerText = "『" + btn_val + "』" + "で回答する！"
    });
  });
});
document.getElementById('answer')?.addEventListener('click', function(e) {  
  e.preventDefault(); // Prevent default link behavior
  
  var selectedAnswer = document.getElementById('answer').getAttribute('answer');
  var correctAnswer = document.getElementById('correct_answer').innerText;
  var isCorrect = selectedAnswer === correctAnswer;
  
  // Clear any existing notification flag
  sessionStorage.removeItem('hasShownNotification');
  
  // Redirect with answer information
  var questionUrl = document.querySelector('.quiz-result').parentElement.href;
  questionUrl += (questionUrl.includes('?') ? '&' : '?') + 'answer=' + encodeURIComponent(selectedAnswer) + '&correct=' + isCorrect;
  window.location.href = questionUrl;
});


//  ofc slide
var ofcSwiper = new Swiper(".ofcSwiper", {
  speed: 7000,
  direction: "horizontal",
  loop: true,
  slidesPerView: 3,
  freeMode: {
    enabled: true,
    momentum: false,
  },
  zoom: true,
  keyboard: true,
  pagination: false,
  navigation: false,
  autoplay: {
    delay: 0
  },
  breakpoints: {
    300: {
      slidesPerView: 2
    },
    769: {
      slidesPerView: 3
    },
    1200: {
      slidesPerView: 4
    }
  },

});



let swiper = new Swiper(".mySwiper", {
  slidesPerView: 3,
  spaceBetween: 30,
  loop: true,
  autoplay: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    769: {
      slidesPerView: 3
    },
    300: {
      slidesPerView: 1
    }
  },
  on: {
    slideChangeTransitionEnd: function () {
      highlightSecondVisible(this);
    },
    init: function () {
      this.slideTo(1);
    }
  }
});

function highlightSecondVisible(swiperInstance) {
  swiperInstance.slides.forEach(slide => {
    slide.classList.remove("active-second");
  });
  const visibleSlides = Array.from(swiperInstance.slides).filter(slide =>
    slide.classList.contains("swiper-slide-visible")
  );
  if (visibleSlides[1]) {
    visibleSlides[1].classList.add("active-second");
  }
}

let historySwiper = new Swiper(".historySwiper", {
  slidesPerView: 2,
  spaceBetween: 30,
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    type: "progressbar"
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  },
  breakpoints: {
    769: {
      slidesPerView: 2
    },
    300: {
      slidesPerView: 1
    },
  },
  on: {
    init: function () {
      const lastVisibleIndex = this.slides.length - this.params.slidesPerView;
      this.slideTo(lastVisibleIndex); // Ensure last slide is visible
      highlightLastSlide(this);       // Highlight the real last slide
    }
  }
});
function highlightLastSlide(swiper) {
  swiper.slides.forEach(slide => slide.classList.remove("active-last"));

  const lastSlide = swiper.slides[swiper.slides.length];
  if (lastSlide) {
    lastSlide.classList.add("active-last");
  }
}



