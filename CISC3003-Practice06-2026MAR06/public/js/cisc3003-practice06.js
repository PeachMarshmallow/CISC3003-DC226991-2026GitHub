/* add loop and other code here ... in this simple exercise we are not
   going to concern ourselves with minimizing globals, etc */

var subtotal = 0;
var cartBody = document.getElementById('cart-body');

for (var i = 0; i < filenames.length; i++) {
    var total = calculateTotal(quantities[i], prices[i]);
    subtotal += total;
    var rowHtml = outputCartRow(filenames[i], titles[i], quantities[i], prices[i], total);
    cartBody.insertAdjacentHTML('beforeend', rowHtml);
}

var tax = subtotal * 0.10;

var shipping = (subtotal > 1000) ? 0 : 40;

var grandTotal = subtotal + tax + shipping;

cartBody.insertAdjacentHTML('beforeend', "<tr><td colspan='3'>Subtotal</td><td>$" + subtotal.toFixed(2) + "</td></tr>");
cartBody.insertAdjacentHTML('beforeend', "<tr><td colspan='3'>Tax</td><td>$" + tax.toFixed(2) + "</td></tr>");
cartBody.insertAdjacentHTML('beforeend', "<tr><td colspan='3'>Shipping</td><td>$" + shipping.toFixed(2) + "</td></tr>");
cartBody.insertAdjacentHTML('beforeend', "<tr><td colspan='3'><strong>Grand Total</strong></td><td><strong>$" + grandTotal.toFixed(2) + "</strong></td></tr>");
