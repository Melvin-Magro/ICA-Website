  <section id="sec1" class="container-fluid">
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
<!-- /container -->

  </body>

</html>
