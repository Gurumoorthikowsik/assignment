// Admin Log in
// $(document).on("submit","#adminLoginFrm", function(){
//    $.post("query/loginExe.php", $(this).serialize(), function(data){
//       if(data.res == "invalid")
//       {
//         Swal.fire(
//           'Invalid',
//           'Please input valid username / password',
//           'error'
//         )
//       }
//       else if(data.res == "success")
//       {
//         $('body').fadeOut();
//         window.location.href='home.php';
//       }
//    },'json');

//    return false;
// });




$(document).on("submit", "#addCourseFrm", function(e){
  e.preventDefault();
  
  $.ajax({
    type: "POST",
    url: "query/addCourseExe.php",
    data: $(this).serialize(),
    dataType: "json",
    success: function(data) {
      if(data.res === "exist") {
        toastr.error(data.course_name + ' Already Exist', 'Error');
        setTimeout(function() {
          window.location.reload();  // Refresh the entire page after 2 seconds
      }, 2000);
      } else if(data.res === "success") {
        toastr.success(data.course_name + ' Successfully Added', 'Success');
        setTimeout(function() {
          window.location.reload();  // Refresh the entire page after 2 seconds
      }, 2000);

      } else {
        toastr.error('There was a problem adding the course. Please try again.', 'Error');
        setTimeout(function() {
          window.location.reload();  // Refresh the entire page after 2 seconds
      }, 2000);
      }
    },
    error: function(xhr, status, error) {
      toastr.error('Something went wrong: ' + xhr.responseText, 'Error');
    }
  });
});

// Update Course swal Fire
// $(document).on("submit","#updateCourseFrm" , function(){
//   $.post("query/updateCourseExe.php", $(this).serialize() , function(data){
//      if(data.res == "success")
//      {
//         Swal.fire(
//             'Success',
//             'Selected course has been successfully updated!',
//             'success'
//           )
//           refreshDiv();
//      }
//   },'json')
//   return false;
// });


$(document).on("submit", "#updateCourseFrm", function(e) {
  e.preventDefault();

  var formData = $(this).serialize();
  console.log(formData);  // Log the data being sent to the server

  $.ajax({
      type: "POST",
      url: "updateCourseExe.php",
      data: formData,
      dataType: "json",
      success: function(data) {
          if (data.res === "success") {
              toastr.success('Selected course has been successfully updated!', 'Success');
              setTimeout(function() {
                  location.reload();
              }, 2000);
          } else {
              toastr.error('There was a problem updating the course. Please try again.', 'Error');
          }
      },
      error: function(xhr, status, error) {
          toastr.error('Something went wrong: ' + xhr.responseText, 'Error');
      }
  });
});




// Delete Course
// $(document).on("click", "#deleteCourse", function(e){
//     e.preventDefault();
//     var id = $(this).data("id");
//      $.ajax({
//       type : "post",
//       url : "query/deleteCourseExe.php",
//       dataType : "json",  
//       data : {id:id},
//       cache : false,
//       success : function(data){
//         if(data.res == "success")
//         {
//           Swal.fire(
//             'Success',
//             'Selected Course successfully deleted',
//             'success'
//           )
//           refreshDiv();
//         }
//       },
//       error : function(xhr, ErrorStatus, error){
//         console.log(status.error);
//       }

//     });
    
   

//     return false;
//   });

$(document).on("click", "#deleteCourse", function(e) {
  e.preventDefault();
  var id = $(this).data("id");

  if (!id) {
      toastr.error('Course ID is missing.', 'Error');
      return;
  }

  $.ajax({
      type: "POST",
      url: "query/deleteCourseExe.php",
      dataType: "json",
      data: { id: id },
      cache: false,
      success: function(data) {
          if (data.res === "success") {
              toastr.success('Selected course successfully deleted', 'Success');
              setTimeout(function() {
                  window.location.reload();  // Refresh the entire page after 2 seconds
              }, 2000);
          } else {
              toastr.error('There was a problem deleting the course. Please try again.', 'Error');
          }
      },
      error: function(xhr, status, error) {
          toastr.error('Something went wrong: ' + xhr.responseText, 'Error');
      }
  });

  return false;
});


