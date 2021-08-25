<?php
    if (!isset($_GET['s'])){
        exit(header('Location: /'));
    }

    require '../config.php';
    require '../includes/simple_html_dom.php';

    $address = $_GET['s'];
    $address_sm = substr($address, 0, 12) . '...' . substr($address, 22, strlen($address));
    $address_xs = substr($address, 0, 5) . '...' . substr($address, 29, strlen($address));

    $url = 'https://www.bitcoinabuse.com/api/reports/check?address='.$address.'&api_token=xvmxfnJtIWZXKPRUyP9jgZRxKjU4ewrvzm8JTWmpnmX08m2yMjpzRHatZ86u';

    $context = stream_context_create();
    stream_context_set_params($context, array('User-Agent' => 'google'));
    $report = (file_get_html($url, 0, $context));

    $confirmed = false;
    $decoded = json_decode($report);
    if (sizeof($decoded->recent) > 0){
        $confirmed = true;
    }
    $link = 'https://www.blockchain.com/btc/address/' . $address;
/*
    $btcabuce_json = file_get_contents('https://www.bitcoinabuse.com/api/reports/check?address='.$_GET['s'].'&api_token=xvmxfnJtIWZXKPRUyP9jgZRxKjU4ewrvzm8JTWmpnmX08m2yMjpzRHatZ86u');
    $rawaddr_json = file_get_contents('https://blockchain.info/balance?active=' . $_GET['s']);

    $btcabuse = json_decode($btcabuce_json);
    $rawaddr = json_decode($rawaddr_json);

    $recent = $btcabuse->recent[0];

    $total = $rawaddr->total_received / 100000000;

    $date = convert_date(date_parse($btcabuse->first_seen));
*/
    $connect_db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    mysqli_query($connect_db, 'SET NAMES utf8');

    $sql = "SELECT `coin`, `link` FROM `scams` WHERE `address` = '$address'";
    $query = mysqli_query($connect_db, $sql);

    if (mysqli_num_rows($query) == 1){
        $scam = mysqli_fetch_array($query);
        if ($scam['coin'] != 'BTC'){
            $link = $scam['link'];
        }
    }

    mysqli_close($connect_db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head.php'; ?>
    <title>Token Network Security Scan</title>
    <script>
        var address = '<?php echo $address; ?>', report = <?php echo $report; ?>;
        var page = 'scam_page';
    </script>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <div class="container">
            <div class="box">
                <h1>Scam Report</h1>
                <!--<p><b>TUMBLER</b></p>-->
                <p class="justify">Cryptocurrencies are not as private as some would believe and without precautions a scammer or criminal can be traced. Tumblers try to prevent that by grouping transactions and erasing the trail.</p>

                <table class="table scam-info">
                    <tbody>
                        <tr>
                            <td><p>Address</p></td>
                            <td>
                                <span class="d-none d-md-block"><?php echo $address; ?></span>
                                <span class="d-none d-sm-block d-md-none"><?php echo $address_sm; ?></span>
                                <span class="d-sm-none"><?php echo $address_xs; ?></span>
                                <a href="<?php echo $link ?>" target="_blank" style="display: block;">View on blockchain.com</a>
                            </td>
                        </tr>
                        <tr>
                            <td><p>Comments </p></td>
                            <td><p class="justify" id="description"></p></td>
                        </tr>
                        <tr>
                            <td><p>Earnings </p></td>
                            <td>
                                <p><span class="danger" id="received_usd"></span> (<span class="danger" id="transaction_count"></span> transactions)</p>
                            </td>
                        </tr>
                        <tr>
                            <td><p>Active Since </p></td>
                            <td><p id="active_since" style="color: #1dd79b;"></p></td>
                        </tr>
                        <tr>
                            <td><p>Status</p></td>
                            <td><p><?php if ($confirmed){echo 'Confirmed Scam';}else {echo 'Not Confirmed';} ?></p></td>
                        </tr>
                    </tbody>
                </table>
                <p style="font-size:13px;font-style: italic;" class="mt-4"><b>Disclaimer:</b> Any scam websites listed on this page have been reported as a scam and are potentially dangerous. Visit at your own risk.</p>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>