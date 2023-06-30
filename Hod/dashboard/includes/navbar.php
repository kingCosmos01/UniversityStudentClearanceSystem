<div class="nabvar">
    <div class="wrapper">
        <div class="left">
            <h4>Hod Dashboard</h4>
        </div>
        <div class="right">
            <p class="dropDown" id="dropDown">
               <?php

                    if(isset($_SESSION['hod']))
                    {
                        echo "<b>" . "Hi, " . $_SESSION['hod'] . "</b>";
                    }

               ?>

                <span></span>
                <span></span>
            </p>
        </div>
    </div>
</div>