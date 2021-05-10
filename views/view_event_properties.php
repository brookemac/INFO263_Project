<?php
include 'partials/loggedIn/header.php'
?>

<?php
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
    $conn=mysqli_connect("localhost", "root", "cryptic", "info263_front_project");

    if(mysqli_connect_errno())
    {
        echo "Connection Failed".mysqli_connect_error();
    }

    $result=mysqli_query($conn, "select * from front_event");
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

        var input = document.querySelector("#name"), // Selects the input.
            datalist = document.querySelector("datalist"); // Selects the datalist.

        // Adds a keyup listener on the input.
        input.addEventListener("keyup", (e) => {

            // If input value is larger or equal than 2 chars, adding "event_name" on ID attribute.
            if (e.target.value.length >= 3) {
                datalist.setAttribute("id", "event_name");
            } else {
                datalist.setAttribute("id", "");
            }
        });

        // I had to include your doValidate() function otherwise I would get an error while validaing.
        function doValidate() {};
    </script>



<?php
include 'partials/loggedIn/footer.php'
?>