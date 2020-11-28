<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Blog</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <?php 
      define('DB_SERVER', 'localhost');
      define('DB_USERNAME', 'root');
      define('DB_PASSWORD', '');
      define('DB_NAME', 'blog');

      $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
      
      if($link === false){
        die("ERROR: Tidak bisa connect. " . mysqli_connect_error());
      }

      /* input user */
      if(isset($_POST['submitUser'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        $sql = "INSERT INTO user(id,name,email) VALUES('$id','$name','$email')";
        $result = mysqli_query($link, $sql);
      }

      /* input blog */
      if(isset($_POST['submitBlog'])){
        
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $file_image = $_FILES['file_image']['name'];
        $temp_name = $_FILES['file_image']['tmp_name'];
        $target =  __DIR__."/".basename($_FILES['file_image']['name']);
        $user_id = $_POST['user_id'];
        
        $sql = "INSERT INTO image_blog(id,title,content,file_image,user_id) VALUES('$id','$title','$content','$file_image',$user_id)";
        $result = mysqli_query($link, $sql);

        if (move_uploaded_file($temp_name,$target)){
            
        }
      }

      /* hapus user */
      if(isset($_POST['deleteUser']))
      {
        $delete = $_POST['deleteUser'];
        $sql = "DELETE FROM user where `id` = '$delete'"; 
        $result = mysqli_query($link, $sql);
      }

      /* hapus blog */
      if(isset($_POST['deleteBlog']))
      {
        $delete = $_POST['deleteBlog'];
        $id = $_POST['id'];
        $image = $_POST['image'];
        $sql = "DELETE FROM image_blog where id = '$id'"; 
        unlink($image);
        $result = mysqli_query($link, $sql);
      }

      /* edit user */
      if(isset($_POST['editUser']))
      {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        
        $sql = "UPDATE user SET name='$name', email='$email' WHERE id=$id"; 
        $result = mysqli_query($link, $sql);
      }

      /* edit blog */
      if(isset($_POST['editBlog']))
      {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $user_id = $_POST['user_id'];
        
        
        $sql = "UPDATE image_blog SET title='$title', content='$content', user_id='$user_id' WHERE id='$id'"; 
        $result = mysqli_query($link, $sql);

      }

    ?>
</head>
<body>
    <!-- Header -->
    <div class="row p-2 text-light bg-dark">
        <div class="col-md-4">
            <h1>Dumb Gram</h1>
        </div>
        <div class="col-md-8 text-right">
            <!-- Button trigger tambah blog -->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#formImageBlog">
            Tambahkan Image Blog
            </button>
            <!-- Button trigger tambah user -->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#formUser">
            Tambahkan User
            </button>
           
        </div>
           
    </div>

    <!-- Card list image blog-->
    <div class="row ml-4 mt-4 "><h2 class="text-center">List Image Blog</h2></div>                   
    <div class="row pl-5">
        
        <?php 
            $sql = "SELECT * FROM image_blog";
            $result = mysqli_query($link, $sql);

            while($row= mysqli_fetch_assoc($result)){ ?>
                <div class="card m-2" style="width: 18rem;" >
                    <img class="card-img-top " src="<?php echo $row['file_image'];?>" height="400" lt="Card image cap">
                    <div class="card-body">
                        <form action="" method="post">
                        <h5 class="card-title"><?php echo $row['title'];?></h5>
                        <button type="button" class="btn btn-primary" data-id="<?php echo $row['id']; ?>" 
                        data-title="<?php echo $row['title']; ?>" data-content="<?php echo $row['content']; ?>"
                        data-user_id="<?php echo $row['user_id']; ?>" data-file_image="<?php echo $row['file_image']; ?>"
                        
                        onclick="$('#idBlog').val($(this).data('id')); 
                            $('#titleBlog').val($(this).data('title')); 
                            $('#contentBlog').val($(this).data('content'));
                            $('#userBlog').val($(this).data('user_id'));
                            $('#ImageBlog').val($(this).data('file_image'));
                            
                            $('#ModalEditBlog').modal('show');" >Edit</button>
                        
                        </form>
                    </div>
                </div>
        <?php } ?>
        
    </div>

    <!--Title user-->
    <div class="row ml-4 mt-4">
        <!-- Title list user-->
        <div class="col">
            <h2 class="text-center">List User</h2>
        </div>   
    </div> 
    <!--Table user-->
    <div class="row pl-5">
        <!-- Table list user-->
        <div class="col">
            <?php 
            $sql = "SELECT * FROM user";
            $result = mysqli_query($link, $sql); ?>
            <form action="" method="post">
                <table class="table table-bordered">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>       
                    </tr>
                    <?php while($row= mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><button type="button" class="btn btn-primary" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-email="<?php echo $row['email']; ?>" onclick="$('#id').val($(this).data('id')); $('#name').val($(this).data('name')); $('#email').val($(this).data('email')); $('#ModalEditUser').modal('show');">Edit</button></td>
                            <td><button type="submit" class="btn btn-danger" name="deleteUser" value="<?php echo $row['id']; ?>">Hapus</button></td>
                            
                        </tr>
                    <?php } ?>
                </table>
            </form>
        </div>                      
    </div>  

    <!-- Modal edit user-->
    <div class="modal fade" id="ModalEditUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" class="form-container">
                    <div class="modal-body">
                        <label for="Id"><b>Id</b></label>
                        <input type="text" class="form-control" id="id" name="id">
                        <br>
                        <label for="Name"><b>Nama</b></label>
                        <input type="text" class="form-control" id="name" name="name">
                        <br>
                        <label for="Email"><b>Email</b></label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" name="editUser" id="editUser" data-id="id" class="btn btn-primary">Simpan</button>           
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal tambah user-->
    <div class="modal fade" id="formUser" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form method="POST" class="form-container">
                    <div class="modal-body">
                        <label for="Id"><b>Id</b></label>
                        <input type="text" class="form-control" placeholder="Input Id" name="id">

                        <label for="Name"><b>Nama</b></label>
                        <input type="text" class="form-control" placeholder="Input Nama User" name="name">

                        <label for="Email"><b>Email</b></label>
                        <input type="text" class="form-control" placeholder="Input Email User" name="email">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="submitUser" class="btn btn-primary">Simpan</button>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tambah blog-->
    <div class="modal fade" id="formImageBlog" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan Blog</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form method="POST" class="form-container" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label for="Id"><b>Id</b></label>
                        <input type="text" class="form-control" placeholder="Input Id" name="id">

                        <label for="Title"><b>Title</b></label>
                        <input type="text" class="form-control" placeholder="Input Judul Blog" name="title">

                        <label for="Content"><b>Content</b></label>
                        <textarea class="form-control" id="content" name="content"></textarea>
                        
                        <br>
                        <label for="foto"><b>Foto</b></label>
                        <input class="form-control" type="file" name="file_image" >
                        <br>
                        <label for="User"><b>User</b></label>
                        <select class="form-control" name="user_id" id="user_id">
                            <option disabled selected> Pilih</option>
                            <?php 
                            $sql = "SELECT * FROM user";
                            $result = $link->query($sql);

                            while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?=$row['id']?>"><?=$row['name']?></option>
                            <?php 
                            }
                            ?>
                        </select>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submitBlog" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

                        
    <!-- Modal Edit blog-->
    <div class="modal fade" id="ModalEditBlog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" class="form-container">
                    <div class="modal-body">
                        <label for="Id"><b>Id</b></label>
                        <input type="text" class="form-control" id="idBlog" name="id">
                        <br>
                        <label for="Title"><b>Title</b></label>
                        <input type="text" class="form-control" id="titleBlog" name="title">
                        <br>
                        <label for="Content"><b>Content</b></label>
                        <textarea class="form-control" id="contentBlog" name="content"></textarea>
                        <br>
                        <label for="User"><b>User Id</b></label>
                        <input type="text" class="form-control" id="userBlog" name="user_id">
                        <br>
                        <label for="Image"><b>Image</b></label>
                        <input type="text" class="form-control" id="ImageBlog" name="image">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                        <button type="submit" name="editBlog" id="editBlog" data-id="id" class="btn btn-primary">Simpan</button>
                        
                        <button type="submit" name="deleteBlog" id="deleteBlog" data-id="id" data-image="image" class="btn btn-primary">Hapus</button>
                                 
                    </div>                
                </form>
            </div>
        </div>
    </div>

    


    




</body>
</html>