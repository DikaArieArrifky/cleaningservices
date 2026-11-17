import Alpine from 'alpinejs';
import { createIcons, icons } from 'lucide';

window.Alpine = Alpine;

// Helper to re-render Lucide icons dynamically (e.g. after Alpine renders or tabs switch)
window.renderIcons = () => {
    createIcons({ icons });
};

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    window.renderIcons();
});

// Re-run icons when Alpine transitions finish
document.addEventListener('alpine:initialized', () => {
    window.renderIcons();
});
