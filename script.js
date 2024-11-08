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

// contact us
function sendContactMail(){
  let param = {
    from_name : document.getElementById("contact-name").value,
    message : document.getElementById("contact-message").value,
    from_email : document.getElementById("contact-email").value,
  }
  emailjs.send("service_3ix5u63", "template_bsc94np", param).then(alert("Message has been sent successfully from: " + param.from_name));
}
// application
function getSelectedOption() {
  const options = document.getElementsByName("option");
  for (let i = 0; i < options.length; i++) {
    if (options[i].checked) {
      return options[i].value; // Get the value of the selected radio button
    }
  }
  return null; // Return null if no option is selected
}
function sendApplyMail(){
  let param = {
    from_name : document.getElementById("apply-name").value,
    message : document.getElementById("apply-message").value,
    from_email : document.getElementById("apply-email").value,
    category : getSelectedOption(),

  }
  emailjs.send("service_3ix5u63", "template_4sgz0wt", param).then(alert("Application has been sent successfully from: " + param.from_name));
 
}