<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["user"]) || $_SESSION["user"] !== true){
    header("location: signin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <title>Admins | AcciAware</title>
    <script src="../../js/passwordMatch.js" defer></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="welcome.php">AcciAware</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <section class="vh-200" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                    <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Report a Case</p>
                        <form class="mx-1 mx-md-4" method="POST" enctype="multipart/form-data" action="../../core/operations/CreateCase.php">
                        
                        <input type="hidden" name="registrationnumber" value="<?php echo $_SESSION["registrationnumber"];?>">
                        
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <input type="text" id="name" name="name" class="form-control" required/>
                            <label class="form-label" for="name">Name</label>
                            </div>
                        </div>
                        
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <select id="type" name="type" class="form-control" class="form-control" required>
                                <option value="Minor">Minor</option>
                                <option value="Severe">Severe</option>
                            </select>
                            <label class="form-label" for="type">Type</label>
                            </div>
                        </div>
                        
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            
                            <select id="vehicle" name="vehicle" class="form-control" required>
                                <option value="Motorcycle">Motorcycle</option>
                                <option value="Bus">Bus</option>
                                <option value="Van">Van</option>
                                <option value="Car">Car</option>
                                <option value="SUV">SUV</option>
                                <option value="Lorry">Lorry</option>
                                <option value="Container">Container</option>
                            </select>
                            <label class="form-label" for="vehicle">Vehicle</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <input type="text" id="cause" name="cause" class="form-control" required/>
                            <label class="form-label" for="cause">Cause</label>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <textarea type="text" id="info" name="info" class="form-control" required></textarea>
                            <label class="form-label" for="info">Info</label>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <input type="file" id="image1" name="image1" class="form-control my-2" accept="image/png, image/jpeg, image/gif" required/>
                            <input type="file" id="image2" name="image2" class="form-control my-2" accept="image/png, image/jpeg, image/gif"/>
                            <input type="file" id="image3" name="image3" class="form-control my-2" accept="image/png, image/jpeg, image/gif"/>
                            <input type="file" id="image4" name="image4" class="form-control my-2" accept="image/png, image/jpeg, image/gif"/>
                            <label class="form-label" for="image1">Images</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>

                        </form>

                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</body>

</html>