<?php
require_once './POST/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/titlelogo.png" type="image/x-icon">
    <title>きらくがき</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="./images/title.PNG" type="image/x-icon">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
<?php include("./components/nav.php"); ?>
    <?php include("./components/aside.php"); ?>
<!-- main content -->
<div class="main-content">
    <div class="write-post-container d-grid gap-2">
        <a href="./POST/list.php" class="btn btn-primary btn-lg">らくがき投稿</a>
    </div>

    <?php
    // データベースに接続
    $pdo = connectDB();

    // 画像を取得
    $sql = 'SELECT * FROM rakugaki_images ORDER BY created_at DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $images = $stmt->fetchAll();
    ?>

    <!-- 画像表示 -->
    <?php foreach ($images as $image): ?>
        <div class="post-container">
            <div class="left-post-contents">
                <div class="user-profile">
                    <img src="images/cat-01.jpg"><!-- ユーザーのアイコン -->
                    <div>
                        <p class="user-text"><?= $image["created_at"]; ?></p><!-- ユーザーネーム -->
                            
                    </div>
                </div>
            </div>
            <!-- 投稿テキスト表示 -->
            <p class="post-text"><?= $image['image_comment']; ?><a href="#"><?= $image['image_hashtag']; ?></a></p>
            
            <!-- データベースから取得した画像を表示 -->
            <img src="data:image/<?= $image['image_type']; ?>;base64,<?= base64_encode($image['image_content']); ?>" class="post-img">
        
        </div>
    <?php endforeach; ?>
</body>
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>