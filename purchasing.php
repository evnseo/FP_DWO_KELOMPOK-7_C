<?php
require 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard AdventureWorks</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href=#>ADVENTUREWORKS</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="purchasing.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Purchasing Cost
                        </a>
                        <a class="nav-link" href="vendors.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Vendors
                        </a>
                        <a class="nav-link" href="territory.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Territory Sales
                        </a>
                        <a class="nav-link" href="linetotal.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Line Total Sales
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                    aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Mondrian</div>

                        <a class="nav-link" href="cube.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Mondrian
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">DWO ADVENTUREWORKS</div>
                    Kelompok 7
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-4">Purchasing Cost</h1>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header text-uppercase">
                                    Purchasing Cost Per Year
                                </div>
                                <div class="card-body">
                                    <div id="purchasingCostChart" style="width: 100%; height: 450px;"></div>
                                </div>
                            </div>
                        </div>

                        <?php
                            $sql = "SELECT t.tahun AS tahun, SUM(f.biaya_purchasing) AS jumlah
                                    FROM purchasing f
                                    JOIN time t ON t.time_id = f.time_id
                                    GROUP BY t.tahun
                                    ORDER BY t.tahun";
                            $result = mysqli_query($connection, $sql);

                            $categories = [];
                            $seriesData = [];

                            while ($row = mysqli_fetch_assoc($result)) {
                                $categories[] = $row['tahun'];
                                $seriesData[] = (float)$row['jumlah'];
                            }
                        ?>

                        <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            Highcharts.chart('purchasingCostChart', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: ''
                                },
                                subtitle: {
                                    text: ''
                                },
                                xAxis: {
                                    categories: <?php echo json_encode($categories); ?>, // Data dari PHP
                                    crosshair: true
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: 'Total Biaya (IDR)'
                                    }
                                },
                                tooltip: {
                                    valuePrefix: 'Rp ',
                                    valueSuffix: ' (IDR)'
                                },
                                plotOptions: {
                                    column: {
                                        pointPadding: 0.2,
                                        borderWidth: 0
                                    }
                                },
                                series: [{
                                    name: 'Purchasing Cost',
                                    data: <?php echo json_encode($seriesData); ?> // Data dari PHP
                                }]
                            });
                        });
                        </script>

