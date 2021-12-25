import Scrollbar from "smooth-scrollbar";
import OverscrollPlugin from "smooth-scrollbar/plugins/overscroll";
import { gsap } from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
import Plyr from "plyr";
import barba from "@barba/core";
import splitbee from "@splitbee/web";

// ? Register plugins
gsap.registerPlugin(ScrollTrigger);
Scrollbar.use(OverscrollPlugin);

// ? DOM Nodes
const htmlEl = document.querySelector("html");
const body = document.body;
const overlayBody = document.querySelector(".overlay--body");
const loader = document.querySelector(".loader");
const loaderTransition = document.querySelector(".loader__transition");
const menu = document.querySelector(".menu");
const menuIcon = document.querySelector(".nav__menu");
const menuBarTop = document.querySelector(".nav__menu-bar--1");
const menuBarBottom = document.querySelector(".nav__menu-bar--2");
const navLinkBlessed = document.querySelector(".nav__link--blessed");
const navLinkContact = document.querySelector(".nav__link--contact");
const navItemTheme = document.querySelector(".nav__item--theme");
const navLinkTheme = document.querySelector(".nav__link--theme");
const menuItems = document.querySelectorAll(".menu__item");
const menuLinks = document.querySelectorAll(".menu__link");

// ? Helper functions
const isMobile = () => matchMedia("(hover: none), (pointer: coarse)").matches;

// ? Smooth scroll setup
let scrollBar;

const initSmoothScroll = () => {
  if (isMobile()) return;

  const viewportEl = document.querySelector("#viewport");
  viewportEl.classList.add("not-touch");

  // * Init scrollbar
  scrollBar = Scrollbar.init(viewportEl, {
    damping: 0.075,

    plugins: {
      overscroll: {
        effect: "bounce",
        damping: 0.15,
        maxOverscroll: 100,
      },
    },
  });

  // * Scroll to top
  scrollBar.scrollTo(0, 0);

  // * Scrollbar tracks customisation
  scrollBar.track.xAxis.element.remove();

  // * Link scrollTrigger to scrollBar
  ScrollTrigger.scrollerProxy(document.body, {
    scrollTop(value) {
      if (arguments.length) {
        scrollBar.scrollTop = value;
      }

      return scrollBar.scrollTop;
    },
  });

  // * Update scrollTrigger when scrollBar updates
  scrollBar.addListener(ScrollTrigger.update);

  // Customise scrollbar
  document.querySelector(".scrollbar-track").classList.add("is-custom");
  document.querySelector(".scrollbar-thumb").classList.add("is-custom");
};

// ? Menu open and close animations
const animMenu = () => {
  gsap.set(menuItems, { x: 50, autoAlpha: 0 });

  const menuTl = gsap
    .timeline({
      reversed: true,
      defaults: { duration: 1, ease: "circ" },
    })
    .to(menu, { duration: 0.5, x: 0 })
    .to(menuBarTop, { duration: 0.5, y: 3, rotate: 135 }, 0)
    .to(menuBarBottom, { duration: 0.5, y: -3, rotate: -135 }, 0)
    .to(navLinkContact, { duration: 0.25, autoAlpha: 0 }, 0)
    .to(
      menuItems,
      {
        x: 0,
        duration: 0.25,
        autoAlpha: 1,
        stagger: 0.1,
      },
      0.25
    );

  menuIcon.addEventListener("click", (e) => {
    e.preventDefault();

    menuTl.reversed(!menuTl.reversed());
    body.classList.toggle("menu-open");
    navItemTheme.classList.toggle("u-hidden");
    overlayBody.classList.toggle("u-hidden");
  });

  overlayBody.addEventListener("click", () => {
    menuTl.reversed(!menuTl.reversed());
    body.classList.toggle("menu-open");
    navItemTheme.classList.toggle("u-hidden");
    overlayBody.classList.toggle("u-hidden");
  });

  [...menuLinks, navLinkBlessed].forEach((link) => {
    link.addEventListener("click", (e) => {
      if (!overlayBody.classList.contains("u-hidden")) {
        menuTl.reversed(!menuTl.reversed());
        body.classList.toggle("menu-open");
        navItemTheme.classList.toggle("u-hidden");
        overlayBody.classList.toggle("u-hidden");
      }
    });
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !overlayBody.classList.contains("u-hidden")) {
      menuTl.reversed(!menuTl.reversed());
      body.classList.toggle("menu-open");
      navLinkBlessed.classList.toggle("menu-open");
      navItemTheme.classList.toggle("u-hidden");
      overlayBody.classList.add("u-hidden");
    }
  });
};

// ? Theme switcher functionality
let darkMode = JSON.parse(localStorage.getItem("darkMode"));

const lightsOn = () => {
  document.documentElement.classList.remove("dark-mode");
  navLinkTheme.textContent = "Lights Out";
  localStorage.setItem("darkMode", null);
};

const lightsOut = () => {
  document.documentElement.classList.add("dark-mode");
  navLinkTheme.textContent = "Lights On";
  localStorage.setItem("darkMode", true);
};

