<style>
    /* Milk Tea Color Palette */
    body {
        background-color: #F1E4D1; /* Creamy Beige background */
        font-family: Arial, sans-serif;
    }

    .card {
        background-color: #D4B89B; /* Light Tea Brown for card background */
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #F1E4D1; /* Creamy Beige for header */
        color: #4E3B31; /* Dark Brown for text */
        font-weight: bold;
    }

    .card-title {
        font-size: 18px;
    }

    .card-tools a {
        color: white;
        background-color: #C28C6A; /* Caramel for button */
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
    }

    .card-tools a:hover {
        background-color: #F4933F; /* Darker shade for hover effect */
    }

    .table {
        background-color: #FFFFFF; /* Milky White for table body */
        border-radius: 8px;
        border: 1px solid #C28C6A; /* Caramel border */
    }

    .table th, .table td {
        padding: 10px;
        text-align: center;
        color: #4E3B31; /* Dark Brown for text */
    }

    .table th {
        background-color: #D4B89B; /* Light Tea Brown for table headers */
        color: white;
        font-weight: bold;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #F1E4D1; /* Creamy Beige for alternating rows */
    }

    .badge-success {
        background-color: #6BBF73; /* Soft green for 'Active' status */
        color: white;
    }

    .badge-danger {
        background-color: #F2D4D1; /* Soft red for 'Inactive' status */
        color: white;
    }

    .btn-flat {
        background-color: #F4C542; /* Milk Tea Yellow for buttons */
        color: white;
        padding: 8px 15px;
        border-radius: 5px;
        font-size: 14px;
    }

    .btn-flat:hover {
        background-color: #F4933F; /* Slightly darker yellow on hover */
    }

    .dropdown-item {
        color: #4E3B31; /* Dark Brown for text */
        padding: 10px;
    }

    .dropdown-item:hover {
        background-color: #F4C542; /* Milk Tea Yellow for hover effect */
        color: white;
    }

    .alert {
        border-radius: 5px;
        font-size: 14px;
        margin-top: 15px;
        padding: 10px;
    }

    .alert-success {
        background-color: #F2A9A9;
        color: #155724;
    }

    .alert-danger {
        background-color: #FFE6E8;
        color: #E3D0D2;
    }
</style>

<?php if ($_settings->chk_flashdata('success')): ?>
<script>
    alert_toast("<?php echo $_settings->flashdata('success') ?>",'success');
</script>
<?php endif; ?>

<div class="card card-outline rounded-0 card-navy">
    <div class="card-header">
        <h3 class="card-title">List of Products</h3>
        <div class="card-tools">
            <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Create New</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-hover table-striped table-bordered" id="list">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="20%">
                    <col width="20%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr>
                        <th>List</th>
                        <th>Date Created</th>
                        <th>Category</th>
                        <th>Name & Size</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $qry = $conn->query("SELECT p.*, c.name as `category` from `product_list` p inner join category_list c on p.category_id = c.id where p.delete_flag = 0 order by p.`name` asc ");
                    while($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                        <td><?php echo $row['category'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td class="text-right"><?php echo $row['price'] ?></td>
                        <td class="text-center">
                            <?php if($row['status'] == 1): ?>
                                <span class="badge badge-success px-3 rounded-pill">Active</span>
                            <?php else: ?>
                                <span class="badge badge-danger px-3 rounded-pill">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td align="center">
                            <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                Action
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                            </div>
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
        $('.delete_data').click(function(){
            _conf("Are you sure to delete this Product permanently?","delete_product",[$(this).attr('data-id')])
        })
        $('#create_new').click(function(){
            uni_modal("<i class='fa fa-plus'></i> Add New Product","products/manage_product.php")
        })
        $('.view_data').click(function(){
            uni_modal("<i class='fa fa-bars'></i> Product Details","products/view_product.php?id="+$(this).attr('data-id'))
        })
        $('.edit_data').click(function(){
            uni_modal("<i class='fa fa-edit'></i> Update Product Details","products/manage_product.php?id="+$(this).attr('data-id'))
        })
        $('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: [6] }
            ],
            order:[0,'asc']
        });
        $('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
    })

    function delete_product($id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_product",
            method:"POST",
            data:{id: $id},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("An error occured.",'error');
                end_loader();
            },
            success:function(resp){
                if(typeof resp == 'object' && resp.status == 'success'){
                    location.reload();
                }else{
                    alert_toast("An error occured.",'error');
                    end_loader();
                }
            }
        })
    }
</script>
