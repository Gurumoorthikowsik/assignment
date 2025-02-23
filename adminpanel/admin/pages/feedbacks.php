<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">

<div class="app-main__outer">
        <div class="app-main__inner">
                <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div><b>RANKING BY EXAM</b></div>
                    </div>
                </div>
                </div> 

                 <div class="col-md-12">
                <div class="main-card mb-3 p-4 card">
                    <div class="card-header">Feedback's List
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered"   style="width:100%" id="tableList1">
                            <thead class="thead-dark">
                            <tr>
                                <th>SI.NO</th>
                                <th class="text-left pl-4" width="20%">Examinee</th>
                                <th class="text-left ">Feedbacks</th>
                                <th class="text-center" width="15%">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                              
                              <?php 
                                $selExam = $conn->query("SELECT * FROM feedbacks_tbl ORDER BY fb_id DESC ");
                                if($selExam->rowCount() > 0)
                                {
                                    while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td class="pl-4"><?php echo $selExamRow['fb_exmne_as']; ?></td>
                                            <td><?php echo $selExamRow['fb_feedbacks']; ?></td>
                                            <td><?php echo $selExamRow['fb_date']; ?></td>
                                        </tr>
                                        <?php $no ++; ?>

                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="5">
                                        <h3 class="p-3">No Feedback found</h3>
                                      </td>
                                    </tr>
                                     
                                   
                                <?php }
                               ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>   
                    
     
      
        
</div>
         

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>

<script>

   $('#tableList1').dataTable( {
  "searching": true
} );

</script>















