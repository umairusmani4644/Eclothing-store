<?php
$adver_obj = mysqli_query($conms, "SELECT * FROM advertise WHERE size='2' OR size='3' ORDER BY RAND() LIMIT 3");

$advertise = array();

while ($ad = mysqli_fetch_array($adver_obj)) {
  $advertise[] = $ad;
}

?>

<?php if(isset($advertise[0])): ?>

<?php if($advertise[0]['type'] == '1'){ ?>
<a href="<?php echo $advertise[0]['link']; ?>" target="_blank">
  <div class="hidden-sm hidden-xs"> 
<div class="ad" style="border: 1px # solid; margin-bottom:15px; margin-top:15px; width: 100%;">
<img src="<?php echo $baseurl; ?>/ad/<?php echo $advertise[0]['body']; ?>" style="width:100%;">
</div>
</div>
</a>
<?php } else { ?>
  <?php echo $advertise[0]['body']; ?>
<?php } ?>

<?php endif; ?>

<?php if(isset($advertise[1])): ?>
<?php if($advertise[1]['type'] == '1'){ ?>
<a href="<?php echo $advertise[1]['link']; ?>" target="_blank">
  <div class="hidden-sm hidden-xs"> 
<div class="ad" style="border: 1px # solid; margin-bottom:15px; margin-top:15px; width: 100%;">
<img src="<?php echo $baseurl; ?>/ad/<?php echo $advertise[1]['body']; ?>" style="width:100%;">
</div>
</div>
</a>
<?php } else { ?>
  <?php echo $advertise[1]['body']; ?>
<?php } ?>

<?php endif; ?>

<?php if(isset($advertise[2])): ?>

<?php if($advertise[2]['type'] == '1'){ ?>
<a href="<?php echo $advertise[2]['link']; ?>" target="_blank">
  <div class="hidden-sm hidden-xs"> 
<div class="ad" style="border: 1px # solid; margin-bottom:15px; margin-top:15px; width: 100%;">
<img src="<?php echo $baseurl; ?>/ad/<?php echo $advertise[2]['body']; ?>" style="width:100%;">
</div>
</div>
</a>
<?php } else { ?>
  <?php echo $advertise[2]['body']; ?>
<?php } ?>

<?php endif; ?>