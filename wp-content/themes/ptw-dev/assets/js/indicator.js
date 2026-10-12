const bars = document.querySelectorAll('.indicator span');
const sections = document.querySelectorAll('section');

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const i = [...sections].indexOf(entry.target);
      bars.forEach((bar, n) => bar.classList.toggle('active', n === i));
    }
  });
}, { rootMargin: '-50% 0px -50% 0px' });

sections.forEach(s => observer.observe(s));
