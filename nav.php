<ul class="nav">
    <li class="nav-item">
        <a class="nav-link active" href="index.php">Home</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categories</a>
        <div class="dropdown-menu">
            <?php
            $query = mysqli_query($db, "select * from Category");
            while($row = mysqli_fetch_array($query)) {
                ?>
                <a class="dropdown-item" href="index.php?cat=<?php echo $row["Name"]; ?>"><?php echo $row['Name']; ?></a>
                <?php
            }
            ?>
        </div>
    </li>
    <?php
    if (empty($_SESSION["login"])) {
        echo("<li class=\"nav-item\">");
        echo("<a href=\"login.php\" class=\"nav-link\">Admin Login</a>");
        echo("</li>");

        echo("<li class=\"nav-item\">");
        echo("<a href=\"readme.php\" class=\"nav-link\">Readme</a>");
        echo("</li>");
    } else {
        echo("<li class=\"nav-item\">");
        echo("<a href=\"login.php\" class=\"nav-link disabled\">Hello, " . $_SESSION["login"] . "!</a>");
        echo("</li>");

        if ($_SESSION["adminType"] == "SuperAdmin") {
            echo("<li class=\"nav-item\">");
            echo("<a href=\"superAdmin.php\" class=\"nav-link\">Admin</a>");
            echo("</li>");
        }

        if ($_SESSION["adminType"] == "CategoryAdmin") {
            echo("<li class=\"nav-item\">");
            echo("<a href=\"categoryAdmin.php\" class=\"nav-link\">Admin</a>");
            echo("</li>");
        }

        echo("<li class=\"nav-item\">");
        echo("<a href=\"logout.php\" class=\"nav-link\">Logout</a>");
        echo("</li>");

        echo("<li class=\"nav-item\">");
        echo("<a href=\"readme.php\" class=\"nav-link\">Readme</a>");
        echo("</li>");
    }
    ?>
</ul>