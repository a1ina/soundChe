<?php

require_once("../init.php");
require_once ("../configuration.php");

$api_id = '4069648'; // Insert here id of your application
$vk_id = '40704529'; // Insert here you vk id

$VK = new vkapi($api_id, $vk_id);
$conf = new JConfig();

$resp = $VK->api('audio.getAlbums',
    array('owner_id' => '-68459439')
);

$db = mysqli_connect($conf->host, $conf->user, $conf->password, $conf->db) or (mysqli_error($db_connect));
mysqli_query($db, 'SET NAMES `utf8`'); // set db charset UTF-8
mysqli_query($db, "DELETE FROM bzyon_vkmusic_albums") or die (mysqli_error($db_connect));

foreach ($resp->album as $item){
    $title = $item->title;
    $aid = $item->album_id;
//        echo $title.'</br>'. $aid;
    mysqli_query($db,"INSERT INTO bzyon_vkmusic_albums (title,aid) VALUE ('".mysqli_escape_string($db,$title)."','".mysqli_escape_string($db,$aid)."')") or die (mysqli_error($db));
}
mysqli_close($db);
