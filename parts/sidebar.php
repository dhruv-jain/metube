<?php require ('cloud.php'); ?>

<div class=" container">
        <nav class="navbar navbar-default sidebar" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="browse.php">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Media Types <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-headphones"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="images.php">Images</a></li>
            <li class="divider"></li>
            <li><a href="audios.php">Music</a></li>
            <li class="divider"></li>
            <li><a href="graphics.php">Graphics</a></li>
               <li class="divider"></li>
            <li><a href="blocked_media.php">Blocked Media</a></li>
			<li class="divider"></li>
			<li><a href="favourite_media.php">Favourite Media</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories<span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-facetime-video"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="shows.php">TV Shows</a></li>
            <li class="divider"></li>
            <li><a href="movies.php">Movies</a></li>
            <li class="divider"></li>
            <li><a href="sports.php">Sports</a></li>
            <li class="divider"></li>
            <li><a href="news.php">News</a></li>
            <li class="divider"></li>
            <li><a href="others.php">Others</a></li>
          </ul>
        </li>
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Channel<span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="myChannel.php">My Channel</a></li>
            <li class="divider"></li>
            <li><a href="browse_channel.php">Explore Channels</a></li>
            <li class="divider"></li>
            <li><a href="create_channel.php">Create Channel</a></li>
          </ul>
        </li> 
        <li ><a href="mySubscribe.php">My Subscriptions<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-circle-arrow-down"></span></a></li>        
        <li ><a href="inbox.php">Messages<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a></li>
          <li ><a href="recently_uploaded.php">Recently Uploaded Media<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-time"></span></a></li>
          <li ><a href="most_viewed.php">Most Viewed Media<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-signal"></span></a></li>
          
           <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Playlist<span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-volume-up"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="myPlaylist.php">My Playlist</a></li>
            <li class="divider"></li>
            <li><a href="create_playlist.php">Create Playlist</a></li>
               <li class="divider"></li>
            <li><a href="associate_media_playlist.php">Associate Media</a></li>
          </ul>
        </li> 
          
           <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Group<span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-sunglasses"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="myGroup.php">My Group</a></li>
            <li class="divider"></li>
            <li><a href="create_group.php">Create Group</a></li>
          </ul>
        </li> 
          
          
      </ul>
    </div>
  </div>
</nav>
    
      
       
</div>
       


 <?php
$result = getKeywords();

for($i=0; $i<count($result); $i++){
	$keywords[] =($result[$i]);
//    echo $keywords[$i];
}

$words = implode(" , ",$keywords);
//echo $words;



$text_content = $words;

$cloud = new PTagCloud(15);
$cloud->addTagsFromText($text_content);
$cloud->setWidth("300px");
echo $cloud->emitCloud();

?>
      