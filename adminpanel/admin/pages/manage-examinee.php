<?php @ini_set('display_errors', 0); ?>

<link rel="stylesheet" type="text/css" href="css/mycss.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css"> -->

<style>
    div#table_filter {
    margin-left: 64%;
}
</style>


<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>MANAGE EXAMINEE</div>
                    </div>
                </div>
            </div>        
            
            <div class="col-md-12">
                <div class="main-card mb-3 p-3card">
                    <div class="card-header">Examinee List
                    </div>
                    <div class="table-responsive p-2">
                        <table class="table table-striped" id="table" style="width:100%">
                            <thead>
                            <tr>
                                <th>SI.No</th>
                                <th>Fullname</th>
                                <th>Gender</th>
                                <th>Course</th>
                                <th>username</th>
                                <th>Password</th>
                                <th>status</th>
                                <th>Action</th>
                                <th>Allow</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                              <?php 
                                $selExmne = $conn->query("SELECT * FROM examinee_tbl ORDER BY exmne_id DESC ");
                                if($selExmne->rowCount() > 0)
                                {
                                    while ($selExmneRow = $selExmne->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td> <?php echo $no; ?>  </td>
                                           <td><?php echo $selExmneRow['exmne_fullname']; ?></td>
                                           <td><?php echo $selExmneRow['exmne_gender']; ?></td>
                                           
                                           <td>
                                            <?php 
                                                 $exmneCourse = $selExmneRow['exmne_course'];
                                                 $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$exmneCourse' ")->fetch(PDO::FETCH_ASSOC);
                                                 echo $selCourse['cou_name'];
                                             ?>
                                            </td>
                                           <td><?php echo $selExmneRow['exmne_email']; ?></td>
                                           <td><?php echo $selExmneRow['exmne_password']; ?></td>
                                           <td><?php echo $selExmneRow['exmne_status']; ?></td>
                                           <td>
                                               <a rel="facebox" href="facebox_modal/updateExaminee.php?id=<?php echo $selExmneRow['exmne_id']; ?>" class="btn btn-sm btn-primary">Update</a>
                                           </td>
                                           <td>
                                            
                                           <button type="button" id="deleteuser" data-id='<?php echo $selExmneRow['exmne_id']; ?>'  class="btn btn-success btn-sm">Allow</button>
                                           

                                           </td>
                                        </tr>

                                        <?php 
                                             $no ++;
                                        ?> 
                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="2">
                                        <h3 class="p-3">No Course Found</h3>
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
   $('#table').dataTable( {
  "searching": true
} );

</script>