// Delete Exam
$(document).on("click", "#deleteExam", function(e) {
  e.preventDefault();
  var id = $(this).data("id");
  $.ajax({
      type: "post",
      url: "query/deleteExamExe.php",
      dataType: "json",  
      data: {id:id},
      cache: false,
      success: function(data) {
          if(data.res == "success") {
              toastr.success('Selected Course successfully deleted');
              setTimeout(function() {
                  location.reload(); // Refresh the page
              }, 2000); // Delay for 2 seconds before reloading the page
          }
      },
      error: function(xhr, ErrorStatus, error) {
          console.log(error);
          toastr.error('Something went wrong while deleting the course.');
      }
  });

  return false;
});



// Add Exam 
// $(document).on("submit","#addExamFrm" , function(){
//   $.post("query/addExamExe.php", $(this).serialize() , function(data){
//     if(data.res == "noSelectedCourse")
//    {
//       Swal.fire(
//           'No Course',
//           'Please select course',
//           'error'
//        )
//     }
//     if(data.res == "noSelectedTime")
//    {
//       Swal.fire(
//           'No Time Limit',
//           'Please select time limit',
//           'error'
//        )
//     }
//     if(data.res == "noDisplayLimit")
//    {
//       Swal.fire(
//           'No Display Limit',
//           'Please input question display limit',
//           'error'
//        )
//     }

//      else if(data.res == "exist")
//     {
//       Swal.fire(
//         'Already Exist',
//         data.examTitle.toUpperCase() + '<br>Already Exist',
//         'error'
//       )
//     }
//     else if(data.res == "success")
//     {
//       Swal.fire(
//         'Success',
//         data.examTitle.toUpperCase() + '<br>Successfully Added',
//         'success'
//       )
//           $('#addExamFrm')[0].reset();
//           $('#course_name').val("");
//             refreshDiv();
//     }
//   },'json')
//   return false;
// });


$(document).on("submit", "#addExamFrm", function(e) {
  e.preventDefault();

  $.post("query/addExamExe.php", $(this).serialize(), function(data) {
      if (data.res === "noSelectedCourse") {
          toastr.error('Please select a course', 'No Course');
      } else if (data.res === "noSelectedTime") {
          toastr.error('Please select a time limit', 'No Time Limit');
      } else if (data.res === "noDisplayLimit") {
          toastr.error('Please input a question display limit', 'No Display Limit');
      } else if (data.res === "exist") {
          toastr.error(data.examTitle.toUpperCase() + ' already exists', 'Already Exist');
      } else if (data.res === "success") {
          toastr.success(data.examTitle.toUpperCase() + ' successfully added', 'Success');
          $('#addExamFrm')[0].reset();
          setTimeout(function() {
              window.location.reload();  // Refresh the page after 2 seconds
          }, 2000);
      } else {
          toastr.error('An error occurred. Please try again.', 'Error');
      }
  }, 'json');

  return false;
});


// Update Exam 
// $(document).on("submit","#updateExamFrm" , function(){
//   $.post("query/updateExamExe.php", $(this).serialize() , function(data){
//     if(data.res == "success")
//     {
//       Swal.fire(
//           'Update Successfully',
//           data.msg + ' <br>are now successfully updated',
//           'success'
//        )
//           refreshDiv();
//     }
//     else if(data.res == "failed")
//     {
//       Swal.fire(
//         "Something's went wrong!",
//          'Somethings went wrong',
//         'error'
//       )
//     }
   
//   },'json')
//   return false;
// });


$(document).on("submit", "#updateExamFrm", function() {
  $.post("query/updateExamExe.php", $(this).serialize(), function(data) {
    if(data.res == "success") {
      toastr.success(data.msg + ' <br>successfully updated');
      setTimeout(function() {
        location.reload();
      }, 1500); // Reloads the page after 1.5 seconds
    } else if(data.res == "failed") {
      toastr.error("Something's went wrong!");
    }
  }, 'json');
  return false;
});


