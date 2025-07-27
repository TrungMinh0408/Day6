<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
</head>
<body>
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>

    <main style="margin: top 100px;">
        <h1 class="text-center" >View Cart</h1>
        <?php
        include_once(__DIR__ . '/../../dbConnect.php');
        $cart = [];
        if(isset($_SESSION['cart'])){
            $cart=$_SESSION['cart'];
        }
        ?>


        <div class="container">
            <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
                <div id="message">&nbsp</div>
                <button type="button" class="close" date-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <str>
                        <th>No.</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                        <th>Actions</th>
                    </str>
                    </thead>
                        <tbody>
                            <?php if(!empty($cart)):?>
                            <?php $no = 1?>
                            <?php foreach ($cart as $item): ?>
                                <tr>
                                    <td><?= $no?></td>
                                    <td><img src="/Day6/assets/<?=$item['image_url'] ?>" 
                                            alt="Product Image" 
                                            style="width:100px; height:auto"></td>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['price'] ?></td>
                                    <td>
                                        <input type="number" 
                                                class="form-control" 
                                                id="quantity_<?= $item['id'] ?>" 
                                                name="quantity" 
                                                value="<?= $item['quantity'] ?>" 
                                                style="width: 80px;" />

                                        <button class="btn btn-primary btn-sm btn-update-quantity" 
                                                data-id="<?=$item['id']?>">
                                            <i class="fa fa-pencil" 
                                               aria-hidden="true"></i>
                                        Update</button>
                                    </td>
                                    <td><?= $item['subTotal'] ?></td>
                                    <td>
                                        <a id="delete_<?= $item['id']?>"
                                            data-id="<?= $item['id'] ?>"
                                            class="btn btn-danger btn-sm btn-delete-item">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            <?php else:?>
                                <str>
                                    <td class = "text-center" colspan="7" >Cart Empty</td>
                                </str>
                            <?php endif?>
                        </tbody>
                </table>
                <div class="mt-3 d-flex gap-2">
                    <a href="/Day6/frontend/index.php" class="btn btn-warning btn-md">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Continue Shopping
                    </a>
                    <a href="/Day6/frontend/pages/checkout_preview.php" class="btn btn-primary btn-md">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        Check out
                    </a>
                </div>

            </div>

        </div>
    </main>    


    

    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>

    <script>
        $(document).ready(function(){
            $('.btn-update-quantity').click(function(){
                const id = $(this).data('id');
                const quantity = $('#quantity_' + id).val();
                
                const data = {
                    id,
                    quantity,
                }
                $.ajax({
                    url: '/Day6/frontend/api/update_cart_item.php',
                    method: 'post',
                    dataType: 'json',
                    data: data,
                    success:function(data){
                        location.reload();
                    },
                    error: function(jqXHR,textStatus,errorThrown){
                        console.log(textStatus);
                        const htmlString = "<h1>Can not update</h1>";
                        $('#message').html(htmlString);
                        $('.alert').removeClass('d-none').addClass('show');
                    }
                });
            });
           $('.btn-delete-item').click(function(){
                const id = $(this).data('id');
                const data = { id };

                $.ajax({
                    url: '/Day6/frontend/api/remove_cart_item.php',
                    method: 'post',
                    dataType: 'json',
                    data: data,
                    success: function(data){
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus);
                    const htmlString = "<h1><strong>Can't Delete</strong></h1>";
                    $('#message').html(htmlString);
                    $('.alert').removeClass('d-none').addClass('show');
                    }
                });
                });
            });
    </script>

</body>
</html>