<?php
                        // Assuming you have already established the database connection

                        // Fetch the top states from the database
                        $sql = "SELECT t.bulan as bulan, SUM(fvb.biaya_purchasing) as total
                                FROM purchasing fvb
                                JOIN time t ON t.time_id  = fvb.time_id 
                                WHERE t.TAHUN='2001'
                                GROUP BY t.bulan 
                                ORDER BY SUM(fvb.biaya_purchasing) DESC
                                LIMIT 12";
                        $result = mysqli_query($connection, $sql);

                        $labels = array();
                        $data = array();
                        $colors = ['#7cb5ec', '#90ed7d', '#f7a35c', '#8085e9', '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1', '#1aadce', '#434348', '#d35400'];

                        // Process the fetched data
                        $index = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Convert the numeric month to a month name
                            $monthName = DateTime::createFromFormat('!m', $row['bulan'])->format('F');
                            $labels[] = $monthName;
                            $data[] = [
                                'name' => $monthName,
                                'y' => (float)$row['total'],
                                'color' => $colors[$index % count($colors)] // Cycle through colors
                            ];
                            $index++;
                        }
                        ?>

                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header text-uppercase">
                                    Purchasing Cost at 2001
                                </div>
                                <div class="card-body">
                                    <div id="pc2001Container"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Include Highcharts library -->
                        <script src="https://code.highcharts.com/highcharts.js"></script>

                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                // Generate chart using Highcharts
                                Highcharts.chart('pc2001Container', {
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                        type: 'pie'
                                    },
                                    title: {
                                        text: 'Purchasing Cost at 2001'
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                    },
                                    accessibility: {
                                        point: {
                                            valueSuffix: '%'
                                        }
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                            },
                                            showInLegend: true
                                        }
                                    },
                                    series: [{
                                        name: 'Total',
                                        colorByPoint: true,
                                        data: <?php echo json_encode($data); ?>
                                    }]
                                });
                            });
                        </script>


                        <?php
                        // Assuming you have already established the database connection

                        // Fetch the top states from the database
                        $sql = "SELECT t.bulan as bulan, SUM(fvb.biaya_purchasing) as total
                                FROM purchasing fvb
                                JOIN time t ON t.time_id  = fvb.time_id 
                                WHERE t.TAHUN='2002'
                                GROUP BY t.bulan 
                                ORDER BY SUM(fvb.biaya_purchasing) DESC
                                LIMIT 12";
                        $result = mysqli_query($connection, $sql);

                        $labels = array();
                        $data = array();
                        $colors = ['#7cb5ec', '#90ed7d', '#f7a35c', '#8085e9', '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1', '#1aadce', '#434348', '#d35400'];

                        // Process the fetched data
                        $index = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Convert the numeric month to a month name
                            $monthName = DateTime::createFromFormat('!m', $row['bulan'])->format('F');
                            $labels[] = $monthName;
                            $data[] = [
                                'name' => $monthName,
                                'y' => (float)$row['total'],
                                'color' => $colors[$index % count($colors)] // Cycle through colors
                            ];
                            $index++;
                        }
                        ?>

                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header text-uppercase">
                                    Purchasing Cost at 2002
                                </div>
                                <div class="card-body">
                                    <div id="pc2002Container"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Include Highcharts library -->
                        <script src="https://code.highcharts.com/highcharts.js"></script>

                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                // Generate chart using Highcharts
                                Highcharts.chart('pc2002Container', {
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                        type: 'pie'
                                    },
                                    title: {
                                        text: 'Purchasing Cost at 2002'
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                    },
                                    accessibility: {
                                        point: {
                                            valueSuffix: '%'
                                        }
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                            },
                                            showInLegend: true
                                        }
                                    },
                                    series: [{
                                        name: 'Total',
                                        colorByPoint: true,
                                        data: <?php echo json_encode($data); ?>
                                    }]
                                });
                            });
                        </script>

                        <?php
                        // Assuming you have already established the database connection

                        // Fetch the top states from the database
                        $sql = "SELECT t.bulan as bulan, SUM(fvb.biaya_purchasing) as total
                                FROM purchasing fvb
                                JOIN time t ON t.time_id  = fvb.time_id 
                                WHERE t.TAHUN='2003'
                                GROUP BY t.bulan 
                                ORDER BY SUM(fvb.biaya_purchasing) DESC
                                LIMIT 12";
                        $result = mysqli_query($connection, $sql);

                        $labels = array();
                        $data = array();
                        $colors = ['#7cb5ec', '#90ed7d', '#f7a35c', '#8085e9', '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1', '#1aadce', '#434348', '#d35400'];

                        // Process the fetched data
                        $index = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Convert the numeric month to a month name
                            $monthName = DateTime::createFromFormat('!m', $row['bulan'])->format('F');
                            $labels[] = $monthName;
                            $data[] = [
                                'name' => $monthName,
                                'y' => (float)$row['total'],
                                'color' => $colors[$index % count($colors)] // Cycle through colors
                            ];
                            $index++;
                        }
                        ?>

                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header text-uppercase">
                                    Purchasing Cost at 2003
                                </div>
                                <div class="card-body">
                                    <div id="pc2003Container"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Include Highcharts library -->
                        <script src="https://code.highcharts.com/highcharts.js"></script>

                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                // Generate chart using Highcharts
                                Highcharts.chart('pc2003Container', {
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                        type: 'pie'
                                    },
                                    title: {
                                        text: 'Purchasing Cost at 2003'
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                    },
                                    accessibility: {
                                        point: {
                                            valueSuffix: '%'
                                        }
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                            },
                                            showInLegend: true
                                        }
                                    },
                                    series: [{
                                        name: 'Total',
                                        colorByPoint: true,
                                        data: <?php echo json_encode($data); ?>
                                    }]
                                });
                            });
                        </script>

                        <?php
                        // Assuming you have already established the database connection

                        // Fetch the top states from the database
                        $sql = "SELECT t.bulan as bulan, SUM(fvb.biaya_purchasing) as total
                                FROM purchasing fvb
                                JOIN time t ON t.time_id  = fvb.time_id 
                                WHERE t.TAHUN='2004'
                                GROUP BY t.bulan 
                                ORDER BY SUM(fvb.biaya_purchasing) DESC
                                LIMIT 12";
                        $result = mysqli_query($connection, $sql);

                        $labels = array();
                        $data = array();
                        $colors = ['#7cb5ec', '#90ed7d', '#f7a35c', '#8085e9', '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1', '#1aadce', '#434348', '#d35400'];

                        // Process the fetched data
                        $index = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Convert the numeric month to a month name
                            $monthName = DateTime::createFromFormat('!m', $row['bulan'])->format('F');
                            $labels[] = $monthName;
                            $data[] = [
                                'name' => $monthName,
                                'y' => (float)$row['total'],
                                'color' => $colors[$index % count($colors)] // Cycle through colors
                            ];
                            $index++;
                        }
                        ?>

                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header text-uppercase">
                                    Purchasing Cost at 2004
                                </div>
                                <div class="card-body">
                                    <div id="pc2004Container"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Include Highcharts library -->
                        <script src="https://code.highcharts.com/highcharts.js"></script>

                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                // Generate chart using Highcharts
                                Highcharts.chart('pc2004Container', {
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                        type: 'pie'
                                    },
                                    title: {
                                        text: 'Purchasing Cost at 2004'
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                    },
                                    accessibility: {
                                        point: {
                                            valueSuffix: '%'
                                        }
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                            },
                                            showInLegend: true
                                        }
                                    },
                                    series: [{
                                        name: 'Total',
                                        colorByPoint: true,
                                        data: <?php echo json_encode($data); ?>
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">UAS Data Warehouse dan Olap &copy; Kelompok 7</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>