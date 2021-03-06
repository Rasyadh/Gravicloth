<!DOCTYPE html>
<html>

<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <meta name="google-signin-client_id" content="599829634564-pv75ra59tp1e6es3ruibr9mdmn0kn7ro.apps.googleusercontent.com">

    <!-- Site Properties -->
    <title>Gravicloth - Custom Clothing IT Brand</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="public/css/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="lib/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="public/css/app.css">

    <script src="public/javascript/jquery.min.js"></script>
    <script src="public/javascript/semantic.min.js"></script>
    
    <script type="text/javascript" src="lib/slick/slick.min.js"></script>
    <script src="public/javascript/banner-carousel.js"></script>
    <script src="public/javascript/following-header.js"></script>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>

<body>

    <div class="pusher">
        <?php 
            include 'config/dbconfig.php';
            include 'config/session.php';

            if (isset($_SESSION['user_session'])){
                $user_id = $_SESSION['user_session'];
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = 'SELECT * FROM user u, user_detail ud WHERE u.id_user=:id_user AND ud.id_user=:user_id';
                $q = $pdo->prepare($sql);
                $q->execute(array(':id_user'=>$user_id, ':user_id'=>$user_id));
                $userInfoRow = $q->fetch(PDO::FETCH_ASSOC);
            }
            
            include 'layout/partials/header.php'; 
        ?>

        <?php 
        $pages_dir = 'layout';
        $category = ['kaos', 'kemeja', 'jaket', 'polo', 'sweatshirt', 'tas', 'celana'];

        if (!empty($_GET['p'])){
            $pages = scandir($pages_dir, 0);
			unset($pages[0], $pages[1]);
 
			$p = $_GET['p'];
            
			if(in_array($p.'.php', $pages)){
				include($pages_dir.'/'.$p.'.php');
			} 
            else if (in_array($p, $category)) {
                $cat_selected = $p;
                include($pages_dir.'/content-category.php');
            }
            else {
				include($pages_dir.'/404.php');
			}
        }
        else {
            include($pages_dir.'/home.php');
        }
        ?>

        <?php 

            include 'layout/partials/social.php';

            include 'layout/partials/footer.php'; ?>
    </div>

<script>
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
        }
</script>
</body>

</html>