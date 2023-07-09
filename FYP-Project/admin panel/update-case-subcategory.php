<?php 
include ("./include/connection.php");
$csubid=$_GET['csubid'];
$sql="SELECT * FROM `case-subcategory` cs INNER JOIN `case-type` ct ON cs.ctype=ct.caseid INNER JOIN `case-category`cc ON cs.cctg=cc.cctgid WHERE `csubid`='$csubid'";
$run=mysqli_query($conn,$sql);
$fet=mysqli_fetch_assoc($run);
if(isset($_POST['update'])){
    $ctype=mysqli_real_escape_string($conn,$_POST['ctype']);
    $cctg=mysqli_real_escape_string($conn,$_POST['cctg']);
    $csubctg=mysqli_real_escape_string($conn,$_POST['csubctg']);

   
    $usql="UPDATE `case-subcategory` SET `ctype`='$ctype' , `cctg`='$cctg' , `csubctg`='$csubctg' WHERE `csubid`='$csubid'";
    $urun=mysqli_query($conn,$usql);
    if ($urun){
        echo "<script>alert ('case-Subcategory has been updated')</script>";
        header("Refresh:0, url=./add-case-subcategory.php");
      }
      else{
        echo "<script>alert ('case-Subcategory has not been updated')</script>";
      }
}
include ("./include/header.php");
include ("./include/sidebar.php");
?>

<div class="container-fluid pt-4 px-4 ">
        <div class="bg-light rounded h-100 p-4">
            <h4 class="mb-4 d-flex justify-content-center text-success">Update Case Category</h4>
            <form  method="post" >
            <div class="mb-3 col-lg-4">
                        <label class="form-label">Case Type</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="ctype">
                        <option value="<?php echo $fet['caseid'] ?>"><?php echo $fet['casetype']; ?></option>
                    <?php 
                       $tsql="SELECT * FROM `case-type`";
                        $trun=mysqli_query($conn,$tsql);
                        while($tfet=mysqli_fetch_assoc($trun)){
                    ?>
                    <option value="<?php echo $tfet['caseid'] ?>"><?php echo $tfet['casetype']; ?></option>
                    <?php
                        }
                    ?>
                        </select>
                    </div>
                    <div class="mb-3 col-lg-4">
                        <label class="form-label">Case Category</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="cctg">
                        <option value="<?php echo $fet['cctgid'] ?>"><?php echo $fet['casectg']; ?></option>
                    <?php 
                       $csql="SELECT * FROM `case-category`";
                        $crun=mysqli_query($conn,$csql);
                        while($cfet=mysqli_fetch_assoc($crun)){
                    ?>
                    <option value="<?php echo $cfet['cctgid'] ?>"><?php echo $cfet['casectg']; ?></option>
                    <?php
                        }
                    ?>
                        </select>
                    </div>
                <div class="mb-3 col-lg-4">
                    <label class="form-label" for="csubctg">Case category</label>
                    <input type="text" class="form-control" id="csubctg" name="csubctg" value="<?php echo $fet['casectg']; ?>"/>
                </div>
                </div>
                    <button type="submit" class="btn btn-primary bg-success" name="update">Update </button>
                </div>
            </form>
        </div>
</div>

<?php include ('./include/footer.php'); ?>