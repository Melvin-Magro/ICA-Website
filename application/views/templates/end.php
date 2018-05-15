<div class="cont">
  <section id="sec1">
    <div class="row">

<?php foreach($nav as $col):?>
      <div class="col-md-3">
        <ul>
<?php foreach ($col as $page => $url): ?>
          <li><?=anchor($url, $page)?></li>
<?php endforeach ?>
        </ul>
      </div>
<?php endforeach?>

    </div>
  </section>
</div>
<!-- /container -->

  </body>

</html>
