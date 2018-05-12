<?php
    $months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
    $years = array(2018,2019,2020,2021,2022,2023,2024,2025);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../../style.css">
        <link rel="stylesheet" href="pi-style.css">
    </head>
    <body>
        <div class="nav-toolbar font-18">
            <a href="../../landing.html" class="nav-toolbar-item">Home</a>
            <a href="../../assignments.html" class="nav-toolbar-item">Assignments</a>
        </div>
        <h1>Checkout</h1>
        <div class="checkout">
            <div class="banner-message">
                Please enter your shipping and billing information below.
            </div>
            <form action="confirmation.php" method="POST">
                <table id="shippingInfo">
                    <tr>
                        <td><span>First Name:</span></td>
                        <td class="red-text"><input name="first-name" type="text" required>*</td>
                    </tr>
                    <tr>
                        <td><span>Last Name:</span></td>
                        <td class="red-text"><input name="last-name" type="text" required>*</td>
                    </tr>
                    <tr>
                        <td><span>Email:</span></td>
                        <td class="red-text"><input name="email" type="text" required>*</td>
                    </tr>
                    <tr>
                        <td><span>Address Line 1:</span></td>
                        <td class="red-text"><input name="address-1" type="text" required>*</td>
                    </tr>
                    <tr>
                        <td><span>Address Line 2:</span></td>
                        <td class="red-text"><input name="address-2" type="text"></td>
                    </tr>
                    <tr>
                        <td><span>City:</span></td>
                        <td class="red-text"><input name="city" required>*</td>
                    </tr>
                    <tr>
                        <td><span>State:</span></td>
                        <td class="red-text"><input name="state" required>*</td>
                    </tr>
                    <tr>
                        <td><span>Zip:</span></td>
                        <td class="red-text"><input name="zip" required>*</td>
                    </tr>
                    <tr>
                        <td><span>Phone:</span></td>
                        <td><input name="phone"></td>
                    </tr>
                </table>
                <table id="paymentInfo">
                    <tr>
                        <td><span>Card Type</span></td>
                        <td>
                            <select name="card-type">
                                <option value="Visa">Visa</option>
                                <option value="MasterCard">MasterCard</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><span>Card Number:</span></td>
                        <td class="red-text"><input name="card-number" type="text" required>*</td>
                    </tr>
                    <tr>
                        <td><span>Expiration Date:</span></td>
                        <td>
                            <div class="block"><span>Month: </span><select name="card-month"><?php foreach ($months as &$month) { echo "<option>" . $month . "</option>"; } ?></select></div>
                            <div class="block"><span>Year: </span><select name="card-year"><?php foreach ($years as &$year) { echo "<option>" . $year . "</option>"; } ?></select></div>
                        </td>
                    </tr>
                </table>
                <div class="button-container confirm-container"><input id="confirmCheckoutButton" type="submit" value="Confirm"></div>
            </form>
        </div>
    </body>
</html>