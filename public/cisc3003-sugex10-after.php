<?php

include 'includes/book-utilities.inc.php';

$customers = readCustomers('data/customers.txt');

$selected_customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : null;

$selected_customer = null;
$selected_orders = [];

if ($selected_customer_id) {
    foreach ($customers as $cust) {
        if ($cust['id'] == $selected_customer_id) {
            $selected_customer = $cust;
            break;
        }
    }
    if ($selected_customer) {
        $selected_orders = readOrders($selected_customer, 'data/orders.txt');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>dc226991 Tan Pak Long</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/demo-styles.css">
    
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="js/material.min.js"></script>
    <script src="js/jquery.sparkline.2.1.2.js"></script>
    <script type="text/javascript">
        $(function() {
            $('.inlinesparkline').sparkline('html', {type: 'bar', height: '1.5em', barColor: '#3f51b5'} );
        });
    </script>
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">

            <div class="mdl-grid">

              <!-- Customers Table -->
              <div class="mdl-cell mdl-cell--7-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Customers</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <table class="mdl-data-table  mdl-shadow--2dp">
                      <thead>
                        <tr>
                          <th class="mdl-data-table__cell--non-numeric">Name</th>
                          <th class="mdl-data-table__cell--non-numeric">University</th>
                          <th class="mdl-data-table__cell--non-numeric">City</th>
                          <th>Sales</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($customers as $cust): ?>
                        <tr>
                          <td class="mdl-data-table__cell--non-numeric">
                            <a href="cisc3003-sugex10-after.php?customer_id=<?php echo $cust['id']; ?>">
                                <?php echo $cust['first_name'] . ' ' . $cust['last_name']; ?>
                            </a>
                          </td>
                          <td class="mdl-data-table__cell--non-numeric"><?php echo $cust['university']; ?></td>
                          <td class="mdl-data-table__cell--non-numeric"><?php echo $cust['city']; ?></td>
                          <td><span class="inlinesparkline"><?php echo $cust['sales']; ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                </div>
              </div>
              
              <div class="mdl-grid mdl-cell--5-col">
    
                  <!-- Customer Details Card -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Customer Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <?php if ($selected_customer): ?>
                            <h4><?php echo $selected_customer['first_name'] . ' ' . $selected_customer['last_name']; ?></h4>
                            <p><strong>Email:</strong> <?php echo $selected_customer['email']; ?></p>
                            <p><strong>University:</strong> <?php echo $selected_customer['university']; ?></p>
                            <p><strong>Address:</strong> <?php echo $selected_customer['address'] . ', ' . $selected_customer['city'] . ' ' . $selected_customer['state'] . ', ' . $selected_customer['country']; ?></p>
                            <p><strong>Phone:</strong> <?php echo $selected_customer['phone']; ?></p>
                        <?php else: ?>
                            <p>Select a customer to view details.</p>
                        <?php endif; ?>
                    </div>    
                  </div>

                  <!-- Order Details Card -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Order Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">       
                        <?php if ($selected_customer): ?>
                            <?php if (count($selected_orders) > 0): ?>
                                <table class="mdl-data-table  mdl-shadow--2dp">
                                  <thead>
                                    <tr>
                                      <th class="mdl-data-table__cell--non-numeric">Cover</th>
                                      <th class="mdl-data-table__cell--non-numeric">ISBN</th>
                                      <th class="mdl-data-table__cell--non-numeric">Title</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($selected_orders as $order): ?>
                                    <tr>
                                      <td class="mdl-data-table__cell--non-numeric"><img src="images/tinysquare/<?php echo $order['isbn']; ?>.jpg" alt="Cover"></td>
                                      <td class="mdl-data-table__cell--non-numeric"><?php echo $order['isbn']; ?></td>
                                      <td class="mdl-data-table__cell--non-numeric"><?php echo $order['title']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                                </table>
                            <?php else: ?>
                                <p>No orders found for this customer.</p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>    
                   </div>


               </div>   
           
            </div>

        </section>
        <footer style="text-align: center; padding: 20px; color: #757575;">
            CISC3003 Web Programming: dc226991 Tan Pak Long 2026
        </footer>
    </main>    
</div>
          
</body>
</html>