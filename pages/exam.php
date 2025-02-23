<style>
  button#TooltipDemo{
      display: none !important;
  }

/*    #sticky {
padding: 0.5ex;
width: 600px;
background-color: #333;
color: #fff;
font-size: 2em;
border-radius: 0.5ex;

}*/

#sticky{
position: fixed;
top: 10;
padding-right: 10%;
z-index: 10000;
border-radius: 0 0 0.5em 0.5em;
}


@media only screen and (max-width: 600px) {

div#sticky {
  margin-left: 64%;
  margin-top: -19%;
}

}
</style>

<?php error_reporting(0);?>


<script type="text/javascript" >
   function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
</script>
 <?php 



    date_default_timezone_set('Asia/Kolkata');
    $examId = $_GET['id'];
    $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ")->fetch(PDO::FETCH_ASSOC);
    $exmneId = $_SESSION['examineeSession']['exmne_id'];
    $getTime = $conn->query("SELECT * FROM timer WHERE user_id='$exmneId' AND quiz_id = '$examId' ")->fetch(PDO::FETCH_ASSOC);
    $getTime['date_time'];
    $current_date = date('Y-m-d H:i:m');
    if(strtotime($getTime['date_time']) < strtotime($current_date)){

        $check_count = $conn->query("SELECT * FROM exam_attempt WHERE exmne_id='$exmneId' AND exam_id = '$examId'");
        if($check_count->rowCount() == 0){

             $insAttempt = $conn->query("INSERT INTO exam_attempt(exmne_id,exam_id)  VALUES('$exmneId','$examId') ");
             echo '<h1 style="padding-left:50%">Time Out</h1>';
             
              die;
         }else{
            echo '<h1 style="padding-left:50%">Time Out</h1>';

            die;
            // die;
         }
         

    }

    $datetime_1 = $getTime['date_time']; 
    $datetime_2 = date('Y-m-d H:i:s'); 

    $start_datetime = new DateTime($datetime_1); 
    $diff = $start_datetime->diff(new DateTime($datetime_2)); 
    $min = $diff->i; 
    $sec = $diff->s;

    $selExamTimeLimit = $selExam['ex_time_limit'];
    $exDisplayLimit = $selExam['ex_questlimit_display'];
 ?>


<div class="app-main__outer">
<div class="app-main__inner">
    <div class="col-md-12">
    
         <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>
                            <?php echo $selExam['ex_title']; ?>
                            <div class="page-title-subheading">
                              <?php echo $selExam['ex_description']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="page-title-actions mr-5" style="font-size: 20px;">
                        <form name="cd">
                          <input type="hidden" name="" id="timeExamLimit" value="<?php echo $min; ?>">

                          <input type="hidden" name="" id="timeExamLimitsec" value="<?php echo $sec; ?>">

                          <center>
                          <!-- <div id="sticky"> -->
                          <input style="border:none;background-color: transparent;color:blue;font-size: 25px;" name="disp" type="text" class="clock" id="txt" value="00:00" size="5" readonly="true" />
                          </center>
                      </form> 
                    </div>   
                 </div>
            </div> 
    </div>

    <div class="col-md-12 p-0 mb-4">
      
      <form method="post" id="submitAnswerFrm">
        <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $examId; ?>">
        <input type="hidden" name="examAction" id="examAction">
    
        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
            <?php 
            $stmt = $conn->prepare("SELECT * FROM exam_question_tbl WHERE exam_id = :examId ORDER BY RAND() LIMIT :exDisplayLimit");
            $stmt->bindValue(':examId', $examId, PDO::PARAM_INT);
            $stmt->bindValue(':exDisplayLimit', $exDisplayLimit, PDO::PARAM_INT);
            $stmt->execute();
            $selQuest = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            if ($selQuest) {
                $i = 1;
                foreach ($selQuest as $selQuestRow) {
                    $questId = $selQuestRow['eqt_id'];
            ?>
            <tr>
                <td>
                    <p><b><?php echo $i++; ?>.) <?php echo htmlspecialchars($selQuestRow['exam_question'], ENT_QUOTES, 'UTF-8'); ?></b></p>
                    <div class="col-md-4 float-left">
                        <div class="form-group pl-4">
                            <input name="answer[<?php echo $questId; ?>][correct]" 
                                   value="<?php echo htmlspecialchars($selQuestRow['exam_ch1'], ENT_QUOTES, 'UTF-8'); ?>" 
                                   class="form-check-input" type="radio" required>
                            <label class="form-check-label">
                                <?php echo htmlspecialchars($selQuestRow['exam_ch1'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        </div>
                        <div class="form-group pl-4">
                            <input name="answer[<?php echo $questId; ?>][correct]" 
                                   value="<?php echo htmlspecialchars($selQuestRow['exam_ch2'], ENT_QUOTES, 'UTF-8'); ?>" 
                                   class="form-check-input" type="radio" required>
                            <label class="form-check-label">
                                <?php echo htmlspecialchars($selQuestRow['exam_ch2'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-8 float-left">
                        <div class="form-group pl-4">
                            <input name="answer[<?php echo $questId; ?>][correct]" 
                                   value="<?php echo htmlspecialchars($selQuestRow['exam_ch3'], ENT_QUOTES, 'UTF-8'); ?>" 
                                   class="form-check-input" type="radio" required>
                            <label class="form-check-label">
                                <?php echo htmlspecialchars($selQuestRow['exam_ch3'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        </div>
                        <div class="form-group pl-4">
                            <input name="answer[<?php echo $questId; ?>][correct]" 
                                   value="<?php echo htmlspecialchars($selQuestRow['exam_ch4'], ENT_QUOTES, 'UTF-8'); ?>" 
                                   class="form-check-input" type="radio" required>
                            <label class="form-check-label">
                                <?php echo htmlspecialchars($selQuestRow['exam_ch4'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        </div>
                    </div>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td style="padding: 20px;">
                    <input name="submit" type="submit" value="Submit" class="btn btn-primary float-right" id="submitBtn">
                </td>
            </tr>
            <?php } else { ?>
                <b>No question at this moment</b>
            <?php } ?>
        </table>
    </form>
    


    </div>
</div>
 
<script type="text/javascript">
    function sticky_relocate() {
  var window_top = $(window).scrollTop();
  var div_top = $('#sticky-anchor').offset().top;
  if (window_top > div_top) {
    $('#sticky').addClass('stick');
  } else {
    $('#sticky').removeClass('stick');
  }
}

$(function() {
  $(window).scroll(sticky_relocate);
  sticky_relocate();
});
</script>