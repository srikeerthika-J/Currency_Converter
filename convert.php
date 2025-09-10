<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>form</title>

    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div form-group>
        <video autoplay muted loop id="backgroundvideo">
            <source src="assets/videos/video1.mp4" type="video/mp4">
        </video>
    </div>
    <center>
        <div class="form-group">
            <h1>CURRENCY CONVERTER</h1><br><br>
            <form method="post">
                <label>AMOUNT</label>
                <input type="number" id="amount" name="amount" required=""><br><br>
                <label for="currency">FROM CURRENCY</label>
                <select id="fromcurrency" name="fromcurrency">
                    <option value="usd">USD - US Dollar</option>
                    <option value="eur">EUR - Euro</option>
                    <option value="gbp">GBP - British Pound</option>
                    <option value="inr">INR - Indian Rupee</option>
                    <option value="jpy">JPY - Japanese Yen</option>
                    <option value="isk">ISK - Icelandic kronur</option>
                    <option value="ltc">LTC - Litecoin</option>
                    <option value="irr">IRR - Iranian rials</option>
                    <option value="usd">CAD - Canadian Dollar</option>
                    <option value="hkd">HKD - Hong Kong Dollars</option>
                    <option value="try">TRY - Turkish Lira</option>
                </select><br><br>
                <label for="currency">TO CURRENCY</label>
                <select id="tocurrency" name="tocurrency">
                    <option value="usd">USD - US Dollar</option>
                    <option value="eur">EUR - Euro</option>
                    <option value="gbp">GBP - British Pound</option>
                    <option value="inr">INR - Indian Rupee</option>
                    <option value="jpy">JPY - Japanese Yen</option>
                    <option value="isk">ISK - Icelandic kronur</option>
                    <option value="ltc">LTC - Litecoin</option>
                    <option value="irr">IRR - Iranian rials</option>
                    <option value="usd">CAD - Canadian Dollar</option>
                    <option value="hkd">HKD - Hong Kong Dollars</option>
                    <option value="try">TRY - Turkish Lira</option>
                </select><br><br>
                <button type="submit" name="convert" id='conver-btn'>CONVERT</button><br><br>
                <label>CONVERTED AMOUNT</label>
                <input type="text" value=" " name="convert_amount" id="convert_amount" readonly=""><br><br>
                <button type="reset" id="clear-btn" name="clear">CLEAR ALL</button><br><br>
            </form>
        </div>
    </center>
    </div>
    <div class="result">
        <?php
        if (isset($_POST['convert'])) {
            $fromcurrency = strtoupper($_POST['fromcurrency']);
            $tocurrency = strtoupper($_POST['tocurrency']);
            $amount = $_POST['amount'];

            if ($amount > 0) {
                $apiKey = "cur_live_T5wxxOnscTuS5HlNGa7y4F3G9XiS3Jb5a8b6eQjl";
                $apiUrl = "https://api.currencyapi.com/v3/latest?apikey=$apiKey&base_currency=$fromcurrency&currencies=$tocurrency";

                $response = file_get_contents($apiUrl);

                if ($response) {
                    $data = json_decode($response, true);

                    if (isset($data['data'][$tocurrency]['value'])) {
                        $rate = $data['data'][$tocurrency]['value'];
                        $convertedAmount = round($amount * $rate, 2);

                        // Display in text field
                        echo "<script>document.getElementById('convert_amount').value = '$convertedAmount';</script>";
                        // echo "<p>$amount $fromcurrency is equivalent to $convertedAmount $tocurrency.</p>";
                        echo "<script>alert('Currency Converted Successfully');</script>";
                    } else {
                        echo "<script>alert('Exchange rate not available for $tocurrency.')</script>";
                    }
                } else {
                    echo "<script>alert('Unable to fetch exchange rates. Please try again later.')</script>";
                }
            } else {
                echo "<script>alert('Please enter a valid amount.');</script>";
            }
        }
        ?>
    </div>

    <script>
        document.getElementById('clear-btn');
        
    </script>

</body>
</html>
