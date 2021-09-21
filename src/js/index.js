import Scrollbar from "smooth-scrollbar";
import OverscrollPlugin from "smooth-scrollbar/plugins/overscroll";
import { gsap } from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
import Plyr from "plyr";
import barba from "@barba/core";

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

const projects = document.querySelectorAll(".project");
const projectImgs = document.querySelectorAll(".project__image-container img");

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
  gsap.set(menuItems, { translateX: 50, autoAlpha: 0 });

  const menuTl = gsap
    .timeline({
      reversed: true,
      defaults: { duration: 1, ease: "Expo.power2" },
    })
    .to(menu, { duration: 0.5, right: 0 })
    .to(menuBarTop, { duration: 0.5, translateY: 3, rotate: "135deg" }, 0)
    .to(menuBarBottom, { duration: 0.5, translateY: -3, rotate: "-135deg" }, 0)
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

const toggleTheme = (mode) => {
  const el = document.documentElement.classList;
  console.log(mode);
  mode === "dark" ? el.add(`dark-mode`) : el.remove(`dark-mode`);
  navLinkTheme.textContent = `Lights ${mode === "light" ? "Out" : "On"}`;
  localStorage.setItem("darkMode", `${mode === "light" ? null : true}`);
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
const imgParallaxEffect = () => {
  const projectImgContainersRegular = document.querySelectorAll(
    ".project__image-container--regular"
  );
  const projectImgContainersFeatured = document.querySelectorAll(
    ".project__image-container--featured"
  );

  [...projectImgContainersRegular, ...projectImgContainersFeatured].forEach(
    (container) => {
      const img = container.querySelector(".project__image");

      const tl = gsap
        .timeline()
        .set(img, { scale: 1.5 })
        .to(img, {
          yPercent: 25,
          scrollTrigger: {
            trigger: container,
            start: "top bottom",
            end: "bottom top",
            scrub: true,
          },
        });
    }
  );
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
    // settings: ["quality", "duration"],
  });
};

// ? Page transitions
const transitionIn = ({ container }) => {
  return gsap
    .timeline({
      defaults: { duration: 1, ease: "power4.out" },
    })
    .to(loaderTransition, { top: 0 })
    .to(container, { y: -50, autoAlpha: 0 }, 0.125);
};

const transitionOut = ({ container }) => {
  return gsap
    .timeline()
    .to(loaderTransition, { top: "-100%" })
    .set(loaderTransition, { top: "100%" })
    .from(container, { y: 50, autoAlpha: 0 });
};

const killEvents = () => {
  // Kill scrollbar and scrolltriggers
  ScrollTrigger.getAll().forEach((trigger) => trigger.kill());
  scrollBar && scrollBar.destroy(scrollBar);
  plyr && plyr.destroy();
};

const scrollToTop = () => {
  scrollBar && scrollBar.scrollTo(0, 0);
  window.scrollTo(0, 0);
};

const refreshEvents = () => {
  scrollBar && scrollBar.update();
  ScrollTrigger.refresh(true);
};

const addEvents = () => {
  // Reinitialise scrollbar and scrolltriggers
  initSmoothScroll();
  imgParallaxEffect();
  imgFluidScaleEffect();
  projectPopUpEffect();
  animLinks();
  initShowreel();
};

const initPageTransitions = () => {
  // Barba transitions
  barba.init({
    timeout: 5000,
    preventRunning: true,
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

    requestError(trigger, action, url, response) {
      // go to a custom 404 page if the user click on a link that return a 404 response status
      if (action === "click" && response.status && response.status === 404) {
        console.log("404");

        barba.go("../404.html");
      }

      // prevent Barba from redirecting the user to the requested URL
      // this is equivalent to e.preventDefault() in this context
      return false;
    },
  });

  // Global barba hooks

  barba.hooks.beforeLeave(() => {
    htmlEl.classList.add("is-transitioning");
  });

  barba.hooks.beforeEnter(() => {
    return new Promise(function (resolve) {
      killEvents();
      resolve();
    });
  });

  barba.hooks.enter(({ current }) => {
    return new Promise(function (resolve) {
      current.container.remove();
      resolve();
    });
  });

  barba.hooks.afterEnter(() => {
    return new Promise(function (resolve) {
      htmlEl.classList.remove("is-transitioning");
      addEvents();
      scrollToTop();
      refreshEvents();
      resolve();
    });
  });
};

// ? Init
function init() {
  setTheme();
  initSmoothScroll();
  initPageTransitions();
  animMenu();
  themeToggle();
  imgHoverEffect();
}

document.addEventListener("DOMContentLoaded", init);
