("true" !== localStorage.getItem("sb-dark-mode") &&
  !window.matchMedia("(prefers-color-scheme: dark)").matches) ||
  document.documentElement.classList.add("dark"),
  "false" === localStorage.getItem("sb-dark-mode") &&
    document.documentElement.classList.remove("dark");

(function () {
  var theme = localStorage.getItem("theme");
  window.metaColors = {
    default: "#f7f7f9",
    dark: "#252526",
    beach: "#e3f6f5",
    choco: "#41312E",
    moomoo: "#f3e1d8",
    bowser: "#29293e",
    yoshi: "#f2ede9",
    rainbow: "#311b46",
    lobster: "#ffb9ad",
    hackernews: "#F8F8EC",
  };
  if (theme) {
    document.documentElement.setAttribute("data-theme", theme);
    document
      .querySelector('meta[name="theme-color"]')
      .setAttribute("content", window.metaColors[theme]);
  }
})();

// in body tag
!(function () {
  function t(t) {
    document.documentElement.setAttribute("data-theme", t);
  }
  var e = (function () {
    var t = null;
    try {
      t = localStorage.getItem("theme");
    } catch (t) {}
    return t;
  })();
  t(null !== e ? e : "light");
})();
