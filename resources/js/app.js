import './bootstrap';

console.log('✅ MindScope loaded successfully!');

// Basic dark mode toggle
document.addEventListener('DOMContentLoaded', function() {
    // Load saved theme
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark');
    }
});

// Theme toggle function
window.toggleTheme = function() {
    const html = document.documentElement;
    const currentTheme = html.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    
    html.setAttribute('data-theme', newTheme);
    html.classList.toggle('dark');
    localStorage.setItem('theme', newTheme);
    
    console.log('Theme changed to:', newTheme);
};

// Quick mood selection
window.selectQuickMood = function(mood) {
    const select = document.getElementById('mood-select');
    if (select) {
        select.value = mood;
        console.log('Mood selected:', mood);
        
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
    if (document.getElementById('mood-select')) {
        document.getElementById('mood-select').value = '';
    }
    if (document.getElementById('mood-details')) {
        document.getElementById('mood-details').value = '';
    }
};