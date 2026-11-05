<script>
      const menuBtn = document.querySelector('.menu-btn');
      const nav = document.querySelector('nav');
      const lineOne = document.querySelector('.line--1');
      const lineTwo = document.querySelector('.line--2');
      const lineThree = document.querySelector('.line--3');
      const linkContainer = document.querySelector('.nav-links');
      const links = document.querySelectorAll('.link');

      menuBtn.addEventListener('click', () => {
          nav.classList.toggle('nav-open');
          lineOne.classList.toggle('line-cross');
          lineTwo.classList.toggle('line-fade-out');
          lineThree.classList.toggle('line-cross');
          linkContainer.classList.toggle('fade-in');
      });

      // Close menu when a link is clicked
      links.forEach(link => {
          link.addEventListener('click', () => {
              nav.classList.remove('nav-open');
              lineOne.classList.remove('line-cross');
              lineTwo.classList.remove('line-fade-out');
              lineThree.classList.remove('line-cross');
              linkContainer.classList.remove('fade-in');
          });
      });
    </script>