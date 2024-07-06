<?php

declare(strict_types=1);

require 'currency.php';

$currency = new Currency();

$amount = $_POST['amount'] ?? null;
$ccy = $_POST['currency'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form action="index.php" method="post">
            <select class="form-select" name="currency">
                <?php
                $index = 1;
                foreach ($currency->customCurrencies() as $currencyName => $rate) {
                    echo "<option value='$currencyName'>$currencyName</option>";
                    if ($index == 10) {
                        break;
                    }
                    $index++;
                } ?>
            </select>
            <fieldset>
                <legend>Currency converter</legend>
                <div class="mb-3">
                    <label for="amount" class="form-label">UZS</label>
                    <input type="text" id="amount" class="form-control" name="amount">
                </div>
                <div class="mb-3">
                    <label for="result" class="form-label">Result</label>
                    <input type="text" id="result" class="form-control" value="<?php
                    if ($amount !== null && $ccy !== null) {
                        try {
                            echo $currency->exchange((float) $amount, $ccy);
                        } catch (Exception $e) {
                            echo $e->getMessage();
                        }
                    } ?>" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Exchange</button>
            </fieldset>
        </form>
    </div>
</body>
</html>
