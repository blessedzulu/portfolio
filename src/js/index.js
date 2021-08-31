import Scrollbar from "smooth-scrollbar";
import OverscrollPlugin from "smooth-scrollbar/plugins/overscroll";
import { gsap } from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

// ? Register plugins
gsap.registerPlugin(ScrollTrigger);
Scrollbar.use(OverscrollPlugin);

// ? DOM Nodes
const body = document.body;
const viewportEl = document.querySelector("#viewport");
const overlayBody = document.querySelector(".overlay--body");
const menu = document.querySelector(".menu");
const menuIcon = document.querySelector(".nav__menu-icon");
const menuBarTop = document.querySelector(".nav__menu-bar--1");
const menuBarBottom = document.querySelector(".nav__menu-bar--2");
const navLinkBlessed = document.querySelector(".nav__link--blessed");
const navLinkContact = document.querySelector(".nav__link--contact");
const navItemTheme = document.querySelector(".nav__item--theme");
const navLinkTheme = document.querySelector(".nav__link--theme");
// const menuList = document.querySelector(".menu__list");
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
const initSmoothScroll = () => {
  const touch = matchMedia("(hover: none), (pointer: coarse)").matches;

  if (touch) return;

  viewportEl.classList.add("not-touch");

  // * Init scrollbar
  const scrollBar = Scrollbar.init(document.querySelector("#viewport"), {
    damping: 0.1,

    plugins: {
      overscroll: {
        effect: "bounce",
        damping: 0.15,
        maxOverscroll: 150,
      },
    },
  });

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
    // .to(navLinkTheme, { duration: 0.25, autoAlpha: 1 }, 0)
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

  menuIcon.addEventListener("click", () => {
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

const themeToggle = () => {
  navLinkTheme.addEventListener("click", (e) => {
    e.preventDefault();

    darkMode = JSON.parse(localStorage.getItem("darkMode"));
    darkMode == null ? lightsOut() : lightsOn();
  });
};

const setTheme = () => {
  darkMode == null ? lightsOn() : lightsOut();
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

// ? Featured project background animation
const animFeaturedBg = () => {
  // gsap.to(overlayFeatured, {
  //   scrollTrigger: {
  //     trigger: sectionFeatured,
  //     start: "top top",
  //     end: "bottom top",
  //     markers: true,
  //     scrub: true,
  //     toggleClass: "u-hidden",
  //   },
  // });
  // [...featuredProjects].forEach((project) => {
  //   gsap.to(overlayFeatured, {
  //     backgroundColor: project.dataset.projectBg,
  //     duration: 0.5,
  //     autoAlpha: 1,
  //     scrollTrigger: {
  //       trigger: project,
  //       start: "center center",
  //       end: "bottom center",
  //       markers: true,
  //     },
  //   });
  // });
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
        scrub: true,
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
        // markers: true,
      },
    });
  });
};

// ? Init
const init = () => {
  initSmoothScroll();
  animMenu();
  animLinks();
  animFeaturedBg();
  setTheme();
  themeToggle();
  imgParallaxEffect();
  imgHoverEffect();
  imgFluidScaleEffect();
  projectPopUpEffect();
};

window.addEventListener("DOMContentLoaded", init);
