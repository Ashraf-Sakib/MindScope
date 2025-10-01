import './bootstrap';
import { themeChange } from 'theme-change';

console.log('✅ MindScope loaded successfully!');

// List of all daisyUI themes
const themes = [
    'light', 'dark', 'cupcake', 'bumblebee', 'emerald', 'corporate',
    'synthwave', 'retro', 'cyberpunk', 'valentine', 'halloween', 'garden',
    'forest', 'aqua', 'lofi', 'pastel', 'fantasy', 'wireframe', 'black',
    'luxury', 'dracula', 'cmyk', 'autumn', 'business', 'acid', 'lemonade',
    'night', 'coffee', 'winter', 'dim', 'nord', 'sunset'
];

// Run theme-change after DOM loads
document.addEventListener('DOMContentLoaded', function() {
    // Initialize theme-change library (enables data-set-theme etc.)
    themeChange(false); // false = don't log in console

    // Ensure a default theme if none is saved
    const savedTheme = localStorage.getItem('theme');
    if (!savedTheme) {
        applyTheme('valentine'); // default theme
    } else {
        applyTheme(savedTheme);
    }

    populateThemeSelector();
});

// ✅ Apply theme function
function applyTheme(themeName) {
    document.documentElement.setAttribute('data-theme', themeName);
    localStorage.setItem('theme', themeName);

    const selector = document.getElementById('theme-selector');
    if (selector) {
        selector.value = themeName;
    }

    console.log('🌈 Theme applied:', themeName);
}

// ✅ Populate theme dropdown selector
function populateThemeSelector() {
    const selector = document.getElementById('theme-selector');
    if (!selector) return;

    const currentTheme = localStorage.getItem('theme') || 'valentine';
    selector.innerHTML = '';

    themes.forEach(theme => {
        const option = document.createElement('option');
        option.value = theme;
        option.textContent = theme.charAt(0).toUpperCase() + theme.slice(1);
        if (theme === currentTheme) option.selected = true;
        selector.appendChild(option);
    });

    selector.addEventListener('change', function() {
        applyTheme(this.value);
    });
}

// ✅ Quick change theme (usable in buttons)
window.changeTheme = function(themeName) {
    if (themes.includes(themeName)) {
        applyTheme(themeName);
    } else {
        console.error('❌ Invalid theme:', themeName);
    }
};

// ✅ Mood selection
window.selectQuickMood = function(mood, event) {
    const select = document.getElementById('mood-select');
    if (select) {
        select.value = mood;
        console.log('😊 Mood selected:', mood);

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
            setTimeout(() => textarea.focus(), 500);
        }
    }
};

// ✅ Save mood
window.saveMood = function() {
    const mood = document.getElementById('mood-select')?.value;
    const details = document.getElementById('mood-details')?.value;

    if (!mood) {
        alert('⚠️ Please select a mood first!');
        return;
    }

    console.log('💾 Saving mood:', { mood, details });
    alert(`✅ Mood saved!\n\nMood: ${mood}\nDetails: ${details || 'None'}`);

    const select = document.getElementById('mood-select');
    const textarea = document.getElementById('mood-details');

    if (select) select.value = '';
    if (textarea) textarea.value = '';

    const buttons = document.querySelectorAll('[onclick^="selectQuickMood"]');
    buttons.forEach(btn => {
        btn.classList.remove('ring-4', 'ring-offset-2', 'ring-primary');
    });
};
