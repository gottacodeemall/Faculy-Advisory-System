<?php
  //List of Users
  session_start();
  if (!isset($_SESSION['email']))
      {header('location: index.php?error=none');
      }
  if ($_SESSION['type']!='Admin')
      {header('location: profile.php');
      }
  require 'common.php';
?>
    <body>
        <?php
          require 'header.php';
        ?>
        <div class="container" style="padding-top: 85px; padding-bottom: 85px;">
        <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
        <p style="font-size: 20px;">
        <?php
          require 'connect.php';
          $select_query="SELECT id, name, type FROM users WHERE NOT(id='".$_SESSION['user_id']."');";
          $select_result=mysqli_query($con, $select_query) or die(mysqli_error($con));
        ?>
        </p>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th><center>Unique Id</center></th>
                <th><center>Name</center></th>
                <th><center>Type</center></th>
                <th><center>Library Section</center></th>
                <th><center>Hostel Section</center></th>
                <th></th>
            </tr>
        <?php
          while($row=mysqli_fetch_array($select_result))
           {$f=1;
            $select_query1="SELECT count(*) FROM check_out WHERE sid='".$row['id']."';";
            $select_result1=mysqli_query($con, $select_query1) or die(mysqli_error($con));
            $row1= mysqli_fetch_array($select_result1);
            $select_query2="SELECT hostel_dues FROM users WHERE id='".$row['id']."';";
            $select_result2=mysqli_query($con, $select_query2) or die(mysqli_error($con));
            $row2= mysqli_fetch_array($select_result2);
        ?>
            <tr class="table table-striped">
                <td><center><?php echo $row['id']?></center></td>
                <td><center><?php echo $row['name']?></center></td>
                <td><center><?php echo $row['type']?></center></td>
                <td>
                    <center>
                        <?php
                          if($row1[0]>0)
                           {echo "<button class='btn btn-danger'>Not Cleared</button>";
                            $f=0;
                           }
                          else
                              echo "<button class='btn btn-success'>Cleared</button>";
                        ?>
                    </center>
                </td>
                <td>
                    <center>
                        <?php
                          if($row2[0]>0)
                           {echo "<button class='btn btn-danger'>Not Cleared</button>";
                            $f=0;
                           }
                          else
                              echo "<button class='btn btn-success'>Cleared</button>";
                        ?>
                    </center>
                </td>
                <td><center><?php if($f==1){echo "<a href='delete_account_script.php?id=".$row['id']."'>";}?><button class="btn btn-info <?php if($f!=1){echo "disabled";}?>">Delete Account</button></a></center></td>
            </tr>
        <?php
           }
        ?>
            </tbody>
        </table>
        </div>
        </div>
        </div>
   </body>
</html>
