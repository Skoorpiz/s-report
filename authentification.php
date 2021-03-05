<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style>
    .form-control {
        border-radius: 0px;
        margin: 12px 3px;
        height: 40px;
    }

    .logo {
        text-align: center;
        padding-top: 20%;
    }

    /*footer*/
    .footer a {
        color: #000;
        text-decoration: none;
    }

    .footer {
        color: #000;
        text-align: center;
    }

    /*footer end*/


    /*for logintemplate blue*/
    .grayBody {
        background-color: #E9E9E9;
    }

    .loginbox {
        margin-top: 5%;
        border-top: 6px solid #0088D8;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 10px 10px -2px rgba(0, 0, 0, 0.12), 0 -2px 10px -2px rgba(0, 0, 0, 0.12);
    }

    .singtext {
        font-size: 28px;
        color: #0088D8;
        font-weight: 500;
        letter-spacing: 1px;
    }

    .submitButton {
        background-color: #0088D8;
        color: #fff;
        margin-top: 12px;
        margin-bottom: 10px;
        padding: 10px 0px;
        width: 100%;
        margin-left: 2px;
        font-size: 16px;
        border-radius: 0px;
        outline: none;
    }

    .submitButton:hover, .submitButton:focus {
        color: #fff;
        outline: none;
    }

    .forGotPassword {
        background-color: #F2F2F2;
        padding: 15px 0px;
        text-align: center;

    }

    .forGotPassword:hover {
        box-shadow: 0 10px 10px -2px rgba(0, 0, 0, 0.12);
    }

    .forGotPassword a {
        color: #000;
        outline: none;
    }

    .forGotPassword a:hover, .forGotPassword a:active, .forGotPassword a:focus {
        text-decoration: none;
        outline: none;
    }
</style>
<form action="script/traitementAuthentification.php" method="post">
    <div class="container">
        <div class="col-lg-4 col-md-3 col-sm-2"></div>
        <div class="col-lg-4 col-md-6 col-sm-8">
            <div class="logo">
                <img src="/edsa-s-report/images/syga_logo.gif" alt="Logo">
            </div>
            <div class="row loginbox">
                <div class="col-lg-12">
                    <span class="singtext">Authentification </span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <input name="courriel" class="form-control" type="text" placeholder="Courriel" required>
                </div>
                <div class="col-lg-12  col-md-12 col-sm-12">
                    <input name="mdp" class="form-control" type="password" placeholder="Mot de passe" required>
                </div>
                <div class="col-lg-12  col-md-12 col-sm-12">
                    <button type="submit" class="btn submitButton"> Envoyer</button>
                </div>

            </div>
        </div>
    </div>
</form>