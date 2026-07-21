import { createInertiaApp } from '@inertiajs/vue3';
import { initializeTheme } from '@/composables/useAppearance';
import AppLayout from '@/layouts/AppLayout.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { initializeFlashToast } from '@/lib/flashToast';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    layout: (name) => {
        switch (true) {
            case name === 'Welcome':
                return null;
            case name.startsWith('auth/'):
                return AuthLayout;
            case name.startsWith('settings/'):
                return [AppLayout, SettingsLayout];
            default:
                return AppLayout;
        }
    },
    progress: {
        color: '#E8770C',
    },
});

// This will set light / dark mode on page load...
initializeTheme();

// This will listen for flash toast data from the server...
initializeFlashToast();

// Setup global scroll reveal observer for premium entry animations
const setupScrollReveal = () => {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.05, rootMargin: '0px 0px -40px 0px' },
    );

    const elements = document.querySelectorAll(
        '.reveal-fade-up, .reveal-slide-left, .reveal-slide-right, .reveal-scale-in',
    );
    elements.forEach((el) => observer.observe(el));
};

document.addEventListener('inertia:success', () => {
    setTimeout(setupScrollReveal, 100);
});
document.addEventListener('DOMContentLoaded', setupScrollReveal);
// Run initial setup in case DOMContentLoaded has already fired
setTimeout(setupScrollReveal, 200);
