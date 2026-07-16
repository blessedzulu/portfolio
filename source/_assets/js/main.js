// Blessed Zulu — site behaviour. Small and quiet.
const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// year stamp
const yearEl = document.getElementById('year');
if (yearEl) yearEl.textContent = new Date().getFullYear();

// live local time in Ndola (Africa/Lusaka) — a small sign of life in the footer
const timeEl = document.getElementById('local-time');
if (timeEl) {
    const fmt = new Intl.DateTimeFormat('en-GB', {
        timeZone: 'Africa/Lusaka',
        hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false,
    });
    const tick = () => { timeEl.textContent = fmt.format(new Date()); };
    tick();
    setInterval(tick, 1000);
}

// copy-to-clipboard (contact page) — swaps the button label briefly on success
document.querySelectorAll('[data-copy]').forEach((btn) => {
    btn.addEventListener('click', async () => {
        try {
            await navigator.clipboard.writeText(btn.dataset.copy);
            const label = btn.querySelector('[data-copy-label]');
            if (label) {
                const prev = label.textContent;
                label.textContent = btn.dataset.copiedLabel || 'Copied';
                setTimeout(() => { label.textContent = prev; }, 1600);
            }
        } catch (e) {}
    });
});

// back to top
const toTop = document.getElementById('back-to-top');
if (toTop) {
    toTop.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' });
    });
}

// theme toggle — the no-flash script in <head> sets the initial state; this just
// flips it and remembers the choice. The .dark class drives the CSS tokens.
const themeBtn = document.getElementById('theme-toggle');
if (themeBtn) {
    const root = document.documentElement;
    const meta = document.querySelector('meta[name="theme-color"]');
    themeBtn.addEventListener('click', () => {
        const dark = !root.classList.contains('dark');
        root.classList.toggle('dark', dark);
        root.style.colorScheme = dark ? 'dark' : 'light';
        if (meta) meta.setAttribute('content', dark ? '#0a0a0a' : '#ffffff');
        try { localStorage.setItem('theme', dark ? 'dark' : 'light'); } catch (e) {}
    });
}

// reveal on scroll
const revealEls = document.querySelectorAll('.reveal');
if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries, obs) => {
        entries.forEach((e) => {
            if (e.isIntersecting) {
                e.target.classList.add('in');
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });
    revealEls.forEach((el) => io.observe(el));
} else {
    revealEls.forEach((el) => el.classList.add('in'));
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
