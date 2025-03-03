<?php
// functions.php ファイルを読み込み
require_once('functions.php');

// データベースに接続
$pdo = connectDB();

// $images が null の場合、空の配列で初期化
$images = $images ?? [];
$err_msg = $err_msg ?? ""; // $err_msg が null の場合、空の文字列で初期化

// POST メソッドでない場合
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // 画像を取得
    $sql = 'SELECT * FROM rakugaki_images ORDER BY created_at DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $images = $stmt->fetchAll();

} else {
    // 画像を保存
    if (!empty($_FILES['image']['name'])) {

        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $content = file_get_contents($_FILES['image']['tmp_name']);
        $size = $_FILES['image']['size'];
        $comment = isset($_POST['comment']) ? $_POST['comment'] : '';
        $hashtag = isset($_POST['hashtag']) ? $_POST['hashtag'] : ''; // ハッシュタグの追加

        // 画像のサイズ・形式チェック
        $maxFileSize = 1048576;
        $validFileTypes = ['image/png', 'image/jpeg'];
        if ($size > $maxFileSize || !in_array($type, $validFileTypes)) {
            $err_msg = '* jpg, jpeg, png 形式で 1 MB までの画像を選択してください。';
        }

        if ($err_msg == '') {
            // 画像情報をデータベースに挿入
            $sql = 'INSERT INTO rakugaki_images(image_name, image_type, image_content, image_size, image_comment, image_hashtag, created_at)
            VALUES (:image_name, :image_type, :image_content, :image_size, :image_comment, :image_hashtag, now())';
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
            $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
            $stmt->bindValue(':image_comment', $comment, PDO::PARAM_STR);
            $stmt->bindValue(':image_hashtag', $hashtag, PDO::PARAM_STR); // ハッシュタグのバインド
            $stmt->bindValue(':image_size', $size, PDO::PARAM_INT);
            $stmt->execute();

            // 画像リストページにリダイレクト
            header('Location: list.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Image Test</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="shortcut icon" href="../images/title.PNG" type="image/x-icon">
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<?php include("../components/post_nav.php"); ?>
<div class="container mt-5">
    <div class="row">
        <div>
            <img src="https://blueimp.github.io/jQuery-File-Upload/" alt="">
            <ul class="list-unstyled">
                <?php for ($i = 0; $i < count($images); $i++): ?>
                    <li class="media mt-5">
                        <a href="#lightbox" data-toggle="modal" data-slide-to="<?= $i; ?>">
                            <img src="image.php?id=<?= $images[$i]['image_id']; ?>" width="100" height="auto" class="mr-3">
                        </a>
                        <div class="media-body">
                            <h5><?= $images[$i]['image_name']; ?> (<?= number_format($images[$i]['image_size'] / 1000, 2); ?> KB)</h5>
                            <p><?= $images[$i]['image_comment']; ?></p> <!-- コメントの表示 -->
                            <p><?= $images[$i]['image_hashtag']; ?></p> <!-- ハッシュタグの表示 -->
                            <a href="javascript:void(0);" 
                               onclick="var ok = confirm('削除しますか？'); if (ok) location.href='delete.php?id=<?= $images[$i]['image_id']; ?>'">
                              <i class="far fa-trash-alt"></i> 削除</a>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
        <div>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>画像を選択</label>
                    <input type="file" name="image" accept=".jpg,.jpeg,.png" required>
                    <?php if ($err_msg != ''): ?>
                        <div class="invalid-feedback d-block"><?= $err_msg; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <input type="text" name="comment" placeholder="作品のコメント">
                </div>
                <div class="form-group">
                    <input type="text" name="hashtag" placeholder="タグ付け 例:#オリキャラ">
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>
</div>

<div class="modal carousel slide" id="lightbox" tabindex="-1" role="dialog" data-ride="carousel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-body">
        <ol class="carousel-indicators">
            <?php for ($i = 0; $i < count($images); $i++): ?>
                <li data-target="#lightbox" data-slide-to="<?= $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>></li>
            <?php endfor; ?>
        </ol>
        <div class="carousel-inner">
            <?php for ($i = 0; $i < count($images); $i++): ?>
                <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>">
                  <img src="image.php?id=<?= $images[$i]['image_id']; ?>" class="d-block w-100">
                </div>
            <?php endfor; ?>
        </div>
        <a class="carousel-control-prev" href="#lightbox" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#lightbox" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
