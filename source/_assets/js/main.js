// Blessed Zulu - site behaviour. Small and quiet.
const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// year stamp
const yearEl = document.getElementById('year');
if (yearEl) yearEl.textContent = new Date().getFullYear();

// live local clock, 12-hour - a small sign of life. Timezone comes from the
// element's data-timezone (set from config), falling back to Africa/Lusaka.
const timeEl = document.getElementById('local-time');
if (timeEl) {
    const fmt = new Intl.DateTimeFormat('en-GB', {
        timeZone: timeEl.dataset.timezone || 'Africa/Lusaka',
        hour: 'numeric', minute: '2-digit', second: '2-digit', hour12: true,
    });
    const tick = () => { timeEl.textContent = fmt.format(new Date()); };
    tick();
    setInterval(tick, 1000);
}

// copy-to-clipboard (contact page). The async Clipboard API only works in a
// secure context (https / localhost), so fall back to execCommand for plain
// http hosts like portfolio.test.
const copyText = async (text) => {
    try {
        if (navigator.clipboard && window.isSecureContext) {
            await navigator.clipboard.writeText(text);
            return true;
        }
    } catch (e) { /* fall through */ }
    try {
        const ta = document.createElement('textarea');
        ta.value = text;
        ta.setAttribute('readonly', '');
        ta.style.cssText = 'position:fixed;top:-9999px;opacity:0';
        document.body.appendChild(ta);
        ta.select();
        const ok = document.execCommand('copy');
        document.body.removeChild(ta);
        return ok;
    } catch (e) { return false; }
};
document.querySelectorAll('[data-copy]').forEach((btn) => {
    btn.addEventListener('click', async () => {
        if (!(await copyText(btn.dataset.copy))) return;
        const label = btn.querySelector('[data-copy-label]');
        if (label) {
            const prev = label.textContent;
            label.textContent = btn.dataset.copiedLabel || 'Copied';
            setTimeout(() => { label.textContent = prev; }, 1600);
        }
    });
});

// wordmark: the non-initial letter runs collapse to zero width once scrolled, so
// "Blessed Zulu" folds in place to "BZ" (and back). CSS animates the max-width;
// here we only measure each run's natural width. No library.
const wmParts = document.querySelectorAll('[data-wm-collapse]');
const wmMeasure = () => wmParts.forEach((el) => el.style.setProperty('--wm-w', el.scrollWidth + 'px'));
if (wmParts.length) {
    wmMeasure();
    // re-measure once the web font has loaded (widths differ from the fallback)
    if (document.fonts && document.fonts.ready) document.fonts.ready.then(wmMeasure);
    window.addEventListener('resize', wmMeasure, { passive: true });
}

const setScrolled = () => document.documentElement.classList.toggle('scrolled', window.scrollY > 24);
setScrolled();
window.addEventListener('scroll', setScrolled, { passive: true });

// direction-aware sliding pill for any horizontal [data-nav] group (the header
// AND the footer socials). One indicator slides between the group's
// [data-nav-link]s, following the cursor. Desktop hover only; standalone links
// have nothing to slide between, so they use the plain .action fade instead.
if (window.matchMedia('(hover: hover)').matches) {
    document.querySelectorAll('[data-nav]').forEach((group) => {
        const indicator = group.querySelector('[data-nav-indicator]');
        if (!indicator) return;
        const links = group.querySelectorAll('[data-nav-link]');
        let active = false;
        const move = (link) => {
            const nb = group.getBoundingClientRect();
            const lb = link.getBoundingClientRect();
            if (!active) indicator.style.transition = 'none'; // first show: no slide from the origin
            indicator.style.left = (lb.left - nb.left) + 'px';
            indicator.style.width = lb.width + 'px';
            indicator.style.height = lb.height + 'px';
            indicator.style.opacity = '1';
            if (!active) { void indicator.offsetWidth; indicator.style.transition = ''; active = true; }
        };
        links.forEach((link) => link.addEventListener('pointerenter', () => move(link)));
        group.addEventListener('pointerleave', () => { indicator.style.opacity = '0'; active = false; });
    });
}

// back to top
const toTop = document.getElementById('back-to-top');
if (toTop) {
    toTop.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' });
    });
}

// theme toggle - the no-flash script in <head> sets the initial state; this just
// flips it and remembers the choice. The .dark class drives the CSS tokens.
const root = document.documentElement;
const themeMeta = document.querySelector('meta[name="theme-color"]');
const syncThemeColor = () => {
    if (themeMeta) themeMeta.setAttribute('content', root.classList.contains('dark') ? '#0a0a0a' : '#ffffff');
};
syncThemeColor(); // match the browser chrome to the theme the no-flash script picked

const themeBtn = document.getElementById('theme-toggle');
if (themeBtn) {
    themeBtn.addEventListener('click', () => {
        const dark = !root.classList.contains('dark');
        root.classList.toggle('dark', dark);
        root.style.colorScheme = dark ? 'dark' : 'light';
        syncThemeColor();
        try { localStorage.setItem('theme', dark ? 'dark' : 'light'); } catch (e) {}
    });
}

// fluid gate: pause the header sim when it is off-screen, the tab is hidden,
// or the visitor prefers reduced motion.
window.FLUID = window.FLUID || { run: true };
const hero = document.getElementById('hero');
if (hero) {
    if (reduce) {
        setTimeout(() => { window.FLUID.run = false; }, 2600);
    } else if ('IntersectionObserver' in window) {
        const io2 = new IntersectionObserver((entries) => {
            window.FLUID.run = entries[0].isIntersecting && !document.hidden;
        }, { threshold: 0.02 });
        io2.observe(hero);
        document.addEventListener('visibilitychange', () => {
            window.FLUID.run = !document.hidden;
        });
    }
}
