jQuery(document).ready(function ($) {
  function loadBooks(page, category, initialCount) {
    $.ajax({
      url: ajax_object.ajax_url,
      type: "post",
      data: {
        action: "load_more_books",
        page: page,
        category: category,
        initial_count: initialCount,
      },
      success: function (response) {
        if (response.html) {
          if (page === 1) {
            $(".books-list").html(response.html);
          } else {
            $(".books-list").append(response.html);
          }
          $("#load-more-books").data("page", page + 1);
          if (!response.has_more_posts) {
            $("#load-more-books").hide();
          } else {
            $("#load-more-books").show();
          }
        } else {
          $("#load-more-books").hide();
        }
      },
    });
  }

  // Load initial books
  loadBooks(1, "", $("#load-more-books").data("count"));

  // Category click event
  $(".category-list a").on("click", function (e) {
    e.preventDefault();
    var category = $(this).data("category");
    $("#load-more-books").data("category", category).data("page", 1);
    loadBooks(1, category, $("#load-more-books").data("count"));
  });

  // Load more button click event
  $("#load-more-books").on("click", function () {
    var button = $(this);
    var page = button.data("page");
    var category = button.data("category");
    var initialCount = button.data("count");
    loadBooks(page, category, initialCount);
  });
});
