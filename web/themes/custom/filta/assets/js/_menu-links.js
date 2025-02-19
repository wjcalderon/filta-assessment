/**
 * @file
 * Validations on menu items
 */


(function ($, Cookies) {
  $(document).ready(function () {
    // const bannerURL = Cookies.get('banner_url');
    // // Replace banner
    // $('.banner').html('<img src="' + bannerURL + '" alt="Banner">');

    $('.menu-header-container-item_first-level_below-item a').click(function (e) {
      e.preventDefault();
      // Get the ID of the parent item
      let parentItemId = $(this).closest('li').parent().attr('data-menu-id');
      let elementLink = $(this).attr('href');
      // Request to obtain the image of the parent item
      $.ajax({
        url: '/get-parent-image/' + parentItemId,
        type: 'GET',
        success: function (data) {
          // Cookies.set('banner_url', data.image_url);
          // window.location.href = elementLink;
          $('.banner').html('<img width="1000" height="400" src="' + data.image_url + '" alt="Banner">');

        }
      });
    });


    $(document).click(function (e) {
      if (!$(e.target).closest('li.menu-header-container-item_first-level').length) {
        $('li.menu-header-container-item_first-level').removeClass('active');
        $('ul.menu-header-container-item_first-level_below').removeClass('active');
      }
    });

    $('li.menu-header-container-item_first-level').click(function (e) {
      if ($(this).attr('data-menu-id')) {
        if ($(this).hasClass('active')) {
          $(this).removeClass('active');
          $(this).find('ul').removeClass('active');
        } else {
          $(this).find('ul').addClass('active');
          $(this).addClass('active');
        }
      }
    });

    $('li.menu-header-container-item_first-level ul li').click(function (e) {
      e.stopPropagation();
    });

  });
})(jQuery, window.Cookies);
