<?php 
$date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 0;
if($_settings->userdata('type') == 3){
    $user_id = $_settings->userdata('id');
}
?>
<?php if($_settings->chk_flashdata('success')): ?>
<script>
    alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<div class="card card-outline rounded-0" style="border-color: #D4B89B;"> <!-- Light Tea Brown Border -->
    <div class="card-header" style="background-color: #F1E4D1;"> <!-- Creamy Beige Header -->
        <h3 class="card-title" style="color: #4E3B31;">Daily Sales Report</h3> <!-- Dark Brown Text -->
    </div>
    <div class="card-body" style="background-color: #D4B89B;"> <!-- Light Tea Brown Background -->
        <div class="container-fluid">
            <fieldset class="border px-2 mb-2 ,x-2" style="border-color: #C28C6A;"> <!-- Caramel Border -->
                <legend class="w-auto px-2" style="color: #4E3B31;">Filter</legend> <!-- Dark Brown Text -->
                <form id="filter-form" action="">
                    <div class="row align-items-end">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="date" style="color: #4E3B31;">Date</label> <!-- Dark Brown Text -->
                                <input type="date" name="date" value="<?= $date ?>" class="form-control form-control-sm rounded-0" required>
                            </div>
                        </div>
                        <?php if($_settings->userdata('type') != 3): ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="user_id" style="color: #4E3B31;">User</label> <!-- Dark Brown Text -->
                                <select name="user_id" class="form-control form-control-sm" required>
                                    <option value="0" <?= $user_id == 0 ? 'selected' : '' ?>>All</option>
                                    <?php 
                                    $qry = $conn->query("SELECT *, concat(firstname, ' ', lastname) as `name` from users order by `name` asc");
                                    while($row = $qry->fetch_assoc()):
                                    ?>
                                    <option value="<?= $row['id'] ?>" <?= $user_id == $row['id'] ? 'selected' : '' ?>><?= $row['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <button class="btn" style="background-color: #C28C6A; color: white; border-radius: 0.25rem;"> <!-- Caramel Button -->
                                    <i class="fa fa-filter"></i> Filter
                                </button>
                                <button class="btn btn-light border" style="border-radius: 0.25rem; border-color: #C28C6A;" type="button" id="print">
                                    <i class="fa fa-print"></i> Print
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </fieldset>
            <div class="container-fluid" id="printout">
                <table class="table table-hover table-striped table-bordered" id="report-list" style="background-color: #F1E4D1;"> <!-- Creamy Beige Table -->
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
                            <th style="color: #4E3B31;">Sales Code</th>
                            <th style="color: #4E3B31;">Customer</th>
                            <th style="color: #4E3B31;">User</th>
                            <th style="color: #4E3B31;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0;
                        $i = 1;
                        $where = "";
                        if($user_id > 0){
                            $where = " and user_id = '{$user_id}' ";
                        }
                        $users_qry = $conn->query("SELECT id, concat(firstname, ' ', lastname) as `name` FROM `users` where id in (SELECT user_id FROM `sale_list` where date(date_created) = '{$date}' {$where}) ");
                        $user_arr = array_column($users_qry->fetch_all(MYSQLI_ASSOC),'name', 'id');
                        $qry = $conn->query("SELECT * FROM `sale_list` where date(date_created) = '{$date}' {$where} order by unix_timestamp(date_updated) desc ");
                        while($row = $qry->fetch_assoc()):
                            $total += $row['amount'];
                        ?>
                        <tr>
                            <td class="text-center" style="color: #4E3B31;"><?php echo $i++; ?></td> <!-- Dark Brown Text -->
                            <td><p class="m-0"><?= date("M d, Y H:i", strtotime($row['date_updated'])) ?></p></td>
                            <td><p class="m-0"><?= $row['code'] ?></p></td>
                            <td><p class="m-0"><?= $row['client_name'] ?></p></td>
                            <td class=''><?= ucwords(isset($user_arr[$row['user_id']]) ? $user_arr[$row['user_id']] : "N/A") ?></td>
                            <td class='text-right' style="color: #4E3B31;"><?= format_num($row['amount']) ?></td> <!-- Dark Brown Text -->
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-center" style="color: #4E3B31;">Total</th> <!-- Dark Brown Text -->
                            <th class="text-right" style="color: #4E3B31;"><?= format_num($total) ?></th> <!-- Dark Brown Text -->
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<noscript id="print-header">
    <style>
        html, body{
            background:unset !important;
            min-height:unset !important
        }
    </style>
    <div class="d-flex w-100">
        <div class="col-2 text-center">
        </div>
        <div class="col-8 text-center" style="line-height:.9em">
            <h4 class="text-center m-0" style="color: #4E3B31;"><?= $_settings->info('name') ?></h4> <!-- Dark Brown Text -->
            <h3 class="text-center m-0" style="color: #4E3B31;"><b>Daily Sales Report</b></h3> <!-- Dark Brown Text -->
            <h5 class="text-center m-0" style="color: #4E3B31;"><b>as of</b></h5> <!-- Dark Brown Text -->
            <h3 class="text-center m-0" style="color: #4E3B31;"><b><?= date("F d, Y", strtotime($date)) ?></b></h3> <!-- Dark Brown Text -->
        </div>
    </div>
    <hr>
</noscript>

<script>
    $(document).ready(function(){
        $('[name="user_id"]').select2({
            placeholder: 'Please Select User Here',
            width: '100%',
            containerCssClass:'form-control form-control-sm rounded-0'
        })
        $('#filter-form').submit(function(e){
            e.preventDefault()
            location.href = "./?page=reports&"+$(this).serialize()
        })
        $('#report-list td,#report-list th').addClass('py-1 px-2 align-middle')
        $('#print').click(function(){
            var head = $('head').clone()
            var p = $($('#printout').html()).clone()
            var phead = $($('noscript#print-header').html()).clone()
            var el = $('<div class="container-fluid">')
            head.find('title').text("Daily Sales Report-Print View")
            el.append(phead)
            el.append(p)
            el.find('.bg-gradient-navy').css({'background':'#001f3f linear-gradient(180deg, #26415c, #001f3f) repeat-x !important','color':'#fff'})
            el.find('.bg-gradient-secondary').css({'background':'#6c757d linear-gradient(180deg, #828a91, #6c757d) repeat-x !important','color':'#fff'})
            el.find('tr.bg-gradient-navy').attr('style',"color:#000")
            el.find('tr.bg-gradient-secondary').attr('style',"color:#000")
            start_loader();
            var nw = window.open("", "_blank", "width=1000, height=900")
                    nw.document.querySelector('head').innerHTML = head.prop('outerHTML')
                    nw.document.querySelector('body').innerHTML = el.prop('outerHTML')
                    nw.document.close()
                    setTimeout(()=>{
                        nw.print()
                        setTimeout(()=>{
                            nw.close()
                            end_loader()
                        },300)
                    },500)
        })
    })
</script>
