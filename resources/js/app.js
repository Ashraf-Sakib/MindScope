import './bootstrap';
import { themeChange } from 'theme-change';

console.log(' MindScope loaded successfully!');

const availableThemes = [
    'light', 'dark', 'cupcake', 'bumblebee', 'emerald', 'corporate', 
    'synthwave', 'retro', 'cyberpunk', 'valentine', 'halloween', 'garden',
    'forest', 'aqua', 'lofi', 'pastel', 'fantasy', 'wireframe', 'black',
    'luxury', 'dracula', 'cmyk', 'autumn', 'business', 'acid', 'lemonade',
    'night', 'coffee', 'winter', 'dim', 'nord', 'sunset'
];

function applyTheme(themeName) {
    document.documentElement.setAttribute('data-theme', themeName);
    localStorage.setItem('theme', themeName);

    const selector = document.getElementById('theme-selector');
    if (selector) {
        selector.value = themeName;
    }

    console.log(' Theme applied:', themeName);
}

function populateThemeSelector() {
    const selector = document.getElementById('theme-selector');
    if (!selector) return;

    const currentTheme = localStorage.getItem('theme') || 'light';
    selector.innerHTML = '';
    availableThemes.forEach(theme => {
        const option = document.createElement('option');
        option.value = theme;
        option.textContent = theme.charAt(0).toUpperCase() + theme.slice(1);
        if (theme === currentTheme) option.selected = true;
        selector.appendChild(option);
    });

    selector.addEventListener('change', function () {
        applyTheme(this.value);
    });

    console.log(' Theme selector populated with', availableThemes.length, 'themes');
}

document.addEventListener('DOMContentLoaded', function() {
    themeChange(false);
    const savedTheme = localStorage.getItem('theme') || 'light';
    applyTheme(savedTheme);
    populateThemeSelector();

    console.log('Theme system initialized');
});

window.changeTheme = function (themeName) {
    applyTheme(themeName);
};

window.selectQuickMood = function (mood, event) {
    const select = document.getElementById('mood-select');
    if (select) {
        select.value = mood;
        console.log(' Mood selected:', mood);

        const buttons = document.querySelectorAll('[onclick^="selectQuickMood"]');
        buttons.forEach(btn => {
            btn.classList.remove('ring-4', 'ring-offset-2', 'ring-primary');
        });

        if (event?.target) {
            event.target.closest('button').classList.add('ring-4', 'ring-offset-2', 'ring-primary');
        }

        const textarea = document.getElementById('mood-details');
        if (textarea) {
            textarea.scrollIntoView({ behavior: 'smooth', block: 'center' });
            textarea.focus({ preventScroll: true });
        }
    }
};

window.saveMood = function () {
    const mood = document.getElementById('mood-select')?.value;
    const details = document.getElementById('mood-details')?.value;

    if (!mood) {
        alert(' Please select a mood first!');
        return;
    }

    console.log('Saving mood:', { mood, details });
    alert(` Mood saved!\n\nMood: ${mood}\nDetails: ${details || 'None'}`);

    const select = document.getElementById('mood-select');
    const textarea = document.getElementById('mood-details');

    if (select) select.value = '';
    if (textarea) textarea.value = '';

    const buttons = document.querySelectorAll('[onclick^="selectQuickMood"]');
    buttons.forEach(btn => {
        btn.classList.remove('ring-4', 'ring-offset-2', 'ring-primary');
    });
};