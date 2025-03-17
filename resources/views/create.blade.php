<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    <h2>Create Product</h2>

    <form action="{{ url('/products') }}" method="POST">
        @csrf
        <div>
            <label for="sku">SKU:</label>
            <input type="text" id="sku" name="sku" required>
        </div>
        <div>
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
        </div>
        <div>
            <label for="cost_price">Cost Price:</label>
            <input type="number" id="cost_price" name="cost_price" step="0.01" required>
        </div>
        <div>
            <label for="additional_cost">Additional Cost:</label>
            <input type="number" id="additional_cost" name="additional_cost" step="0.01" required>
        </div>
        <button type="submit">Save Product</button>
    </form>
</body>
</html>
