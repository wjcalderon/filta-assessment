/**
 * @file
 * Managing product behaviors
 */

Drupal.behaviors.test = {
  attach(context) {
    document.querySelectorAll('.product-banner-content-btn.button-primary').forEach(function (button) {
      button.addEventListener('click', function () {
        let productId = this.getAttribute('nid');
        // Request to manage product of the day
        fetch('/save-featured-product/' + productId, {
          method: 'GET',
        })
          .then(response => response.json())
          .then(data => {
            console.log(data);
          })
          .catch(error => {
            console.log(error);
          })
          .finally(() => {
            window.location.href = '/product/' + productId;
          });
      });
    });
  },
};
