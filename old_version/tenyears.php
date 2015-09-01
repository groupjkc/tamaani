<?php
    session_start();
    include('includes/languages/'.$_SESSION['lang'].'.php'); 
    include('includes/config.php');
    include('includes/functions.php');
    
    $text = get_text(5);?>
 
    <div id='inside_content' class="tenyears_page">  
        <div class="tenyears_content_body">
            <div class="title big_title_<?php echo $_SESSION['lang']?>">
                <?php   echo $text['title']; ?>
            </div>
            <?php
                if($text['text_icon'] != '' && file_exists("images/".$text['text_icon'])){
                    echo '<div class="intro_img">';
                    echo '<img src="images/'.$text['text_icon'].'">';
                    echo '</div>';
                } 
            ?>
            <div class="content">
                <?php echo $text['text']?>
            </div>
            
        </div>
        
    </div>
    <script type="text/javascript" src="js/monthly_usage.js" ></script> 