const themeToggle = () => {
  navLinkTheme.addEventListener("click", (e) => {
    e.preventDefault();

    darkMode = JSON.parse(localStorage.getItem("darkMode"));
    darkMode === null ? lightsOut() : lightsOn();
    // darkMode === null ? toggleTheme("dark") : toggleTheme("dark");
  });
};

const setTheme = () => {
  darkMode === null ? lightsOn() : lightsOut();
  // darkMode === null ? toggleTheme("dark") : toggleTheme("light");
};

// ? Link hover animations
const animLinks = () => {
  const linksPlain = document.querySelectorAll(".link.link--plain");
  const linksUnderlined = document.querySelectorAll(".link.link--underline");

  [...linksPlain].forEach((link) => {
    link.addEventListener("mouseleave", () => {
      link.classList.add("link--plain--anim");
    });

    link.addEventListener("transitionend", () => {
      link.classList.remove("link--plain--anim");
    });
  });

  [...linksUnderlined].forEach((link) => {
    link.addEventListener("mouseleave", () => {
      link.classList.add("link--underline--anim");
    });

    link.addEventListener("transitionend", () => {
      link.classList.remove("link--underline--anim");
    });
  });
};

// ? Parallax image scrolling effect
const createParallaxEffect = (el, container, yPercent) => {
  return gsap.to(el, {
    yPercent,
    ease: "none",
    scrollTrigger: {
      trigger: container,
      start: "top bottom",
      end: "bottom top",
      scrub: true,
    },
  });
};

const imgParallaxEffect = () => {
  const imgContainersParallax = document.querySelectorAll(
    ".project__image-container"
  );

  [...imgContainersParallax].forEach((container) => {
    const img = container.querySelector(".project__image");
    createParallaxEffect(img, container, 20);
  });
};

// ? Fluid image scale on scroll effect
const imgFluidScaleEffect = () => {
  const projectImgContainersFluid = document.querySelectorAll(
    ".project__image-container--fluid"
  );

  [...projectImgContainersFluid].forEach((container) => {
    const imgFluid = container.querySelector(".project__image--fluid");

    gsap.to(imgFluid, {
      scale: 1.25,
      scrollTrigger: {
        trigger: container,
        start: "top bottom",
        end: "top top",
        scrub: 1,
      },
    });
  });
};

// ? Image hover move effect
const imgHoverEffect = () => {};

// ? Project grow on scroll effect
const projectPopUpEffect = () => {
  const projectsRegular = document.querySelectorAll(".project--regular");

  [...projectsRegular].forEach((project) => {
    gsap.to(project, {
      scrollTrigger: {
        trigger: project,
        start: "top bottom-=20%",
        end: "bottom top",
        toggleClass: "anim-in",
        // toggleActions: "play pause pause reset",
      },
    });
  });
};

// ? Initialise video player
let plyr;

const initShowreel = () => {
  plyr = new Plyr("#player", {
    title: "Portfolio Showreel",
    controls: ["play-large", "play", "fullscreen", "settings"],
  });
};

// ? Initialise analytics
const initAnalytics = () => {
  splitbee.init();
  splitbee.track("Contact Form Submission");
};

// ? Page transitions
const transitionIn = ({ container }) => {
  return gsap
    .timeline({
      defaults: { duration: 1, ease: "power4.out" },
    })
    .to(loaderTransition, { yPercent: -100 })
    .to(container, { y: -50, autoAlpha: 0 }, 0.125);
};

const transitionOut = ({ container }) => {
  return gsap
    .timeline()
    .to(loaderTransition, { yPercent: -200 })
    .set(loaderTransition, { yPercent: 0 })
    .from(container, { y: 50, autoAlpha: 0 });
};

const killEvents = () => {
  // Kill scrollbar, scrolltriggers and analytics
  ScrollTrigger.getAll().forEach((trigger) => trigger.kill());
  scrollBar?.destroy(scrollBar);
  plyr?.destroy();
};

const addEvents = () => {
  // Reinitialise scrollbar, scrolltriggers and analytics
  initSmoothScroll();
  imgParallaxEffect();
  imgFluidScaleEffect();
  initAnalytics();
  projectPopUpEffect();
  animLinks();
  initShowreel();
};

const refreshEvents = () => {
  scrollBar?.update();
  ScrollTrigger.refresh(true);
};

const initPageTransitions = () => {
  // Barba transitions
  barba.init({
    preventRunning: true,
    timeout: 5000,
    transitions: [
      {
        name: "page-transition",
        once() {
          // addEvents();
        },
        async leave({ current }) {
          await transitionIn(current);
        },
        enter({ next }) {
          transitionOut(next);
        },
      },
    ],
  });

  // Global barba hooks
  barba.hooks.beforeEnter(() => {
    killEvents();
    window.scrollTo(0, 0);
  });

  barba.hooks.afterEnter(() => {
    addEvents();
    refreshEvents();
  });
};

// ? Init
function init() {
  setTheme();
  initSmoothScroll();
  initPageTransitions();
  initAnalytics();
  animMenu();
  themeToggle();
  imgHoverEffect();
}

document.addEventListener("DOMContentLoaded", init);
