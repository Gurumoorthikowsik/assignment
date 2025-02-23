
// Submit Answer
// $(document).on('submit', '#submitAnswerFrm', function(){
//   var examAction = $('#examAction').val();
  

//   if(examAction != "")
//   {
//     Swal.fire({
//     title: 'Time Out',
//     text: "your time is over, please click ok",
//     icon: 'warning',
//     showCancelButton: false,
//     allowOutsideClick: false,
//     confirmButtonColor: '#3085d6',
//     cancelButtonColor: '#d33',
//     confirmButtonText: 'OK!'
// }).then((result) => {
// if (result.value) {

//    $.post("query/submitAnswerExe.php", $(this).serialize(), function(data){

//     if(data.res == "alreadyTaken")
//     {
//        Swal.fire(
//          'Already Taken',
//          "you already take this exam",
//          'error'
//        ) 
//     }
//     else if(data.res == "success")
//     {
//         Swal.fire({
//             title: 'Success',
//             text: "your answer successfully submitted!",
//             icon: 'success',
//             allowOutsideClick: false,
//             confirmButtonColor: '#3085d6',
//             confirmButtonText: 'OK!'
//         }).then((result) => {
//         if (result.value) {
//           $('#submitAnswerFrm')[0].reset();
//            var exam_id = $('#exam_id').val();
//            window.location.href='home.php?page=result&id=' + exam_id;
//         }

//         });


//     }
//     else if(data.res == "failed")
//     {
//      Swal.fire(
//          'Error',
//          "Something;s went wrong",
//          'error'
//        ) 
//     }

//    },'json');

// }
// });
//   }
//   else
//   {
//       Swal.fire({
//     title: 'Are you sure?',
//     text: "you want to submit your answer now?",
//     icon: 'warning',
//     showCancelButton: true,
//     allowOutsideClick: false,
//     confirmButtonColor: '#3085d6',
//     cancelButtonColor: '#d33',
//     confirmButtonText: 'Yes, submit now!'
// }).then((result) => {
// if (result.value) {

//    $.post("query/submitAnswerExe.php", $(this).serialize(), function(data){

//     if(data.res == "alreadyTaken")
//     {
//        Swal.fire(
//          'Already Taken',
//          "you already take this exam",
//          'error'
//        ) 
//     }
//     else if(data.res == "success")
//     {
//         Swal.fire({
//             title: 'Success',
//             text: "your answer successfully submitted!",
//             icon: 'success',
//             allowOutsideClick: false,
//             confirmButtonColor: '#3085d6',
//             confirmButtonText: 'OK!'
//         }).then((result) => {
//         if (result.value) {
//           $('#submitAnswerFrm')[0].reset();
//            var exam_id = $('#exam_id').val();
//            window.location.href='home.php?page=result&id=' + exam_id;
//         }

//         });


//     }
//     else if(data.res == "failed")
//     {
//      Swal.fire(
//          'Error',
//          "Something;s went wrong",
//          'error'
//        ) 
//     }

//    },'json');

// }
// });
//   }








// return false;
// });




$(document).on('submit', '#submitAnswerFrm', function(e){
    e.preventDefault(); // Prevent default form submission
    var examAction = $('#examAction').val();
    var submitBtn = $('#submitBtn');

    // Disable the button to prevent multiple clicks
    submitBtn.prop('disabled', true);

    function handleResponse(data) {
        if (data.res == "alreadyTaken") {
            Swal.fire('Already Taken', "You already took this exam", 'error');
        } else if (data.res == "success") {
            Swal.fire({
                title: 'Success',
                text: "Your answer was successfully submitted!",
                icon: 'success',
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK!'
            }).then((result) => {
                if (result.value) {
                    $('#submitAnswerFrm')[0].reset();
                    var exam_id = $('#exam_id').val();
                    window.location.href = 'home.php?page=result&id=' + exam_id;
                }
            });
        } else if (data.res == "failed") {
            Swal.fire('Error', "Something went wrong", 'error');
        }

        // Re-enable the button after response
        submitBtn.prop('disabled', false);
    }

    function submitForm() {
        $.post("query/submitAnswerExe.php", $(this).serialize(), function(data) {
            handleResponse(data);
        }, 'json');
    }

    if (examAction != "") {
        Swal.fire({
            title: 'Time Out',
            text: "Your time is over, please click OK",
            icon: 'warning',
            showCancelButton: false,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK!'
        }).then((result) => {
            if (result.value) {
                submitForm.call(this);
            } else {
                submitBtn.prop('disabled', false); // Re-enable button if user cancels
            }
        });
    } else {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to submit your answer now?",
            icon: 'warning',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit now!'
        }).then((result) => {
            if (result.value) {
                submitForm.call(this);
            } else {
                submitBtn.prop('disabled', false); // Re-enable button if user cancels
            }
        });
    }
});



// Submit Feedbacks
$(document).on("submit","#addFeebacks", function(){
   $.post("query/submitFeedbacksExe.php", $(this).serialize(), function(data){
      if(data.res == "limit")
      {
        Swal.fire(
          'Error',
          'You reached the 3 limit maximum for feedbacks',
          'error'
        )
      }
      else if(data.res == "success")
      {
        Swal.fire(
          'Success',
          'your feedbacks has been submitted successfully',
          'success'
        )
          $('#addFeebacks')[0].reset();
        
      }
   },'json');

   return false;
});

