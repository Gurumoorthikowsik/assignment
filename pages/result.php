 <?php 
    $examId = $_GET['id'];
    $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ")->fetch(PDO::FETCH_ASSOC);

 ?>

<style>
    button#TooltipDemo{

        display: none !important;
    }
</style>
<div class="app-main__outer">
<div class="app-main__inner">
    <div id="refreshData">
            
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
            </div>
        </div>  

      
        <div class="row col-md-12">
        	<h1 class="text-primary">RESULT'S</h1>
        </div>

        <div class="row col-md-6 float-left">
        	<div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Your Answers</h5>
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                        <?php 
                        $selQuest = $conn->prepare("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE eqt.exam_id = :examId AND ea.axmne_id = :exmneId AND ea.exans_status = 'new'");
                        $selQuest->bindParam(':examId', $examId, PDO::PARAM_INT);
                        $selQuest->bindParam(':exmneId', $exmneId, PDO::PARAM_INT);
                        $selQuest->execute();
                        
                        $i = 1;
                        while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td>
                                    <b><p><?php echo htmlspecialchars($i++) . ".) " . htmlspecialchars($selQuestRow['exam_question']); ?></p></b>
                                    <label class="pl-4 text-success">
                                        Your Answer : 
                                        <?php 
                                        if ($selQuestRow['exam_answer'] !== $selQuestRow['exans_answer']) { ?>
                                            <span style="color:red"> <?php echo htmlspecialchars($selQuestRow['exans_answer']); ?></span><br>
                                            Correct Answer : <span style="color:green"> <?php echo htmlspecialchars($selQuestRow['exam_answer']); ?></span>
                                        <?php } else { ?>
                                            <span class="text-success"> <?php echo htmlspecialchars($selQuestRow['exans_answer']); ?></span>
                                        <?php } ?>
                                    </label>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                
            </div>
        </div>

        <div class="col-md-6 float-left">
        	<div class="col-md-6 float-left">
        	<div class="card mb-3 widget-content bg-night-fade">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h5>Score</h5></div>
                        <div class="widget-subheading" style="color: transparent;">/</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <?php 
                                $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer = ea.exans_answer  WHERE ea.axmne_id='$exmneId' AND ea.exam_id='$examId' AND ea.exans_status='new' ");
                            ?>
                            <span>
                                <?php echo $selScore->rowCount(); ?>
                                <?php 
                                    $over  = $selExam['ex_questlimit_display'];
                                 ?>
                            </span> / <?php echo $over; ?>
                        </div>
                    </div>
                </div>
            </div>
        	</div>

            <div class="col-md-6 float-left">
            <div class="card mb-3 widget-content bg-happy-green">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h5>Percentage</h5></div>
                        <div class="widget-subheading" style="color: transparent;">/</div>
                        </div>
                        <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <?php 
                                $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer = ea.exans_answer  WHERE ea.axmne_id='$exmneId' AND ea.exam_id='$examId' AND ea.exans_status='new' ");
                            ?>
                            <span>
                                <?php 
                                    $score = $selScore->rowCount();
                                    $ans = $score / $over * 100;
                                    echo number_format($ans,2);
                                    echo "%";
                                    
                                 ?>
                            </span> 
                        </div>
                    </div>
                </div>
            </div>
                                                    
            <?php 
   
                                                
    $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer = ea.exans_answer  WHERE ea.axmne_id='$exmneId' AND ea.exam_id='$examId' AND ea.exans_status='new' ");
    
    $score = $selScore->rowCount();
    $ans = $score / $over * 100;
    $formattedScore = number_format($ans,2);
  

    if($ans >= 50) {
       
        // echo ($selExmneeData['certificate']);
    
        $examId = $_GET['id'];
        $selExam = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_id ='$examId'")->fetch(PDO::FETCH_ASSOC);
       
    } else {
      
        echo '<button class="btn btn-danger">Better Luck Next Time!</button>';
        
    }
?>


            </div>
        </div>
    </div>

    
    </div>
    
</div>