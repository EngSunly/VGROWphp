<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php 

    session_start();
    function Connection(){
        $connection = new mysqli('127.0.0.1','root','','testdatabase');

        return $connection;
    }
    

    function AddTeacher(){
        if(isset($_POST['btn-add-teacher'])){
            // echo 123;
            $name= $_POST['name'];
            $img = $_FILES['img']['name'];
            $active= $_POST['active'];
            // echo $status.$img;
            if(!empty($name) && !empty($img)&& !empty($active)){
                $img = date('dmyhis').'-'.$img;
                $path = './assets/Teacher/'.$img;
                move_uploaded_file($_FILES['img']['tmp_name'],$path);
                $sql = "INSERT INTO `teacher`(`Name`,`Image`,`Active`) VALUES('$name','$img','$active')";
                $rs = Connection()->query($sql);
                if($rs){
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Teacher Insert Success",
                                icon: "success",
                                button: "Done",
                              });
                        });
                    </script>
                '; 
                }
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "You missed some field",
                                icon: "error",
                                button: "Done",
                              });
                        });
                    </script>
                ';
            }

        }
    }
    AddTeacher();

    function ViewTeacher(){

        if(empty($_GET['page'])){
            $page=1;
      }
      else
        $page=$_GET['page'];
        $current_page=($page-1)*4;
        $sql = "SELECT * FROM `teacher` LIMIT $current_page,4";
        $rs  = Connection()->query($sql);
        while($row = mysqli_fetch_assoc($rs)){
            echo '
                <tr>  
                    <td>'.$row['ID'].'</td>
                    <td>'.$row['Name'].'</td>
                    <td><img src="./assets/Teacher/'.$row['Image'].'" width="100px"/></td>
                    <td>'.$row['Active'].'</td>
                    <td width="150px">
                        <a href="update-teacher.php?id='.$row['ID'].'" class="btn btn-primary">Update</a>
                        <button type="button" remove-id="'.$row['ID'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Remove
                        </button>
                    </td>
                </tr>
            
            ';
        } 
      
        
    }

    function UpdateTeacher(){
       
        $name= '';
        $img ='';  
        $active='';
        if(isset($_POST['btn-update-teacher'])){
            $id = $_GET['id'];
            $name= $_POST['name'];
            $img = $_FILES['img']['name'];  
            $active=$_POST['active'];

            if(empty($img)){
                $img = $_POST['old_img'];
            }
            else{
                $img = date('dmyhis').'-'.$img;
                $path = './assets/Teacher/'.$img;
                move_uploaded_file($_FILES['img']['tmp_name'],$path);
            }

            if(!empty($name) && !empty($active)){
                $sql = "UPDATE `teacher` SET `Name`='$name',`Image`='$img',`Active`='$active' WHERE `ID` = '$id'";
                $rs = Connection()->query($sql);
                if($rs){
        
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Teacher Update Success",
                                icon: "success",
                                button: "Done",
                              });
                        });
                    </script>
                ';  
               
                }
            }
        }
    }
    UpdateTeacher();

    function DeleteTeacher(){
        if(isset($_POST['btn-delete-teacher'])){
            // echo 123;
            $id = $_POST['remove_id'];

            $sql = "DELETE FROM `teacher` WHERE `ID` = '$id'";
            $rs  = Connection()->query($sql);
            if($rs){
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Success",
                            text: "Teacher Delete Success",
                            icon: "success",
                            button: "Done",
                          });
                    });
                </script>
            '; 
            }
        }
    }

    DeleteTeacher();

    function  pagination($tbName)
    {
        $sql="SELECT COUNT(`ID`) as 'TotalNews' FROM `$tbName`  ";
        $result=Connection()->query($sql);
        $row=mysqli_fetch_assoc($result);
        $total_news=$row['TotalNews'];
        $total_page=ceil($total_news/4) ;
           for($i=1;$i<=$total_page;$i++)
           {
              echo '<li>
                       <a href="view-'.$tbName.'.php?page='.$i.'" class="m-2">'.$i.'</a>
                    </li>
                    ';
           }
    }