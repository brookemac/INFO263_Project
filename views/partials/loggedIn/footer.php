    </section>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/admin.js"></script>
    <script src="../js/colored.js"></script>
    <script src="../js/waves.min.js"></script>
    <?php
    if (isset($scripts)) {
      foreach($scripts as $script_path) {
         echo '<script src="'.$script_path.'"></script>';
      }
    }
    ?>
</body>
</html>