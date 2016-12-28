<?php
//error_reporting();
//ini_set("display_errors", 1);
include('../../db_conn.php');
include('../../configdata.php');
@session_start();
    ?>

<div class="portlet-body">
    <div class="table-scrollable">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>
                    Select Category
                </th>
                <th>
                    Notification Name
                </th>
                <th>
                    Subject
                </th>
                <th>
                    Content
                </th>
                <th>
                    Operations
                </th>

            </tr>
            </thead>
            <tbody>

            <?php
            $result=$conn->query("select * from mail_configuration ");
            $i=1;
            while($row = $result->fetch_array()) {
                ?>
                <tr>
                    <td><?php echo $row['category'];?></td>
                    <td><?php echo$row['notification']; ?></td>
                    <td><?php echo$row['subject']; ?></td>
                    <td><?php echo $row['content']; ?></td>
                    <td>
                        <button type="button" class="btn btn-icon-only red" onclick="mailconfigedit('<?php echo $row['id'];?>', '<?php echo $row['subject']?>', '<?php echo $row['notification'];?>', '<?php echo urlencode($row['content']) ;?>', '<?php echo $row['category']; ?>');">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn  purple" id="mailActivated<?php echo $i;?>" onclick="configMailActivated('<?php echo $row['id'];?>','<?php echo $i ?>');"> <?php echo $row['mail_status'];?> </button>
                        <input type="hidden" id="activated<?php echo $i;?>" value="<?php echo $row['mail_status'];?>">

                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>

            </tbody>
        </table>
    </div>

    <div class="modal fade" id="EditMailConfig" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        
</div>

