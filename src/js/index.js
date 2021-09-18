import Scrollbar from "smooth-scrollbar";
import OverscrollPlugin from "smooth-scrollbar/plugins/overscroll";
import { gsap } from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
import Plyr from "plyr";
import barba from "@barba/core";
import gsapCore from "gsap/gsap-core";

// ? Register plugins
gsap.registerPlugin(ScrollTrigger);
Scrollbar.use(OverscrollPlugin);

// ? DOM Nodes
const htmlEl = document.querySelector("html");
const body = document.body;
const viewportEl = document.querySelector("#viewport");
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

const linksPlain = document.querySelectorAll(".link.link--plain");
const linksUnderlined = document.querySelectorAll(".link.link--underline");

const featuredProjects = document.querySelectorAll(".project--featured");
const overlayFeatured = document.querySelector(".overlay--featured");
const sectionFeatured = document.querySelector(".featured-work");

const aboutProcessImgs = document.querySelectorAll(".about__process-img");

const projects = document.querySelectorAll(".project");
const projectsRegular = document.querySelectorAll(".project--regular");

const projectImgContainers = document.querySelectorAll(
  ".project__image-container"
);
const projectImgContainersRegular = document.querySelectorAll(
  ".project__image-container--regular"
);
const projectImgContainersFeatured = document.querySelectorAll(
  ".project__image-container--featured"
);
const projectImgContainersFluid = document.querySelectorAll(
  ".project__image-container--fluid"
);
const projectImgs = document.querySelectorAll(".project__image-container img");

// ? Smooth scroll setup
let scrollBar;

const initSmoothScroll = () => {
  const touch = matchMedia("(hover: none), (pointer: coarse)").matches;

  if (touch) return;

  viewportEl.classList.add("not-touch");

  // * Init scrollbar
  scrollBar = Scrollbar.init(document.querySelector("#viewport"), {
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
    navLinkBlessed.classList.toggle("menu-open");
    navItemTheme.classList.toggle("u-hidden");
    overlayBody.classList.toggle("u-hidden");
  });

  overlayBody.addEventListener("click", () => {
    menuTl.reversed(!menuTl.reversed());
    body.classList.toggle("menu-open");
    navLinkBlessed.classList.toggle("menu-open");
    navItemTheme.classList.toggle("u-hidden");
    overlayBody.classList.toggle("u-hidden");
  });

  menuLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      menuTl.reversed(!menuTl.reversed());
      body.classList.toggle("menu-open");
      navLinkBlessed.classList.toggle("menu-open");
      navItemTheme.classList.toggle("u-hidden");
      overlayBody.classList.toggle("u-hidden");
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
  overlayBody.classList.remove("dark-mode");

  [...aboutProcessImgs].forEach((img) => {
    img.classList.remove("dark-mode");
  });

  localStorage.setItem("darkMode", null);
};

const lightsOut = () => {
  document.documentElement.classList.add("dark-mode");
  overlayBody.classList.add("dark-mode");
  navLinkTheme.textContent = "Lights On";

  [...aboutProcessImgs].forEach((img) => {
    img.classList.add("dark-mode");
  });

  localStorage.setItem("darkMode", true);
};

const toggleTheme = (mode = "light-mode") => {
  if (mode === "dark-mode") {
  }
};

const themeToggle = () => {
  navLinkTheme.addEventListener("click", (e) => {
    e.preventDefault();

    darkMode = JSON.parse(localStorage.getItem("darkMode"));
    darkMode === null ? lightsOut() : lightsOn();
  });
};

const setTheme = () => {
  darkMode === null ? lightsOn() : lightsOut();
};

// ? Link hover animations
const animLinks = () => {
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
  [...projectImgContainersRegular, ...projectImgContainersFeatured].forEach(
    (container) => {
      const img = container.querySelector(".project__image");

      gsap.set(img, { scale: 1.5 });

      gsap.to(img, {
        yPercent: 25,
        scrollTrigger: {
          trigger: container,
          start: "top bottom",
          end: "bottom top",
          scrub: true,
          // markers: true,
        },
      });
    }
  );
};

// ? Fluid image scale on scroll effect
const imgFluidScaleEffect = () => {
  [...projectImgContainersFluid].forEach((container) => {
    const imgFluid = container.querySelector(".project__image--fluid");

    gsap.to(imgFluid, {
      scale: 1.25,
      scrollTrigger: {
        trigger: container,
        start: "top bottom",
        end: "top top",
        scrub: 1,
        // markers: true,
      },
    });
  });
};

// ? Image hover move effect
const imgHoverEffect = () => {};

// ? Project grow on scroll effect
const projectPopUpEffect = () => {
  [...projectsRegular].forEach((project) => {
    gsap.to(project, {
      scrollTrigger: {
        trigger: project,
        start: "top bottom-=20%",
        end: "bottom top",
        toggleClass: "anim-in",
        // toggleActions: "play pause pause reset",
        markers: true,
      },
    });
  });
};

// ? Initialise video player
const initShowreel = () => {
  const plyr = new Plyr("#player", {
    title: "Portfolio Showreel",
    controls: ["play-large", "fullscreen"],
  });
};

// ? Page transitions
const transitionIn = (data) => {
  return gsap
    .timeline({
      defaults: { duration: 1, ease: "power4.out" },
    })
    .to(loaderTransition, { top: 0 });
};

const transitionOut = (data) => {
  return gsap
    .timeline()
    .to(loaderTransition, { top: "-100%" })
    .set(loaderTransition, { top: "100%" })
    .from(data.next.container, { y: 50, autoAlpha: 0 });
};

const killEvents = () => {
  // Kill scrollbar and scrolltriggers
  scrollBar.destroy(scrollBar);
  [...ScrollTrigger.getAll()].forEach((trigger) => trigger.kill());
};

const addEvents = () => {
  // Reinitialise scrollbar and scrolltriggers
  initSmoothScroll();
  initShowreel();
  imgParallaxEffect();
  imgFluidScaleEffect();
  projectPopUpEffect();
};

const initPageTransition = () => {
  barba.init({
    transitions: [
      {
        name: "page-transition",
        once() {
          addEvents();
        },
        async leave(data) {
          await transitionIn(data);
        },
        enter(data) {
          transitionOut(data);
        },
      },
    ],
  });
};

// ? Barba hooks
barba.hooks.beforeLeave(() => {
  htmlEl.classList.add("is-transitioning");
  killEvents();
});

barba.hooks.after(() => {
  htmlEl.classList.remove("is-transitioning");
  addEvents();
  scrollBar.scrollTo(0, 0);
  window.scrollTo(0, 0);

  scrollBar.update();
  ScrollTrigger.refresh(true);
});

// ? Init
const init = () => {
  // initSmoothScroll();
  // initShowreel();
  initPageTransition();
  animMenu();
  animLinks();
  setTheme();
  themeToggle();
  // imgParallaxEffect();
  imgHoverEffect();
  // imgFluidScaleEffect();
  // projectPopUpEffect();
};

// ? Call functions on page transition
// barba.hooks.beforeEnter((data) => {
//   init();
// });

window.addEventListener("DOMContentLoaded", init);
