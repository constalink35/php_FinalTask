<?php
dd('$referal');
if(!empty($_POST["referal"])) { //Принимаем данные

    $referal = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["referal"]))));
    dd($referal);
    $tags = \App\Tag::where('name','like','%$referal%')->get();

    foreach ($tags as $tag) {
        echo "\n<li>" . $tag->name . "</li>";
    }
 }
?>
