let menuButton = document.querySelector('#MenuButton');
let navigationBar = document.querySelector('.navigationBar');

menuButton.onclick = () => {
    menuButton.classList.toggle('fa-times');
    navigationBar.classList.toggle('active');
};

window.onscroll = () => {
    
    menuButton.classList.remove('fa-times');
    navigationBar.classList.remove('active');
};

document.querySelector('#searchIcon').onclick = () => {
   
    document.querySelector('#search').classList.toggle('active');
};

document.querySelector('#SearchClose').onclick = () => {
    
    document.querySelector('#search').classList.remove('active');
};

var swiper = new Swiper(".HomeSlider", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 5500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
   
    loop:true,
  });

  console.log("Initializing Swiper");

  document.addEventListener('DOMContentLoaded', function () {
    const faqs = document.querySelectorAll('.FAQ');

    faqs.forEach((faq) => {
        faq.addEventListener('click', () => {
            const isActive = faq.classList.toggle('active');
            const answer = faq.querySelector('.answer');

            if (isActive) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
            } else {
                answer.style.maxHeight = '0';
            }
        });
    });
});

function openForm() {
    document.getElementById("myForm").style.display = "block";
  }
  
  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }


  




    function continueShopping() {
      
      window.location.href = '../Client/Home.php #FoodMenu';
    }

  
  

 