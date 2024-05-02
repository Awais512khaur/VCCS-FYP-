<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="style.css">
        <title>Report</title>

    </head>
   <body>
    <H1>Product Report</H1>
    <br>
    <table id="tb1" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Unit</th>
                <th>Price per unit</th>
                <th>Quantity</th>
                <th>Sales id</th>
                <th>Product id</th>
            </tr>
        </thead>
          <tbody>
     <?php
      $servername= "localhost";
      $username = "root";
      $password = "";
      $database = "vccs_db";

      $connection = new mysqli($servername, $username, $password, $database);
      if($connection-> connect_error)
      {
        die("connection failed:". $connection-> connect_error);
      }
      $sql = "SELECT * FROM product_sales";
      $result = $connection-> query($sql);

      while($row = $result->fetch_assoc())
      {
        echo "<tr>
                 <td>".$row["id"]."</td>
                 <td>".$row["name"]."</td>
                 <td>".$row["unit"]."</td>
                 <td>".$row["price_per_unit"]."</td>
                 <td>".$row["quantity"]."</td>
                 <td>".$row["sales_id"]."</td>
                 <td>".$row["product_id"]."</td>
                 </tr>";
             
      }
      ?>
          </tbody>
          </table>
          <H1>Sales Report</H1>
          <table id="tb2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Date</th>
                <th>Amount paid</th>
                <th>Customer ID</th>
                <th>Vehicle_ID</th>
                <th>Outlet_ID</th>
            </tr>
        </thead>
          <tbody>
     <?php
      $servername= "localhost";
      $username = "root";
      $password = "";
      $database = "vccs_db";

      $connection = new mysqli($servername, $username, $password, $database);
      if($connection-> connect_error)
      {
        die("connection failed:". $connection-> connect_error);
      }
      $sql = "SELECT * FROM sales_t";
      $result = $connection-> query($sql);

      while($row = $result->fetch_assoc())
      {
        echo "<tr>
                 <td>".$row["id"]."</td>
                 <td>".$row["customer_name"]."</td>
                 <td>".$row["date"]."</td>
                 <td>".$row["amountPaid"]."</td>
                 <td>".$row["customer_id"]."</td>
                 <td>".$row["vehicle_id"]."</td>
                 <td>".$row["outlite_id"]."</td>
                 </tr>";
             
      }
      ?>
          </tbody>
          </table>
          <br><br>
          <div class="text-center">
            <button onclick="window.print()" id="btn">Download Report</button>
          </div>
</body>
</html>