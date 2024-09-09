<?php
include_once("inc/header.php");
include_once("inc/db_config.php");

if(isset($_GET['seen'])){
    $frm_data = filteration($_GET);

    if($frm_data['seen'] == 'all'){
        $q = "UPDATE `user_queries` SET `seen`=?";
        $values = [1];
        if(update($q,$values,'i')){
            alert('success','Mark all as read');
        }
        else{
            alert('error','Operation is failed');
        }
    }
    else{
        $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
        $values = [1,$frm_data['seen']];
        if(update($q,$values,'ii')){
            alert('success','Mark as read');
        }
        else{
            alert('error','Operation is failed');
        }
    }
}

if(isset($_GET['del'])){
    $frm_data = filteration($_GET);

    if($frm_data['del'] == 'all'){
        $q = "DELETE FROM `user_queries`";
        if(mysqli_query($con,$q)){
            alert('success','All Data deleted!');
        }
        else{
            alert('error','Operation failed!');
        }
    }
    else{
        $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
        $values = [$frm_data['del']];
        if(delete_fun($q,$values,'i')){
            alert('success','Data deleted!');
        }
        else{
            alert('error','Operation failed!');
        }
    }
}

?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">USER QUERIES</h3>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    
                    <div class="text-end mb-4">
                        <a href="user_queries.php?seen=all" class="btn btn-dark rounded-pill shadow-none btn-sm">
                            <i class="bi bi-check-all"></i> Mark all read
                        </a>
                        <a href="user_queries.php?del=all" class="btn btn-danger rounded-pill shadow-none btn-sm">
                            <i class="bi bi-trash"></i> Delete all
                        </a>
                    </div>

                    <div class="table-responsive-md" style="height: 450px;overflow-y:scroll;" id="style-7">
                        <table class="table table-hover border">
                            <thead class="sticky-top table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $q = "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC";
                                $data = mysqli_query($con,$q);
                                $i = 1;

                                while($row = mysqli_fetch_assoc($data)){
                                    $seen = '';
                                    if($row['seen'] != 1){
                                        $seen = "<a href='user_queries.php?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary mb-2'>Mark as read</a>";
                                    }
                                    $seen .= "<a href='user_queries.php?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger'>Delete</a>";
                                    echo <<<query
                                        <tr>
                                            <td>$i</td>
                                            <td>$row[name]</td>
                                            <td>$row[email]</td>
                                            <td>$row[subject]</td>
                                            <td>$row[message]</td>
                                            <td>$row[date]</td>
                                            <td>$seen</td>
                                        </tr>
                                    query;
                                    $i++;
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>

<?php require("inc/scripts.php"); ?>
</body>

</html>