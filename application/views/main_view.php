<?php
if (!$_SESSION['isauth']) {
    header("location:/".login); //переадресация на страницу входа
    exit();
} else {
    echo "<p>".$data['header']."</p>";
    if (strcmp($_SESSION['userrole'],"vk")==0) {
        echo"<img src=\"".$data['img']."\">";
    }
}
