<?php 
    include('header.php');
    include('sidebar.php');

    $id = $_GET['id'];

    $sql = "SELECT * FROM `teacher` WHERE `ID` = '$id'";
    $rs = Connection()->query($sql);
    $row = mysqli_fetch_assoc($rs);

?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update Teacher info</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data" id="teacher-form">

                                   <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" id="name" value="<?php echo $row['Name'] ?>" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="img" id="img" class="form-control">
                                        <img id="show-img" src="../assets/Teacher/<?php echo $row['Image'] ?>" alt="" width="100px">

                                        <input type="hidden" name="old_img" id="" value="<?php echo $row['Image'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Active</label>
                                        <select class="form-select" name="active">
                                            <option value="yes" <?php if($row['Active']=="yes") echo 'selected' ?> >yes</option>
                                            <option value="no" <?php if($row['Active']=="no") echo 'selected' ?>>no</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn-update-teacher" id="btn-update-teacher" class="btn btn-success">Update Teacher</button>
                                    </div>
                                </form>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script>
    $(document).ready(function(){
        $('#img').change(function(){
            $('#show-img').hide();
        });
    });
   
</script>
</html>