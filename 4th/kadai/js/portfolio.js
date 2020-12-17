function updateTabs() {
  var tabs = {
      2: "About",
      4: "History",
      5: "Skills",
      6: "Works"
    },
    left = [],
    right = [],
    book = $(" #flipbook"),
    actualPage = book.turn("page"),
    view = book.turn("view");

  for (var page in tabs) {
    var isHere = $.inArray(parseInt(page, 10), view) != -1;

    if (page > actualPage && !isHere)
      right.push('<a href="#page/' + page + '">' + tabs[page] + "</a>");
    else if (isHere) {
      if (page % 2 === 0)
        left.push(
          '<a href="#page/' + page + '" class="on">' + tabs[page] + "</a>"
        );
      else
        right.push(
          '<a href="#page/' + page + '" class="on">' + tabs[page] + "</a>"
        );
    } else left.push('<a href="#page/' + page + '">' + tabs[page] + "</a>");
  }

  $(" #flipbook .tabs .left").html(left.join(""));
  $(" #flipbook .tabs .right").html(right.join(""));
}
