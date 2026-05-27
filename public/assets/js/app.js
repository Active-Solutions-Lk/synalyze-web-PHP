document.addEventListener("DOMContentLoaded", () => {
    // Initialize Lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Mobile menu toggle logic
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const iconOpen = mobileMenuBtn ? mobileMenuBtn.querySelector('.menu-icon-open') : null;
    const iconClose = mobileMenuBtn ? mobileMenuBtn.querySelector('.menu-icon-close') : null;

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
            if (iconOpen && iconClose) {
                iconOpen.classList.toggle('hidden');
                iconOpen.classList.toggle('block');
                iconClose.classList.toggle('hidden');
                iconClose.classList.toggle('block');
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', (event) => {
            if (!mobileMenu.contains(event.target) && !mobileMenuBtn.contains(event.target) && mobileMenu.classList.contains('open')) {
                mobileMenu.classList.remove('open');
                if (iconOpen && iconClose) {
                    iconOpen.classList.remove('hidden');
                    iconOpen.classList.add('block');
                    iconClose.classList.add('hidden');
                    iconClose.classList.remove('block');
                }
            }
        });
    }

    // Theme toggle via 'd' hotkey
    window.addEventListener("keydown", (event) => {
        if (event.defaultPrevented || event.repeat) return;
        if (event.metaKey || event.ctrlKey || event.altKey) return;
        if (event.key.toLowerCase() !== "d") return;
        
        // Don't toggle if typing in an input
        const target = event.target;
        if (target.isContentEditable || target.tagName === "INPUT" || target.tagName === "TEXTAREA" || target.tagName === "SELECT") {
            return;
        }

        document.documentElement.classList.toggle('dark');
        const isDark = document.documentElement.classList.contains('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });

    // Check localStorage for theme
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
    } else if (localStorage.getItem('theme') === 'light') {
        document.documentElement.classList.remove('dark');
    }

    // Pricing toggle (if exists)
    const btnMonthly = document.getElementById('btn-monthly');
    const btnAnnual = document.getElementById('btn-annual');
    if (btnMonthly && btnAnnual) {
        btnMonthly.addEventListener('click', () => {
            btnMonthly.className = "bg-[#3d8c7c] text-white px-6 py-2 rounded-full font-bold text-lg";
            btnAnnual.className = "border border-white/20 text-white px-6 py-2 rounded-full font-bold text-lg hover:bg-white/5 transition-colors";
            document.querySelectorAll('[data-monthly]').forEach(el => el.textContent = el.getAttribute('data-monthly'));
        });
        btnAnnual.addEventListener('click', () => {
            btnAnnual.className = "bg-[#3d8c7c] text-white px-6 py-2 rounded-full font-bold text-lg";
            btnMonthly.className = "border border-white/20 text-white px-6 py-2 rounded-full font-bold text-lg hover:bg-white/5 transition-colors";
            document.querySelectorAll('[data-annual]').forEach(el => el.textContent = el.getAttribute('data-annual'));
        });
    }

    // Contact subject pills (if exists)
    const subjectPills = document.querySelectorAll('.subject-pill');
    const subjectInput = document.getElementById('subject-input');
    if (subjectPills.length > 0 && subjectInput) {
        subjectPills.forEach(pill => {
            pill.addEventListener('click', () => {
                // Remove active classes
                subjectPills.forEach(p => {
                    p.classList.remove('bg-white', 'text-black', 'font-bold', 'shadow-md');
                    p.classList.add('bg-[#627387]', 'text-white', 'hover:bg-[#6e8096]');
                });
                // Add active to clicked
                pill.classList.remove('bg-[#627387]', 'text-white', 'hover:bg-[#6e8096]');
                pill.classList.add('bg-white', 'text-black', 'font-bold', 'shadow-md');
                // Update hidden input
                subjectInput.value = pill.getAttribute('data-value');
            });
        });
    }

    // -------------------------------------------------------
    // SIGNUP: Password show/hide toggle
    // -------------------------------------------------------
    document.querySelectorAll('.signup-eye-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var targetId = btn.getAttribute('data-target');
            var input = document.getElementById(targetId);
            var eyeImg = btn.querySelector('.signup-eye-icon');
            if (!input || !eyeImg) return;

            var isHidden = (input.type === 'password');
            input.type = isHidden ? 'text' : 'password';

            // Swap the eye icon src using the data-* paths set on the page
            var showSrc = document.body.getAttribute('data-eye-show') || '';
            var hideSrc = document.body.getAttribute('data-eye-hide') || '';
            if (showSrc && hideSrc) {
                eyeImg.src = isHidden ? showSrc : hideSrc;
            }
            eyeImg.alt = isHidden ? 'Hide' : 'Show';
        });
    });

    // -------------------------------------------------------
    // SIGNUP: Phone country code dropdown
    // -------------------------------------------------------
    var phoneBtn = document.getElementById('phone-country-btn');
    var phoneDropdown = document.getElementById('phone-country-dropdown');
    var phoneCodeSpan = document.getElementById('phone-country-code');
    var phoneFlagSpan = document.getElementById('phone-flag-emoji');
    var phoneSearch = document.getElementById('phone-search');
    var countryItems = document.querySelectorAll('.phone-country-item');

    if (phoneBtn && phoneDropdown) {
        phoneBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            var isHidden = phoneDropdown.hidden;
            phoneDropdown.hidden = !isHidden;
            if (!isHidden) return;
            // Focus search on open
            if (phoneSearch) {
                phoneSearch.value = '';
                countryItems.forEach(function(li) { li.classList.remove('hidden-item'); });
                setTimeout(function() { phoneSearch.focus(); }, 50);
            }
        });

        // Search filter
        if (phoneSearch) {
            phoneSearch.addEventListener('input', function() {
                var query = phoneSearch.value.toLowerCase();
                countryItems.forEach(function(li) {
                    var name = li.getAttribute('data-name') || '';
                    var code = li.getAttribute('data-code') || '';
                    li.classList.toggle('hidden-item', !name.toLowerCase().includes(query) && !code.includes(query));
                });
            });
        }

        // Select country
        countryItems.forEach(function(li) {
            li.addEventListener('click', function() {
                var code = li.getAttribute('data-code') || '+1';
                var flag = li.getAttribute('data-flag') || '🇺🇸';
                if (phoneCodeSpan) phoneCodeSpan.textContent = code;
                if (phoneFlagSpan) phoneFlagSpan.textContent = flag;
                phoneDropdown.hidden = true;
            });
        });

        // Close on outside click
        document.addEventListener('click', function(e) {
            if (!phoneDropdown.hidden && !phoneBtn.contains(e.target) && !phoneDropdown.contains(e.target)) {
                phoneDropdown.hidden = true;
            }
        });
    }
});
