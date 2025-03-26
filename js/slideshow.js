let currentSlide = 0;
const slides = document.querySelector('.slides');
const totalSlides = document.querySelectorAll('.slide').length;

function showSlide(index){
  currentSlide = index;
  if (currentSlide >= totalSlides){
    currentSlide = 0;
  }
  if (currentSlide < 0) {
    currentSlide = totalSlides - 1;
  }
  slides.style.transform = `translateX(-${currentSlide * 100}vw)`;
}

function nextSlide(){
    showSlide(currentSlide + 1 );
}

function prevSlide(){
  showSlide(currentSlide - 1);
}

setInterval(() => {
  nextSlide();
}, 3000);



document.addEventListener('DOMContentLoaded', function () {
  const productLists = document.querySelectorAll('.product-list');
  let lastScrollTop = window.pageYOffset || document.documentElement.scrollTop;

  function checkVisibility() {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      const isScrollingDown = scrollTop > lastScrollTop;

      productLists.forEach((productList, index) => {
          const rect = productList.getBoundingClientRect();
          const windowHeight = window.innerHeight || document.documentElement.clientHeight;
          const nextProductList = productLists[index + 1];

          if (isScrollingDown) {
              if (rect.bottom <= windowHeight && nextProductList && nextProductList.getBoundingClientRect().top <= windowHeight) {
                  productList.classList.add('hidden');
              }
          } else {
              if (rect.top >= 0 && rect.bottom <= windowHeight) {
                  productList.classList.remove('hidden');
              }
          }
      });

      lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
  }

  window.addEventListener('scroll', checkVisibility);
  window.addEventListener('resize', checkVisibility);

  // Initial check
  checkVisibility();
});
