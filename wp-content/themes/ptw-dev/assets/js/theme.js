const themeDict = window.ptwThemeData || {
  theme: 'THEME',
  light: 'LIGHT',
  dark: 'DARK',
  auto: 'AUTO'
};

function updateThemeButtonLabel(mode) {
  const btn = document.getElementById('theme-btn');
  if (!btn) return;

  let activeModeText = themeDict.auto;
  if (mode === 'dark') {
    activeModeText = themeDict.dark;
  } else if (mode === 'light') {
    activeModeText = themeDict.light;
  }

  btn.textContent = `[${themeDict.theme}: ${activeModeText} ▾]`;
}

(function () {
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme) {
    document.documentElement.setAttribute('data-theme', savedTheme);
    updateThemeButtonLabel(savedTheme);
  } else {
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    document.documentElement.setAttribute('data-theme', prefersDark ? 'dark' : 'light');
    updateThemeButtonLabel('system');
  }
})();

function setTheme(mode) {
  if (mode === 'system') {
    localStorage.removeItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    document.documentElement.setAttribute('data-theme', prefersDark ? 'dark' : 'light');
    updateThemeButtonLabel('system');
  } else {
    localStorage.setItem('theme', mode);
    document.documentElement.setAttribute('data-theme', mode);
    updateThemeButtonLabel(mode);
  }
}
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
  if (!localStorage.getItem('theme')) {
    const newSystemTheme = e.matches ? 'dark' : 'light';
    document.documentElement.setAttribute('data-theme', newSystemTheme);
    updateThemeButtonLabel('system');
  }
});
