$(document).ready(function(){
  $(".block").draggable({
    revert: true
  });

  $(".block").droppable({
    drop: function(event, draggedElement) {
      var droppedNumber = draggedElement.draggable.attr("data-number");
      var targetNumber = $(this).attr("data-number");
      if (droppedNumber == targetNumber) {
        $(this).text(droppedNumber);
        $(this).attr("data-number", droppedNumber);
        draggedElement.draggable.remove();
        $(this).addClass("correct");
      }
    }
  });
});
