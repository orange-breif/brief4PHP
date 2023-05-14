// const productContainers = [...document.querySelectorAll('.product-container')];
// const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
// const preBtn = [...document.querySelectorAll('.pre-btn')];

// productContainers.forEach((item, i) => {
//     let containerDimensions = item.getBoundingClientRect();
//     let containerWidth = containerDimensions.width;

//     nxtBtn[i].addEventListener('click', () => {
//         item.scrollLeft += containerWidth;
//     })

//     preBtn[i].addEventListener('click', () => {
//         item.scrollLeft -= containerWidth;
//     })
// })
const productContainers = [...document.querySelectorAll('.product-container')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

productContainers.forEach((container, i) => {
  const cards = container.querySelectorAll('.product-card');
  const cardWidth = cards[0].getBoundingClientRect().width;
  let scrollAmount = 0;

  nxtBtn[i].addEventListener('click', () => {
    if (scrollAmount < (cards.length - 1) * cardWidth) {
      scrollAmount += cardWidth;
      container.scroll({
        left: scrollAmount,
        behavior: 'smooth'
      });
    }
  });

  preBtn[i].addEventListener('click', () => {
    if (scrollAmount > 0) {
      scrollAmount -= cardWidth;
      container.scroll({
        left: scrollAmount,
        behavior: 'smooth'
      });
    }
  });
});
