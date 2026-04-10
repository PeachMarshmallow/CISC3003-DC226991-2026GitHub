/* define functions here */

function calculateTotal(quantity, price) {
    return quantity * price;
}

function outputCartRow(filename, title, quantity, price, total) {
    return "<tr>" +
           "<td><img src='images/" + filename + "' alt='" + title + "' /> " + title + "</td>" +
           "<td>" + quantity + "</td>" +
           "<td>$" + price.toFixed(2) + "</td>" +
           "<td>$" + total.toFixed(2) + "</td>" +
           "</tr>";
}

        
