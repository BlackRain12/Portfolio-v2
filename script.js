// Example of enhancing the parallax effect with JavaScript
document.addEventListener('scroll', function() {
    const parallaxElements = document.querySelectorAll('.parallax');
    parallaxElements.forEach(element => {
      let scrollPosition = window.pageYOffset;
      element.style.backgroundPositionY = -(scrollPosition * 0.5) + 'px'; // Adjust the multiplier to change the effect strength
    });
  });