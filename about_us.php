<?php
session_start();
include('includes/languages/'.$_SESSION['lang'].'.php'); 
include('includes/config.php');
include('includes/functions.php');
	
$text = get_text(2);
$links = get_tenYears_links();
?>

<div id='inside_content' class="white_box">
 
    <div class="left_box">
        <div class="title black" style="font-size:30px; padding-bottom:25px; padding-top:10px;">About Us</div>
        <?php if ( $links ): ?>
            <div class="link_list">
                <?php foreach( $links as $l ): ?>
                    <div class="link_wrapper">
                        <span class="link" data-id="<?php echo $l['id'];?>"><?php echo $l["title_".$_SESSION['lang']]; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <img src="images/<?php echo $text['text_icon']?>" width="260">
        <div style="padding-top: 30px; font-size: 14px;"><?php echo $lang['about_text_des']; ?></div>
    </div>
	
    <div class="right_box">
	
        <div class="main_text active">
            <div class="title black" ><?php echo $text['title']; ?></div>  
            <div class="horizontal_bar" ></div> 
            <?php echo $text['text']; ?> 
        </div>
		
<?php if ( $links ): ?>
<?php foreach( $links as $li ): ?>
		<div class="main_text" data-id="<?php echo $li['id']; ?>">
			<div class="title black"><?php echo $li["title_".$_SESSION['lang']]; ?></div>  
			<div class="horizontal_bar" ></div>
			<div class="content"><?php echo $li["text_".$_SESSION['lang']]; ?></div>
		</div>
<?php endforeach; ?>
<?php endif; ?>                                                          
    </div>
    
</div>

<div class="bottom_shadow"></div>
<script type="text/javascript" src="js/monthly_usage.js" ></script>
<script>
    $(document).ready(function(){
        $(".link").click(function(){
            $(".link").filter(".active").removeClass("active");
            $(".main_text").filter(".active").removeClass("active");
            $(this).addClass("active");
            var id = $(this).data("id");
            $('.main_text').filter('[data-id="'+id+'"]').addClass("active");
        });
    });
</script>
<style>
    .link_list { padding-bottom: 20px;}
    .link_wrapper { padding-bottom: 5px; width: 90%; border-bottom: 1px solid; margin-bottom: 5px;}
    .link { font-size: 18px; text-transform: uppercase; cursor: pointer; }
    .link.active { cursor: auto; color: #0A88C2; }
    .main_text {display: none;}
    .main_text.active {display: block;}
    .content { text-align: justify; padding-top: 20px;}
    .title { text-transform: capitalize;}
</style>