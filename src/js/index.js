import { gsap } from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

// ? DOM Nodes
const body = document.body;
const overlayBody = document.querySelector(".overlay--body");
const menu = document.querySelector(".menu");
const menuIcon = document.querySelector(".nav__menu-icon");
const menuBarTop = document.querySelector(".nav__menu-bar--1");
const menuBarBottom = document.querySelector(".nav__menu-bar--2");
const navLinkBlessed = document.querySelector(".nav__link--blessed");
const navLinkContact = document.querySelector(".nav__link--contact");
// const menuList = document.querySelector(".menu__list");
const menuItems = document.querySelectorAll(".menu__item");
const menuLinks = document.querySelectorAll(".menu__link");

const linksPlain = document.querySelectorAll(".link.link--plain");
const linksUnderlined = document.querySelectorAll(".link.link--underline");

const featuredProjects = document.querySelectorAll(".project--featured");
const overlayFeatured = document.querySelector(".overlay--featured");
const sectionFeatured = document.querySelector(".featured-work");

// Menu open and close animations
const animMenu = () => {
  gsap.set(menuItems, { translateX: 50, autoAlpha: 0 });

  const menuTl = gsap
    .timeline({
      reversed: true,
      defaults: { duration: 1, ease: "Expo.power2" },
    })
    .to(menu, { duration: 0.5, right: 0 })
    .to(menuBarTop, { duration: 0.5, translateY: 3, rotate: "135" }, 0)
    .to(menuBarBottom, { duration: 0.5, translateY: -3, rotate: "-135" }, 0)
    // .to(navLinkBlessed, { duration: 0, color: "var(--color-white)" },)
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

  menuIcon.addEventListener("click", () => {
    menuTl.reversed(!menuTl.reversed());
    body.classList.toggle("menu-open");
    navLinkBlessed.classList.toggle("menu-open");
    overlayBody.classList.toggle("u-hidden");
  });

  overlayBody.addEventListener("click", () => {
    menuTl.reversed(!menuTl.reversed());
    body.classList.toggle("menu-open");
    overlayBody.classList.toggle("u-hidden");
  });

  menuLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      menuTl.reversed(!menuTl.reversed());
      body.classList.toggle("menu-open");
      overlayBody.classList.toggle("u-hidden");
    });
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !overlayBody.classList.contains("u-hidden")) {
      menuTl.reversed(!menuTl.reversed());
      overlayBody.classList.toggle("u-hidden");
      body.classList.toggle("menu-open");
    }
  });
};

// Link hover animations
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

// Featured project background animation
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

const init = () => {
  animMenu();
  animLinks();
  animFeaturedBg();
};

window.addEventListener("DOMContentLoaded", init);
