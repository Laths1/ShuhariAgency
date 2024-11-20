let currentIndex = 0;
const slides = document.querySelectorAll('.carousel-item');
const totalSlides = slides.length;

function showSlide(index) {
  if (index >= totalSlides) {
    currentIndex = 0; // Loop back to the first slide
  } else if (index < 0) {
    currentIndex = totalSlides - 1; // Loop back to the last slide
  } else {
    currentIndex = index;
  }

  // Move the carousel to show the current slide
  const offset = -currentIndex * 100;  // Calculate the percentage offset
  document.querySelector('.carousel-items').style.transform = `translateX(${offset}%)`;
}

function nextSlide() {
  showSlide(currentIndex + 1);
}

function prevSlide() {
  showSlide(currentIndex - 1);
}

