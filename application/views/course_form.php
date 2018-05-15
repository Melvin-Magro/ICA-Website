<?="NB. Please use course level 1 for part-time courses."?>
<br><br><br>
<?=form_open($properties['action'], NULL, $properties['hidden'])?>
<?=form_error('form')?>
  <?php foreach ($form as $key => $input):?>
    <div>
      <?=form_error($key);?>
      <?=form_label($key.':', $input['id']);?>
      <?=form_input($input);?>
    </div>
  <?php endforeach;?>
  <?=form_submit(null, "Submit")?>
<?=form_close()?>
