<?php
session_start();

if (isset($_SESSION["loggedin"]) && !empty($_SESSION["loggedin"])) {
    //echo 'Hello ' . $_SESSION["session_name"];
    if(isset($_SESSION['session_role'])) {
        if($_SESSION['session_role'] == 3) {
            header("location: index.php");
            exit;
        }
    }
} else {
    header("location: login.php");
    exit;
}

include_once './commons/db.php';
include_once './transaction/transaction.php';
include_once './transaction/transactionDao.php';

$transactionDao = new TransactionDao();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src='https://cdn.plot.ly/plotly-latest.min.js'></script>
</head>

<body>
    <?php include './includes/header.php'; ?>
    <div class="container" style="padding-top: 15%">
        <div class="row">
            <div id='pieChart'><!-- Plotly chart will be drawn inside this DIV --></div>
            <div id='barGraph'><!-- Plotly chart will be drawn inside this DIV --></div>
        </div>
    </div>

<?php include './includes/footer.php'; ?>
</body>
</html>
<script>

    var pieValues = [];
    var pieLabels = [];
    var index = 0;

    <?php $resultSet = $transactionDao->getNonZeroNumberOfTransactionsPerCar(); ?>
    <?php
        while($row = $resultSet->fetch_array()) { 
    ?>
            pieValues[index] = <?php echo $row['total_count']; ?>;
            pieLabels[index] = '<?php echo $row['name']; ?>';
            index = index + 1;
    <?php
        } 
    ?>

    var pieData = [{
        values: pieValues,
        labels: pieLabels,
        type: 'pie'
    }];

    var pieLayout = {
        title: 'Top Rented Car of all time (%)',
        height: 400,
        width: 500
    };

    Plotly.newPlot('pieChart', pieData, pieLayout);
</script>
<script>
    var barValues = [];
    var barLabels = [];

    <?php $resultSet = $transactionDao->getNumberOfTransactionsPerUser(); ?>
    <?php
        while($row = $resultSet->fetch_array()) { 
    ?>
            barValues[index] = <?php echo $row['count_per_user']; ?>;
            barLabels[index] = '<?php echo $row['name']; ?>';
            index = index + 1;
    <?php
        } 
    ?>
    
    var data = [{
        x: barLabels,
        y: barValues,
        type: 'bar'
    }];

    var barLayout = {
        title: 'Number of Bookings Per User',
        height: 400,
        width: 600
    };

    Plotly.newPlot('barGraph', data, barLayout);
</script>