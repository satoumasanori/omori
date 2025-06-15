document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll('.range-button');
  const nextBtn = document.querySelector('.next-btn');
  const prevBtn = document.querySelector('.prev-btn');
  const monthNextBtn = document.querySelector('.month-next-btn');
  const monthPrevBtn = document.querySelector('.month-prev-btn');
  const eventPageNation = document.getElementById('event-pagination-handle-button');

  let currentRange = 'day';      // default range
  let currentDate = new Date();  // default date is today
  let currentPage = 1;
  let perPage = 8;
  let allMonthEvents = [];
  function formatDate(date) {
    return date.toISOString().slice(0, 10);
  }
  function updateCountdown(targetDateStr, elementId) {
    const today = new Date();
    const targetDate = new Date(targetDateStr);
    const diffTime = targetDate - today;
  
    // Calculate days difference, rounding up to include the target day itself
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    
    const countdownElement = document.getElementById(elementId);
    if (countdownElement) {
      countdownElement.textContent = diffDays > 0 ? diffDays : 0;
    }
  }
  
  // Example: 150th anniversary is on 2026-06-12
  updateCountdown('2026-06-12', 'countdown-days');
  function updateRangeLabel(range, date) {
    const labelDiv = document.getElementById('event-range-label');
    const current = new Date(date);
    if (!labelDiv) return;
    if (range === 'day') {
      labelDiv.innerHTML = ''; // No label needed for day
    } else if (range === 'week') {
      const start = new Date(current);
      const end = new Date(current);
      start.setDate(current.getDate() - current.getDay() + 1); // Start from Monday
      end.setDate(start.getDate() + 6); // End on Sunday
      const format = d => `${String(d.getMonth() + 1).padStart(2, '0')}.${String(d.getDate()).padStart(2, '0')}`;
      labelDiv.innerHTML = `<p>${format(start)}~</p><p>${format(end)}</p>`;
    } else if (range === 'month') {
      labelDiv.innerHTML = `<p>${current.getMonth() + 1}</p><p>月のイベント</p>`;
    }
  }
  function displayPaginatedEvents(page) {
    const eventWrapper = document.getElementById('event-results');
    const start = (page - 1) * perPage;
    const end = start + perPage;
    allMonthEvents.forEach((el, i) => {
      el.style.display = (i >= start && i < end) ? 'block' : 'none';
    });
    const totalPages = Math.ceil(allMonthEvents.length / perPage);
    monthPrevBtn.disabled = page === 1;
    if(page === 1) {
      monthPrevBtn.classList.add('button-disabled');
    } else {
      monthPrevBtn.classList.remove('button-disabled');
    }
    monthNextBtn.disabled = page === totalPages;
    if(page === totalPages) {
      monthNextBtn.classList.add('button-disabled');
    } else {
      monthNextBtn.classList.remove('button-disabled');
    }
  }
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
  
  function loadEvents(range, date) {
    const eventWrapper = document.getElementById('event-results');
    const eventBox = document.getElementById('event-box');
    currentPage = 1;
    allMonthEvents = [];
    // Show loading text
    eventWrapper.innerHTML = '<p>読み込み中...</p>';
    fetch(`${eventCalendar.ajaxUrl}?action=load_events&range=${range}&date=${date}`)
      .then(res => res.text())
      .then(html => {
        eventWrapper.innerHTML = html;
        eventBox.classList.remove('calendarSwiper');
        eventWrapper.classList.remove('day-event-cards','swiper-wrapper', 'event-week', 'event-month', 'calendarSwiper');
        eventPageNation.classList.remove('display-none');
        if (range === 'month') {
          eventWrapper.classList.add('event-month');
          allMonthEvents = Array.from(eventWrapper.querySelectorAll('.event-card'));
          displayPaginatedEvents(currentPage);
          eventWrapper.style.transform = 'unset'
          eventWrapper.style.transitionDuration = 'unset'
          console.log('range is month');
        } else if (range === 'week') {
          eventWrapper.style.transform = 'unset'
          eventWrapper.style.transitionDuration = 'unset'
          eventWrapper.classList.add('event-week');
          allMonthEvents = Array.from(eventWrapper.querySelectorAll('.event-card'));
          displayPaginatedEvents(currentPage);
        } else if (range === 'day') {
          eventBox.classList.add('event-box', 'calendarSwiper');
          eventWrapper.classList.add( 'swiper-wrapper');
          eventPageNation.classList.add('display-none');
          eventWrapper.classList.add('day-event-cards');
          if(eventWrapper.children.length <= 3 && eventWrapper.children.length > 0) {
            console.log('sdsdfsf');
            
            eventWrapper.classList.add('three-event-cards');
           eventBox.classList.remove('event-box', 'calendarSwiper');
            eventWrapper.classList.remove('swiper-wrapper', 'day-event-cards');
            eventWrapper.style.transform = 'unset'
          eventWrapper.style.transitionDuration = 'unset'
            for(eventWrapperChild of eventWrapper.children) {
              eventWrapperChild.classList.remove('swiper-slide');
            }
          }else {
            eventWrapper.classList.remove('three-event-cards');
          }
          // :white_check_mark: Initialize Swiper after DOM update for day view
          if(eventWrapper.children.length > 3) {
            setTimeout(() => {
              const swiperEl = document.querySelector(".calendarSwiper");
              if (!swiperEl) return;
              const slideCount = swiperEl.querySelectorAll(".swiper-slide").length;
              new Swiper(swiperEl, {
                slidesPerView: 3,
                spaceBetween: 30,
                freeMode: true,
                speed: 5000,
                loop: slideCount > 3,
                autoplay: {
                  delay: 1,
                  pauseOnMouseEnter: false,
                  disableOnInteraction: false,
                  waitForTransition: true,
                  stopOnLastSlide: false,
                },
                effect: 'slide',
                on: {
                  init: function () {
                    this.slideTo(1);
                  }
                },
                breakpoints: {
                  769: { slidesPerView: 3 },
                  600: { slidesPerView: 2 },
                  300: { slidesPerView: 1.5 },
                },
              });
            }, 100);
          }
        }
        updateRangeLabel(range, date);
      })
      .catch(() => {
        eventWrapper.innerHTML = '<p>イベントの読み込みに失敗しました。</p>';
      });
  }
  buttons.forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      buttons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      currentRange = btn.dataset.range;
      currentDate = new Date(); // reset to today
      loadEvents(currentRange, formatDate(currentDate));
    });
  });
  prevBtn?.addEventListener('click', () => {
    currentDate = shiftDate(currentDate, currentRange, +1);
    loadEvents(currentRange, formatDate(currentDate));
  });
  nextBtn?.addEventListener('click', () => {
    currentDate = shiftDate(currentDate, currentRange, -1);
    loadEvents(currentRange, formatDate(currentDate));
  });
  monthNextBtn?.addEventListener('click', () => {
    if (currentRange === 'day') return;
    const totalPages = Math.ceil(allMonthEvents.length / perPage);
    if (currentPage < totalPages) {
      currentPage++;
      displayPaginatedEvents(currentPage);
    }
  });
  monthPrevBtn?.addEventListener('click', () => {
    if (currentRange === 'day') return;
    if (currentPage > 1) {
      currentPage--;
      displayPaginatedEvents(currentPage);
    }
  });
  // Initial load
  const defaultBtn = document.querySelector('.range-button.active') || buttons[0];
  if (defaultBtn) {
    defaultBtn.classList.add('active');
    currentRange = defaultBtn.dataset.range;
    currentDate = new Date();
    loadEvents(currentRange, formatDate(currentDate));
  }
});