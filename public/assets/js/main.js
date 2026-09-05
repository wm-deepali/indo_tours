$(function () {

  // ============ HEADER FIXED ON SCROLL ============
  const headerEl = document.querySelector("header");
  if (headerEl) {
    const toggleHeaderFixed = () => {
      headerEl.classList.toggle("header-fixed", window.scrollY > 100);
    };
    toggleHeaderFixed();
    window.addEventListener("scroll", toggleHeaderFixed);
  }

  // ============ FORM CONTROLS (floating label / validation state) ============
  const formControls = $(".form-control");
  formControls.on("focus input change blur", throttle(handleForm));
  formControls.each(function () {
    handleForm.call(this);
  });

  // ============ NICE SELECT ============
  niceSelect($);
  $("select").niceSelect();

  // ============ ANIMATIONS ============
  handleAnimations();

  // ============ WHATSAPP URLS ============
  adjustWhatsAppUrls();
  $(window).resize(function () {
    adjustWhatsAppUrls();
  });

  // ============ COUNT ANIMATION ============
  startCountAnimation();
  $(window).on("scroll", function () {
    startCountAnimation();
  });

  // ============ TABS ============
  $(".tab-nav li").on("click", function () {
    const tab = $(this).data("tab");
    const $target = $('.tab-nav-content .tabs[data-tab="' + tab + '"]');
    $(this).addClass("active").siblings().removeClass("active");
    if ($target.length) {
      $target.addClass("active").siblings(".tabs").removeClass("active");
    } else {
      $(".tab-nav-content .tabs").removeClass("active");
    }
  });

  // ============ SCROLL TO (data-scrollTo) ============
  $(document).on("click", "[data-scrollTo]", function () {
    const headerheight =
      parseInt($(":root").css("--headerpadding")) +
      parseInt($(":root").css("--headerfixed"));

    const section = $(this).attr("data-scrollTo");

    if (section) {
      $("html, body")
        .stop()
        .animate(
          { scrollTop: $(section).offset().top - headerheight },
          1000
        );
    }
  });

  // ============ MODAL OPEN (jQuery data-model trigger, legacy) ============
  $(document).on("click", "[data-model]", function () {
    const model = $(this).attr("data-model");
    const type = $(this).attr("data-type");
    openModel(model, type);
  });

  $(document).on("click", ".overlay, .close", function () {
    closeModel();
  });

  // ============ SCROLL TO SECTION (hash links) ============
  function scrollToHash(hash) {
    const headerHeight = parseInt($(":root").css("--headerheight")) || 0;
    const $target = $(hash);
    if (!$target.length) return;

    $("html, body")
      .stop()
      .animate({ scrollTop: $target.offset().top - headerHeight }, 600);
  }

  if (window.location.hash) {
    scrollToHash(window.location.hash);
  }

  $(window).on("hashchange", function () {
    scrollToHash(window.location.hash);
    if (typeof closeModel === "function") closeModel();
  });

  $(document).on("click", 'a[href^="#"]', function (e) {
    const hash = $(this).attr("href");
    if (hash.length > 1 && $(hash).length) {
      e.preventDefault();
      history.pushState(null, null, hash);
      scrollToHash(hash);
      if (typeof closeModel === "function") closeModel();
    }
  });

  // ============ MOBILE DROPDOWN MENU ============
  $(".hasDropdown").on("click", function (e) {
    e.stopPropagation();

    const slideMenu = $(this).find(".dropdown-menu-ham");
    const plusIcon = $(this).find(".plu-ico");

    $(".dropdown-menu-ham").not(slideMenu).slideUp();
    $(".hasDropdown").not(this).removeClass("active");
    $(".plu-ico").not(plusIcon).removeClass("active");

    $(this).toggleClass("active");
    plusIcon.toggleClass("active");

    slideMenu.stop().slideToggle();
  });

  // ============ ACCORDIONS ============
  $(".accordion-wrapper").each(function () {
    const $wrapper = $(this);

    $wrapper.find(".accordion-item").removeClass("active");
    $wrapper.find(".accordion-content").hide();
    $wrapper.find(".accordion-icon").text("+");

    const $firstItem = $wrapper.find(".accordion-item").first();
    $firstItem.addClass("active");
    $firstItem.find(".accordion-content").show();
    $firstItem.find(".accordion-icon").text("−");

    $wrapper.on("click", ".accordion-header", function () {
      const $item = $(this).closest(".accordion-item");
      const $content = $(this).siblings(".accordion-content");
      const isActive = $item.hasClass("active");

      $wrapper.find(".accordion-item").removeClass("active");
      $wrapper.find(".accordion-content").slideUp(300);
      $wrapper.find(".accordion-icon").text("+");

      if (!isActive) {
        $item.addClass("active");
        $content.slideDown(300);
        $item.find(".accordion-icon").text("−");
      }
    });
  });

  $(".expand-toggle input[type='checkbox']").on("change", function () {
    const $wrapper = $(this)
      .closest(".Itinerary, .listing-secI")
      .find(".accordion-wrapper");

    if ($(this).is(":checked")) {
      $wrapper.find(".accordion-item").addClass("active");
      $wrapper.find(".accordion-content").slideDown(300);
      $wrapper.find(".accordion-icon").text("−");
    } else {
      $wrapper.find(".accordion-item").removeClass("active");
      $wrapper.find(".accordion-content").slideUp(300);
      $wrapper.find(".accordion-icon").text("+");

      const $firstItem = $wrapper.find(".accordion-item").first();
      $firstItem.addClass("active");
      $firstItem.find(".accordion-content").show();
      $firstItem.find(".accordion-icon").text("−");
    }
  });

  // ============ VIDEO POPUP ============
  $("[data-video]").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();

    $(".video-pop").addClass("is-open");

    let src = $(this).attr("data-video");

    if (src.includes("youtube.com/embed/")) {
      const videoId = src.split("embed/")[1].split("?")[0];
      src += "&autoplay=1&loop=1&playlist=" + videoId;
    }

    $("#iframe1").attr("src", src);
    $("body,html").addClass("overflow-hidden");
  });

  // ============ SWIPERS ============
  new Swiper(".placesSlider", {
    slidesPerView: 3.2,
    spaceBetween: 24,
    navigation: {
      nextEl: ".placesSlider-next",
      prevEl: ".placesSlider-prev",
    },
    breakpoints: {
      0: { slidesPerView: 1.15, spaceBetween: 14 },
      576: { slidesPerView: 1.6, spaceBetween: 16 },
      768: { slidesPerView: 2.2, spaceBetween: 18 },
      1200: { slidesPerView: 3, spaceBetween: 24 },
    },
  });

  new Swiper(".logoSlider", {
    loop: true,
    spaceBetween: 32,
    slidesPerView: 3,
    autoplay: { delay: 0, disableOnInteraction: false },
    speed: 4000,
    allowTouchMove: false,
    breakpoints: {
      480: { slidesPerView: 3, spaceBetween: 16 },
      640: { slidesPerView: 3, spaceBetween: 20 },
      768: { slidesPerView: 5, spaceBetween: 20 },
      991: { slidesPerView: 6, spaceBetween: 20 },
      1280: { slidesPerView: 8, spaceBetween: 20 },
    },
  });

  new Swiper(".destSlider", {
    slidesPerView: 3,
    spaceBetween: 20,
    loop: true,
    speed: 2000,
    navigation: {
      nextEl: ".destSlider-next",
      prevEl: ".destSlider-prev",
    },
    breakpoints: {
      0: { slidesPerView: 1.15, spaceBetween: 14 },
      576: { slidesPerView: 1.6 },
      768: { slidesPerView: 2.2 },
      992: { slidesPerView: 3 },
    },
  });

  new Swiper(".homeSlider", {
    slidesPerView: 1,
    spaceBetween: 5,
    loop: true,
    autoplay: { delay: 2000, disableOnInteraction: false },
    speed: 3000,
    pagination: { el: ".swiper-pagination", clickable: true },
  });

  const imgSlider = new Swiper(".imgSlider", {
    slidesPerView: 1,
    speed: 2000,
    allowTouchMove: false,
    effect: "fade",
    fadeEffect: { crossFade: true },
  });

  const textSlider = new Swiper(".textSlider", {
    direction: "vertical",
    loop: true,
    autoplay: { delay: 1000, disableOnInteraction: false },
    slidesPerView: 1,
    speed: 1500,
  });

  const stepItems = document.querySelectorAll(".step-item");

  function goToStep(index) {
    imgSlider.slideTo(index);
    textSlider.slideTo(index);

    stepItems.forEach((item, i) => {
      item.classList.remove("active", "done");
      if (i < index) item.classList.add("done");
      if (i === index) item.classList.add("active");
    });
  }

  stepItems.forEach((item) => {
    item.addEventListener("click", () => {
      const step = parseInt(item.getAttribute("data-step"));
      goToStep(step);
    });
  });

  new Swiper(".tabingSlider", {
    loop: false,
    navigation: {
      nextEl: ".tabingSlider-next",
      prevEl: ".tabingSlider-prev",
    },
    breakpoints: {
      0: { slidesPerView: 1.2, spaceBetween: 10, speed: 1000 },
      520: { slidesPerView: 2, spaceBetween: 10, speed: 1000 },
      769: { slidesPerView: 4, spaceBetween: 20, speed: 1000 },
      991: { slidesPerView: 5, spaceBetween: 20, speed: 2000 },
      1100: { slidesPerView: 8, spaceBetween: 20, speed: 2000 },
    },
  });

  new Swiper(".concertSliderText", {
    loop: false,
    navigation: {
      nextEl: ".concertSliderText-next",
      prevEl: ".concertSliderText-prev",
    },
    breakpoints: {
      0: { slidesPerView: 1, speed: 1000 },
    },
  });

  // FIX: ye missing tha — team slider (about-secF) kaam nahi kar raha tha isi wajah se
  new Swiper(".fourSilder", {
    loop: true,
    navigation: {
      nextEl: ".fourSilder-next",
      prevEl: ".fourSilder-prev",
    },
    breakpoints: {
      0: { slidesPerView: 1.1, spaceBetween: 10 },
      640: { slidesPerView: 2.3, spaceBetween: 10 },
      991: { slidesPerView: 3, spaceBetween: 10 },
      1280: { slidesPerView: 4, spaceBetween: 15 },
    },
  });

  new Swiper(".thirdSilder", {
    navigation: {
      nextEl: ".thirdSilder-next",
      prevEl: ".thirdSilder-prev",
    },
    loop: true,
    speed: 1000,
    breakpoints: {
      0: { slidesPerView: 1.2, spaceBetween: 20 },
      640: { slidesPerView: 1.2, spaceBetween: 10 },
      768: { slidesPerView: 2.2, spaceBetween: 20 },
      991: { slidesPerView: 3, spaceBetween: 20 },
      1280: { slidesPerView: 4, spaceBetween: 20 },
    },
  });

  new Swiper(".reviewSlider", {
    loop: false,
    initialSlide: 1,
    pagination: {
      el: ".detail-secF .swiper-pagination",
      type: "progressbar",
    },
    navigation: {
      nextEl: ".review-next",
      prevEl: ".review-prev",
    },
    breakpoints: {
      0: { slidesPerView: 1.2, spaceBetween: 20 },
      640: { slidesPerView: 1.2, spaceBetween: 10 },
      768: { slidesPerView: 2.2, spaceBetween: 20 },
      991: { slidesPerView: 2, spaceBetween: 20, allowTouchMove: false },
      1280: { slidesPerView: 1.5, spaceBetween: 20, allowTouchMove: true },
    },
  });

 
  new Swiper(".twoSlider", {
    navigation: {
      nextEl: ".twoSlider-next",
      prevEl: ".twoSlider-prev",
    },
    speed: 1000,
    breakpoints: {
      0: { slidesPerView: 1.2, spaceBetween: 20 },
      640: { slidesPerView: 1.2, spaceBetween: 10 },
      1280: { slidesPerView: 2, spaceBetween: 20 },
    },
  });

  new Swiper(".centerSlider", {
    centeredSlides: true,
    centeredSlidesBounds: true,
    slidesOffsetAfter: 120,
    loop: true,
    navigation: {
      nextEl: ".centerSlider-next",
      prevEl: ".centerSlider-prev",
    },
    breakpoints: {
      0: { slidesPerView: 1.2, spaceBetween: 10, speed: 1000 },
      520: { slidesPerView: 1.2, spaceBetween: 10, speed: 1000 },
      769: { slidesPerView: 2.3, spaceBetween: 20, speed: 1000 },
      991: { slidesPerView: 2.3, spaceBetween: 60, speed: 1000 },
      1100: { slidesPerView: 2.3, spaceBetween: 60, speed: 1000 },
    },
  });

  new Swiper(".listSlider", {
    loop: true,
    effect: "fade",
    fadeEffect: { crossFade: true },
    autoplay: { delay: 4000, disableOnInteraction: false },
    speed: 1000,
    allowTouchMove: false,
  });

    new Swiper('.banner-swiper', {
        loop: true,
        speed: 700,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.banner-swiper .swiper-pagination',
            clickable: true,
        },
    });

  new Swiper(".TestimonialSlider2", {
    loop: true,
    navigation: {
      nextEl: ".testimonial2-next",
      prevEl: ".testimonial2-prev",
    },
    breakpoints: {
      0: { slidesPerView: 1, spaceBetween: 16 },
      768: { slidesPerView: 2, spaceBetween: 20 },
    },
  });

    new Swiper(".TestimonialSlider", {
    loop: true,
    navigation: {
      nextEl: ".testimonial-next",
      prevEl: ".testimonial-prev",
    },
    breakpoints: {
      0: { slidesPerView: 1, spaceBetween: 16 },
      768: { slidesPerView: 3, spaceBetween: 20 },
    },
  });

  // ============ NAV DROPDOWN PANELS (mega menu / search panel) ============
  document.querySelectorAll("[data-dropdown]").forEach((wrapper) => {
    const trigger = wrapper.querySelector("[data-dropdown-trigger]");
    const panel = wrapper.querySelector("[data-dropdown-panel]");
    if (!trigger || !panel) return;

    const EDGE_GAP = 16;

    const positionPanel = () => {
      panel.style.marginLeft = "0px";

      const panelRect = panel.getBoundingClientRect();
      const triggerRect = trigger.getBoundingClientRect();
      const viewportWidth = document.documentElement.clientWidth;

      let shift = 0;
      if (panelRect.right > viewportWidth - EDGE_GAP) {
        shift = viewportWidth - EDGE_GAP - panelRect.right;
      } else if (panelRect.left < EDGE_GAP) {
        shift = EDGE_GAP - panelRect.left;
      }
      panel.style.marginLeft = `${shift}px`;

      const newPanelRect = panel.getBoundingClientRect();
      const arrowLeft =
        triggerRect.left + triggerRect.width / 2 - newPanelRect.left;
      panel.style.setProperty("--dropdown-arrow", `${arrowLeft}px`);
    };

    const open = () => {
      trigger.classList.add("is-open");
      panel.classList.add("is-open");
      trigger.setAttribute("aria-expanded", "true");
      positionPanel();
    };

    const close = () => {
      trigger.classList.remove("is-open");
      panel.classList.remove("is-open");
      trigger.setAttribute("aria-expanded", "false");
    };

    trigger.addEventListener("click", (e) => {
      e.stopPropagation();
      const isOpen = panel.classList.contains("is-open");

      document
        .querySelectorAll("[data-dropdown-panel].is-open")
        .forEach((p) => {
          if (p !== panel) p.classList.remove("is-open");
        });
      document
        .querySelectorAll("[data-dropdown-trigger].is-open")
        .forEach((t) => {
          if (t !== trigger) t.classList.remove("is-open");
        });

      isOpen ? close() : open();
    });

    panel.addEventListener("click", (e) => e.stopPropagation());

    window.addEventListener("resize", () => {
      if (panel.classList.contains("is-open")) positionPanel();
    });
  });

  document.addEventListener("click", () => {
    document
      .querySelectorAll("[data-dropdown-panel].is-open")
      .forEach((p) => p.classList.remove("is-open"));
    document
      .querySelectorAll("[data-dropdown-trigger].is-open")
      .forEach((t) => t.classList.remove("is-open"));
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      document
        .querySelectorAll("[data-dropdown-panel].is-open")
        .forEach((p) => p.classList.remove("is-open"));
      document
        .querySelectorAll("[data-dropdown-trigger].is-open")
        .forEach((t) => t.classList.remove("is-open"));
    }
  });

  // ============ CHIP TOGGLES ============
  document.querySelectorAll(".chip-group:not([data-multi-select])").forEach((group) => {
    group.querySelectorAll(".chip").forEach((chip) => {
      chip.addEventListener("click", () => {
        group.querySelectorAll(".chip").forEach((c) => c.classList.remove("is-active"));
        chip.classList.add("is-active");
      });
    });
  });

  document.querySelectorAll("[data-multi-select]").forEach((group) => {
    group.querySelectorAll(".chip").forEach((chip) => {
      chip.addEventListener("click", () => chip.classList.toggle("is-active"));
    });
  });

  // ============ PRICE RANGE SLIDER ============
  document.querySelectorAll("[data-range-slider]").forEach((slider) => {
    const fill = slider.querySelector("[data-range-fill]");
    const minHandle = slider.querySelector('[data-range-handle="min"]');
    const maxHandle = slider.querySelector('[data-range-handle="max"]');
    const minTooltip = slider.querySelector('[data-range-tooltip="min"]');
    const maxTooltip = slider.querySelector('[data-range-tooltip="max"]');
    const panel = slider.closest(".search-panel");
    const minInput = panel.querySelector('[data-price="min"]');
    const maxInput = panel.querySelector('[data-price="max"]');

    const RANGE_MIN = 0;
    const RANGE_MAX = 500000;
    let minPct = 0;
    let maxPct = 100;

    const pctToVal = (pct) => Math.round(RANGE_MIN + (pct / 100) * (RANGE_MAX - RANGE_MIN));
    const formatShort = (val) => (val >= 100000 ? `${(val / 100000).toFixed(val % 100000 === 0 ? 0 : 1)}L` : val);

    const render = () => {
      minHandle.style.left = `${minPct}%`;
      maxHandle.style.left = `${maxPct}%`;
      fill.style.left = `${minPct}%`;
      fill.style.right = `${100 - maxPct}%`;
      const minVal = pctToVal(minPct);
      const maxVal = pctToVal(maxPct);
      minTooltip.textContent = formatShort(minVal);
      maxTooltip.textContent = formatShort(maxVal);
      minInput.value = minVal;
      maxInput.value = maxVal;
    };

    const dragHandle = (handle, isMin) => {
      handle.addEventListener("pointerdown", (e) => {
        e.preventDefault();
        const move = (moveEvent) => {
          const rect = slider.getBoundingClientRect();
          let pct = ((moveEvent.clientX - rect.left) / rect.width) * 100;
          pct = Math.max(0, Math.min(100, pct));

          if (isMin) {
            minPct = Math.min(pct, maxPct - 2);
          } else {
            maxPct = Math.max(pct, minPct + 2);
          }
          render();
        };
        const up = () => {
          document.removeEventListener("pointermove", move);
          document.removeEventListener("pointerup", up);
        };
        document.addEventListener("pointermove", move);
        document.addEventListener("pointerup", up);
      });
    };

    dragHandle(minHandle, true);
    dragHandle(maxHandle, false);

    minInput.addEventListener("change", () => {
      const val = Math.max(RANGE_MIN, Math.min(RANGE_MAX, Number(minInput.value) || 0));
      minPct = Math.min((val / RANGE_MAX) * 100, maxPct - 2);
      render();
    });
    maxInput.addEventListener("change", () => {
      const val = Math.max(RANGE_MIN, Math.min(RANGE_MAX, Number(maxInput.value) || 0));
      maxPct = Math.max((val / RANGE_MAX) * 100, minPct + 2);
      render();
    });

    render();
  });

  // ============ DESTINATION AUTOCOMPLETE ============
  const DESTINATIONS = [
    "Ladakh", "Kashmir", "Manali", "Kerala", "Goa", "Rajasthan", "Himachal",
    "Uttarakhand", "Sikkim", "Meghalaya", "Andaman", "Dubai", "Bali",
    "Thailand", "Singapore", "Maldives", "Vietnam", "Europe", "Switzerland",
    "Mauritius", "Malaysia", "Australia", "Japan",
  ];

  document.querySelectorAll("[data-destination-wrap]").forEach((wrap) => {
    const input = wrap.querySelector("[data-destination-input]");
    const list = wrap.parentElement.querySelector("[data-destination-list]");
    if (!input || !list) return;

    const renderList = (items) => {
      list.innerHTML = items
        .map((name) => `<button type="button" data-value="${name}">${name}</button>`)
        .join("");
      list.classList.toggle("is-open", items.length > 0);
    };

    input.addEventListener("input", () => {
      const q = input.value.trim().toLowerCase();
      const matches = q ? DESTINATIONS.filter((d) => d.toLowerCase().includes(q)) : [];
      renderList(matches);
    });

    input.addEventListener("focus", () => {
      if (input.value.trim()) input.dispatchEvent(new Event("input"));
    });

    list.addEventListener("click", (e) => {
      const btn = e.target.closest("button[data-value]");
      if (!btn) return;
      input.value = btn.dataset.value;
      list.classList.remove("is-open");
    });

    document.addEventListener("click", (e) => {
      if (!wrap.parentElement.contains(e.target)) list.classList.remove("is-open");
    });
  });

  // ============ TRAVELERS STEPPER ============
  document.querySelectorAll("[data-travelers-wrap]").forEach((wrap) => {
    const trigger = wrap.querySelector("[data-travelers-trigger]");
    const popover = wrap.querySelector("[data-travelers-popover]");
    const label = wrap.querySelector("[data-travelers-label]");
    const doneBtn = wrap.querySelector("[data-travelers-done]");
    const counts = { adults: 2, children: 0 };

    const updateLabel = () => {
      const parts = [`${counts.adults} Adult${counts.adults !== 1 ? "s" : ""}`];
      if (counts.children > 0) {
        parts.push(`${counts.children} Child${counts.children !== 1 ? "ren" : ""}`);
      }
      label.textContent = parts.join(", ");
    };

    trigger.addEventListener("click", (e) => {
      e.stopPropagation();
      popover.classList.toggle("is-open");
    });

    wrap.querySelectorAll("[data-step]").forEach((btn) => {
      btn.addEventListener("click", () => {
        const key = btn.dataset.step;
        const dir = Number(btn.dataset.dir);
        const min = key === "adults" ? 1 : 0;
        counts[key] = Math.max(min, Math.min(9, counts[key] + dir));
        wrap.querySelector(`[data-count="${key}"]`).textContent = counts[key];
      });
    });

    doneBtn.addEventListener("click", () => {
      updateLabel();
      popover.classList.remove("is-open");
    });

    document.addEventListener("click", (e) => {
      if (!wrap.contains(e.target)) popover.classList.remove("is-open");
    });

    updateLabel();
  });

  // ============ CLEAR ALL (search panel) ============
  document.querySelectorAll("[data-clear-all]").forEach((btn) => {
    btn.addEventListener("click", () => {
      const panel = btn.closest(".search-panel");
      panel.querySelectorAll(".chip").forEach((c) => c.classList.remove("is-active"));
      panel.querySelectorAll('input[type="checkbox"]').forEach((cb) => (cb.checked = false));
      panel.querySelectorAll(".panel-search-input input, [data-search-input]").forEach((i) => (i.value = ""));
      panel.querySelectorAll("[data-travel-date]").forEach((i) => (i.value = ""));

      const slider = panel.querySelector("[data-range-slider]");
      if (slider) {
        slider.querySelector('[data-range-handle="min"]').style.left = "0%";
        slider.querySelector('[data-range-handle="max"]').style.left = "100%";
        panel.querySelector('[data-price="min"]').value = 0;
        panel.querySelector('[data-price="max"]').value = 500000;
        panel.querySelector('[data-range-tooltip="min"]').textContent = "0";
        panel.querySelector('[data-range-tooltip="max"]').textContent = "5L";
        panel.querySelector("[data-range-fill]").style.left = "0%";
        panel.querySelector("[data-range-fill]").style.right = "0%";
      }
    });
  });

  // ============ GENERIC MODAL OPEN/CLOSE ============
  document.querySelectorAll("[data-model]").forEach((trigger) => {
    trigger.addEventListener("click", (e) => {
      e.preventDefault();
      const selector = trigger.getAttribute("data-model");
      const modal = document.querySelector(selector);
      if (modal) modal.classList.add("is-open");
    });
  });

  document.querySelectorAll(".model .close").forEach((closeBtn) => {
    closeBtn.addEventListener("click", () => {
      closeBtn.closest(".model")?.classList.remove("is-open");
    });
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      document.querySelectorAll(".model.is-open").forEach((m) => m.classList.remove("is-open"));
    }
  });

  // ============ DATE PICKERS ============

  // Search panel date field (name="daterange")
  const $daterangeInput = $('input[name="daterange"]');
  if ($daterangeInput.length) {
    $daterangeInput.daterangepicker({
      singleDatePicker: true,
      autoApply: true,
      autoUpdateInput: false,
      minDate: moment().add(1, "days"),
      opens: "left",
      locale: { format: "DD/MM/YYYY" },
    });

    $daterangeInput.on("apply.daterangepicker", function (ev, picker) {
      $(this)
        .val(picker.startDate.format("DD/MM/YYYY"))
        .addClass("has-value")
        .closest(".form-group")
        .addClass("active");
    });

    $daterangeInput.on("cancel.daterangepicker", function () {
      $(this).val("").removeClass("has-value").closest(".form-group").removeClass("active");
    });

    $daterangeInput.each(function () {
      if ($(this).val().trim() !== "") {
        $(this).addClass("has-value").closest(".form-group").addClass("active");
      }
    });
  }

  // Enquiry popup date field (name="dates")
  const $datesInput = $('input[name="dates"]');
  if ($datesInput.length) {
    $datesInput.daterangepicker({
      singleDatePicker: true,
      autoUpdateInput: false,
      autoApply: true,
      minDate: moment(),
      locale: { format: "MM/DD/YYYY" },
    });

    // Force empty on init — plugin startup par internal startDate set kar deta hai
    $datesInput.val("");

    $datesInput.on("apply.daterangepicker", function (ev, picker) {
      $(this).val(picker.startDate.format("MM/DD/YYYY"));
    });

    $datesInput.on("cancel.daterangepicker", function () {
      $(this).val("");
    });
  }

  // ============ LOGIN MODAL: Continue -> OTP screen ============
  const loginPop = document.querySelector(".login-pop");
  if (loginPop) {
    const loginWrap = loginPop.querySelector(".login-wrap");
    const otpField = loginPop.querySelector(".otp-field");
    const continueBtn = loginPop.querySelector(".Continue");
    const backBtn = loginPop.querySelector(".bk_btn");

    const showOtp = () => {
      loginWrap.style.display = "none";
      otpField.style.display = "flex";
      otpField.querySelector("input")?.focus();
    };

    const showLogin = () => {
      loginWrap.style.display = "flex";
      otpField.style.display = "none";
    };

    continueBtn?.addEventListener("click", () => {
      const mobileInput = loginPop.querySelector("#txtLogInMobileNo");
      if (!mobileInput || !mobileInput.value.trim()) {
        mobileInput?.focus();
        return;
      }
      // TODO: yaha actual "send OTP" API call lagana
      showOtp();
    });

    backBtn?.addEventListener("click", showLogin);
  }

  // ============ OTP INPUTS: auto-advance, numeric-only, backspace, paste ============
  document.querySelectorAll(".otpInput").forEach((otpGroup) => {
    const inputs = Array.from(otpGroup.querySelectorAll("input"));

    inputs.forEach((input, i) => {
      input.addEventListener("input", () => {
        input.value = input.value.replace(/\D/g, "").slice(0, 1);
        if (input.value && inputs[i + 1]) inputs[i + 1].focus();
      });

      input.addEventListener("keydown", (e) => {
        if (e.key === "Backspace" && !input.value && inputs[i - 1]) {
          inputs[i - 1].focus();
        }
      });
    });

    otpGroup.addEventListener("paste", (e) => {
      e.preventDefault();
      const pasted = (e.clipboardData || window.clipboardData).getData("text").replace(/\D/g, "");

      inputs.forEach((input, i) => {
        input.value = pasted[i] || "";
      });

      const lastFilled = Math.min(pasted.length, inputs.length) - 1;
      if (lastFilled >= 0) inputs[lastFilled].focus();
    });
  });

  // ============ RESEND OTP ============
  document.querySelectorAll(".otp-field .alert a").forEach((resendLink) => {
    resendLink.addEventListener("click", (e) => {
      e.preventDefault();
      // TODO: yaha actual "resend OTP" API call lagana
      console.log("Resend OTP requested");
    });
  });

  // ============ FANCYBOX ============
  Fancybox.bind("[data-fancybox]", {
    autoStart: false,
    contentClick: "iterateZoom",
    Images: {
      Panzoom: { maxScale: 3 },
    },
    keyboard: true,
    Thumbs: true,
    Toolbar: {
      display: {
        left: ["infobar"],
        middle: ["toggle1to1", "rotateCCW", "rotateCW"],
        right: ["close"],
        bottom: [],
      },
    },
  });

}); // end main $(function)



 document.addEventListener('DOMContentLoaded', function () {
  var openBtn  = document.querySelector('[data-ham-open]');
  var hamPop   = document.querySelector('[data-ham-pop]');
  if (!hamPop) return;

  var closeBtn   = hamPop.querySelector('[data-ham-close]');
  var nav        = hamPop.querySelector('[data-mob-nav]');
  var mainPanel  = nav.querySelector('[data-panel-main]');
  var subPanels  = nav.querySelectorAll('.nav-panel-sub');
  var detailPanel = nav.querySelector('[data-panel-detail]');
  var detailTitle = detailPanel.querySelector('[data-detail-title]');
  var detailList  = detailPanel.querySelector('[data-detail-list]');
  var detailBack  = detailPanel.querySelector('[data-detail-back]');

  function resetMobNav() {
    subPanels.forEach(function (p) { p.classList.remove('is-active'); });
    mainPanel.classList.remove('is-left');
    detailPanel.classList.remove('is-active');
    detailList.innerHTML = '';
  }

  function openMenu() {
    hamPop.classList.add('is-open');
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    hamPop.classList.remove('is-open');
    document.body.style.overflow = '';
    setTimeout(resetMobNav, 400);
  }

  if (openBtn)  openBtn.addEventListener('click', openMenu);
  if (closeBtn) closeBtn.addEventListener('click', closeMenu);

  // ---- Level 1 -> Level 2 ----
  nav.querySelectorAll('.nav-list-main > li[data-target]').forEach(function (li) {
    var trigger = li.querySelector('.nav-main-link');
    trigger.addEventListener('click', function () {
      var target = li.getAttribute('data-target');
      var panel = nav.querySelector('.nav-panel-sub[data-panel="' + target + '"]');
      if (!panel) return;

      mainPanel.classList.add('is-left');
      subPanels.forEach(function (p) { p.classList.remove('is-active'); });
      panel.classList.add('is-active');
    });
  });

  // ---- Level 2 -> back to Level 1 ----
  nav.querySelectorAll('.nav-panel-sub > [data-back]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      mainPanel.classList.remove('is-left');
      btn.closest('.nav-panel-sub').classList.remove('is-active');
    });
  });

  // ---- Level 2 -> Level 3 (accordion-trigger click) ----
  nav.querySelectorAll('.accordion-trigger').forEach(function (trigger) {
    trigger.addEventListener('click', function () {
      var item   = trigger.closest('.accordion-item');
      var source = item.querySelector('.accordion-source');
      if (!source) return;

      detailTitle.textContent = trigger.childNodes[0].textContent.trim();
      detailList.innerHTML = source.innerHTML;
      detailPanel.classList.add('is-active');
    });
  });

  // ---- Level 3 -> back to Level 2 ----
  detailBack.addEventListener('click', function () {
    detailPanel.classList.remove('is-active');
  });
});