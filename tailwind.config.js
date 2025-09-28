module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                'pastel': {
                    'yellow': '#fef9c3',
                    'orange': '#fed7aa', 
                    'blue': '#dbeafe',
                    'green': '#dcfce7',
                    'red': '#fee2e2',
                    'purple': '#f3e8ff',
                },
                'lavender': {
                    50: '#f5f3ff',
                    100: '#ede9fe',
                    200: '#ddd6fe',
                    300: '#c4b5fd',
                    400: '#a78bfa',
                    500: '#8b5cf6',
                    600: '#7c3aed',
                    700: '#6d28d9',
                },
                'mint': {
                    50: '#f0fdfa',
                    100: '#ecfdf5',
                    200: '#d1fae5',
                    300: '#a7f3d0',
                    500: '#10b981',
                    600: '#059669',
                    700: '#047857',
                }
            }
        },
    },
     plugins: [require("daisyui")],
  daisyui: {
    themes: ["light", "dark"], 
  },
}