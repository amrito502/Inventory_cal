<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Inventory</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Cost Price</th>
                    <th>Additional Cost</th>
                    <th>Total Amount</th>
                    <th>Discount (%)</th>
                    <th>Grand Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="form-control sku" placeholder="sku"></td>
                    <td><input type="text" class="form-control product_name" placeholder="name"></td>
                    <td><input type="text" class="form-control quantity" value="1"></td>
                    <td><input type="text" class="form-control cost_price" value="1"></td>
                    <td><input type="text" class="form-control additional_cost" value="0.00"></td>
                    <td><input type="text" class="form-control total_amount" value="0"></td>
                    <td><input type="text" class="form-control discount" value="0.00"></td>
                    <td><input type="text" class="form-control grand_total" value="0.00"></td>
                    <td><input type="hidden" class="product_id" value=""> 
                </tr>
            </tbody>
        </table>
        <button id="saveInventory" class="btn btn-primary">Save Inventory</button>
    </div>



    <script>
        $(document).ready(function() {
            $('.sku').on('keyup', function() {
                let sku = $(this).val();
                let row = $(this).closest('tr');
    
                if (sku) {
                    $.ajax({
                        url: '/get-product-by-sku',
                        type: 'GET',
                        data: { sku: sku },
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        success: function(response) {
                            if (response.success) {
                                row.find('.product_name').val(response.product.product_name);
                                row.find('.cost_price').val(response.product.cost_price);
                                row.find('.additional_cost').val(response.product.additional_cost);
                                row.find('.product_id').val(response.product.id);
                                calculateRow(row);
                            } else {
                                row.find('.product_name').val('');
                                row.find('.cost_price').val(0);
                                row.find('.additional_cost').val(0);
                                row.find('.product_id').val('');
                            }
                        },
                        error: function(xhr) {
                            alert("Error: " + xhr.responseJSON.message);
                        }
                    });
                } else {
                    row.find('.product_name').val('');
                    row.find('.cost_price').val(0);
                    row.find('.additional_cost').val(0);
                    row.find('.product_id').val('');
                }
            });
    
            $('.quantity, .cost_price, .additional_cost, .discount').on('input', function() {
                let row = $(this).closest('tr');
                calculateRow(row);
            });
    
            function calculateRow(row) {
                let quantity = parseFloat(row.find('.quantity').val()) || 0;
                let cost_price = parseFloat(row.find('.cost_price').val()) || 0;
                let additional_cost = parseFloat(row.find('.additional_cost').val()) || 0;
                let discount = parseFloat(row.find('.discount').val()) || 0;
    
                let totalAmount = (quantity * cost_price) + additional_cost;
                let discountAmount = (totalAmount * discount) / 100;
                let grandTotal = totalAmount - discountAmount;
    
                row.find('.total_amount').val(totalAmount.toFixed(2));
                row.find('.grand_total').val(grandTotal.toFixed(2));
            }

            $("#saveInventory").on("click", function() {
                let data = [];
    
                $("tbody tr").each(function() {
                    let row = $(this);
    
                    let rowData = {
                        product_id: row.find(".product_id").val(),
                        sku: row.find(".sku").val(),
                        product_name: row.find(".product_name").val(),
                        quantity: row.find(".quantity").val(),
                        cost_price: row.find(".cost_price").val(),
                        additional_cost: row.find(".additional_cost").val(),
                        total_amount: row.find(".total_amount").val(),
                        discount: row.find(".discount").val(),
                        grand_total: row.find(".grand_total").val(),
                    };
    
                    data.push(rowData);
                });
  
                $.ajax({
                    url: "/inventories",
                    type: "POST",
                    data: JSON.stringify({ data: data }),
                    contentType: "application/json",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
    
</body>

</html>
