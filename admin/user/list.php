<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title" style="color: #3e2a47;">List of Users</h3> <!-- Dark Brown for card title -->
		<div class="card-tools">
			<a href="./?page=user/manage_user" id="create_new" class="btn btn-flat btn-caramel"><span class="fas fa-plus"></span> Create New</a>
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid" style="background-color: #f5f5f5; padding: 30px;"> <!-- Milky White Background -->
			<table class="table table-hover table-striped table-bordered" id="list" style="background-color: #fff5e1;"> <!-- Milky White for table body -->
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="25%">
					<col width="15%">
					<col width="10%">
					<col width="15%">
				</colgroup>
				<thead style="background-color: #d8b095; color: #3e2a47;"> <!-- Creamy Beige for header -->
					<tr>
						<th>ID</th>
						<th>Date Updated</th>
						<th>Name</th>
						<th>Username</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT *, concat(firstname,' ', lastname) as `name` from `users` where id != '{$_settings->userdata('id')}' order by concat(firstname,' ', lastname) asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr style="background-color: #ffffff;"> <!-- Milky White for table rows -->
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_updated'])) ?></td>
							<td><?php echo $row['name'] ?></td>
							<td><?php echo $row['username'] ?></td>
							<td class="text-center">
                                <?php if($row['type'] == 1): ?>
                                    Administrator
                                <?php elseif($row['type'] == 2): ?>
                                    Staff
                                <?php else: ?>
									Cashier
                                <?php endif; ?>
                            </td>
							<td align ="center">
								 <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="./?page=user/manage_user&id=<?= $row['id'] ?>"><span class="fa fa-edit text-dark"></span> Edit</a>
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
			_conf("Are you sure to delete this User permanently?","delete_user",[$(this).attr('data-id')])
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [6] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
	function delete_user($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Users.php?f=delete",
			method:"POST",
			data:{id: $id},
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(resp == 1){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>

<style>
    /* Milk Tea-inspired color palette */
    
    body {
        background-color: #f5f5f5; /* Milky White background */
        font-family: Arial, sans-serif;
    }
    
    .container-fluid {
        background-color: #fff5e1; /* Milky White background for the form */
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    .table th, .table td {
        color: #3e2a47; /* Dark Brown color for text */
    }

    .table thead {
        background-color: #d8b095; /* Creamy Beige for header */
        color: #3e2a47; /* Dark Brown for text */
    }

    .table-hover tbody tr:hover {
        background-color: #d8b095; /* Creamy Beige hover effect */
    }
    
    .btn-caramel {
        background-color: #c67c4f; /* Caramel for buttons */
        border-color:rgb(29, 21, 16);
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 8px;
    }
    
    .btn-caramel:hover {
        background-color:rgb(236, 184, 144); /* Slightly darker caramel for hover effect */
    }

    .dropdown-item {
        color: #3e2a47; /* Dark Brown for dropdown text */
    }

    .dropdown-item:hover {
        background-color: #d8b095; /* Creamy Beige hover effect */
    }

    .alert-danger {
        background-color: rgb(229, 22, 39); /* Red for error alert */
        color: #721c24;
        border-radius: 5px;
        padding: 15px;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: rgb(39, 226, 83); /* Green for success alert */
        color: #155724;
        border-radius: 5px;
        padding: 15px;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .toast {
        background-color:rgb(13, 11, 10); /* Caramel toast background */
        color: white;
        font-size: 14px;
        border-radius: 8px;
        padding: 10px 20px;
        text-align: center;
    }
</style>
