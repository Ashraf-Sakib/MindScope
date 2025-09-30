import './bootstrap';

console.log('✅ MindScope loaded successfully!');

// Available DaisyUI themes
const themes = [
    'light', 'dark', 'cupcake', 'bumblebee', 'emerald', 'corporate', 
    'synthwave', 'retro', 'cyberpunk', 'valentine', 'halloween', 'garden',
    'forest', 'aqua', 'lofi', 'pastel', 'fantasy', 'wireframe', 'black',
    'luxury', 'dracula', 'cmyk', 'autumn', 'business', 'acid', 'lemonade',
    'night', 'coffee', 'winter', 'dim', 'nord', 'sunset'
];

// Dark themes (for applying Tailwind dark class)
const darkThemes = ['dark', 'night', 'forest', 'black', 'dracula', 'business', 'luxury', 'halloween', 'synthwave', 'cyberpunk', 'coffee', 'dim', 'sunset'];

// Initialize theme on page load
document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme') || 'cupcake';
    applyTheme(savedTheme);
    populateThemeSelector();
});

// Apply theme function
function applyTheme(themeName) {
    const html = document.documentElement;
    html.setAttribute('data-theme', themeName);
    
    // Add/remove dark class for Tailwind
    if (darkThemes.includes(themeName)) {
        html.classList.add('dark');
    } else {
        html.classList.remove('dark');
    }
    
    localStorage.setItem('theme', themeName);
    
    // Update theme selector if it exists
    const selector = document.getElementById('theme-selector');
    if (selector) {
        selector.value = themeName;
    }
    
    console.log('Theme applied:', themeName);
}

// Populate theme selector dropdown
function populateThemeSelector() {
    const selector = document.getElementById('theme-selector');
    if (!selector) return;
    
    const currentTheme = localStorage.getItem('theme') || 'cupcake';
    
    // Clear existing options
    selector.innerHTML = '';
    
    // Add all theme options
    themes.forEach(theme => {
        const option = document.createElement('option');
        option.value = theme;
        option.textContent = theme.charAt(0).toUpperCase() + theme.slice(1);
        if (theme === currentTheme) {
            option.selected = true;
        }
        selector.appendChild(option);
    });
    
    // Add change event listener
    selector.addEventListener('change', function() {
        applyTheme(this.value);
    });
}

// Legacy toggle theme function (for button)
window.toggleTheme = function() {
    const html = document.documentElement;
    const currentTheme = html.getAttribute('data-theme');
    const newTheme = darkThemes.includes(currentTheme) ? 'cupcake' : 'dark';
    applyTheme(newTheme);
};

// Change theme function
window.changeTheme = function(themeName) {
    if (themes.includes(themeName)) {
        applyTheme(themeName);
    } else {
        console.error('Invalid theme:', themeName);
    }
};

// Quick mood selection
window.selectQuickMood = function(mood) {
    const select = document.getElementById('mood-select');
    if (select) {
        select.value = mood;
        console.log('Mood selected:', mood);
        
        // Visual feedback on button
        const buttons = document.querySelectorAll('[onclick^="selectQuickMood"]');
        buttons.forEach(btn => {
            btn.classList.remove('ring-4', 'ring-offset-2', 'ring-primary');
        });
        event.target.closest('button').classList.add('ring-4', 'ring-offset-2', 'ring-primary');
        
        // Scroll to textarea
        const textarea = document.getElementById('mood-details');
        if (textarea) {
            textarea.scrollIntoView({ behavior: 'smooth', block: 'center' });
            setTimeout(() => textarea.focus(), 500);
        }
    }
};

// Save mood function
window.saveMood = function() {
    const mood = document.getElementById('mood-select')?.value;
    const details = document.getElementById('mood-details')?.value;
    
    if (!mood) {
        alert('⚠️ Please select a mood first!');
        return;
    }
    
    console.log('Saving mood:', { mood, details });
    alert(`✅ Mood saved!\n\nMood: ${mood}\nDetails: ${details || 'None'}`);
    
    // Reset form
    const select = document.getElementById('mood-select');
    const textarea = document.getElementById('mood-details');
    
    if (select) select.value = '';
    if (textarea) textarea.value = '';
    
    // Remove visual feedback from buttons
    const buttons = document.querySelectorAll('[onclick^="selectQuickMood"]');
    buttons.forEach(btn => {
        btn.classList.remove('ring-4', 'ring-offset-2', 'ring-primary');
    });
};