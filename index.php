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
                    <h1 class="mt-4 mb-4">DASHBOARD</h1>
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1 text-center">
                                                Total Biaya Purchasing </div>
                                                    <?php
                                                    $sql = "SELECT SUM(Biaya_purchasing) AS total_pembelian FROM purchasing";
                                                    $result = mysqli_query($connection, $sql);
                                                    $row = mysqli_fetch_assoc($result);
                                                    $totalPembelian = $row['total_pembelian'];
                                                    ?>
                                                    <div class="h5 mb-0 font-weight-bold text-primary text-center"><?php echo number_format($totalPembelian); ?></div>
                                        </div>
                                        <!-- <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1 text-center">
                                                Total Jumlah Produk</div>
                                                <?php
                                                    $sql = "SELECT SUM(ProductId) AS total_product FROM purchasing";
                                                    $result = mysqli_query($connection, $sql);
                                                    $row = mysqli_fetch_assoc($result);
                                                    $totalHarga = $row['total_product'];
                                                    ?>
                                                    <div class="h5 mb-0 text-primary text-center"><?php echo number_format($totalHarga); ?></div>
                                        </div>
                                        <!-- <div class="col-auto">
                                            <i class="fas fa-chart-area fa-2x text-gray-300"></i>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1 text-center">
                                                Total Sales
                                            </div>
                                                <?php
                                                    $sql = "SELECT COUNT(linetotal) AS total FROM sales";
                                                    $result = mysqli_query($connection, $sql);
                                                    $row = mysqli_fetch_assoc($result);
                                                    $totalVendor = $row['total'];
                                                    ?>
                                                    <div class="h5 mb-0 text-primary text-center"><?php echo number_format($totalVendor); ?></div>
                                        </div>
                                        <!-- <div class="col-auto">
                                            <i class="fas fa-chart-area fa-2x text-gray-300"></i>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center text-center">
                                        <div class="col mr-2 text-center text-uppercase mb-1">
                                            Total Terrtitory
                                        </div>
                                        <?php
                                            $sql = "SELECT COUNT(TerritoryID) AS total FROM dim_teritori";
                                            $result = mysqli_query($connection, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                            $totalVendor = $row['total'];
                                            ?>
                                            
                                                
                                            <div class="h5 mb-0 text-primary text-center"><?php echo $totalVendor; ?>
                                            </div>
                                            
                                        <!-- <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    name: 'Biaya Purchasing',
                                    data: <?php echo json_encode($seriesData); ?> // Data dari PHP
                                }]
                            });
                        });
                        </script>


                        <!-- HTML code for the chart -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header text-uppercase">
                                    Top Vendors
                                </div>
                                <div class="card-body">
                                    <div id="topVendorsChart" style="width: 100%; height: 450px;"></div>
                                </div>
                            </div>
                        </div>

                        <?php
                            // Fetch the top vendors from the database
                            $sql = "SELECT dv.Name AS nama_vendor, COUNT(fvb.VendorID) as total_pembelian
                                    FROM purchasing fvb
                                    JOIN dim_vendor dv ON dv.VendorID = fvb.VendorID
                                    GROUP BY dv.Name
                                    ORDER BY COUNT(fvb.VendorID) DESC
                                    LIMIT 5";
                            $result = mysqli_query($connection, $sql);

                            $categories = [];
                            $seriesData = [];

                            while ($row = mysqli_fetch_assoc($result)) {
                                $categories[] = $row['nama_vendor'];
                                $seriesData[] = (int)$row['total_pembelian']; // Pastikan tipe data integer
                            }
                        ?>


                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                Highcharts.chart('topVendorsChart', {
                                    chart: {
                                        type: 'bar',
                                        height: 500 // Tinggi grafik dalam piksel
                                    },
                                    title: {
                                        text: ''
                                    },
                                    xAxis: {
                                        categories: <?php echo json_encode($categories); ?>, // Nama vendor dari PHP
                                        title: {
                                            text: 'Vendors'
                                        }
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: 'Total Purchases'
                                        },
                                        labels: {
                                            overflow: 'justify'
                                        }
                                    },
                                    tooltip: {
                                        valueSuffix: ' purchases'
                                    },
                                    plotOptions: {
                                        bar: {
                                            dataLabels: {
                                                enabled: true
                                            }
                                        }
                                    },
                                    series: [{
                                        name: 'Total Purchases',
                                        data: <?php echo json_encode($seriesData); ?> // Data pembelian dari PHP
                                    }]
                                });
                            });
                        </script>
                        <!-- HTML code for the chart -->
                        <div class="col-xl-6">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <h6 class="text-uppercase">Top 5 Territory Sales in 2003</h6>
                                </div>
                                <div class="card-body">
                                    <div id="highchartPieContainer" style="height: 400px;"></div>
                                </div>
                            </div>
                        </div>

                        <?php
                            // Assuming you have already established the database connection

                            // Fetch the top cities based on the total amount of purchases
                            $sql = "SELECT dt.Name as name, SUM(f.linetotal) as total
                                    FROM sales f
                                    JOIN dim_teritori dt ON dt.TerritoryID = f.TerritoryID
                                    JOIN time t ON t.time_id = f.time_id
                                    WHERE t.TAHUN='2003'
                                    GROUP BY dt.Name
                                    ORDER BY SUM(f.linetotal) DESC
                                    LIMIT 5";

                            $result = mysqli_query($connection, $sql);

                            $data = array();

                            // Process the fetched data into Highcharts format
                            while ($row = mysqli_fetch_assoc($result)) {
                                $data[] = array(
                                    'name' => $row['name'],
                                    'y' => (float) $row['total'] // Ensure the total is a float
                                );
                            }
                        ?>

                        <!-- Load Highcharts Library -->
                        <script src="https://code.highcharts.com/highcharts.js"></script>
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                // Highcharts configuration
                                Highcharts.chart('highchartPieContainer', {
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                        type: 'pie'
                                    },
                                    title: {
                                        text: ''
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
                                                enabled: false
                                            },
                                            showInLegend: true
                                        }
                                    },
                                    series: [{
                                        name: 'Sales',
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

                        // Process the fetched data
                        while ($row = mysqli_fetch_assoc($result)) {
                            $labels[] = $row['bulan'];
                            $data[] = [
                                'name' => $row['bulan'],
                                'y' => (float)$row['total']
                            ];
                        }
                        ?>


                        <!-- HTML code for the chart -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header text-uppercase">
                                    Purchasing Cost at 2003
                                </div>
                                <div class="card-body">
                                    <div id="highchartsContainer"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Include Highcharts library -->
                        <script src="https://code.highcharts.com/highcharts.js"></script>

                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                // Generate chart using Highcharts
                                Highcharts.chart('highchartsContainer', {
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                        type: 'pie'
                                    },
                                    title: {
                                        text: ''
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



                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header text-uppercase">
                                    Line Total Terendah pada Tahun 2003
                                </div>
                                <div class="card-body">
                                    <div id="highchartColumnContainer" style="height: 400px;"></div>
                                </div>
                            </div>
                        </div>

                        <?php
                            // Query untuk mengambil data dari database
                            $sql = "SELECT
                                    dt.group as kelompok,
                                    SUM(CASE WHEN t.bulan = 1 THEN f.linetotal ELSE 0 END) AS january_total,
                                    SUM(CASE WHEN t.bulan = 2 THEN f.linetotal ELSE 0 END) AS february_total,
                                    SUM(CASE WHEN t.bulan = 3 THEN f.linetotal ELSE 0 END) AS march_total
                                    FROM sales f
                                    JOIN dim_teritori dt ON dt.TerritoryID = f.TerritoryID 
                                    JOIN time t ON t.time_id = f.time_id 
                                    WHERE t.tahun = 2003 AND t.bulan BETWEEN 1 AND 3
                                    GROUP BY dt.group;";
                            $result = mysqli_query($connection, $sql);

                            $labels = array();
                            $januari = array();
                            $februari = array();
                            $march = array();

                            // Proses hasil query
                            while ($row = mysqli_fetch_assoc($result)) {
                                $labels[] = $row['kelompok'];
                                $januari[] = (float)$row['january_total'];
                                $februari[] = (float)$row['february_total'];
                                $march[] = (float)$row['march_total'];
                            }
                        ?>

                        <!-- Load Highcharts Library -->
                        <script src="https://code.highcharts.com/highcharts.js"></script>
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                Highcharts.chart('highchartColumnContainer', {
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
                                        categories: <?php echo json_encode($labels); ?>,
                                        crosshair: true,
                                        title: {
                                            text: 'Groups'
                                        }
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: 'Line Total'
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
                                    series: [
                                        {
                                            name: 'January',
                                            data: <?php echo json_encode($januari); ?>,
                                            // color: 'rgba(255, 99, 132, 0.7)' // Merah
                                        },
                                        {
                                            name: 'February',
                                            data: <?php echo json_encode($februari); ?>,
                                            // color: 'rgba(54, 162, 235, 0.7)' // Biru
                                        },
                                        {
                                            name: 'March',
                                            data: <?php echo json_encode($march); ?>,
                                            // color: 'rgba(255, 206, 86, 0.7)' // Kuning
                                        }
                                    ]
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