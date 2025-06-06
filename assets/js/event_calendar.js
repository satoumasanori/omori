document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll('.range-button');
  const events = document.getElementById('event-results');
  const nextBtn = document.querySelector('.next-btn');
  const prevBtn = document.querySelector('.prev-btn');

  let currentRange = 'day';      // default range
  let currentDate = new Date();  // default date is today

  // Format date to YYYY-MM-DD string
  function formatDate(date) {
    return date.toISOString().slice(0, 10);
  }

  // Load events from server by range and date
  function loadEvents(range, date) {
    const eventWrapper = document.getElementById('event-results');
  
    // Show loading text
    eventWrapper.innerHTML = '<p>読み込み中...</p>';
  
    fetch(`${eventCalendar.ajaxUrl}?action=load_events&range=${range}&date=${date}`)
      .then(res => res.text())
      .then(html => {
        // Replace content
        eventWrapper.innerHTML = html;
  
        // Reset class list
        eventWrapper.classList.remove('swiper-wrapper', 'day-event-cards', 'event-week', 'event-month');
  
        // Apply correct class based on range
        if (range === 'month') {
          eventWrapper.classList.add('event-month');
        }else if (range === 'week') {
          eventWrapper.classList.add('event-week');
        } else if (range === 'day') {
          eventWrapper.classList.add('day-event-cards', 'swiper-wrapper');
        }
      })
      .catch(() => {
        eventWrapper.innerHTML = '<p>イベントの読み込みに失敗しました。</p>';
      });
  }
  document.addEventListener('DOMContentLoaded', function () {
    document.body.classList.remove('tribe-events-ajax-loading');
  });

  // Move date forward or backward based on range and direction (+1 or -1)
  function shiftDate(date, range, direction) {
    const d = new Date(date);
    switch (range) {
      case 'day':
        d.setDate(d.getDate() + direction);
        break;
      case 'week':
        d.setDate(d.getDate() + direction * 7);
        break;
      case 'month':
        d.setMonth(d.getMonth() + direction);
        break;
    }
    return d;
  }

  // Range button click: update currentRange, reset currentDate, load events
  buttons.forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();

      buttons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      currentRange = btn.dataset.range;
      currentDate = new Date();  // reset to today when range changes
      loadEvents(currentRange, formatDate(currentDate));
    });
  });

  // Prev button click: move currentDate backward by 1 range step
  prevBtn?.addEventListener('click', () => {
    currentDate = shiftDate(currentDate, currentRange, +1);
    loadEvents(currentRange, formatDate(currentDate));
  });

  // Next button click: move currentDate forward by 1 range step
  nextBtn?.addEventListener('click', () => {
    currentDate = shiftDate(currentDate, currentRange, -1);
    loadEvents(currentRange, formatDate(currentDate));
  });

  // On initial load, find default active range button and load events
  const defaultBtn = document.querySelector('.range-button.active') || buttons[0];
  if (defaultBtn) {
    defaultBtn.classList.add('active');
    currentRange = defaultBtn.dataset.range;
    currentDate = new Date();
    loadEvents(currentRange, formatDate(currentDate));
  }
});


var f_swiper = new Swiper(".calendarSwiper", {
  slidesPerView: 3,
  spaceBetween: 30,
  autoplay: false,
  loop: false,
  loopAdditionalSlides: 3,

  speed: 1000,

  // pagination: {
  //   el: ".swiper-pagination",
  //   clickable: true,
  // },
  // navigation: {
  //   nextEl: ".swiper-button-next",
  //   prevEl: ".swiper-button-prev"
  // },
  on: {
    init: function () {
      this.slideTo(1);
    }
  },
  breakpoints: {
    769: {
      slidesPerView: 3
    },
    300: {
      slidesPerView: 1.5
    },
  },
});