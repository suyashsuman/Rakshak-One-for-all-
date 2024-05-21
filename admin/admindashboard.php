<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if (!isset($_SESSION['adminSession'])) {
    header("Location: ../index.php");
}
$usersession = $_SESSION['adminSession'];
$res = mysqli_query($con, "SELECT * FROM `admin` WHERE adminId='$usersession'");
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

?>
<!-- update -->
<?php
if (isset($_POST['submit'])) {
	//variables
	$adminId = $_POST['adminId'];
	$password = $_POST['password'];
	
	$res = mysqli_query($con, "UPDATE admin SET adminId='$adminId', password='$password'");
	// $userRow=mysqli_fetch_array($res);
    $_SESSION['adminSession']=$adminId;
	header('Location: admindashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Welcome Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
</head>

<body>


    <!-- Navigation -->
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="admindashboard.php">Welcome
            <?php echo $usersession; ?>
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="admindashboard.php">
                                <span data-feather="file" class="align-text-bottom"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admindoctor.php">
                                <span data-feather="user" class="align-text-bottom"></span>
                                Manage doctor
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="adminhospital.php">
                                <span data-feather="heart" class="align-text-bottom"></span>
                                Manage Hospital
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="adminpatient.php">
                                <span data-feather="file-plus" class="align-text-bottom"></span>
                                Manage Patient
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-uppercase">
                        <span>More options</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle" class="align-text-bottom"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">

                        <li class="nav-item">
                            <a class="nav-link" href="admincontact.php">
                                <span data-feather="mail"></span>
                                Messages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="adminquestion.php">
                                <span data-feather="help-circle"></span>
                                Manage Question
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php?logout">
                                <span data-feather="log-out"></span>
                                Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- navigation end -->
            <!-- <div class="container-fluid"> -->


            <!-- Page Heading -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>
                <!-- Page Heading end-->
                <!-- Appointment list -->
                <h2 class="my-4">Manage Admin Credentials</h2>
                <div class="row my-4">
                    <div class="col-md-4 my-2">
                        <div class="card text-center" style="width: 14rem; height:23rem;">
                            <img src="assets/img/1.jpg" class="card-img-top" style="height: 225px; width: 220px; " alt="image for this category">
                            <div class="card-body">
                                <h5 class="card-title">Administrator</h5>
                                <p class="card-text">Admin</p>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Change Credentials</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="myModalLabel">Manage Credentials</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<!-- form start -->
									<form action="<?php $_PHP_SELF ?>" method="post">
										<table class="table table-hover table-bordered">
											<tbody>
												<tr>
													<td>Login Id:</td>
													<td><input type="text" class="form-control" name="adminId" value="<?php echo $usersession; ?>" /></td>
												</tr>
												<tr>
													<td>Password</td>
													<td><input type="text" class="form-control" name="password" value="<?php echo $userRow['password']; ?>" /></td>
												</tr>
											</tbody>
										</table>
										<input type="submit" name="submit" class="btn btn-success my-2 ms-2" value="Update Info">
									</form>
								</div>
							</div>
						</div>
					</div>
                
            </main>
        </div>

    </div>
    <!-- Bootstrap Core JavaScript -->

    
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="dashboard.js"></script>
</body>

</html>