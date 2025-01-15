<style>
    /* Milk Tea Color Palette */
    body {
        background-color: #fff5e1; /* Milky White background */
        font-family: Arial, sans-serif;
    }

    h1 {
        font-size: 48px;
        font-weight: bold;
        text-align: center;
        color: #3e2a47; /* Dark Brown for the heading */
    }

    .row {
        margin-top: 30px;
    }

    /* Info Box */
    .info-box {
        background-color: #f5f5f5; /* Milky White background for info box */
        border: 1px solid #d8b095; /* Light Tea Brown border for info box */
    }

    .info-box-icon {
        background-color: #f4c542; /* Caramel color for icons */
    }

    .info-box-content {
        color: #3e2a47; /* Dark Brown for text inside info box */
    }

    .info-box-text {
        font-weight: bold;
    }

    .info-box-number {
        font-size: 18px;
    }

    .carousel-item img {
        object-fit: contain;
    }

    .carousel-inner {
        background-color: #fff5e1; /* Milky White for carousel background */
    }

    .carousel-control-prev-icon, .carousel-control-next-icon {
        background-color: #c67c4f; /* Caramel for carousel controls */
    }

    .carousel-control-prev, .carousel-control-next {
        color: #3e2a47; /* Dark Brown for carousel control arrows */
    }

    .container {
        margin-top: 30px;
    }

    .carousel-inner .carousel-item {
        transition: transform 0.3s ease, opacity 0.3s ease;
    }
</style>

<h1>Point Of Sale - <?php echo $_settings->info('name') ?></h1>

<hr>

<div class="row">
    <div class="col-12 col-sm-4 col-md-4">
        <div class="info-box">
            <span class="info-box-icon"><i class="fas fa-th-list"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Categories List</span>
                <span class="info-box-number text-right">
                    <?php 
                    $category = $conn->query("SELECT * FROM category_list where delete_flag = 0 and `status` = 1")->num_rows;
                    echo format_num($category);
                    ?>
                </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-4 col-md-4">
        <div class="info-box">
            <span class="info-box-icon"><i class="fas fa-mug-hot"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Products List</span>
                <span class="info-box-number text-right">
                    <?php 
                    $product = $conn->query("SELECT * FROM product_list where delete_flag = 0 and `status` = 1")->num_rows;
                    echo format_num($product);
                    ?>
                </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-4 col-md-4">
        <div class="info-box">
            <span class="info-box-icon"><i class="fas fa-calendar-day"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Today's Sales</span>
                <span class="info-box-number text-right">
                    <?php 
                    if($_settings->userdata('type') == 3):
                        $total = $conn->query("SELECT sum(amount) as total FROM sale_list where user_id = '{$_settings->userdata('id')}' ");
                    else:
                        $total = $conn->query("SELECT sum(amount) as total FROM sale_list");
                    endif;
                    $total = $total->num_rows > 0 ? $total->fetch_array()['total'] : 0; 
                    $total = $total > 0 ? $total : 0;
                    echo format_num($total);
                    ?>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php 
    $files = array();
    $fopen = scandir(base_app.'uploads/banner');
    foreach($fopen as $fname){
        if(in_array($fname, array('.','..')))
            continue;
        $files[] = validate_image('uploads/banner/'.$fname);
    }
    ?>
    <div id="tourCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
        <div class="carousel-inner h-100">
            <?php foreach($files as $k => $img): ?>
            <div class="carousel-item h-100 <?php echo $k == 0 ? 'active' : '' ?>">
                <img class="d-block w-100 h-100" style="object-fit:contain" src="<?php echo $img ?>" alt="">
            </div>
            <?php endforeach; ?>
        </div>
        <a class="carousel-control-prev" href="#tourCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#tourCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
