// // $help_page = $('[data-id="help_page"]');

// // $help_page.on("click", function() {
// //   console.log('calling')
// // })

// $(document).ready(function() {

//   $('img').click(function(event) {
//     console.log(event)
//   })

//   // Handle button click event
//   $('[data-id="help_page"]').click(function() {
//     // Get the ID from the data-id attribute
//     var id = $(this).data("id");
//     console.log(id);

//     openModal();
    
//     // Make AJAX call to retrieve the data
//     $.ajax({
//       url: "/get-data/" + id,
//       success: function(data) {
//         // console.log(data)
//         // Update the modal's content with the retrieved data
//         $("#content-modal").html(data);
//       }
//     });
//   });
// });


// $modalLargeAnchor = $(".faith-test");

// // Launch Command Module
// function openModal() {
//   $modalLargeAnchor.show();
//   setTimeout(function() {
//      $modalLargeBackdrop.fadeIn("slow");
//    }, 20);
//    setTimeout(function() {
//       $postingToolOuter.toggle( "slide", { direction: "up"  }, 700 );
//     }, 225);
// };


