import './bootstrap';
document.addEventListener('DOMContentLoaded', function() {
    console.log(' MindScope loaded successfully!');
    initDarkMode();
    initFormEnhancements();
    initInteractiveElements();
    initBreathingExercise();
    initMoodTracking();
});
function initDarkMode() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
    const currentTheme = localStorage.getItem('theme') || 
                        (prefersDarkScheme.matches ? 'dark' : 'light');
    
    if (currentTheme === 'dark') {
        document.documentElement.classList.add('dark');
    }
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateDarkModeButton(isDark);
        });
    }
    prefersDarkScheme.addEventListener('change', (e) => {
        if (!localStorage.getItem('theme')) {
            document.documentElement.classList.toggle('dark', e.matches);
        }
    });
}

function updateDarkModeButton(isDark) {
    const darkModeToggle = document.getElementById('darkModeToggle');
    if (darkModeToggle) {
        darkModeToggle.innerHTML = isDark ? ' Dark' : ' Light';
    }
}
function initFormEnhancements() {
    // Auto-resize textareas
    const autoResizeTextareas = document.querySelectorAll('textarea[data-auto-resize]');
    autoResizeTextareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
        
        // Trigger initial resize
        textarea.dispatchEvent(new Event('input'));
    });

    // Form validation enhancements
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                // Add loading state
                submitButton.disabled = true;
                submitButton.innerHTML = '⏳ Processing...';
                
                // Re-enable after 5 seconds (safety net)
                setTimeout(() => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = submitButton.dataset.originalText || 'Submit';
                }, 5000);
            }
        });
    });

    // Save button original text
    document.querySelectorAll('button[type="submit"]').forEach(button => {
        button.dataset.originalText = button.innerHTML;
    });
}

// Interactive Elements
function initInteractiveElements() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Toast notifications
    window.showToast = function(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300 ${
            type === 'success' ? 'bg-green-500 text-white' : 
            type === 'error' ? 'bg-red-500 text-white' : 
            'bg-blue-500 text-white'
        }`;
        toast.innerHTML = `
            <div class="flex items-center space-x-2">
                <span>${type === 'success' ? '✅' : type === 'error' ? '❌' : '💡'}</span>
                <span>${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-2">×</button>
            </div>
        `;
        
        document.body.appendChild(toast);
        setTimeout(() => toast.style.transform = 'translateX(0)', 100);
        setTimeout(() => {
            if (toast.parentElement) {
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => toast.remove(), 300);
            }
        }, 5000);
    };
    window.copyToClipboard = async function(text) {
        try {
            await navigator.clipboard.writeText(text);
            showToast('Copied to clipboard!', 'success');
        } catch (err) {
            console.error('Failed to copy: ', err);
            showToast('Failed to copy', 'error');
        }
    };
}
function initBreathingExercise() {
    const breathText = document.getElementById('breath-text');
    const circle = document.getElementById('circle');
    
    if (!breathText || !circle) return;

    let isRunning = false;
    let animationInterval;

    window.startBreathingExercise = function() {
        if (isRunning) return;
        
        isRunning = true;
        const quotes = [
            "You are stronger than you think.",
            "One step at a time.",
            "Breathe. Relax. Reset.",
            "Your mind deserves a break.",
            "Calmness is a superpower."
        ];

        let phase = 0;
        
        animationInterval = setInterval(() => {
            phase = (phase + 1) % 3;
            
            switch(phase) {
                case 0: // Inhale
                    breathText.textContent = 'Inhale...';
                    breathText.className = 'text-2xl font-semibold text-green-600 dark:text-green-400 mb-6';
                    circle.style.transform = 'scale(1.5)';
                    break;
                case 1: // Hold
                    breathText.textContent = 'Hold...';
                    breathText.className = 'text-2xl font-semibold text-blue-600 dark:text-blue-400 mb-6';
                    break;
                case 2: // Exhale
                    breathText.textContent = 'Exhale...';
                    breathText.className = 'text-2xl font-semibold text-purple-600 dark:text-purple-400 mb-6';
                    circle.style.transform = 'scale(1)';
                    const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
                    document.getElementById('quote-text').textContent = `"${randomQuote}"`;
                    break;
            }
        }, 4000);
    };

    window.stopBreathingExercise = function() {
        isRunning = false;
        clearInterval(animationInterval);
        breathText.textContent = 'Paused';
        circle.style.transform = 'scale(1)';
    };
    if (window.location.pathname.includes('relief')) {
        setTimeout(startBreathingExercise, 1000);
    }
}
function initMoodTracking() {

    const moodRadios = document.querySelectorAll('input[name="mood"]');
    moodRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('label').forEach(label => {
                label.classList.remove('ring-2', 'ring-offset-2');
            });
            if (this.checked) {
                this.closest('label').classList.add('ring-2', 'ring-offset-2', 'ring-indigo-500');
            }
        });
        if (radio.checked) {
            radio.dispatchEvent(new Event('change'));
        }
    });
    const quickMoodButtons = document.querySelectorAll('[data-mood]');
    quickMoodButtons.forEach(button => {
        button.addEventListener('click', function() {
            const mood = this.dataset.mood;
            const radio = document.querySelector(`input[name="mood"][value="${mood}"]`);
            if (radio) {
                radio.checked = true;
                radio.dispatchEvent(new Event('change'));
                document.getElementById('mood-form')?.scrollIntoView({ 
                    behavior: 'smooth' 
                });
            }
        });
    });
}
window.formatDate = function(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { 
        weekday: 'short', 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};
window.addEventListener('error', function(e) {
    console.error('JavaScript Error:', e.error);
});
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { initDarkMode, initFormEnhancements };
}