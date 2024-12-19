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
                    <h1 class="mt-4 mb-4">Line Total</h1>
                    <div class="row">
                    <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header text-uppercase">
                                    Line Total Terendah per Tahun
                                </div>
                                <div class="card-body">
                                    <div id="highchartColumnContainer" style="height: 400px;"></div>
                                </div>
                            </div>
                        </div>

                        <?php
                        // Query untuk mendapatkan line total terendah per tahun
                        $sql = "
                            SELECT 
                                t.tahun, 
                                MIN(f.linetotal) AS min_line_total
                            FROM sales f
                            JOIN time t ON t.time_id = f.time_id
                            WHERE t.tahun BETWEEN 2001 AND 2004
                            GROUP BY t.tahun
                            ORDER BY t.tahun ASC;
                        ";

                        $result = mysqli_query($connection, $sql);

                        $years = array();
                        $minLineTotals = array();

                        // Proses hasil query
                        while ($row = mysqli_fetch_assoc($result)) {
                            $years[] = $row['tahun'];
                            $minLineTotals[] = (float)$row['min_line_total'];
                        }
                        ?>
                        <!-- Load Highcharts Library -->
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                Highcharts.chart('highchartColumnContainer', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Line Total Terendah per Tahun (2001-2004)'
                                    },
                                    xAxis: {
                                        categories: <?php echo json_encode($years); ?>,
                                        crosshair: true,
                                        title: {
                                            text: 'Tahun'
                                        }
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: 'Line Total (Minimum)'
                                        }
                                    },
                                    tooltip: {
                                        shared: true,
                                        valuePrefix: 'Rp '
                                    },
                                    plotOptions: {
                                        column: {
                                            pointPadding: 0.2,
                                            borderWidth: 0
                                        }
                                    },
                                    series: [{
                                        name: 'Minimum Line Total',
                                        data: <?php echo json_encode($minLineTotals); ?>,
                                        color: 'rgba(54, 162, 235, 0.7)' // Warna biru
                                    }]
                                });
                            });
                        </script>

                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header text-uppercase">
                                    Line Total Tertinggi per Tahun
                                </div>
                                <div class="card-body">
                                    <div id="highchartColumnContainerMax" style="height: 400px;"></div>
                                </div>
                            </div>
                        </div>

                        <?php
                        // Query untuk mendapatkan line total tertinggi per tahun
                        $sql = "
                            SELECT 
                                t.tahun, 
                                MAX(f.linetotal) AS max_line_total
                            FROM sales f
                            JOIN time t ON t.time_id = f.time_id
                            WHERE t.tahun BETWEEN 2001 AND 2004
                            GROUP BY t.tahun
                            ORDER BY t.tahun ASC;
                        ";

                        $result = mysqli_query($connection, $sql);

                        $yearsMax = array();
                        $maxLineTotals = array();

                        // Proses hasil query
                        while ($row = mysqli_fetch_assoc($result)) {
                            $yearsMax[] = $row['tahun'];
                            $maxLineTotals[] = (float)$row['max_line_total'];
                        }
                        ?>
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                Highcharts.chart('highchartColumnContainerMax', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Line Total Tertinggi per Tahun (2001-2004)'
                                    },
                                    xAxis: {
                                        categories: <?php echo json_encode($yearsMax); ?>,
                                        crosshair: true,
                                        title: {
                                            text: 'Tahun'
                                        }
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: 'Line Total (Maximum)'
                                        }
                                    },
                                    tooltip: {
                                        shared: true,
                                        valuePrefix: 'Rp '
                                    },
                                    plotOptions: {
                                        column: {
                                            pointPadding: 0.2,
                                            borderWidth: 0
                                        }
                                    },
                                    series: [{
                                        name: 'Maximum Line Total',
                                        data: <?php echo json_encode($maxLineTotals); ?>,
                                        color: 'rgba(255, 99, 132, 0.7)' // Warna merah
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