// Update Question
$(document).on("submit","#updateQuestionFrm" , function(){
  $.post("query/updateQuestionExe.php", $(this).serialize() , function(data){
     if(data.res == "success")
     {
        Swal.fire(
            'Success',
            'Selected question has been successfully updated!',
            'success'
          )
          refreshDiv();
     }
  },'json')
  return false;
});


// Delete Question
$(document).on("click", "#deleteQuestion", function(e){
    e.preventDefault();
    var id = $(this).data("id");
     $.ajax({
      type : "post",
      url : "query/deleteQuestionExe.php",
      dataType : "json",  
      data : {id:id},
      cache : false,
      success : function(data){
        if(data.res == "success")
        {
          Swal.fire(
            'Deleted Success',
            'Selected question successfully deleted',
            'success'
          )
          refreshDiv();
        }
      },
      error : function(xhr, ErrorStatus, error){
        console.log(status.error);
      }

    });
    
   

    return false;
  });


// Add Question 
// $(document).on("submit","#addQuestionFrm" , function(){
//   $.post("query/addQuestionExe.php", $(this).serialize() , function(data){
//     if(data.res == "exist")
//     {
//       Swal.fire(
//           'Already Exist',
//           data.msg + ' question <br>already exist in this exam',
//           'error'
//        )
//     }
//     else if(data.res == "success")
//     {
//       Swal.fire(
//         'Success',
//          data.msg + ' question <br>Successfully added',
//         'success'
//       )
//         $('#addQuestionFrm')[0].reset();
//         refreshDiv();
//     }
   
//   },'json')
//   return false;
// });


$(document).on("submit", "#addQuestionFrm", function() {
  $.post("query/addQuestionExe.php", $(this).serialize(), function(data) {
    if (data.res == "exist") {
      toastr.error(data.msg + ' question already exists in this exam', 'Already Exist');
    } else if (data.res == "success") {
      toastr.success(data.msg + ' question successfully added', 'Success');
      $('#addQuestionFrm')[0].reset();
      setTimeout(function() {
        location.reload();  // Refresh the page after a short delay
      }, 1000); // Adjust the delay as needed
    }
  }, 'json');
  return false;
});


// Add Examinee
// $(document).on("submit","#addExamineeFrm" , function(){
//   $.post("query/addExamineeExe.php", $(this).serialize() , function(data){
//     if(data.res == "noGender")
//     {
//       Swal.fire(
//           'No Gender',
//           'Please select gender',
//           'error'
//        )
//     }
//     else if(data.res == "noCourse")
//     {
//       Swal.fire(
//           'No Course',
//           'Please select course',
//           'error'
//        )
//     }
//     else if(data.res == "noLevel")
//     {
//       Swal.fire(
//           'No Year Level',
//           'Please select year level',
//           'error'
//        )
//     }
//     else if(data.res == "fullnameExist")
//     {
//       Swal.fire(
//           'Fullname Already Exist',
//           data.msg + ' are already exist',
//           'error'
//        )
//     }
//     else if(data.res == "emailExist")
//     {
//       Swal.fire(
//           'Email Already Exist',
//           data.msg + ' are already exist',
//           'error'
//        )
//     }
//     else if(data.res == "success")
//     {
//       Swal.fire(
//           'Success',
//           data.msg + ' are now successfully added',
//           'success'
//        )
//         refreshDiv();
//         $('#addExamineeFrm')[0].reset();
//     }
//     else if(data.res == "failed")
//     {
//       Swal.fire(
//           "Something's Went Wrong",
//           '',
//           'error'
//        )
//     }


    
//   },'json')
//   return false;
// });

$(document).on("submit", "#addExamineeFrm", function() {


  alert(123);
  
  $.post("query/addExamineeExe.php", $(this).serialize(), function(data) {
    if (data.res == "noGender") {
      toastr.error('Please select gender', 'No Gender');
    } else if (data.res == "noCourse") {
      toastr.error('Please select course', 'No Course');
    } else if (data.res == "noLevel") {
      toastr.error('Please select year level', 'No Year Level');
    } else if (data.res == "fullnameExist") {
      toastr.error(data.msg + ' are already exist', 'Fullname Already Exist');
    } else if (data.res == "emailExist") {
      toastr.error(data.msg + ' are already exist', 'Email Already Exist');
    } else if (data.res == "success") {
      toastr.success(data.msg + ' are now successfully added', 'Success');
      $('#addExamineeFrm')[0].reset();
      setTimeout(function() {
        location.reload(); // Reload the page
      }, 2000); // 2 seconds delay before reloading
    } else if (data.res == "failed") {
      toastr.error('Something went wrong', "Something's Went Wrong");
    }
  }, 'json');
  return false;
});



