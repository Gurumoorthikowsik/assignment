$(document).on("click", "#startQuiz", function () {
  var thisId = $(this).data("id");

  console.log("thisId:", thisId);

  Swal.fire({
    title: "Are you sure?",
    text: "You want to take this exam now, your time will start automatically.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, start now!",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "post",
        url: "query/selExamAttemptExe.php",
        dataType: "json",
        data: { thisId: thisId },
        cache: false,
        success: function (data) {
          console.log("response values", data);

          if (data.res === "alreadyExam") {
            Swal.fire("Already Taken", "You have already taken this exam.", "error");
          } else if (data.res === "noques") {
            Swal.fire("No Questions", "No questions available at this moment.", "error");
          } else if (data.res === "takeNow") {
            window.location.href = "home.php?page=exam&id=" + thisId;
          } else if (data.res === "error") {
            Swal.fire("Error", data.msg, "error"); // Displays the specific error message from PHP
          }
        },
        error: function (xhr) {
          console.log("AJAX Error:", xhr.responseText);
          Swal.fire("Error", "An error occurred: " + xhr.responseText, "error");
        },
      });
    }
  });

  return false;
});


// Reset Exam Form
$(document).on("click","#resetExamFrm", function(){
      $('#submitAnswerFrm')[0].reset();
      return false;
});





// Select Time Limit
var mins
var secs;
var timeOut = $('#timeout').val();
function cd() {
  var timeExamLimit = $('#timeExamLimit').val();
  var timeExamLimitsec = $('#timeExamLimitsec').val();
  mins = 1 * m("" + timeExamLimit); // change minutes here
  secs = 0 + s(":"+timeExamLimitsec); 
  redo();
}

function m(obj) {
  for(var i = 0; i < obj.length; i++) {
      if(obj.substring(i, i + 1) == ":")
      break;
  }
  return(obj.substring(0, i));
}

function s(obj) {
  for(var i = 0; i < obj.length; i++) {
      if(obj.substring(i, i + 1) == ":")
      break;
  }
  return(obj.substring(i + 1, obj.length));
}

function dis(mins,secs) {
  var disp;
  if(mins <= 9) {
      disp = " 0";
  } else {
      disp = " ";
  }
  disp += mins + ":";
  if(secs <= 9) {
      disp += "0" + secs;
  } else {
      disp += secs;
  }
  return(disp);
}

function redo() {
  secs--;
  if(secs == -1) {
      secs = 59;
      mins--;
  }
  document.cd.disp.value = dis(mins,secs); 
  if((mins == 0) && (secs == 0) || timeOut == 'yes') {
    $('#examAction').val("autoSubmit");
     $('#submitAnswerFrm').submit();
  } else {
    cd = setTimeout("redo()",1000);
  }
}

function init() {
  cd();
}
window.onload = init;
