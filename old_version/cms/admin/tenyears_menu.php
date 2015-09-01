<link href="include/style_admin.css" rel="stylesheet" type="text/css">

<?php
   include "include/session_test.php";
   include "../include/tenyears.php"; //---> functions  
?>

<script type="text/javascript" language="javascript">
  function addTenyear()
  {
    popup('tenyears_add.php?session=<?php echo $session?>&lang=<?php echo $lang?>',900,500);
  }
  function editTenyear(id)
  {
    popup('tenyears_add.php?session=<?php echo $session?>&lang=<?php echo $lang?>&id='+id,900,500);
  }
</script>

<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
<tr valign="top">
  <td colspan="2" height="10"></td>
</tr>

<tr valign="top"> 
    <td width="15" height="25"><img src="images/shim.gif" width="15" height="1"></td> 
    <td> <table width="100%"  border="0" cellspacing="0" cellpadding="0"> 
        <tr> 
          <td width="98%"><span class="titre">ABOUT US SubTexts</span></td> 
          <td width="2%"><img src="./images/<?php echo $lang?>.gif" width="16" height="16" alt="<?php echo $lang_param[$lang]["description"]?>"></td> 
        </tr> 
      </table> 
      </td> 
</tr>
<tr>
  <td colspan="2" height="2" bgcolor="#FF0000"></td>
</tr>
<tr>
  <td colspan="2" style="padding-top: 20px;text-align: center;">
    <?php $res = getTenyearsContent(); ?>
    <?php if ( array() != $res ): ?>
      <table width="100%" align="center" border="0" cellpadding="2" cellspacing="1" class="text">
        <tbody>
          <tr class="tcat">
            <td width="25" class="inactif">#</td>
            <td>Titre En</td>
            <td>Titre Fr</td>
            <td>Titre In</td>
            <td>Order</td>
            <td>Visible</td>
            <td>Action</td>                                             
          </tr>
          <?php $i=1; ?>
          <?php foreach( $res as $row ): ?>
              <tr class="item">
                <td class="vermid"><?php echo $i; $i++; ?></td>
                <td class="vermid"><?php echo $row["title_en"]; ?></td>
                <td class="vermid"><?php echo $row["title_fr"]; ?></td>
                <td class="vermid"><?php echo $row["title_in"]; ?></td>
                <td class="vermid"><?php echo $row["order"]; ?></td>
                <td class="vermid"><?php echo ($row["enabled"] == "1")? "Yes" : "No"; ?></td>
                <td class="vermid"><span class="btc" onClick="javascript: editTenyear(<?php echo $row["id"]; ?>);">Edit</span></td>
              </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
        Please add contents
    <?php endif; ?>
  </td>
</tr>
<tr>
  <td colspan="2" style="padding-top: 20px; text-align: center;">
    <div style="cursor:pointer; display: inline-block;" onClick="javascript: addTenyear();">
      <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
        <tr>
          <td width="6"><img src="./images/boutton-gauche.gif" border="0"></td>
          <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">Add</td>
          <td width="7"><img src="./images/boutton-droite.gif" border="0"></td>
        </tr>
      </table>
    </div>
  </td>
</tr>
<tr valign="top">
  <td height="15"></td>
  <td></td>
</tr>
<tr>
  <td height="15"></td>
  <td></td>
</tr>															
</table>
<style>
  .vermid {
    padding-top: 10px;
    padding-bottom: 8px;
  }
  .item {
    background: #E7E7E7;
  }
  .btc {
    font-weight: bold;
    cursor: pointer;
    color: #21536A;
  }
</style>