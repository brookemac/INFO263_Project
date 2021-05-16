<?php
include 'partials/loggedIn/header.php'
?>


<?php
require_once "../database/database_client.php";
echo "Start typing to select your event to then view its properties";
?>

    <html>
    <head>
        <script>
            function showProperties(str) {
                if (str == "") {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "getproperties.php?q="+str,true);
                    xmlhttp.send();
                }
            }
        </script>
    </head>
    <body>

    <?php
    $result=mysqli_query($mysqli, "select * from front_event ORDER BY event_name ASC;");
    ?>


    <form>

        <label><input placeholder="Search..." id="name" list="event_name" autocomplete='off' onchange="showProperties(this.value)"/></label>
        <datalist id="event_name" class="dle">
            <?php
            while($row=mysqli_fetch_array($result))
            {
                echo "<option value='$row[event_name]'>$row[event_name]</option>";
            }
            ?>
        </datalist><br><br>


    </form>
    <br>
    <div id="txtHint"><b></b></div>
    </body>
    </html>

    <script>

        var input = document.querySelector("#name"),
            datalist = document.querySelector("datalist");

        input.addEventListener("keyup", (e) => {

            if (e.target.value.length >= 3) {
                datalist.setAttribute("id", "event_name");
            } else {
                datalist.setAttribute("id", "");
            }
        });

    </script>

<?php
mysqli_close($mysqli);
?>



<?php
include 'partials/loggedIn/footer.php'
?>