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
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="Bootstrap 5 logo" class="d-inline-block align-top" width="56" height="56"></a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Notification</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                          ユーザ
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li>
                            <a class="dropdown-item" href="user.php"><img src="images/userpic.png" class="settings-icons">ユーザ</a>
                        </li>
                          <li>
                            <a class="dropdown-item" href="#"><img src="images/usersetting.png" class="settings-icons">個人情報</a>
                        </li>
                          <li><hr class="dropdown-divider"></li>
                          <li>
                            <a class="dropdown-item" href="help.php">
                                <img src="images/help.png" class="settings-icons">ヘルプ</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="login.php"><img src="images/logout.png" class="settings-icons">ログアウト</a>
                        </li>
                        </ul>
                      </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="検索。。。" aria-label="Search">
                    <button><img src="images/search.png" alt=""></button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <!--left sidebar-->
        <div class="left-sidebar">
            <div class="event-bar">
                <div class="eventbar-title">
                    <h4>エベント</h4>
                    <a href="#">See All</a>
                </div>
                <div class="event">
                    <div class="left-event">
                        <h3>18日(水)</h3>
                        <span>12月</span>
                    </div>
                    <div class="right-event">
                        <h4>今月タイプ</h4>
                        <p>白黒</p>
                        <a href="#">More Info</a>

                    </div>

                </div>
            </div>

            <div class="imp-links">
                <a href="#"><img src="images/new.png" alt="">新作品</a>
                <a href="#"><img src="images/famous.png" alt="">大人気</a>
                <a href="#"><img src="images/follow.png" alt="">フォロー中</a>
                <a href="#"><img src="images/save.png" alt="">保存</a>
                <a href="#">See More</a>

            </div>
            <div class="shortcut-links">
                <p>作品のタイプ</p>
                <a href="#"><img src="images/type1.png" alt="">aaaaa</a>
                <a href="#"><img src="images/type2.png" alt="">bbbbb</a>
                <a href="#"><img src="images/type3.png" alt="">cccc</a>

            </div>
        </div>


        <!--main content-->
        <div class="main-content">
            <div class="write-post-container">
                <div class="user-profile">
                    <img src="images/profile..jpg">
                    <div>
                        <p>株式会社烈丸</p>
                    </div>
                </div>

                <div class="post-input-container">
                    <textarea rows="3" placeholder="今日何を描いたの? 株式会社烈丸"></textarea>
                    <div class="add-post-links">
                        <a href="#"><img src="images/logo.png" alt="">落書き</a>
                    </div>
                </div>
            </div>

            <div class="post-container">
                <div class="left-post-contents">
                    <div class="user-profile">
                        <img src="images/cat-01.jpg">
                        <div>
                            <p>猫</p>
                        </div>
                    </div>
                </div>
                <p class="post-text">初めてのきらくがきです。<a href="#">#新タイプ</a> </p>
                <img src="images/cat-02.jpg" class="post-img">

                <div class="post-row">
                    <div class="activity-icons">
                        <div><img src="images/saw.png">1234</div>
                        <button id="likeButton">
                            <img src="images/fire.png">
                        </button>  
                        <span id = "likeCount">0</span>
                    </div>
                </div>
            </div>

            <div class="post-container">
                <div class="left-post-contents">
                    <div class="user-profile">
                        <img src="images/dog-01.jpg">
                        <div>
                            <p>犬のお回り</p>
                        </div>
                    </div>
                </div>
                <p class="post-text">初めてのきらくがきです。<a href="#">#新タイプ</a> </p>
                <img src="images/dog-02.jpg" class="post-img">

                <div class="post-row">
                    <div class="activity-icons">
                        <div><img src="images/saw.png">1234</div>
                        <div><img src="images/fire.png">999</div>
                    </div>
                </div>
            </div>

            <div class="post-container">
                <div class="left-post-contents">
                    <div class="user-profile">
                        <img src="images/profile..jpg">
                        <div>
                            <p>株式会社烈丸</p>
                        </div>
                    </div>
                </div>
                <p class="post-text">初めてのきらくがきです。<a href="#">#新タイプ</a> </p>
                <img src="images/backgroundpic.jpg" class="post-img">

                <div class="post-row">
                    <div class="activity-icons">
                        <div><img src="images/saw.png">1234</div>
                        <div><img src="images/fire.png">999</div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>]
    
</body>
</html>