// Update Examinee
// $(document).on("submit","#updateExamineeFrm" , function(){
//   $.post("query/updateExamineeExe.php", $(this).serialize() , function(data){
//      if(data.res == "success")
//      {
//         Swal.fire(
//             'Success',
//             data.exFullname + ' <br>has been successfully updated!',
//             'success'
//           )
//           refreshDiv();
//      }
//   },'json')
//   return false;
// });



// $(document).on("submit","#updateExamineeFrm", function(){
//   $.post("query/updateExamineeExe.php", $(this).serialize(), function(data){
//     if(data.res == "success") {
//       toastr.success(data.exFullname + ' has been successfully updated!');
//       setTimeout(function() {
//         location.reload(); // Refresh the page after 2 seconds
//       }, 2000);
//     } else if(data.res == "failed") {
//       toastr.error("Something went wrong while updating.");
//     }
//   }, 'json');
//   return false;
// });


$(document).on("submit", "#updateExamineeFrm", function(event) {
  event.preventDefault(); // Prevent default form submission

  var formData = $(this).serialize(); // Serialize form data

  console.log("Updating Data:", formData); // Debugging log

  var submitButton = $("button[type='submit']");
  submitButton.prop("disabled", true).html("Updating...");

  var loader = $("<div class='loader'></div>").appendTo("body"); // Show loader

  $.ajax({
    url: "query/updateExamineeExe.php",
    type: "POST",
    data: formData,
    dataType: "json",
    success: function(response) {
      console.log("Response:", response); // Debugging log

      loader.remove();
      submitButton.prop("disabled", false).html("Update Now");

      if (response.res === "success") {
        toastr.success(response.msg);
        setTimeout(function() {
          location.reload();
        }, 2000);
      } else {
        toastr.error(response.msg || "Something went wrong while updating.");
      }
    },
    error: function(xhr, status, error) {
      console.error("AJAX Error:", status, error);
      console.error("Server Response:", xhr.responseText); 

      loader.remove();
      submitButton.prop("disabled", false).html("Update Now");

      toastr.error("AJAX request failed.");
    }
  });
});


// Delete user praddd
// $(document).on("click", "#deleteuser", function(e){
//   e.preventDefault();
//   var id = $(this).data("id");
//    $.ajax({
//     type : "post",
//     url : "query/delete.php",
//     dataType : "json",  
//     data : {id:id},
//     cache : false,
//     success : function(data){
//       if(data.res == "success")
//       {
//         Swal.fire(
//           'Success',
//           'Selected User successfully Updated',
//           'success'
//         )
//         refreshDiv();
//       }
//     },
//     error : function(xhr, ErrorStatus, error){
//       console.log(status.error);
//     }

//   });
  
 

//   return false;
// });

$(document).on("click", "#deleteuser", function(e) {
  e.preventDefault();
  var id = $(this).data("id");
  $.ajax({
    type: "post",
    url: "query/delete.php",
    dataType: "json",
    data: { id: id },
    cache: false,
    success: function(data) {
      if (data.res == "success") {
        toastr.success('Selected User successfully deleted');
        setTimeout(function() {
          location.reload();  // Refresh the page after a short delay
        }, 1000);  // 1 second delay before reload
      } else {
        toastr.error('Failed to delete user');
      }
    },
    error: function(xhr, ErrorStatus, error) {
      console.log(ErrorStatus + ": " + error);
      toastr.error('An error occurred while processing the request');
    }
  });
});




function refreshDiv(){
  $('#tableList').load(document.URL +  ' #tableList');
  $('#refreshData').load(document.URL +  ' #refreshData');
  $('#modalForExam').modal('hide')

}


