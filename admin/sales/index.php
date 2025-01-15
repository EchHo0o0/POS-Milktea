<?php if($_settings->chk_flashdata('success')): ?>
<script>
    alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<div class="card card-outline rounded-0" style="border-color: #D4B89B;"> <!-- Light Tea Brown Border -->
    <div class="card-header" style="background-color: #F1E4D1;"> <!-- Creamy Beige Header -->
        <h3 class="card-title" style="color: #4E3B31;">List of Sales</h3> <!-- Dark Brown Text -->
        <div class="card-tools">
            <a href="./?page=sales/manage_sale" id="create_new" class="btn btn-flat" style="background-color: #C28C6A; color: white;"> <!-- Caramel Button -->
                <span class="fas fa-plus"></span> Create New
            </a>
        </div>
    </div>
    <div class="card-body" style="background-color: #D4B89B;"> <!-- Light Tea Brown Background -->
        <div class="container-fluid">
            <table class="table table-hover table-striped table-bordered" style="background-color: #F1E4D1;"> <!-- Creamy Beige Table -->
                <colgroup>
                    <col width="5%">
                    <col width="20%">
                    <col width="20%">
                    <col width="25%">
                    <col width="15%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr style="background-color: #D4B89B;"> <!-- Light Tea Brown Header -->
                        <th style="color: #4E3B31;">List</th> <!-- Dark Brown Text -->
                        <th style="color: #4E3B31;">Date Updated</th>
                        <th style="color: #4E3B31;">Code</th>
                        <th style="color: #4E3B31;">Customer</th>
                        <th style="color: #4E3B31;">Amount</th>
                        <th style="color: #4E3B31;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    if($_settings->userdata('type') == 3):
                    $qry = $conn->query("SELECT * FROM `sale_list` where user_id = '{$_settings->userdata('id')}' order by unix_timestamp(date_updated) desc ");
                    else:
                    $qry = $conn->query("SELECT * FROM `sale_list` order by unix_timestamp(date_updated) desc ");
                    endif;
                    while($row = $qry->fetch_assoc()):
                    ?>
                        <tr>
                            <td class="text-center" style="color: #4E3B31;"><?php echo $i++; ?></td> <!-- Dark Brown Text -->
                            <td><p class="m-0 truncate-1"><?= date("M d, Y H:i", strtotime($row['date_updated'])) ?></p></td>
                            <td><p class="m-0 truncate-1"><?= $row['code'] ?></p></td>
                            <td><p class="m-0 truncate-1"><?= $row['client_name'] ?></p></td>
                            <td class="text-right" style="color: #4E3B31;"><?= format_num($row['amount']) ?></td> <!-- Dark Brown Text -->
                            <td align="center">
                                <a class="btn btn-default bg-gradient-light btn-flat btn-sm" href="?page=sales/view_details&id=<?php echo $row['id'] ?>" style="background-color: #C28C6A; color: white;"> <!-- Caramel Button -->
                                    <span class="fa fa-eye text-dark"></span> View
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.table').dataTable({
            columnDefs: [
                    { orderable: false, targets: [5] }
            ],
            order:[0,'asc']
        });
        $('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
    })
</script>
