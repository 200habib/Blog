const setup = () => {
    const getTheme = () => {
      if (window.localStorage.getItem('dark')) {
        return JSON.parse(window.localStorage.getItem('dark'));
      }
      return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    };

    const setTheme = (value) => {
      if (value) {
        document.documentElement.classList.add('dark');
        document.documentElement.classList.remove('light');
      } else {
        document.documentElement.classList.remove('dark');
        document.documentElement.classList.add('light');
      }
      window.localStorage.setItem('dark', value);
    };

    return {
      isDark: getTheme(),
      toggleTheme() {
        this.isDark = !this.isDark;
        setTheme(this.isDark);
      },
      initializeTheme() {
        setTheme(this.isDark);
      }
    };
  };

  // Esegui la configurazione al caricamento della pagina
  document.addEventListener('DOMContentLoaded', () => {
    const themeController = setup();
    themeController.initializeTheme();

    // Assegna il toggle al pulsante
    const themeToggleBtn = document.getElementById('theme-toggle');
    themeToggleBtn.addEventListener('click', () => {
      themeController.toggleTheme();
    });
  });