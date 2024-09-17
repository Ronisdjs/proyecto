function showAlert(message, type = 'success') {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;

    $('#alert-container').html(alertHtml);
    setTimeout(() => {
        $('.alert').alert('close');
    }, 3000); // Cierra la alerta después de 3 segundos
}

$(document).ready(function() {
    $('.add-to-cart').on('click', function() {
        var productId = $(this).data('id');
        var productName = $(this).data('nombre');
        var productPrice = parseFloat($(this).data('precio'));
        var productImage = $(this).data('imagen');
        var productStock = $(this).data('stock');
        var descuento = parseFloat($(this).data('descuento'));
        var precioConDescuento = parseFloat($(this).data('total'));
        var quantity = parseInt(document.getElementById('quantity-' + productId).value);
        var precioConDescuentoAplicado = precioConDescuento * quantity;

        // Verificar si el producto ya está en la tabla
        var $existingRow = $(`.shopping-cart-table tbody tr[data-id="${productId}"]`);
        if ($existingRow.length > 0) {
            // Producto ya está en el carrito, actualizar cantidad y total
            var $quantityCell = $existingRow.find('.cart-cantidad');
            var $totalCell = $existingRow.find('.cart-total');
            var existingQuantity = parseInt($quantityCell.text());
            var newQuantity = existingQuantity + quantity;
            var newTotal = parseFloat($totalCell.data('total')) + precioConDescuentoAplicado;

            // Actualizar la cantidad y el total en la tabla
            $quantityCell.text(newQuantity);
            $totalCell.text(formatNumber(newTotal));
            $totalCell.data('total', newTotal);

            // Mostrar alerta de actualización
            showAlert(`Cantidad actualizada para el producto: ${productName}. Nueva cantidad: ${newQuantity}.`, 'info');
        } else {
            // Producto no está en el carrito, agregar nueva fila
            var precioConDescuentoFormateado = formatNumber(precioConDescuentoAplicado);
            var precioOriginalFormateado = formatNumber(productPrice);

            var newRow = `<tr data-id="${productId}">
                <td>${productId}</td>
                <td><img src="${productImage}" alt="${productName}" style="width: 50px; height: auto;"></td>
                <td>${productName}</td>
                <td class="cart-cantidad">${quantity}</td>
                <td class="cart-sub-total" data-sub-total="${productPrice}">${precioOriginalFormateado}</td>
                <td class="cart-descuento">${descuento}%</td> 
                <td class="cart-total" data-total="${precioConDescuentoAplicado}">${precioConDescuentoFormateado}</td>
                <td><button class="btn btn-danger remove-item" data-id="${productId}">Eliminar</button></td>
            </tr>`;

            $('.shopping-cart-table tbody').append(newRow);

            // Mostrar alerta de adición
            showAlert(`Producto añadido al carrito: ${productName}. Cantidad: ${quantity}.`, 'success');
        }

        // Actualizar los totales después de agregar o actualizar un producto
        calculateAndUpdateTotals();
    });

    $('.shopping-cart-table').on('click', '.remove-item', function() {
        var productName = $(this).closest('tr').find('td:nth-child(3)').text(); // Obtener nombre del producto
        $(this).closest('tr').remove();

        // Mostrar alerta de eliminación
        showAlert(`Producto eliminado del carrito: ${productName}.`, 'danger');

        // Actualizar los totales después de eliminar el producto
        calculateAndUpdateTotals();
    });

    $('#modal-productos').on('hidden.bs.modal', function() {
        console.log("La modal se ha cerrado.");
        calculateAndUpdateTotals();
    });

    // Inicializar los totales al cargar la página
    calculateAndUpdateTotals();
});
